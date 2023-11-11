@extends('layouts.app')

@section('titulo')
    Editar perfil: {{ auth()->user()->username }}
@endsection

@push('scriptImgPerfil')
    <script type="text/javascript">
        const inputImg = document.querySelector('#imagen');
        const imgPerfil = document.querySelector('#imgPerfil');
        const limpiarImg = document.querySelector('#limpiarImg');

        limpiarImg.addEventListener("click", function(){
            inputImg.value = "";
            imgPerfil.src = "{{ auth()->user()->imagen ? asset('perfiles') . '/' . auth()->user()->imagen : asset('img/usuario.svg') }}";
        });

        inputImg.onchange = evt => {
            const [file] = inputImg.files
            if (file) {
                imgPerfil.src = URL.createObjectURL(file)
            }
        }
    </script>
@endpush

@section('contenido')
    <div>
        <div class="w-full p-6 rounded-lg bg-gray-50 dark:bg-gray-800">

            <form action="{{ route('perfil.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex items-center flex-wrap">
                    <img id="imgPerfil" class="rounded w-36 h-36 mr-5" src="{{ auth()->user()->imagen ? asset('perfiles') . '/' . auth()->user()->imagen : asset('img/usuario.svg') }}" alt="Imagen del perfil">
                    <div class="dark:text-white">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="imagen">Subir una imagen</label>
                        <input 
                            id="imagen"
                            name="imagen"
                            type="file"
                            class="block w-full text-sm text-gray-900 border border-gray-600 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" 
                            aria-describedby="imagen_help"
                            accept=".jpg, .jpeg, .png"
                        />
                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="imagen_help">PNG o JPG (MAX. 1000x1000px).</div>
                        <button type="button" id="limpiarImg" class="px-3 py-2 text-sm font-medium my-2 text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Limpiar</button>
                    </div>
                </div>

                <h4 class="text-base text-gray-800 mt-5 dark:text-white">Información de la Cuenta</h2>
                <hr class="mb-5">

                <div class="grid md:grid-cols-1 lg:grid-cols-2 items-center mb-5 gap-6">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombres y Apellidos</label>
                        <div class="flex">
                            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-600 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M4.5 3.75a3 3 0 00-3 3v10.5a3 3 0 003 3h15a3 3 0 003-3V6.75a3 3 0 00-3-3h-15zm4.125 3a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5zm-3.873 8.703a4.126 4.126 0 017.746 0 .75.75 0 01-.351.92 7.47 7.47 0 01-3.522.877 7.47 7.47 0 01-3.522-.877.75.75 0 01-.351-.92zM15 8.25a.75.75 0 000 1.5h3.75a.75.75 0 000-1.5H15zM14.25 12a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H15a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3.75a.75.75 0 000-1.5H15z" clip-rule="evenodd" />
                                </svg>                                  
                            </span>

                            <input 
                                id="name"
                                name="name"
                                type="text"
                                maxlength="30"
                                class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('name') border-red-500 @enderror"
                                value="{{ auth()->user()->name }}"
                                required
                            />
                        </div>
                        @error('name')
                            <p class="text-sm absolute text-red-600 dark:text-red-500"><span class="font-medium">Oh, no!</span> {{ $message }}</p>
                        @enderror   
                    </div>

                    <div>
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre de Usuario</label>
                        
                        <div class="flex">
                            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-600 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
                                </svg>                                  
                            </span>

                            <input 
                                id="username"
                                name="username"
                                type="text"
                                maxlength="20"
                                class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 lowercase focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('username') border-red-500 @enderror" 
                                value="{{ auth()->user()->username }}"
                                required
                            />
                        </div>
                        @error('username')
                            <p class="text-sm absolute text-red-600 dark:text-red-500"><span class="font-medium">Oh, no!</span> {{ $message }}</p>
                        @enderror   
                    </div>
                </div>

                <div class="grid md:grid-cols-1 lg:grid-cols-2 items-center mt-7 gap-6">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo Electrónico</label>
                        <div class="flex">
                            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-600 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
                                <path d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
                                </svg>                                  
                            </span>
                            <input 
                                id="email"
                                name="email"
                                type="email"
                                maxlength="60"
                                class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('email') border-red-500 @enderror" 
                                value="{{ auth()->user()->email }}"
                                required
                            />
                        </div>
                        @error('email')
                            <p class="text-sm absolute text-red-600 dark:text-red-500"><span class="font-medium">Oh, no!</span> {{ $message }}</p>
                        @enderror 
                    </div>

                    <div>
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Teléfono</label>
                        <div class="flex">
                            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-600 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z" clip-rule="evenodd" />
                                </svg>                                  
                            </span>
                            <input 
                                id="phone"
                                name="phone"
                                type="tel" 
                                maxlength="30"
                                pattern="\([0-9]{3}\) [0-9]{3}[ -][0-9]{4}"
                                class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('phone') border-red-500 @enderror"
                                value="{{ auth()->user()->phone }}"
                                placeholder="(+51) 123-456-789"
                            />
                        </div>
                        @error('phone')
                            <p class="text-sm absolute text-red-600 dark:text-red-500"><span class="font-medium">Oh, no!</span> {{ $message }}</p>
                        @enderror 
                    </div>
                </div>

                <h4 class="text-base text-gray-800 mt-5 dark:text-white">Cambiar Contraseña</h2>
                <hr class="mb-5">

                <div class="grid md:grid-cols-1 lg:grid-cols-2 items-center gap-6">
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nueva contraseña</label>
                        <div class="flex">
                            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-600 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M15.75 1.5a6.75 6.75 0 00-6.651 7.906c.067.39-.032.717-.221.906l-6.5 6.499a3 3 0 00-.878 2.121v2.818c0 .414.336.75.75.75H6a.75.75 0 00.75-.75v-1.5h1.5A.75.75 0 009 19.5V18h1.5a.75.75 0 00.53-.22l2.658-2.658c.19-.189.517-.288.906-.22A6.75 6.75 0 1015.75 1.5zm0 3a.75.75 0 000 1.5A2.25 2.25 0 0118 8.25a.75.75 0 001.5 0 3.75 3.75 0 00-3.75-3.75z" clip-rule="evenodd" />
                                </svg>                                                                  
                            </span>
                            <input 
                                id="password"
                                name="password"
                                type="password"
                                class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('password') border-red-500 @enderror"
                                placeholder="*************"
                            />
                        </div>
                        @error('password')
                            <p class="text-sm absolute text-red-600 dark:text-red-500"><span class="font-medium">Oh, no!</span> {{ $message }}</p>
                        @enderror 
                    </div>

                    <div>
                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirmar nueva contraseña</label>
                        <div class="flex">
                            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-600 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                                </svg>                                  
                            </span>
                            <input 
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password" 
                                class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('password') border-red-500 @enderror" 
                                placeholder="*************"
                            />
                        </div>
                    </div>
                </div>

                <h4 class="text-base text-gray-800 mt-5 dark:text-white">Confirmar datos</h2>
                <hr class="mb-5">

                <div class="grid md:grid-cols-1 lg:grid-cols-2 items-end mt-5 gap-3">
                    <div class="mr-4">
                        <label for="current_password_info" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirmar Contraseña actual</label>
                        <div class="flex">
                            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-600 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            <input 
                                id="current_password_info"
                                name="current_password_info"
                                type="password" 
                                class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('current_password_info') border-red-500 @enderror" 
                                placeholder="*************"
                                required
                            />
                        </div>
                    </div>
                    
                    <div>
                        <button 
                            type="submit" 
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            data-popover-target="popover-info"
                            data-popover-placement="bottom"
                        >
                            Guardar Información
                            <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </button>
                        <div data-popover id="popover-info" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                            <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                                <h3 class="font-semibold text-gray-900 dark:text-white">Confirmar Contraseña</h3>
                            </div>
                            <div class="px-3 py-2">
                                <p>Para poder guardar los datos, debe confirmar su contraseña actual.</p>
                            </div>
                            <div data-popper-arrow></div>
                        </div>
                    </div>
                    @error('current_password_info')
                        <p class="text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh, no!</span> {{ $message }}</p>
                    @enderror
                </div>
            </form>

            <hr class="my-5">

            <div class="flex">
                <div class="w-full">
                    <div class="flex items-center my-2 justify-between flex-wrap">
                        <div>
                            <label class="inline text-sm font-semibold mb-1 text-gray-900 dark:text-white">
                                Eliminar tu cuenta, 
                            </label>
                            <small class="text-xs text-slate-500">
                                perderá todos los datos de su cuenta
                            </small>
                        </div>
                        <div>
                            <button type="button" data-modal-target="deleteAccount" data-modal-toggle="deleteAccount" class="inline-flex items-center justify-center rounded text-xs font-semibold border border-red-500 text-red-500 transition-all hover:shadow-lg hover:bg-red-500 hover:text-white hover:shadow-red-500/30 focus:shadow-none focus:outline focus:outline-red-500/40 px-3 py-2">
                                Eliminar Cuenta
                            </button>
                        </div>
                    </div>
                    @error('current_password_delete')
                        <p class="text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh, no!</span> {{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div id="deleteAccount" tabindex="-1" class="fixed top-0 left-0 right-0 z-[45] hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="deleteAccount">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <form action="{{ route('perfil.destroy', auth()->user()) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="p-6 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                ¿Está seguro que desea eliminar su cuenta?
                            </h3>
                            <div class="my-5">
                                <label for="current_password_delete" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirmar Contraseña actual</label>
                                <div class="flex">
                                    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-600 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    <input 
                                        id="current_password_delete"
                                        name="current_password_delete"
                                        type="password" 
                                        class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('current_password_info') border-red-500 @enderror" 
                                        placeholder="*************"
                                        required
                                    />
                                </div>
                            </div>
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
                                    <h3 class="font-semibold text-gray-900 dark:text-white">Eliminar Cuenta</h3>
                                </div>
                                <div class="px-3 py-2">
                                    <p>Esta acción no se puede deshacer.</p>
                                </div>
                                <div data-popper-arrow></div>
                            </div>
                            <button data-modal-hide="deleteAccount" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                No, cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection