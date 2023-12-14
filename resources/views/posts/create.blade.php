@extends('layouts.app')

@section('titulo')
    Crea una nueva publicación
@endsection

@push('tagifyStyle')
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endpush

@push('tagifyScript')
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
@endpush

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@push('scriptConteoCifras')
    <script type="text/javascript">
        // Conteo letras
        const descripcion = document.querySelector('#descripcion');
        const conteo = document.querySelector('#conteo');

        descripcion.addEventListener('input', function(e) {
            const target = e.target;
            const longitudMax = target.getAttribute('maxlength');
            const longitudAct = target.value.length;
            conteo.innerHTML = `${longitudAct}/${longitudMax}`;
        });
    </script>
@endpush

@push('tagifyJs')
    <script type="text/javascript">
        // Input tags
        const myTagify = function () {
            // tagify
            const input_tags = document.querySelectorAll("input.tagify");

            if ( input_tags != null) {
                for( let i = 0; i < input_tags.length; i++)
                {
                    new Tagify(input_tags[i]);
                }
            }
        }

        // Launch Function
        myTagify();
    </script>
@endpush

@section('contenido')
    <div class="md:flex md:items-center flex-col">
        <div class="lg:w-1/2 md:w-full">
            <form action="{{ route('imagenes.store') }}" method="POST" enctype="multipart/form-data" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center @error('imagen') border-red-500 @enderror">
                @csrf
            </form>
            @error('imagen') 
                <div id="alert-imagen" class="flex items-center p-4 my-4 text-red-50 rounded-lg bg-red-500 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
                    <span class="sr-only">Info</span>
                    <div class="ml-3 text-sm font-medium">
                        {{ $message }}
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-imagen" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                    </button>
                </div>
            @enderror
        </div>

        <form 
            action="{{ route('posts.store') }}" 
            method="POST" 
            class="bg-white mx-auto lg:w-1/2 md:w-full flex flex-col text-gray-800 border border-gray-300 border-t-0 p-4 shadow-lg"
        >
        @csrf
            <input 
                id="titulo"
                name="titulo"
                type="text"
                maxlength="255"
                class="bg-gray-100 border p-3 mb-4 outline-none focus:border-blue-500 @error('titulo') border-red-500 @enderror" 
                spellcheck="false" 
                placeholder="Título de la publicación" 
                value="{{ old('titulo') }}"
            />
            @error('titulo') 
                <div id="alert-titulo" class="flex items-center p-4 mb-4 text-red-50 rounded-lg bg-red-500 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
                    <span class="sr-only">Info</span>
                    <div class="ml-3 text-sm font-medium">
                        {{ $message }}
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-titulo" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                    </button>
                </div>
            @enderror

            <div class="mb-6">
                <label for="tags" class="inline-block mb-2">Tags</label>
                <input 
                    type="text" 
                    name="tags" 
                    id="tags" 
                    class="tagify w-full leading-5 relative text-sm py-2 px-4 rounded text-gray-800 bg-white border border-gray-300 overflow-x-auto focus:outline-none focus:border-gray-400 focus:ring-0 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-700 dark:focus:border-gray-600"
                >
            </div>

            <textarea 
                id="descripcion"
                name="descripcion"  
                class="bg-gray-100 sec p-3 h-60 border outline-none focus:border-blue-500 @error('descripcion') border-red-500 @enderror" 
                spellcheck="false" 
                placeholder="Describe todo sobre el post aquí"
                maxlength="300"
            >{{ old('descripcion') }}</textarea>
            @error('descripcion') 
                <div id="alert-descripcion" class="flex items-center p-4 my-4 text-red-50 rounded-lg bg-red-500 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
                    <span class="sr-only">Info</span>
                    <div class="ml-3 text-sm font-medium">
                        {{ $message }}
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-descripcion" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                    </button>
                </div>
            @enderror

            <div>
                <input
                    name="imagen"
                    type="hidden"
                    value="{{ old('imagen') }}"                                    
                />
            </div>
            
            <!-- icons -->
            <div class="icons flex text-gray-500 m-2">
                <div id="conteo" class="mr-auto text-gray-400 text-xs font-semibold">0/300</div>
            </div>
            <!-- buttons -->
            <div class="buttons flex">
                <div class="btn border border-gray-300 p-1 px-4 font-semibold cursor-pointer text-gray-500 ml-auto hover:border-gray-400 hover:text-gray-600">Cancel</div>
                <input 
                    type="submit" 
                    value="Publicar" 
                    class="btn border border-blue-500 p-1 px-4 font-semibold cursor-pointer text-white ml-2 bg-blue-500 hover:border-blue-600 hover:bg-blue-600"
                />
            </div>
        </form>
@endsection