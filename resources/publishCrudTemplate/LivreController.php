<?php

namespace App\Http\Controllers\Livre;

use App\Http\Controllers\Controller;
use App\Http\Requests\Livre\LivreModelRequest;
use App\Http\Services\Livre\LivreService;
use App\Models\Livre;
use Carbon\Exceptions\InvalidFormatException;
use Carbon\Exceptions\NotLocaleAwareException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use InvalidArgumentException;
use Session;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\Translation\Exception\InvalidArgumentException as ExceptionInvalidArgumentException;

class LivreController extends Controller
{
    private const ABILITY = 'livre';

    private const PATH_VIEWS = 'livre';

    /**
     * @var LivreService
     */
    private $service;

    /**
     * Constructor
     *
     * @param  LivreService  $service
     */
    public function __construct(LivreService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
        Session::put('level_menu_1', 'livre');
        Session::put('level_menu_2', self::ABILITY);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response|RedirectResponse|View|void
     */
    public function index()
    {
        if ($this->can(self::ABILITY . '-retrieve')) {
            $ok = Session::pull('ok');

            return view(self::PATH_VIEWS . '.index', compact('ok'));
        }
    }

    /**
     * @return View|Factory|null
     *
     * @throws BindingResolutionException
     * @throws RouteNotFoundException
     * @throws InvalidFormatException
     * @throws NotLocaleAwareException
     * @throws ExceptionInvalidArgumentException
     * @throws InvalidArgumentException
     */
    public function create()
    {
        return $this->model(null, 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LivreModelRequest  $request
     *
     * @return RedirectResponse|void
     */
    public function store(LivreModelRequest $request)
    {
        if ($this->can(self::ABILITY . '-create')) {
            $data = $request->all();

            $livre = $this->service->store($data);
            Session::put('ok', 'Création effectuée');

            return redirect(self::PATH_VIEWS);
        }
    }

    /**
     * @param  Livre  $livre
     *
     * @return View|Factory|null
     *
     * @throws BindingResolutionException
     * @throws RouteNotFoundException
     * @throws InvalidFormatException
     * @throws NotLocaleAwareException
     * @throws ExceptionInvalidArgumentException
     * @throws InvalidArgumentException
     */
    public function show(Livre $livre)
    {
        return $this->model($livre, 'retrieve');
    }

    /**
     * @param  Livre  $livre
     *
     * @return View|Factory|null
     *
     * @throws BindingResolutionException
     * @throws RouteNotFoundException
     * @throws InvalidFormatException
     * @throws NotLocaleAwareException
     * @throws ExceptionInvalidArgumentException
     * @throws InvalidArgumentException
     */
    public function edit(Livre $livre)
    {
        return $this->model($livre, 'update');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LivreModelRequest  $request
     * @param  Livre  $livre
     *
     * @return RedirectResponse|void
     */
    public function update(LivreModelRequest $request, Livre $livre)
    {
        if ($this->can(self::ABILITY . '-update')) {
            $this->service->update($livre, $request->all());
            Session::put('ok', 'Mise à jour effectuée');

            return redirect(route(self::PATH_VIEWS . '.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Livre  $livre
     *
     * @return RedirectResponse|void
     */
    public function destroy(Livre $livre)
    {
        if ($this->can(self::ABILITY . '-delete')) {
            $this->service->destroy($livre);
            Session::put('ok', 'Suppression effectuée');

            return redirect(route(self::PATH_VIEWS . '.index'));
        }
    }

    /**
     * Restaure un élément supprimé
     *
     * @example Penser à utiliser un bind dans le web.php
     *          Route::bind('livre_id', function ($livre_id) {
     *              return Livre::onlyTrashed()->find($livre_id);
     *          });
     *
     * @param  Livre  $livre
     *
     * @return RedirectResponse|void
     */
    public function undelete(Livre $livre)
    {
        if ($this->can(self::ABILITY . '-delete')) {
            $this->service->undelete($livre);
            Session::put('ok', 'Restauration effectuée');

            return redirect(route(self::PATH_VIEWS . '.index'));
        }
    }

    /**
     * Renvoie la liste des Livre au format JSON pour leur gestion
     *
     * @return string|false|void — a JSON encoded string on success or FALSE on failure
     */
    public function json()
    {
        if ($this->can(self::ABILITY . '-retrieve')) {
            return $this->service->json();
        }
    }

    /**
     * Rempli un tableau avec les données nécessaires aux vues
     *
     * @param  Livre  $livre|null
     * @param  string  $ability
     *
     * @return array
     *
     * @throws InvalidArgumentException
     */
    private function data(?Livre $livre, string $ability): array
    {
        return [
            'livre' => $livre,
            'livres' => Livre::all(),
            // variables à ajouter
            'disabled' => $ability === 'retrieve',
        ];
    }

    /**
     * @param  Livre  $livre|null
     * @param  string  $ability
     *
     * @return View|Factory|null
     *
     * @throws BindingResolutionException
     * @throws RouteNotFoundException
     * @throws InvalidFormatException
     * @throws NotLocaleAwareException
     * @throws ExceptionInvalidArgumentException
     * @throws InvalidArgumentException
     */
    private function model(?Livre $livre, string $ability)
    {
        if ($this->can(self::ABILITY . '-' . $ability)) {
            return view(
                self::PATH_VIEWS . '.model',
                $this->data($livre, $ability)
            );
        }

        return null;
    }
}
