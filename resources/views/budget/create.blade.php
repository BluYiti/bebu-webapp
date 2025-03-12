<x-app-layout>
    <x-slot name="title">
        Create New Budget
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-6">Create a New Budget</h1>

                    <form action="{{ route('budget.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                            <input type="text" id="category" name="category" required
                                   class="mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-white">
                        </div>

                        <div>
                            <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Amount (₱)</label>
                            <input type="number" id="amount" name="amount" step="0.01" required
                                   class="mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-white">
                        </div>

                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Date</label>
                            <input type="date" id="start_date" name="start_date" required
                                   class="mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-white">
                        </div>

                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Date</label>
                            <input type="date" id="end_date" name="end_date" required
                                   class="mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-white">
                        </div>

                        <div>
                            <button type="submit"
                                    class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                                Save Budget
                            </button>
                        </div>
                    </form>

                    <div class="mt-4">
                        <a href="{{ route('budget.index') }}" class="text-blue-500 hover:underline">Back to Budget Overview</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
