<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAttemptRequest;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Requests\VerifyContactChannelRequest;
use App\Http\Resources\ContactVerificationResource;
use App\Http\Resources\UserAuthenticatedResource;
use App\Http\Resources\UserResource;
use App\Models\ContactChannelVerificationCode;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{

    /**
     * @param LoginAttemptRequest $request
     * @return UserAuthenticatedResource
     * @throws AuthorizationException
     */
    public function createToken(LoginAttemptRequest $request): UserAuthenticatedResource
    {


        $email = $request->input('email');
        $password = $request->input('password');


        $response = Http::post(config('app.url') . '/api/oauth/token', [
            'grant_type' => 'password',
            'client_id' => env('OAUTH_CLIENT_ID'),
            'client_secret' => env('OAUTH_CLIENT_SECRET'),
            'username' => $email,
            'password' => $password,
            'scope' => '',
        ])->json();

        if (isset($response['error'])) {
            throw new AuthorizationException;
        }



        $user = User::where('email', $email)->first();
        $response['user'] = $user;


        return new UserAuthenticatedResource($response);

    }


    /**
     * @param UserRegistrationRequest $request
     * @return UserResource
     */
    public function register(UserRegistrationRequest  $request): UserResource
    {

        $request->merge(
          ['password' => Hash::make($request->input('password'))]
        );
        $user = User::create($request->input());


      //  ContactChannelVerificationCode::generate($user, ContactChannelVerificationCode::EMAIL);


        return new UserResource($user);

    }


    /**
     * @param VerifyContactChannelRequest $request
     * @return ContactVerificationResource
     */
    public function verifyChannel(VerifyContactChannelRequest $request): ContactVerificationResource
    {

        $user = $request->user();
        $channelType = $request->input('channel_type');

        $code = $request->input('code');

        return ContactChannelVerificationCode::verify($user, $channelType,  $code);


    }


}
