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
                <div class="flex justify-between items-center bg-gray-200 px-4 py-2 rounded-t-lg">
                    <h3 class="font-semibold text-lg">Libros</h3>
                    <a href="{{ route('book.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Agregar Libro</a>
                </div>

                <!-- Formulario de búsqueda -->
                <div class="p-4 flex justify-end">
                    <form action="{{ route('book.search') }}" method="GET" class="flex">
                        <input type="text" name="search" placeholder="Buscar libros..."
                            class="form-input rounded-l-md">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r-md">Buscar</button>
                    </form>
                </div>

                <!-- Listado de libros -->
                <div class="p-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @forelse ($books as $item)
                        <!-- Tarjeta de Ejemplo -->
                        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                            <img src="https://picsum.photos/300/200?seed={{ $item->id }}" alt="Portada del Libro"
                                class="w-full h-64 object-cover rounded-t-lg">
                            <div class="p-4">
                                <h3 class="font-semibold text-lg mb-2">{{ $item->title }}</h3>
                                <p class="text-gray-700">Autor: {{ $item->author }}</p>
                                <p class="text-gray-700">Cantidad: {{ $item->quantity }}</p>
                                <p class="text-gray-700">Género: Ficción</p>
                                <div class="mt-4 flex justify-end space-x-4">
                                    <a href="{{ route('book.edit', $item) }}"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</a>
                                    <form action="{{ route('book.destroy', $item) }}" method="post">
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

                <!-- Paginador -->
                <div class="p-4">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
