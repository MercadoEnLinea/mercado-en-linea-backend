<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TransactionReview
 *
 * @property int $id
 * @property int $reviewer_id
 * @property int $rol
 * @property int $transaction_id
 * @property int $score
 * @property string|null $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionReview newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionReview newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionReview query()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionReview whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionReview whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionReview whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionReview whereReviewerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionReview whereRol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionReview whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionReview whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionReview whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $reviewed_id
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionReview whereReviewedId($value)
 */
class TransactionReview extends Model
{
    use HasFactory;

    const BUYER =1;
    const SELLER =2;

    protected $fillable = ['reviewer_id', 'reviewed_id', 'rol', 'transaction_id', 'score', 'body'];



}
