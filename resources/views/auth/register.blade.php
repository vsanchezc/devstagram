@extends('layouts.app')

@section('titulo')

Registro
    
@endsection

@section('contenido')

    <div class="min-w-screen h-[calc(100vh-6rem)] flex items-center justify-center px-5 py-5">
        <div class="bg-white dark:bg-gray-800 text-gray-500 rounded-3xl shadow-xl w-full overflow-hidden" style="max-width:1000px">
            <div class="md:flex w-full">
                <div class="hidden md:flex w-1/2 bg-gray-600 dark:bg-blue-600 py-10 px-10">
                    <img src="{{ asset('img/registro.svg') }}" alt="Imagen Login de Usuarios" width="100%">
                </div>
                <div class="w-full md:w-1/2 py-10 px-5 md:px-10">
                    <div class="text-center mb-10">
                        <h1 class="font-bold text-3xl text-gray-900 dark:text-white">Registrate en Devstagram</h1>
                        <p class="text-gray-400">Ingresa tus datos de registro</p>
                    </div>
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="relative z-0 w-full mb-6 group">
                            <input 
                                id="name"
                                name="name"
                                type="text"
                                maxlength="30"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" 
                                placeholder=" " 
                                value="{{ old('name') }}"
                                required 
                            />
                            <label 
                                for="name" 
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 z-1 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                            >
                                Nombres y Apellidos
                            </label>
                            @error('name')
                                <div id="alert-name" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
                                    <span class="sr-only">Info</span>
                                    <div class="ml-3 text-sm font-medium">
                                        {{ $message }}
                                    </div>
                                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-name" aria-label="Close">
                                        <span class="sr-only">Close</span>
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                                    </button>
                                </div>
                            @enderror
                        </div>
                        <div class="relative z-0 w-full mb-6 group">
                            <input 
                                id="username"
                                name="username"
                                type="text"
                                maxlength="20" 
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" 
                                placeholder=" " 
                                value="{{ old('username') }}"
                                required 
                            />
                            <label 
                                for="username" 
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 z-1 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                            >
                                Nombre de usuario
                            </label>
                            @error('username')
                                <div id="alert-username" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
                                    <span class="sr-only">Info</span>
                                    <div class="ml-3 text-sm font-medium">
                                        {{ $message }}
                                    </div>
                                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-username" aria-label="Close">
                                        <span class="sr-only">Close</span>
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                                    </button>
                                </div>
                            @enderror
                        </div>
                        <div class="relative z-0 w-full mb-6 group">
                            <input 
                                id="email"
                                name="email"
                                type="email"
                                maxlength="60"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" 
                                placeholder=" " 
                                value="{{ old('email') }}"
                                required 
                            />
                            <label 
                                for="email" 
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 z-1 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                            >
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
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative z-0 w-full mb-6 group">
                                <input 
                                    id="password"
                                    name="password"
                                    type="password"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" 
                                    placeholder=" " 
                                    required 
                                />
                                <label 
                                    for="password" 
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 z-1 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                                >
                                    Contraseña
                                </label>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <input 
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    type="password"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" 
                                    placeholder=" " 
                                    required 
                                />
                                <label 
                                    for="password_confirmation" 
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 z-1 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                                >
                                    Confirmar contraseña
                                </label>
                            </div>
                        </div>
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
                        <input 
                            type="submit"
                            value="Crear Cuenta"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full cursor-pointer sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        />
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