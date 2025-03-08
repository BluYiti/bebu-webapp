<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Sana magamit mo to Bebu ko I love you so much po!") }}
                </div>
            </div>

            <div class="container mx-auto p-4 mt-8">
                <h1 class="text-2xl font-bold mb-4 text-black dark:text-white ">Dashboard Summary</h1>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Total Income -->
                    <div class="bg-green-100 p-4 rounded-lg">
                        <h2 class="text-lg font-semibold">Total Allowance</h2>
                        <p class="text-3xl font-bold">₱{{ number_format($totalIncome, 2) }}</p>
                    </div>

                    <!-- Total Expenses -->
                    <div class="bg-red-100 p-4 rounded-lg">
                        <h2 class="text-lg font-semibold">Total Expenses</h2>
                        <p class="text-3xl font-bold">₱{{ number_format($totalExpenses, 2) }}</p>
                    </div>

                    <!-- Budget Status -->
                    <div class="bg-blue-100 p-4 rounded-lg">
                        <h2 class="text-lg font-semibold">Budget Remaining</h2>
                        <p class="text-3xl font-bold">₱{{ number_format($budgetRemaining, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
