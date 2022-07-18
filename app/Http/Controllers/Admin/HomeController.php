<?php

namespace App\Http\Controllers\Admin;

use App\Admin\User;
use App\Helpers\Functions;
use App\Http\Controllers\Controller;
use App\Model\Admin\Veiculos\Viaturas;
use Illuminate\Http\Request;

use DateTime;
use Illuminate\Support\Facades\DB;

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
        $users = User::where('active', 1)->get();
        return view('admin.home',[
            'title_postfix' => 'Painel geral',
            'users'         => $users->count(),
        ]);
    }
}
