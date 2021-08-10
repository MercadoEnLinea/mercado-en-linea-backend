<?php

namespace App\Models;

use App\Http\Resources\ContactVerificationResource;
use App\Mail\RequestEmailConfirmation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

/**
 * App\Models\ContactChannelVerificationCode
 *
 * @property int $id
 * @property int $user_id
 * @property string $channel_type
 * @property string $channel
 * @property string $code
 * @property int $used
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ContactChannelVerificationCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactChannelVerificationCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactChannelVerificationCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactChannelVerificationCode whereChannel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactChannelVerificationCode whereChannelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactChannelVerificationCode whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactChannelVerificationCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactChannelVerificationCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactChannelVerificationCode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactChannelVerificationCode whereUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactChannelVerificationCode whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 */
class ContactChannelVerificationCode extends Model
{
    use HasFactory;

    const PHONE = 1;
    const EMAIL = 2;

    protected $fillable = ['user_id', 'channel_type', 'channel', 'code', 'used'];


    public static function verify(User $user, string $channelType, string $code)
    {

        $channelType = $channelType == 'EMAIL' ? self::EMAIL : self::PHONE;


        $channel = $channelType == self::EMAIL ? $user->email : $user->phone;

        $validCode = self::where('channel_type', $channelType)
            ->where('used', false)
            ->where('channel', $channel)
            ->where('code', $code)
            ->where('user_id', $user->id)
            ->first();


        if ($validCode != null) {
            if ($channelType == self::EMAIL) {

                $user->email_verified_at = now();

            } else {
                $user->phone_verified_at = now();
            }

            $user->save();
        }

        return new ContactVerificationResource(['valid' => $validCode != null,
            'channel' => $channel]);


    }

    public static function generate(User $user, int $channelType)
    {

        $code = bin2hex(random_bytes(4));


        $channel = match ($channelType) {
            self::PHONE => $user->phone,
            default => $user->email,
        };


        $channelVerificationCode = self::create(
            ['user_id' => $user->id,
                'channel_type' => $channelType,
                'channel' => $channel,
                'code' => $code,
                'used' => false
            ]
        );


        $channelVerificationCode->send();


    }


    public function send()
    {
        switch ($this->channel_type) {
            case self::PHONE:
                $this->sms();
                break;

            default:
            case self::EMAIL:
                $this->email();
                break;
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function email()
    {

        Mail::to($this->channel)->send(new RequestEmailConfirmation($this->user, $this));

    }

    public function sms()
    {

        try {


            $client = new Client(config('twilio.account'), config('twilio.token'));

            $cellphone = $this->channel;
            $message = $this->code;


            $client->messages->create(
                '+52' . $cellphone,
                [
                    'from' => '+14159650513',
                    'body' => $message,

                ]
            );
        } catch (\Exception $exception) {

        }

    }
}
