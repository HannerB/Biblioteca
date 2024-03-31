<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="pb-5 border-b border-gray-200 sm:flex sm:items-center sm:justify-between">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Categorías</h3>
            <div class="mt-3 sm:mt-0 sm:ml-4">
                <a href="{{ route('category.create') }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Nueva Categoría
                </a>
            </div>
        </div>
        <div class="overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nombre
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Editar</span>
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Eliminar</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($categories as $category)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $category->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('category.edit', $category) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form action="{{ route('category.destroy', $category) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
