<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Solicitar Préstamo') }}
        </h2>
    </x-slot>

    <!-- Mostrar mensaje de éxito si está presente -->
    @if (session()->has('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4 mx-auto max-w-7xl">
        <strong class="font-bold">Éxito!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path fill-rule="evenodd" d="M14.95 5.364a1.25 1.25 0 0 0-1.768 1.768L10 10.768l-3.182-3.182a1.25 1.25 0 1 0-1.768 1.768L8.232 12l-3.182 3.182a1.25 1.25 0 1 0 1.768 1.768L10 13.232l3.182 3.182a1.25 1.25 0 1 0 1.768-1.768L11.768 12l3.182-3.182a1.25 1.25 0 0 0 0-1.768z" clip-rule="evenodd" />
            </svg>
        </span>
    </div>
    @endif

    <div class="py-12">
        <div class="max-w-lg mx-auto sm:px-6 lg:px-8"> <!-- Cambiado a max-w-lg para hacerlo menos ancho -->
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Formulario de solicitud de préstamo -->
                    <form action="{{ route('books.submit_loan', $book->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="quantity" class="block font-medium text-sm text-gray-700">Cantidad de Libros</label>
                            <input type="number" id="quantity" name="quantity" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required> <!-- Estilos personalizados -->
                        </div>
                        <div class="mb-4">
                            <label for="duration" class="block font-medium text-sm text-gray-700">Duración del Préstamo (días)</label>
                            <input type="number" id="duration" name="duration" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required> <!-- Estilos personalizados -->
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Solicitar Préstamo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
