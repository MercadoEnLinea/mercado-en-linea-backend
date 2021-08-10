<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property int $seller_id
 * @property string $name
 * @property int $category_id
 * @property string|null $description
 * @property array|null $delivery_options
 * @property array|null $payment_options
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductImage[] $images
 * @property-read int|null $images_count
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDeliveryOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePaymentOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSellerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $views
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereViews($value)
 */
class Product extends BaseModel
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'delivery_options', 'payment_options', 'seller_id', 'category_id'];

    protected $casts = [
        'delivery_options' => 'array',
        'payment_options' => 'array',
    ];


    protected $with = ['images', 'seller'];
    protected $appends = ['sell_count'];


    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function getSellCountAttribute()
    {
        return $this->purchases()->count();
    }

    public function purchases()
    {
        return $this->hasMany(Transaction::class, 'product_id');
    }

    public function updateCounter()
    {
        $this->views++;
        $this->save();
    }


}
