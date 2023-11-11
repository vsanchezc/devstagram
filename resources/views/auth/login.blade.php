@extends('layouts.app')

@section('titulo')

Iniciar Sesión
    
@endsection

@section('contenido')

    <div class="min-w-screen h-[calc(100vh-6rem)] flex items-center justify-center px-5 py-5">
        <div class="bg-white dark:bg-gray-800 text-gray-500 rounded-3xl shadow-xl w-full overflow-hidden" style="max-width:1000px">
            <div class="md:flex w-full">
                <div class="hidden md:flex w-1/2 bg-gray-600 dark:bg-blue-600 py-10 px-10">
                    <img src="{{ asset('img/login.svg') }}" alt="Imagen Login de Usuarios" width="100%">
                </div>
                <div class="w-full md:w-1/2 py-10 px-5 md:px-10">
                    <div class="text-center mb-10">
                        <h1 class="font-bold text-3xl text-gray-900 dark:text-white">Iniciar Sesión</h1>
                        <p class="text-gray-400">Ingresa tus datos de acceso</p>
                    </div>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        @if (session('mensaje'))
                            <div id="mensaje" class="flex items-center w-full p-4 mb-4 text-red-500 bg-red-50 rounded-lg dark:text-red-400 dark:bg-gray-800" role="alert">
                                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                                    </svg>
                                    <span class="sr-only">Error icon</span>
                                </div>
                                <div class="ml-3 text-sm font-normal">
                                    {{ session('mensaje') }}
                                </div>
                                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#mensaje" aria-label="Close">
                                    <span class="sr-only">Close</span>
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                </button>
                            </div>
                        @endif

                        <div class="relative z-0 w-full mb-6 group">
                            <input 
                                id="email"
                                name="email"
                                type="email"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" 
                                placeholder=" " 
                                required 
                            />
                            <label for="email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 z-1 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                Correo Electrónico
                            </label>
                            @error('email')
                                <div id="alert-email" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
                                    <span class="sr-only">Info</span>
                                    <div class="ml-3 text-sm font-medium">
                                        {{ $message }}
                                    </div>
                                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-email" aria-label="Close">
                                        <span class="sr-only">Close</span>
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                                    </button>
                                </div>
                            @enderror
                        </div>

                        <div class="relative z-0 w-full mb-6 group">
                            <input 
                                id="password"
                                name="password"
                                type="password"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" 
                                placeholder=" " 
                                required 
                            />
                            <label for="password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 z-1 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                Contraseña
                            </label>
                            @error('password')
                                <div id="alert-password" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
                                    <span class="sr-only">Info</span>
                                    <div class="ml-3 text-sm font-medium">
                                        {{ $message }}
                                    </div>
                                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-password" aria-label="Close">
                                        <span class="sr-only">Close</span>
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                                    </button>
                                </div>
                            @enderror
                        </div>
                        <div class="flex items-center z-0 w-full mb-6">
                            <input 
                                id="remember" 
                                type="checkbox" 
                                name="remember"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                            >
                            <label for="remember" class="ml-2 text-sm text-gray-500 dark:text-gray-400">
                                Mantener mi sesión abierta.
                            </label>
                        </div>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Ingresar
                        </button>
                        <hr class="h-px my-7 bg-gray-200 border-0 dark:bg-gray-700">
                        <p class="text-sm font-light text-gray-500 dark:text-gray-300">
                            No tienes una cuenta? 
                            <a href="{{ route('register') }}" class="font-medium hover:underline text-blue-700 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-500 ">
                                Regístrate
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="z-40 w-full p-4 fixed bottom-0 left-0 bg-white border-t border-gray-200 shadow md:flex md:items-center md:justify-end md:p-6 dark:bg-gray-800 dark:border-gray-600">
        <div class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
            <p class="mr-4md:mr-6">© {{ now() -> year }} Devstagram - Todos los derechos reservados.</p>
        </div>
    </footer>
    
@endsection