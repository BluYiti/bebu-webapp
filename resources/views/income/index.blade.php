<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Incomes Management") }}
                </div>
            </div>

            <div class="container mx-auto p-4 mt-8">
                <h1 class="text-2xl font-bold mb-4 text-black dark:text-white">Allowance</h1>

                <a href="{{ route('incomes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Add Income</a>

                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <table class="w-full table-auto border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2">#</th>
                                <th class="border border-gray-300 px-4 py-2">Source</th>
                                <th class="border border-gray-300 px-4 py-2">Amount</th>
                                <th class="border border-gray-300 px-4 py-2">Date</th>
                                <th class="border border-gray-300 px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="incomes-table">
                            @foreach ($incomes as $income)
                            <tr class="border border-gray-200" id="income-{{ $income->id }}">
                                <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $income->source }}</td>
                                <td class="border border-gray-300 px-4 py-2">₱{{ number_format($income->amount, 2) }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $income->date }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <a href="{{ route('incomes.edit', $income->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>
                                    <button onclick="deleteIncome({{ $income->id }})" class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
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
        function deleteIncome(id) {
            if (confirm('Are you sure you want to delete this income?')) {
                // Send DELETE request using fetch API
                fetch(`/incomes/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (response.ok) {
                        // Remove the income row from the table
                        document.getElementById('income-' + id).remove();
                    } else {
                        alert('An error occurred. Please try again.');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }
    </script>
</x-app-layout>
