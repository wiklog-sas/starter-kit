<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Indique si l'utilisateur connecté à les droits pour l'habilitation demandée
     *
     * @param  string  $ability  Habilitation à tester
     * @param  bool  $force_redirect  Indique si l'utilisateur est redirigé vers la DEFAULT_ROUTE ou si la méthode renvoie false pour personnaliser l'action en retour
     *
     * @return Redirector|bool
     *
     * @throws BindingResolutionException
     * @throws RouteNotFoundException
     */
    protected function can(string $ability, bool $force_redirect = true)
    {
        if (Auth::user()->can($ability)) {
            return true;
        }

        if ($force_redirect) {
            Session::put('message', 'Vous n’avez pas l’autorisation pour accéder à cet espace');
            abort(401);
        } else {
            return false;
        }
    }
}
