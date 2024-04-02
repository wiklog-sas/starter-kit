<?php

namespace App\Http\Services\Livre;

use App\Http\Repositories\Livre\LivreRepository;
use App\Models\Livre;

class LivreService
{
    /**
     * @var LivreRepository
     */
    protected $livreRepository;

    /**
     * Constructor
     *
     * @param  LivreRepository  $livreRepository
     */
    public function __construct(LivreRepository $livreRepository)
    {
        $this->livreRepository = $livreRepository;
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
        //
        // Règles de gestion à appliquer avant l'enregistrement en base
        //

        return $this->livreRepository->store($inputs);
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
        //
        // Règles de gestion à appliquer avant l'enregistrement en base
        //

        return $this->livreRepository->update($livre, $inputs);
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
        //
        // Règles de gestion à appliquer avant l'enregistrement en base
        //

        return $this->livreRepository->destroy($livre);
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
        //
        // Règles de gestion à appliquer avant l'enregistrement en base
        //

        $this->livreRepository->undelete($livre);
    }

    /**
     * Return a JSON for index datatable
     *
     * @return string|false|void — a JSON encoded string on success or FALSE on failure
     */
    public function json()
    {
        //
        // Règles de gestion à appliquer avant l'enregistrement en base
        //

        return $this->livreRepository->json();
    }
}
