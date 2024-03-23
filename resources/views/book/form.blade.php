<x-app-layout>
    <div class="max-w-md mx-auto mt-8">
        @if (Session::has('mensaje'))
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded-md text-center my-5">
                {{ Session::get('mensaje') }}
            </div>
        @endif

        <form method="POST" action="{{ route('book.store') }}" class="border border-gray-300 rounded-md p-6 shadow">
            @csrf

            <!-- Nombre del Libro -->
            <div class="mb-4">
                <label for="title" class="block font-medium text-sm text-gray-700">{{ __('Nombre del Libro') }}</label>
                <input class="block mt-1 w-full form-input rounded-lg" type="text" name="title" value="{{ old('title') }}" required>
                @error('title')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Autor -->
            <div class="mb-4">
                <label for="author" class="block font-medium text-sm text-gray-700">{{ __('Autor') }}</label>
                <input class="block mt-1 w-full form-input rounded-lg" type="text" name="author" required>
                @error('author')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Cantidad de Libros -->
            <div class="mb-4">
                <label for="quantity" class="block font-medium text-sm text-gray-700">{{ __('Cantidad de Libros') }}</label>
                <input class="block mt-1 w-full form-input rounded-lg" type="number" name="quantity" required>
                @error('quantity')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">{{ __('Guardar') }}</button>
            </div>
        </form>
    </div>
</x-app-layout>
