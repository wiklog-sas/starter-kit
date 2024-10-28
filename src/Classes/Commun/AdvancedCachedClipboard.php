<?php

namespace App\Classes\Commun;

use Silber\Bouncer\CachedClipboard;
use Illuminate\Database\Eloquent\Model;

/**
 * @codeCoverageIgnore
 * @see https://github.com/JosephSilber/bouncer/issues/430
 * @annotation Ajouter la ligne "Bouncer::setClipboard(new AdvancedCachedClipboard(new ArrayStore));" dans le méthode register de AppServiceProvider
 */
class AdvancedCachedClipboard extends CachedClipboard
{

    protected $abilities = array();
    protected $roles = array();

    /**
     * Get the given authority's abilities.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $authority
     * @param  bool  $allowed
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAbilities(Model $authority, $allowed = true)
    {
        $key = $this->getCacheKey($authority, 'abilities', $allowed);

        if (!isset($this->abilities[$key])) {
            $this->abilities[$key] = parent::getAbilities($authority, $allowed);
        }

        return $this->abilities[$key];
    }

    /**
     * Get the given authority's roles.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $authority
     * @return \Illuminate\Support\Collection
     */
    public function getRoles(Model $authority)
    {
        $key = $this->getCacheKey($authority, 'roles');

        if (!isset($this->roles[$key])) {
            $this->roles[$key] = parent::getRoles($authority);
        }

        return $this->roles[$key];
    }

    /**
     * Clear the cache.
     *
     * @param  null|\Illuminate\Database\Eloquent\Model  $authority
     * @return $this
     */
    public function refresh($authority = null)
    {
        parent::refresh($authority);

        if (is_null($authority)) {
            $this->abilities = array();
            $this->roles = array();
        }

        return $this;
    }

    /**
     * Clear the cache for the given authority.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $authority
     * @return $this
     */
    public function refreshFor(Model $authority)
    {
        parent::refreshFor($authority);

        unset($this->abilities[$this->getCacheKey($authority, 'abilities', true)]);
        unset($this->abilities[$this->getCacheKey($authority, 'abilities', false)]);
        unset($this->roles[$this->getCacheKey($authority, 'roles')]);

        return $this;
    }
}
