<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Create Savings Goal") }}
                </div>
            </div>

            <div class="container mx-auto p-4 mt-8">
                <h1 class="text-2xl font-bold mb-4 text-black dark:text-white">New Savings Goal</h1>

                <form action="{{ route('savings.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" id="title" name="title" required class="w-full border-gray-300 rounded-lg p-2">
                    </div>

                    <div class="mb-4">
                        <label for="goal_amount" class="block text-sm font-medium text-gray-700">Goal Amount</label>
                        <input type="number" id="goal_amount" name="goal_amount" required class="w-full border-gray-300 rounded-lg p-2">
                    </div>

                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">
                        Save Goal
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
