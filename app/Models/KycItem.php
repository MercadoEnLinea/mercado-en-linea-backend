<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\KycItem
 *
 * @property int $id
 * @property int $user_id
 * @property string $url
 * @property string $payload
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|KycItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KycItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KycItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|KycItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycItem wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycItem whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycItem whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycItem whereUserId($value)
 * @mixin \Eloquent
 */
class KycItem extends Model
{
    use HasFactory;

    const VALIDATED_STATUS = 1;
    const PENDING_STATUS = 2;
    const REJECTED_STATUS = 3;
}
