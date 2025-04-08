<x-app-layout>
    <x-slot name="title">
        Budget Overview
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Manage your budget effectively, Bebu!") }}
                </div>
            </div>

            <div class="container mx-auto p-4 mt-8">
                <h1 class="text-2xl font-bold mb-4 text-black dark:text-white">Budget Overview</h1>

                <!-- No Budgets Message (Initially Hidden) -->
                <div id="noBudgetsMessage" class="bg-yellow-100 p-4 rounded-lg hidden">
                    <p class="text-lg text-black mb-4">No budgets available yet. Please create a budget.</p>
                    <a href="{{ route('budget.create') }}" class="text-white bg-green-500 px-4 py-2 rounded-lg hover:bg-green-700">Create Budget</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($budgets as $budget)
                        <div id="budget-card-{{ $budget->id }}" class="p-4 rounded-lg border shadow-sm bg-white dark:bg-gray-700">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Category: {{ $budget->category ?? 'Uncategorized' }}</h2>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Created on: {{ $budget->created_at->format('F j, Y') }}</p>

                            <div class="mt-4">
                                <div class="bg-green-100 p-4 rounded-lg mb-2">
                                    <h3 class="text-md font-medium">Total Budget</h3>
                                    <p class="text-2xl font-bold">₱{{ number_format($budget->amount, 2) }}</p>
                                </div>

                                <div class="bg-red-100 p-4 rounded-lg mb-2">
                                    <h3 class="text-md font-medium">Spent So Far</h3>
                                    <p class="text-2xl font-bold">₱{{ number_format($budget->spent_amount, 2) }}</p>
                                </div>

                                <div class="bg-blue-100 p-4 rounded-lg mb-4">
                                    <h3 class="text-md font-medium">Remaining Budget</h3>
                                    <p class="text-2xl font-bold">₱{{ number_format($budget->total_budget - $budget->spent_amount, 2) }}</p>
                                </div>

                                <!-- Delete Button -->
                                <button type="button" onclick="confirmDelete({{ $budget->id }})" class="text-white bg-red-500 px-4 py-2 rounded-lg hover:bg-red-700">Delete Budget</button>
                            </div>
                        </div>
                    @endforeach                    
                </div>
            
                <div class="mt-8">
                    <a href="{{ route('budget.create') }}" class="text-white bg-green-500 px-4 py-2 rounded-lg hover:bg-green-700">Create New Budget</a>
                </div>
            </div>            
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg p-8 max-w-md w-full">
            <h2 class="text-xl font-bold mb-4">Confirm Deletion</h2>
            <p>Are you sure you want to delete this budget? This action cannot be undone.</p>
            <div class="flex justify-end mt-4">
                <button type="button" onclick="closeModal()" class="text-gray-600 bg-gray-300 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400">Cancel</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-white bg-red-500 px-4 py-2 rounded-lg hover:bg-red-700">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const budgets = @json($budgets); // Convert PHP variable to JavaScript array

            // Check if there are no budgets
            if (budgets.length === 0) {
                // Show the "No budgets" message
                document.getElementById('noBudgetsMessage').classList.remove('hidden');
            } else {
                // Hide the "No budgets" message
                document.getElementById('noBudgetsMessage').classList.add('hidden');
            }
        });

        function confirmDelete(budgetId) {
            const form = document.getElementById('deleteForm');
            form.action = `/budget/${budgetId}`;  // Dynamically set the form action URL
            document.getElementById('deleteModal').classList.remove('hidden'); // Show the modal
        }

        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden'); // Hide the modal
        }

        document.getElementById('deleteForm').addEventListener('submit', function(event) {
            event.preventDefault();  // Prevent form from submitting normally

            // Get the form element
            const form = event.target;

            const budgetId = form.action.split('/').pop();  // Get the budget ID from the URL
            const budgetCard = document.querySelector(`#budget-card-${budgetId}`);  // Get the budget card to remove

            // Send the DELETE request via AJAX
            fetch(form.action, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': form.querySelector('[name="_token"]').value
                }
            })
            .then(response => {
                if (response.ok) {
                    // If successful, remove the budget card from the DOM
                    budgetCard.remove();
                    closeModal();  // Close the modal
                } else {
                    alert('An error occurred while deleting the budget.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while deleting the budget.');
            });
        });
    </script>
</x-app-layout>
