<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Builder;
use  Illuminate\Contracts\Pagination\LengthAwarePaginator;


/**
 * App\Models\BaseModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel query()
 * @mixin \Eloquent
 */
class BaseModel extends Model
{
    use HasFactory;


    /**
     * @param int $perPage
     * @param string|null $orderField
     * @param string|null $orderDirection
     * @return LengthAwarePaginator
     */
    public static function sorter(int $perPage = 10, ?string $orderField = null, ?string $orderDirection = null, array $queries = []): LengthAwarePaginator
    {

        $orderField = $orderField ?? 'id';
        $orderDirection = $orderDirection ?? 'ASC';


        $query = self::query();

        foreach ($queries as $field => $value) {

            $query = $query->where($field, 'like', '%' . $value . '%');
        }
        $query = $query->orderBy($orderField, $orderDirection);

        return $query->paginate($perPage);

    }
}
