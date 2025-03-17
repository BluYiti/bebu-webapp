<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Add New Income") }}
                </div>
            </div>

            <div class="container mx-auto p-4 mt-8">
                <h1 class="text-2xl font-bold mb-4 text-black dark:text-white">New Income Entry</h1>

                <form action="{{ route('incomes.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
                    @csrf

                    <div class="mb-4">
                        <label for="source" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Source</label>
                        <input type="text" name="source" id="source" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Amount</label>
                        <input type="number" name="amount" id="amount" step="0.01" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
                        <input type="date" name="date" id="date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                
                    <!-- Checkbox to Set Date to Today -->
                    <div class="mb-4 flex items-center">
                        <input type="checkbox" id="set-now" class="mr-2">
                        <label for="set-now" class="text-sm text-gray-700 dark:text-gray-300">Set date to today</label>
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save Income</button>
                    <a href="{{ route('incomes.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        // JavaScript to set the date to today when the checkbox is checked
        document.getElementById('set-now').addEventListener('change', function() {
            const dateInput = document.getElementById('date');
            if (this.checked) {
                const today = new Date().toISOString().split('T')[0]; // Get the current date in YYYY-MM-DD format
                dateInput.value = today;
            } else {
                dateInput.value = ''; // Clear the date input if unchecked
            }
        });
    </script>
</x-app-layout>
