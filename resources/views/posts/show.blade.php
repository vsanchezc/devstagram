@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto grid lg:grid-cols-2 gap-4">
        <div class="w-full">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
        </div>

        <div class="w-full bg-white">        
            <div class="flex flex-col shadow justify-between bg-white h-full p-5">
                <div class="flex w-full items-center justify-between max-md:grid gap-2">
                    <div class="w-full flex items-center max-md:grid gap-2">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('posts.index', $post->user->username) }}" class="w-12">
                                <img src="{{ $post->user->imagen ? asset('perfiles') . '/' . $post->user->imagen : asset('img/usuario.svg') }}" alt="imagen usuario" class="rounded w-full">
                            </a>
                        </div>
                        <div class="w-full">
                            <a href="{{ route('posts.index', $post->user->username) }}" class="font-bold flex flex-wrap gap-2">
                                {{ ucfirst($post->user->name) }}
                            </a>
                            <p class="font-medium">{{ ucfirst($post->titulo) }}</p>
                            <p class="font-normal">{{ ucfirst($post->descripcion) }}</p>
                        </div>
                    </div>

                    @auth
                        @if ($post->user_id === auth()->user()->id)
                            <div>
                                <button type="button" data-modal-target="deletePost" data-modal-toggle="deletePost" class="inline-flex items-center justify-center rounded text-xs font-semibold border border-red-500 text-red-500 transition-all hover:shadow-lg hover:bg-red-500 hover:text-white hover:shadow-red-500/30 focus:shadow-none focus:outline focus:outline-red-500/40 p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        @endif
                    @endauth    
                </div>

                <p class="text-sm text-gray-500 mt-2">
                    {{ $post->created_at->diffForHumans() }}
                </p>

                <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">
                <div class="bg-white overflow-y-scroll flex-1">
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario)
                            <div class="flex w-full items-center max-md:grid gap-2 my-2">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('posts.index', $comentario->user) }}" class="w-12">
                                        <img src="{{ $comentario->user->imagen ? asset('perfiles') . '/' . $comentario->user->imagen : asset('img/usuario.svg') }}" alt="imagen usuario" class="rounded-full w-full">
                                    </a>
                                </div>
                                <div class="border-gray-300">
                                        <a href="{{ route('posts.index', $comentario->user) }}" class="font-bold">
                                            {{ ucfirst($comentario->user->name) }}
                                        </a>
                                        
                                        <p>
                                            {{ $comentario->comentario }}
                                        </p>
                                
                                    <p class="text-sm text-gray-500">
                                        {{ $comentario->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No Hay Comentarios Aún</p>
                    @endif
                </div>

                @auth
                    @if(session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                            {{ session('mensaje') }}
                        </div>
                    @endif
                    <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">
                    <livewire:like-post :post="$post" />
                    <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">
                    <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                        @csrf  
                        <div class="relative">
                            <input 
                                id="comentario"
                                type="text"
                                name="comentario"
                                class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Añade un comentario..."
                            />
                            @error('comentario')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                            @enderror
                            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Publicar</button>
                        </div>
                    </form>
                @endauth
            </div>
        </div>
    </div>

    @auth
        @if ($post->user_id === auth()->user()->id)
            <div id="deletePost" tabindex="-1" class="fixed top-0 left-0 right-0 z-[45] hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="deletePost">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <div class="p-6 text-center">
                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                    ¿Está seguro que desea eliminar esta publicación?
                                </h3>
                                <button 
                                    type="submit" 
                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2"
                                    data-popover-target="popover-delete"
                                    data-popover-placement="bottom"
                                >
                                    Si, eliminar
                                </button>
                                <div data-popover id="popover-delete" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                    <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                                        <h3 class="font-semibold text-gray-900 dark:text-white">Eliminar Publicación</h3>
                                    </div>
                                    <div class="px-3 py-2">
                                        <p>Esta acción no se puede deshacer.</p>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                                <button data-modal-hide="deletePost" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                    No, cancelar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endauth  
@endsection