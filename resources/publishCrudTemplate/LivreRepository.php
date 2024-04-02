<?php

namespace App\Http\Repositories\Livre;

use App\Models\Livre;
use Auth;
use DB;

class LivreRepository
{
    /**
     * @var Livre
     */
    protected $livre;

    /**
     * Constructor
     *
     * @param  Livre  $livre
     */
    public function __construct(Livre $livre)
    {
        $this->livre = $livre;
    }

    /**
     * Store a new model instance
     *
     * @param  array  $inputs
     *
     * @return Livre
     */
    public function store(array $inputs): Livre
    {
        $livre = new $this->livre();
        $livre->user_id_creation = Auth::id();

        $this->save($livre, $inputs);

        return $livre;
    }

    /**
     * Update the model instance
     *
     * @param  Livre  $livre
     * @param  array  $inputs
     *
     * @return Livre
     */
    public function update(Livre $livre, array $inputs): Livre
    {
        $livre->user_id_modification = Auth::id();

        $this->save($livre, $inputs);

        return $livre;
    }

    /**
     * Delete the model instance
     *
     * @param  Livre  $livre
     *
     * @return bool|null
     */
    public function destroy(Livre $livre)
    {
        $livre->user_id_suppression = Auth::id();
        $livre->save();

        return $livre->delete();
    }

    /**
     * Undelete the model instance
     *
     * @param  Livre  $livre
     *
     * @return void
     */
    public function undelete(Livre $livre)
    {
        $livre->user_id_suppression = null;
        $livre->restore();
    }

    /**
     * Return a JSON for index datatable
     *
     * @return string|false|void — a JSON encoded string on success or FALSE on failure
     */
    public function json()
    {
        $query = "
            SELECT 
                *,
                (select concat(coalesce(uc.name, ''), ' ', coalesce(uc.name, '')) from users uc where uc.id = l.user_id_creation) createur,
                (select concat(coalesce(uu.name, ''), ' ', coalesce(uu.name, '')) from users uu where uu.id = l.user_id_modification) modificateur,
                (select concat(coalesce(ud.name, ''), ' ', coalesce(ud.name, '')) from users ud where ud.id = l.user_id_suppression) suppresseur
            FROM livres l
        ;";

        return json_encode(
            DB::select($query)
        );
    }

    /**
     * Save the model instance
     *
     * @param  Livre  $livre
     *
     * @return Livre
     */
    private function save(Livre $livre, array $inputs): Livre
    {
        $livre->title = $inputs['title'];
        $livre->author = $inputs['author'];
        $livre->description = $inputs['description'];
        $livre->release_date = $inputs['release_date'];
        $livre->price = $inputs['price'];
        $livre->save();

        return $livre;
    }
}
