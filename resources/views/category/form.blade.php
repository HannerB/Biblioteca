<x-app-layout>
    <div class="max-w-md mx-auto mt-8">
        @if (isset($category))
            <form method="POST"
                action="{{ route('category.update', $category) }}"
                class="border border-gray-300 rounded-md p-6 shadow">
                @method('PUT')
        @else
            <form method="POST" action="{{ route('category.store') }}"
                class="border border-gray-300 rounded-md p-6 shadow">
        @endif
        @csrf

        <!-- Nombre de la Categoría -->
        <div class="mb-4">
            <label for="name" class="block font-medium text-sm text-gray-700">{{ __('Nombre de la Categoría') }}</label>
            <input class="block mt-1 w-full form-input rounded-lg" type="text" name="name"
                value="{{ old('name') ?? @$category->name }} " required>
            @error('name')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">{{ isset($category) ? __('Actualizar') : __('Guardar') }}</button>
        </div>
        </form>
    </div>
</x-app-layout>
