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

                <!-- Current Budget Information -->
                @if(isset($budget))
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Total Budget -->
                        <div class="bg-green-100 p-4 rounded-lg">
                            <h2 class="text-lg font-semibold">Total Budget</h2>
                            <p class="text-3xl font-bold">₱{{ number_format($budget->total_budget, 2) }}</p>
                        </div>

                        <!-- Spent Amount -->
                        <div class="bg-red-100 p-4 rounded-lg">
                            <h2 class="text-lg font-semibold">Spent So Far</h2>
                            <p class="text-3xl font-bold">₱{{ number_format($budget->spent_amount, 2) }}</p>
                        </div>

                        <!-- Remaining Budget -->
                        <div class="bg-blue-100 p-4 rounded-lg">
                            <h2 class="text-lg font-semibold">Remaining Budget</h2>
                            <p class="text-3xl font-bold">₱{{ number_format($budget->total_budget - $budget->spent_amount, 2) }}</p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <!-- Edit Button (if user has permission) -->
                        <a href="{{ route('budget.edit', $budget->id) }}" class="btn btn-primary text-white bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-700">Edit Budget</a>
                    </div>

                @else
                    <div class="alert alert-warning bg-yellow-100 p-4 rounded-lg">
                        <p class="text-lg text-black">No budget set yet. Please create a budget.</p>
                        <a href="{{ route('budget.create') }}" class="btn btn-success text-white bg-green-500 px-4 py-2 rounded-lg hover:bg-green-700">Create Budget</a>
                    </div>
                @endif

                <!-- Budget Form (only if no current budget) -->
                @if(!isset($budget))
                    <div class="mt-8">
                        <div class="card bg-white shadow-md p-6 rounded-lg">
                            <h5 class="text-lg font-semibold">Set Your Budget</h5>
                            <form action="{{ route('budget.update', $budget->id ?? '') }}" method="POST">
                                @csrf
                                @method($budget ? 'PUT' : 'POST')

                                <div class="form-group mb-4">
                                    <label for="total_budget" class="block text-gray-700">Total Budget</label>
                                    <input type="number" step="0.01" class="form-control w-full p-2 mt-2 border border-gray-300 rounded-lg" id="total_budget" name="total_budget" value="{{ old('total_budget', $budget->total_budget ?? '') }}" required>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="spent_amount" class="block text-gray-700">Spent Amount</label>
                                    <input type="number" step="0.01" class="form-control w-full p-2 mt-2 border border-gray-300 rounded-lg" id="spent_amount" name="spent_amount" value="{{ old('spent_amount', $budget->spent_amount ?? '') }}" required>
                                </div>

                                <button type="submit" class="btn btn-primary text-white bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-700">Save Budget</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
