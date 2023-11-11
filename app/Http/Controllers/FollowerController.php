<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user)
    {
        # followers, permite acceder a la informacion
        # followers(), permite acceder al metodo
        # attach(), es útil cuando se tiene la relacion de muchos a muchos
        # como la relación es el mismo usuario dos veces en la misma tabla se usa attach()
        $user->followers()->attach( auth()->user()->id );
        return back();
    }

    public function destroy(User $user)
    {
        $user->followers()->detach( auth()->user()->id );
        return back();
    }
}
