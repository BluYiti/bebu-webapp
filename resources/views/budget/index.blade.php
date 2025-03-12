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

                @if($budgets->isEmpty())
                    <div class="alert alert-warning bg-yellow-100 p-4 rounded-lg">
                        <p class="text-lg text-black mb-4">No budgets available yet. Please create a budget.</p> <!-- Added margin bottom -->
                        <a href="{{ route('budget.create') }}" class="btn btn-success text-white bg-green-500 px-4 py-2 rounded-lg hover:bg-green-700">Create Budget</a>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach($budgets as $budget)
                            <div class="bg-green-100 p-4 rounded-lg">
                                <h2 class="text-lg font-semibold">Total Budget</h2>
                                <p class="text-3xl font-bold">₱{{ number_format($budget->total_budget, 2) }}</p>
                            </div>

                            <div class="bg-red-100 p-4 rounded-lg">
                                <h2 class="text-lg font-semibold">Spent So Far</h2>
                                <p class="text-3xl font-bold">₱{{ number_format($budget->spent_amount, 2) }}</p>
                            </div>

                            <div class="bg-blue-100 p-4 rounded-lg">
                                <h2 class="text-lg font-semibold">Remaining Budget</h2>
                                <p class="text-3xl font-bold">₱{{ number_format($budget->total_budget - $budget->spent_amount, 2) }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="mt-8">
                    <a href="{{ route('budget.create') }}" class="btn btn-success text-white bg-green-500 px-4 py-2 rounded-lg hover:bg-green-700">Create New Budget</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
