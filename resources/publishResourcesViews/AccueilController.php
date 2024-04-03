<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AccueilController extends Controller
{
    private const PATH_VIEWS = 'accueil';

    /**
     * Constructeur de la classe AccueilController
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        Session::put('level_menu_1', 'home');
        Session::pull('level_menu_2');
    }

    /**
     * Retourne la vue accueil
     *
     * @return View
     */
    public function index()
    {
        return view(self::PATH_VIEWS);
    }
}
