<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Complaint
 *
 * @property int $id
 * @property int $complainer_id
 * @property int $accused_id
 * @property int|null $transaction_id
 * @property int|null $product_id
 * @property int|null $complaint_category_id
 * @property string $body
 * @property int $resolution_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Complaint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Complaint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Complaint query()
 * @method static \Illuminate\Database\Eloquent\Builder|Complaint whereAccusedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Complaint whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Complaint whereComplainerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Complaint whereComplaintCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Complaint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Complaint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Complaint whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Complaint whereResolutionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Complaint whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Complaint whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Complaint extends Model
{
    use HasFactory;

    const PENDING = 0;
    const IN_FAVOUR = 1;
    const REJECTED = 2;
}
