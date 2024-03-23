<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Libros') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">

                <!-- Formulario de búsqueda -->
                <div class="p-4 flex justify-end">
                    <form action="{{ route('book.searchBook') }}" method="GET" class="flex">
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
                                    @if ($userRole == \App\Models\User::ROLE_STUDENT)
                                    <div class="mt-4 flex justify-end space-x-4">
                                        <a href="#"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Llevar</a>
                                    </div>
                                @endif
                                
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
