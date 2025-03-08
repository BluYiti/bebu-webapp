@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-xl font-bold mb-4">Expenses</h2>
    <a href="{{ route('expenses.create') }}" class="btn btn-primary">Add Expense</a>

    <table class="table-auto w-full mt-4 border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
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
@endsection
