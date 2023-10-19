@extends('layouts.default')

@section('content')
<section class="text-gray-600">
    <div class="container px-5 py-24 mx-auto">
        <div class="lg:w-2/4 w-full mx-auto overflow-auto">
            <div class="flex items-center justify-between mb-2">
                <h1 class="text-2xl font-medium title-font mb-2 text-gray-900">Editar Cliente</h1>
            </div>

            <form action="{{ route('clients.update', $client->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                
                <div class="flex flex-wrap">
                    <div class="p-2 w-1/2">
                        <div class="relative">
                            <label for="name" class="leading-7 text-sm text-gray-600">Nome do Cliente</label>
                            <input value="{{ $client->name }}" type="text" id="name" name="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>

                    <div class="p-2 w-1/2">
                        <div class="relative">
                            <label for="email" class="leading-7 text-sm text-gray-600">E-mail</label>
                            <input value="{{ $client->email }}" type="email" id="email" name="email" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                        </div>
                    </div>

                    <div class="p-2 w-1/2">
                        <div class="relative">
                            <label for="telefone" class="leading-7 text-sm text-gray-600">Telefone</label>
                            <input value="{{ $client->telefone }}" type="text" id="telefone" name="telefone" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus-ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>

                    <div class="p-2 w-1/2">
                        <div class="relative">
                            <label for="cover" class="leading-7 text-sm text-gray-600">Imagem de capa</label>
                            <input type="file" id="cover" name="cover" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus-ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                        </div>
                    </div>

                    @if($client->cover)
                    <div class="p-2 w-full">
                        <img src="{{ $client->cover }}" alt="{{ $client->name }}">

                        <!-- Include a button or link for deleting the image if needed. -->
                        <a href="{{ route('clients.destroyImage', $client->id) }}" class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded">Deletar imagem</a>
                    </div>
                    @endif

                    <div class="p-2 w-full">
                        <div class="relative">
                            <label for="description" class="leading-7 text-sm text-gray-600">Descrição</label>
                            <textarea id="description" name="description" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus-ring-2 focus-ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $client->description }}</textarea>
                        </div>
                    </div>

                    <div class="p-2 w-full">
                        <button type="submit" class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">Editar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
