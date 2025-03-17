<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Add New Expense") }}
                </div>
            </div>

            <div class="container mx-auto p-4 mt-8">
                <h1 class="text-2xl font-bold mb-4 text-black dark:text-white">Add Expense</h1>

                @if ($errors->any())
                    <div class="bg-red-500 text-white p-4 mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form to create new expense -->
                <form method="POST" action="{{ route('expenses.store') }}">
                    @csrf
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4">
                        <!-- Hidden Fields for user_id and budget_id -->
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="budget_id" value="{{ $selectedBudgetId }}"> <!-- Pass the selected budget id -->
                
                        <!-- Date Field -->
                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
                            <input type="date" id="date" name="date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                
                        <!-- Checkbox to Set Date to Today -->
                        <div class="mb-4 flex items-center">
                            <input type="checkbox" id="set-now" class="mr-2">
                            <label for="set-now" class="text-sm text-gray-700 dark:text-gray-300">Set date to today</label>
                        </div>
                
                        <!-- Category Field -->
                        <div class="mb-4">
                            <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                            <select id="category" name="category" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="" disabled selected>Select a Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}">{{ $category }}</option>
                                @endforeach
                            </select>
                        </div>
                
                        <!-- Amount Field -->
                        <div class="mb-4">
                            <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price (₱)</label>
                            <input type="number" step="0.01" id="amount" name="amount" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                
                        <!-- Quantity Field -->
                        <div class="mb-4">
                            <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quantity</label>
                            <div class="flex items-center">
                                <button type="button" id="decrease-quantity" class="px-2 py-1 bg-gray-200 rounded-l">-</button>
                                <input type="number" id="quantity" name="quantity" value="{{ old('quantity', 1) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" required>
                                <button type="button" id="increase-quantity" class="px-2 py-1 bg-gray-200 rounded-r">+</button>
                            </div>
                        </div>

                        <!-- Total Amount Field -->
                        <div class="mb-4">
                            <label for="total_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Total Amount (₱)</label>
                            <input type="number" id="total_amount" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" readonly>
                        </div>
                
                        <!-- Notes Field -->
                        <div class="mb-4">
                            <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notes</label>
                            <textarea id="notes" name="notes" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>
                
                        <!-- Submit Button -->
                        <div class="mb-4 text-right">
                            <button type="submit" class="inline-block bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">
                                Save Expense
                            </button>
                        </div>
                    </div>
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

        // JavaScript to increase and decrease the quantity
        document.getElementById('increase-quantity').addEventListener('click', function() {
            let quantityInput = document.getElementById('quantity');
            quantityInput.value = parseInt(quantityInput.value) + 1;
            console.log("Quantity after increase: ", quantityInput.value); // Add this line for debugging
        });

        document.getElementById('decrease-quantity').addEventListener('click', function() {
            let quantityInput = document.getElementById('quantity');
            if (parseInt(quantityInput.value) > 1) { // Prevent going below 1
                quantityInput.value = parseInt(quantityInput.value) - 1;
                console.log("Quantity after decrease: ", quantityInput.value); // Add this line for debugging
            }
        });

        // Function to update the total amount based on amount and quantity
        function updateTotalAmount() {
            const amount = parseFloat(document.getElementById('amount').value) || 0;
            const quantity = parseInt(document.getElementById('quantity').value) || 1;
            const totalAmount = amount * quantity;
            document.getElementById('total_amount').value = totalAmount.toFixed(2);
        }

        // Update total amount on quantity or amount change
        document.getElementById('amount').addEventListener('input', updateTotalAmount);
        document.getElementById('quantity').addEventListener('input', updateTotalAmount);

        // Call updateTotalAmount initially to set the default value
        updateTotalAmount();
    </script>
</x-app-layout>
