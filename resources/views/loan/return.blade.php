<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Devolución de Libro
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Libros prestados</h3>
                    @if ($userLoans->count() > 0)
                        <form method="POST" action="{{ route('book.return') }}">
                            @csrf
                            <div class="grid grid-cols-3 gap-6">
                                @foreach ($userLoans as $loan)
                                    <div class="border rounded-md p-4">
                                        <input type="checkbox" name="loan_ids[]" value="{{ $loan->id }}">
                                        <span class="block mt-2">Usuario: {{ $loan->user_id }}</span>
                                        <span class="block">Libro: {{ $loan->book_id }}</span>
                                        <span class="block">Fecha de préstamo: {{ $loan->created_at->format('Y-m-d') }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-6">
                                <label for="return_date" class="block font-medium text-sm text-gray-700">Fecha de Devolución</label>
                                <input id="return_date" class="block mt-1 w-full" type="date" name="return_date" required />
                            </div>
                            <div class="flex items-center justify-end mt-6">
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                                    Devolver Libro
                                </button>
                            </div>
                        </form>
                    @else
                        <p>No tienes libros prestados actualmente.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
