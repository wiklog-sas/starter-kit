<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Permet de connaître les derniers User ayant agit sur un Model
 *
 * @method userCreation() userCreation(): BelongsTo
 * @method userModification() userModification(): BelongsTo
 * @method userSuppression() userSuppression(): BelongsTo
 */
trait WhoActs
{
    /**
     * Renvoie le User de création du Model
     *
     * @return BelongsTo
     */
    public function userCreation(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_creation');
    }

    /**
     * Renvoie le User de modification du Model
     *
     * @return BelongsTo
     */
    public function userModification(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_modification');
    }

    /**
     * Renvoie le User de suppression du Model
     *
     * @return BelongsTo
     */
    public function userSuppression(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_suppression');
    }
}
