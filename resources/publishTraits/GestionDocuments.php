<?php

namespace App\Traits;

use Arr;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

trait GestionDocuments
{
    /*
        Remplacer "entity..." et "Entity..." sur les lignes suivantes

        // Ajouter dans web.php les routes
        Route::get('entity/{entity}/document/{document}/telecharger', [EntityController::class, 'telechargerDocuments'])->name('entity.document.telecharger');
        Route::get('entity/{entity}/document/{document}/supprimer', [EntityController::class, 'supprimerDocument'])->name('entity.document.supprimer');

        // Ajouter dans le controller
        use GestionDocuments;
        public const PATH_DOCUMENTS = 'app/documents/entity/' ou /documents/entity/ selon la config;

        // Ajouter cette ligne pour update les documents (méthodes store et update par exemple)
        $this->enregistrerDocuments($request, $entity);

        // A ajouter dans la fonction data() du controller ou envoyer cette valeur à la vue
        'liste_nom_documents' => $entity ? $this->listeNomDocuments($entity) : [],

        // Ajouter dans le form request (validation)
        $rules['documents.*'] = ['nullable', 'file', 'max:10240', new DocumentNameUniqueRule($this, EntityController::PATH_DOCUMENTS)];

        // Ajouter dans le formulaire (ne pas changer les champs property)
        <x-inputs.input-hidden property="id" :entity="$entity" />
        <x-inputs.input-files-with-affichage :entity="$entity" entityName="entity" :listeNomDocuments="$liste_nom_documents" />
    */

    /**
     * Télécharge le document à partir du nom du document
     *
     * @param  int  $id
     * @param  string  $documents  nom du document
     *
     * @return BinaryFileResponse
     */
    public function telechargerDocuments(int $id, string $documents)
    {
        return response()->download(Storage::path(self::PATH_DOCUMENTS . $id . '/' . $documents), null, ['Content-type' => 'application/pdf;charset=UTF-8']);
    }

    /**
     * Supprime un fichier en le renommant delete-date-nomFichier
     *
     * @param  int  $id
     * @param  string  $documents  nom du fichier
     *
     * @return RedirectResponse
     */
    public function supprimerDocument(int $id, string $documents)
    {
        $path = self::PATH_DOCUMENTS . $id . '/' . $documents;
        $new_path = self::PATH_DOCUMENTS . $id . '/deleted-' . date('YmdHi') . '_' . uniqid() . '-'. $documents;

        Storage::move($path, $new_path);

        return back();
    }

    /**
     * Enregistre la liste des fichiers contenues dans la liste "documents"
     *
     * @param  Request  $request
     * @param  mixed  $entity
     *
     * @return void
     */
    private function enregistrerDocuments(Request $request, mixed $entity)
    {
        /** @var array<array<UploadedFile>> */
        $documents = $request->file();

        if (Arr::accessible($documents) && Arr::exists($documents, 'documents')) {
            $path = self::PATH_DOCUMENTS . $entity->id;
            if (! Storage::exists($path)) {
                Storage::makeDirectory($path);
            }

            foreach ($documents['documents'] as $document) {
                Storage::putFileAs($path, $document, $document->getClientOriginalName());
            }
        }
    }

    /**
     * Renvoi la liste des noms des fichiers "non supprimés" contenues dans un répertoire
     *
     * @param  mixed  $entity
     *
     * @return Collection<int, string>
     */
    private function listeNomDocuments(mixed $entity)
    {
        $path_folder = self::PATH_DOCUMENTS . $entity->id;

        $liste_path_documents = collect(Storage::files($path_folder));

        return $liste_path_documents->map(function ($path_document) {
            return pathinfo($path_document, PATHINFO_BASENAME);
        })->filter(function ($nom_document) {
            return ! preg_match('/^deleted-\d/', $nom_document);
        });
    }
}
