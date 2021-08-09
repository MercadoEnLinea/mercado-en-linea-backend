<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ComplaintCategory
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ComplaintCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ComplaintCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ComplaintCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ComplaintCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComplaintCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComplaintCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComplaintCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComplaintCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ComplaintCategory extends Model
{
    use HasFactory;
}
