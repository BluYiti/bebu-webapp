<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold">Edit Savings Goal</h1>
                </div>
            </div>

            <div class="container mx-auto p-4 mt-8">
                <form action="{{ route('savings.update', $saving->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Title</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $saving->title) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="goal_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Goal Amount</label>
                        <input type="number" id="goal_amount" name="goal_amount" value="{{ old('goal_amount', $saving->goal_amount) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="target_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Target Date</label>
                        <input type="date" id="target_date" name="target_date" value="{{ old('target_date', $saving->target_date) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <button type="submit" class="inline-block bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Update Goal</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
