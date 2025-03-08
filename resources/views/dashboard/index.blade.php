@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Dashboard Summary</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Total Income -->
        <div class="bg-green-100 p-4 rounded-lg">
            <h2 class="text-lg font-semibold">Total Income</h2>
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
@endsection
