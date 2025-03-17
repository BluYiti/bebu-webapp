<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Deposit to Savings Goal") }}
                </div>
            </div>

            <div class="container mx-auto p-4 mt-8">
                <h1 class="text-2xl font-bold mb-4 text-black dark:text-white">Deposit to: {{ $saving->title }}</h1>
                
                <form action="{{ route('savings.deposit.store', $saving->id) }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="deposit_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deposit Amount</label>
                        <input type="number" name="deposit_amount" id="deposit_amount" value="{{ old('deposit_amount') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        @error('deposit_amount')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Current Amount: ₱{{ number_format($saving->current_amount, 2) }} <br>
                            Goal Amount: ₱{{ number_format($saving->goal_amount, 2) }}
                        </p>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="inline-block bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600">
                            Deposit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
