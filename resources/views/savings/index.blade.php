<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Savings Goals Management") }}
                </div>
            </div>

            <div class="container mx-auto p-4 mt-8">
                <h1 class="text-2xl font-bold mb-4 text-black dark:text-white">Your Savings Goals</h1>

                <!-- Display success or error messages -->
                @if(session('success'))
                    <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                        {{ session('error') }}
                    </div>
                @endif
                
                <a href="{{ route('savings.create') }}" class="inline-block bg-blue-500 text-white py-2 px-4 rounded-lg mb-4 hover:bg-blue-600 dark:bg-blue-700 dark:hover:bg-blue-600">
                    Add Savings Goal
                </a>

                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4">
                    <ul class="space-y-4">
                        @foreach($savings as $saving)
                            <li class="pb-4 
                                       @if($saving->current_amount >= $saving->goal_amount) bg-green-100 dark:bg-green-600 border-none @else border-b border-gray-300 dark:border-gray-700 @endif
                                       p-4 rounded-lg">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <strong class="text-lg text-black dark:text-white">{{ $saving->title }}</strong>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            Goal: ₱{{ number_format($saving->goal_amount, 2) }} 
                                            (Current: ₱{{ number_format($saving->current_amount, 2) }})
                                        </p>
                                    </div>

                                    <div class="flex space-x-4">
                                        <!-- Deposit Button -->
                                        <a href="{{ route('savings.deposit.store', $saving->id) }}" 
                                           class="inline-block bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 dark:bg-green-700 dark:hover:bg-green-600">
                                            Deposit
                                        </a>

                                        <!-- Withdraw Button -->
                                        <a href="{{ route('savings.withdraw.store', $saving->id) }}" 
                                           class="inline-block bg-orange-500 text-white py-2 px-4 rounded-lg hover:bg-orange-600 dark:bg-orange-600 dark:hover:bg-orange-500">
                                            Withdraw
                                        </a>

                                        <!-- Edit Button -->
                                        <a href="{{ route('savings.edit', $saving->id) }}" 
                                           class="inline-block bg-yellow-500 text-white py-2 px-4 rounded-lg hover:bg-yellow-600 dark:bg-yellow-600 dark:hover:bg-yellow-500">
                                            Edit
                                        </a>

                                        <!-- Complete Button (New) -->
                                        @if($saving->current_amount >= $saving->goal_amount)
                                            <a href="{{ route('savings.complete', $saving->id) }}" 
                                               class="inline-block bg-teal-500 text-white py-2 px-4 rounded-lg hover:bg-teal-600 dark:bg-teal-600 dark:hover:bg-teal-500">
                                                Complete
                                            </a>
                                        @endif

                                        <!-- Delete Button -->
                                        <form action="{{ route('savings.destroy', $saving->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="inline-block bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-500" 
                                                    onclick="return confirm('Are you sure you want to delete this goal?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
