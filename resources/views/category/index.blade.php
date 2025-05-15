<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 dark:text-gray-100 leading-tight">
            {{ __('Todo Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <!-- CREATE BUTTON & FLASH MESSAGE -->
                <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                    <div class="p-6 text-xl text-gray-700 dark:text-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <!-- Ganti route ke kategori -->
                                <x-create-button href="{{ route('category.create') }}" />
                            </div>

                            @if (session('success'))
                                <p x-data="{ show: true }" x-show="show" x-transition
                                   x-init="setTimeout(() => show = false, 5000)"
                                   class="text-sm text-green-500 dark:text-green-300">
                                    {{ session('success') }}
                                </p>
                            @endif

                            @if (session('danger'))
                                <p x-data="{ show: true }" x-show="show" x-transition
                                   x-init="setTimeout(() => show = false, 5000)"
                                   class="text-sm text-red-500 dark:text-red-300">
                                    {{ session('danger') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- CATEGORY TABLE -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-600 dark:text-gray-300">
                        <thead class="text-sm text-gray-600 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                            <tr>
                                <th scope="col" class="px-6 py-3">Title</th>
                                <th scope="col" class="px-6 py-3">Todo</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                    <!-- TITLE CATEGORY -->
                                    <td class="px-6 py-4 font-medium text-gray-800 dark:text-gray-200">
                                        {{ $category->title }} <!-- Menggunakan title -->
                                    </td>

                                    <!-- JUMLAH TODO -->
                                    <td class="px-6 py-4">
                                        {{ $category->todos_count }}
                                    </td>

                                    <!-- AKSI DELETE -->
                                    <td class="px-6 py-4">
                                        <form action="{{ route('category.destroy', $category) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-600 dark:text-red-400 hover:underline text-sm font-medium"
                                                    onclick="return confirm('Are you sure you want to delete this category?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        No category available
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>