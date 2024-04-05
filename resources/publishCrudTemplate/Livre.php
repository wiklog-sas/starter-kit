<?php

namespace App\Models;

use App\Traits\LogAction;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Livre
 *
 * @property int $id
 * @property string $title
 * @property string $author
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $release_date
 * @property float|null $price
 * @property \Illuminate\Support\Carbon $created_at
 * @property int $user_id_creation
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $user_id_modification
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $user_id_suppression
 *
 * @property-read string $actions
 *
 * @method static \Database\Factories\LivreFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Livre newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Livre newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Livre onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Livre query()
 * @method static \Illuminate\Database\Eloquent\Builder|Livre whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Livre whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Livre whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Livre whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Livre whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Livre wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Livre whereReleaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Livre whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Livre whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Livre whereUserIdCreation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Livre whereUserIdModification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Livre whereUserIdSuppression($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Livre withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Livre withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Livre extends Model
{
    use HasFactory;
    use LogAction;
    use SoftDeletes;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'actions',
    ];

    /*
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'release_date' => 'date',
    ];

    /** @return string  */
    public function getActionsAttribute()
    {
        return '';
    }

    /**
     * Prepare a date for array / JSON serialization.
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('d/m/Y');
    }
}
