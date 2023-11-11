<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        # Validar la contraseña actual
        if (! Hash::check($request->current_password_info, auth()->user()->password)) {
            return back()->withErrors([
                'current_password_info' => ['La contraseña actual no coincide!!']
            ]);
        }

        # Modificar el request
        $request->request->add(['username' => Str::slug($request->username)]);
        
        # Validar
        # Cuando son más de 3 validaciones se recomienda colocar en un arreglo
        # in, palabras que deben ir en el username
        # not_in, palabras que no deben ir
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:30', 'not_in:twitter,editar-perfil'],
            'email' => ['required', 'email', 'unique:users,email,'.auth()->user()->id, 'max:60', 'not_in:twitter,editar-perfil']            
        ]);

        # Condicional si viene el campo phone
        if($request->phone) {
            $this->validate($request, [
                'phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:9'
            ]);
        }

        # Condicional si viene el campo password
        if($request->password) {
            $this->validate($request, [
                'password' => 'confirmed|min:6'
            ]);
            $newPass = Hash::make( $request->password );
        }

        # Condicional si hay imagen
        if($request->imagen) {
            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);

            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }

        # Guardar cambios
        # ?? significa que si no encuentra valores pasa a la siguiente variable
        $usuario = User::find(auth()->user()->id);
        $usuario->name = $request->name;
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->password = $newPass ?? auth()->user()->password;
        $usuario->phone = $request->phone ?? null;
        $usuario->save();

        # Redireccionar
        return redirect()->route('posts.index', $usuario->username);
    }

    public function destroy(Request $request, User $user) {
        # Validar la contraseña actual
        if (! Hash::check($request->current_password_delete, auth()->user()->password)) {
            return back()->withErrors([
                'current_password_delete' => ['La contraseña actual no coincide!!']
            ]);
        }
        $user->delete();        
        auth()->logout();
        return redirect()->route('login');
    }
}
