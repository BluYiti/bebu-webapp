<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Edit Income") }}
                </div>
            </div>

            <div class="container mx-auto p-4 mt-8">
                <h1 class="text-2xl font-bold mb-4 text-black dark:text-white">Edit Income</h1>

                <a href="{{ route('incomes.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mb-4 inline-block">Back to Incomes</a>

                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <form action="{{ route('incomes.update', $income->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="p-6">
                            <div class="mb-4">
                                <label for="source" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Source</label>
                                <input type="text" id="source" name="source" value="{{ old('source', $income->source) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                            </div>

                            <div class="mb-4">
                                <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Amount</label>
                                <input type="number" id="amount" name="amount" value="{{ old('amount', $income->amount) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                            </div>

                            <div class="mb-4">
                                <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
                                <input type="date" id="date" name="date" value="{{ old('date', $income->date) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md">Update Income</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
