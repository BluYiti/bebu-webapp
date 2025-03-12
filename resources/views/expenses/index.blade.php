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
                    <table class="table-auto w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th class="border p-2">Date</th>
                                <th class="border p-2">Category</th>
                                <th class="border p-2">Amount</th>
                                <th class="border p-2">Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expenses as $expense)
                                <tr>
                                    <td class="border p-2">{{ $expense->date }}</td>
                                    <td class="border p-2">{{ $expense->category }}</td>
                                    <td class="border p-2">₱{{ number_format($expense->amount, 2) }}</td>
                                    <td class="border p-2">{{ $expense->notes }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
