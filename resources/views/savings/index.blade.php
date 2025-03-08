@extends('layouts.app')

@section('content')
    <h1>Your Savings Goals</h1>

    <a href="{{ route('savings.create') }}" class="btn btn-primary">Add Savings Goal</a>

    <ul>
        @foreach($savings as $saving)
            <li>
                <strong>{{ $saving->title }}</strong> - Goal: ₱{{ number_format($saving->goal_amount, 2) }} 
                (Current: ₱{{ number_format($saving->current_amount, 2) }})
                <a href="{{ route('savings.edit', $saving->id) }}">Edit</a>
                <form action="{{ route('savings.destroy', $saving->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
