<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questionnaire;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userinfo = [auth()->user()->name, auth()->user()->email];
        $questionnaires = auth()->user()->questionnaires;
        // $questionnaires = Questionnaire::all();
        return view('home', compact('questionnaires', 'userinfo'));
    }
}
