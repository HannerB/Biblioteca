<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inventario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                @if (Session::has('mensaje'))
                    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded-md text-center my-5">
                        {{ Session::get('mensaje') }}
                    </div>
                @endif
                <div class="pb-5 border-b border-gray-200 sm:flex sm:items-center sm:justify-between">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Libros</h3>
                    <div class="mt-3 sm:mt-0 sm:ml-4">
                        <a href="{{ route('books.create') }}" 
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Agregar Libro
                        </a>
                    </div>
                </div>
                <div class="overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @forelse ($books as $item)
                            <!-- Tarjeta de Ejemplo -->
                            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                                <img src="https://picsum.photos/300/200?seed={{ $item->id }}" alt="Portada del Libro"
                                    class="w-full h-64 object-cover rounded-t-lg">
                                <div class="p-4">
                                    <h3 class="font-semibold text-lg mb-2">{{ $item->title }}</h3>
                                    <p class="text-gray-700">Autor: {{ $item->author }}</p>
                                    <p class="text-gray-700">Cantidad: {{ $item->quantity }}</p>    
                                    <p class="text-gray-700">Categoría:</p>
                                    <ul class="list-disc pl-5">
                                        @foreach ($item->categories as $category)
                                            <li>{{ $category->name }}</li>
                                        @endforeach
                                    </ul>
                                    <div class="mt-4 flex justify-end space-x-4">
                                        <a href="{{ route('books.edit', $item) }}"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</a>
                                        <form action="{{ route('books.destroy', $item) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No hay libros disponibles.</p>
                        @endforelse
                    </div>
                </div>
                <!-- Paginador -->
                <div class="p-4">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
