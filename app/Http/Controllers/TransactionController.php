<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListRequest;
use App\Http\Requests\TransactionCreateRequest;
use App\Http\Requests\TransactionReviewRequest;
use App\Http\Resources\TransactionCollection;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\TransactionReviewResource;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionReview;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function index(ListRequest  $request)
    {


        $perPage = $request->input('per_page', 10);
        $transactions = Transaction::sorter($perPage, $request->input('order_field'), $request->input('order_direction'));

        return new TransactionCollection($transactions);
    }

    public function purchase(TransactionCreateRequest  $request): TransactionResource
    {

        $buyer_id =$request->user()->id;

        $product = Product::find($request->input('product_id'));

        $request->merge(['seller_id' => $product->seller_id]);
        $request->merge(['buyer_id' => $buyer_id]);

        $transaction = Transaction::create($request->input());



        return new TransactionResource($transaction);
    }


    public function show(Transaction $transaction): TransactionResource
    {

        return new TransactionResource($transaction);
    }

    public function review(TransactionReviewRequest $request, Transaction $transaction)
    {
        $loggedUser = $request->user();


        $request->merge(['transaction_id' => $transaction->id]);
        $request->merge(['reviewer_id' => $loggedUser->id]);

        if($transaction->reviewStatus($loggedUser))
        {
            return  new TransactionReviewResource($transaction->userReview($loggedUser));
        }

        $rol = TransactionReview::SELLER;
        $reviewedId = $transaction->buyer_id;
        if($loggedUser->id == $transaction->buyer_id)
        {
            $rol = TransactionReview::BUYER;
            $reviewedId = $transaction->seller_id;
        }


        $request->merge(['rol' => $rol]);
        $request->merge(['reviewed_id' => $reviewedId]);
        $review = TransactionReview::create($request->input());

        return  new TransactionReviewResource($review);



    }
}
