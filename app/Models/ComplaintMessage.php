<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ComplaintMessage
 *
 * @property int $id
 * @property int $user_id
 * @property int $complaint_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ComplaintMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ComplaintMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ComplaintMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ComplaintMessage whereComplaintId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComplaintMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComplaintMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComplaintMessage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComplaintMessage whereUserId($value)
 * @mixin \Eloquent
 */
class ComplaintMessage extends Model
{
    use HasFactory;
}
