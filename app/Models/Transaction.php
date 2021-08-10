<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property int $seller_id
 * @property int $buyer_id
 * @property int $product_id
 * @property int $status_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereBuyerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereSellerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $buyer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TransactionReview[] $reviews
 * @property-read int|null $reviews_count
 * @property-read \App\Models\User $seller
 */
class Transaction extends BaseModel
{
    use HasFactory;

    public static $statuses = [
        '1' => 'Completada',
        '2' => 'Cancelada',
    ];

    protected $fillable = ['buyer_id',
        'seller_id',
        'product_id'];

    protected  $with = ['buyer', 'seller', 'reviews'];

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }



    public function product()
    {
        return $this->belongsTo(Product::class );
    }



    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }


    public function reviews()
    {
        return $this->hasMany(TransactionReview::class);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function reviewStatus(User $user): bool
    {
       $reviews = $this->reviews()->where('reviewer_id', $user->id)->first();

       return $reviews != null;
    }

    /**
     * @param User $user
     * @return TransactionReview|null
     */
    public function userReview(User $user): ?TransactionReview {
        return  $this->reviews()->where('reviewer_id', $user->id)->first();
    }

}
