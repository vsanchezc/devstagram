<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function index(User $user)
    {
        #Filtrar sin relaciones con where
        $posts = Post::where('user_id', $user->id)->latest()->paginate(8);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required|max:300',
            'imagen' => 'required'
        ]);

        # Primera forma de almacenar
        // Post::create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id
        // ]);

        # Segunda forma de almacenar
        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->desripcion = $request->desripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = $request->auth()->user()->id;
        // $post->save();

        # Tercera forma de almacenar con Relaciones
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'user' => $user,
            'post' => $post
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        # Eliminar la imagen
        $imagen_path = public_path('uploads/' . $post->imagen);

        if(File::exists($imagen_path)) {
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
