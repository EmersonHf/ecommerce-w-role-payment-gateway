@extends('layouts.default')
@section('content')
    <section class="text-gray-600">
        <div class="container px-5 py-24 mx-auto">
            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                <div class="flex items-center justify-between mb-2">
                    <h1 class="text-2xl font-medium title-font mb-2 text-gray-900">Clientes</h1>

                    <a href="{{ route('seller.clients.create', ['seller' => Auth::user()->id]) }}"
                        class="flex ml-auto text-white bg-indigo-500 border-0 py-1.5 px-3 text-sm focus:outline-none hover:bg-indigo-600 rounded">Adicionar Cliente</a>
                </div>
                <table class="table-auto w-full text-left whitespace-no-wrap">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">#
                            </th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"
                                style="width: 150px">Imagem</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                Nome</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                Email</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                Telefone</th>
                            <th
                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 text-right">
                                Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse ($clients as $client)
                            <tr @if ($loop->even) class="bg-gray-100" @endif>
                                <td class="px-4 py-3">{{ $client->id }}</td>
                                <td class="px-4 py-3">
                                    <img alt="ecommerce" class="object-cover object-center w-full h-full block"
                                        src="{{ Storage::url($client->cover) }}">
                                    {{-- "@if (str_contains($product->cover, 'products'))
                                            {{ Storage::url($product->cover),$product->id }}
                                  @else
                                            {{ $product->cover }}
                                  @endif"> --}}
                                </td>
                                <td class="px-4 py-3">{{ $client->name }}</td>
                                <td class="px-4 py-3">{{ $client->email }}</td>
                                <td class="px-4 py-3">{{ $client->telefone }}</td>
                                <td class="px-4 py-3 text-sm text-right space-x-3 text-gray-900">
                                    <a href="{{ route('sellers.client.edit', $client->id) }}"
                                        class="mt-3 text-indigo-500 inline-flex items-center">Editar</a>
                                        <x-confirm-delete-button :route="route('sellers.client.destroy', $client->id )" />

                                </td>
                            </tr>
                        @empty
                            <tr>

                                <td class="px-4 py-3 text-sm text-right space-x-3 text-gray-900">
                                    <h1>no products on the table</h1>
                                </td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </section>
@endsection
