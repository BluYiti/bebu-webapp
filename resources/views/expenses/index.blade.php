<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Expenses Management") }}
                </div>
            </div>

            <div class="container mx-auto p-4 mt-8">
                <h1 class="text-2xl font-bold mb-4 text-black dark:text-white">Expenses List</h1>
                
                <a href="{{ route('expenses.create') }}" class="inline-block bg-blue-500 text-white py-2 px-4 rounded-lg mb-4 hover:bg-blue-600">
                    Add Expense
                </a>

                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4">
                    <table class="table-auto w-full border-collapse border border-gray-300 dark:border-gray-600">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                <th class="border p-2">Date</th>
                                <th class="border p-2">Category</th>
                                <th class="border p-2">Amount</th>
                                <th class="border p-2">Quantity</th>
                                <th class="border p-2">Total Amount</th>
                                <th class="border p-2">Notes</th>
                                <th class="border p-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expenses as $expense)
                                <tr id="expense-{{ $expense->id }}" class="text-gray-900 dark:text-gray-100">
                                    <td class="border p-2 border-gray-300 dark:border-gray-600">{{ $expense->date }}</td>
                                    <td class="border p-2 border-gray-300 dark:border-gray-600">{{ $expense->category }}</td>
                                    <td class="border p-2 border-gray-300 dark:border-gray-600">₱{{ number_format($expense->amount, 2) }}</td>
                                    <td class="border p-2 border-gray-300 dark:border-gray-600">{{ $expense->quantity }}</td>
                                    <td class="border p-2 border-gray-300 dark:border-gray-600">₱{{ number_format($expense->total_amount, 2) }}</td>
                                    <td class="border p-2 border-gray-300 dark:border-gray-600">{{ $expense->notes }}</td>
                                    <td class="border p-2 border-gray-300 dark:border-gray-600">
                                        <button class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 dark:hover:bg-red-400 delete-btn" data-id="{{ $expense->id }}">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add event listener to each delete button
            const deleteButtons = document.querySelectorAll('.delete-btn');
            
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const expenseId = this.getAttribute('data-id');
                    if (confirm('Are you sure you want to delete this expense?')) {
                        deleteExpense(expenseId);
                    }
                });
            });

            // Function to delete an expense
            function deleteExpense(expenseId) {
                fetch(`/expenses/${expenseId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`expense-${expenseId}`).remove();
                        alert('Expense deleted successfully!');
                    } else {
                        alert('There was an error deleting the expense.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('There was an error deleting the expense.');
                });
            }
        });
    </script>

    <!-- CSRF Token for AJAX requests -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</x-app-layout>
