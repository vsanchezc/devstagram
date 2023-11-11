@extends('layouts.app')

@section('titulo')
    Perfil: {{ $user->username }}
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="flex items-center justify-center">
            <div>
                <img src="{{ $user->imagen ? asset('perfiles') . '/' . $user->imagen : asset('img/usuario.svg') }}" alt="imagen usuario" class="rounded w-36 h-36">
            </div>

            <div class="px-5 flex flex-col items-start">
                <div class="flex items-center gap-2">
                    <p class="text-gray-700 text-2xl">{{ $user->username }}</p>
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a  
                                href="{{ route('perfil.index') }}" 
                                class="text-gray-500 hover:text-gray-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>                                  
                            </a>
                        @endif
                    @endauth
                </div>

                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                    {{ $user->followers->count() }}
                    <button data-modal-target="follower-modal" data-modal-toggle="follower-modal" class="font-normal hover:underline"> @choice('Seguidor|Seguidores', $user->followers->count())</button>
                </p>

                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->followings->count() }}
                    <button data-modal-target="following-modal" data-modal-toggle="following-modal" class="font-normal hover:underline"> Siguiendo</button>
                </p>

                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->posts->count() }}
                    <span class="font-normal"> Posts</span>
                </p>

                @auth
                    @if ($user->id !== auth()->user()->id)
                        @if ($user->siguiendo(auth()->user()))
                            <form 
                                action="{{ route('users.unfollow', $user) }}"
                                method="POST"
                            >
                            @csrf
                            @method('DELETE')
                                <input 
                                    type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                                    value="Dejar de seguir"
                                />

                            </form>
                        @else
                            <form 
                                action="{{ route('users.follow', $user) }}"
                                method="POST"
                            >
                            @csrf
                                <input 
                                    type="submit"
                                    class="bg-blue-500 hover:bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                                    value="Seguir"
                                />
                            </form>           
                        @endif
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <div class="border-b border-gray-200 dark:border-gray-700 my-4">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center justify-center text-gray-500 dark:text-gray-400">
            <li class="me-2">
                <a href="#" class="inline-flex items-center justify-center p-4 uppercase text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500 group" aria-current="page">
                    <svg class="w-4 h-4 me-2 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                        <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                    </svg>Publicaciones
                </a>
            </li>
        </ul>
    </div>

    <section class="container mx-auto w-11/12">

        <x-listar-post :posts="$posts" />
        
    </section>

    <!-- Following modal -->
    <div id="following-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Siguiendo
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="following-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <ul class="my-4 space-y-3">
                        @foreach ($user->followings as $followings)
                            <li>
                                <a href="{{ route('posts.index', $followings->username) }}" class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                    <img class="w-10 h-10 rounded-full" src="{{ $followings->imagen ? asset('perfiles') . '/' . $followings->imagen : asset('img/usuario.svg') }}" alt="Rounded avatar">
                                    <span class="flex-1 ms-3 whitespace-nowrap">{{ $followings->name }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Follower modal -->
    <div id="follower-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Seguidores
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="follower-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <ul class="my-4 space-y-3">
                        @foreach ($user->followers as $followers)
                            <li>
                                <a href="{{ route('posts.index', $followers->username) }}" class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                    <img class="w-10 h-10 rounded-full" src="{{ $followers->imagen ? asset('perfiles') . '/' . $followers->imagen : asset('img/usuario.svg') }}" alt="Rounded avatar">
                                    <span class="flex-1 ms-3 whitespace-nowrap">{{ $followers->name }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection