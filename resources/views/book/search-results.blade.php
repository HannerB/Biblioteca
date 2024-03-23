<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Resultados de la Búsqueda
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">

                <!-- Listado de libros -->
                <div class="p-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @if($books->isEmpty())
                        <p>No se encontraron resultados para "{{ $searchTerm }}".</p>
                    @else
                        @foreach($books as $book)
                            <!-- Tarjeta de Ejemplo -->
                            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                                <img src="https://picsum.photos/300/200?seed={{ $book->id }}" alt="Portada del Libro"
                                    class="w-full h-64 object-cover rounded-t-lg">
                                <div class="p-4">
                                    <h3 class="font-semibold text-lg mb-2">{{ $book->title }}</h3>
                                    <p class="text-gray-700">Autor: {{ $book->author }}</p>
                                    <p class="text-gray-700">Cantidad: {{ $book->quantity }}</p>
                                    <p class="text-gray-700">Género: Ficción</p>
                                    <div class="mt-4 flex justify-end space-x-4">
                                        <a href""
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Llevar</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- Paginador -->
                <div class="p-4">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
