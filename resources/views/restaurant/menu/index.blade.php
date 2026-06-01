@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-3xl font-bold">Menu Items</h2>
        <a href="{{ route('menu.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Add Item
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($menuItems as $item)
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-bold mb-2">{{ $item->item_name }}</h3>
                <p class="text-gray-600 mb-2">{{ $item->description }}</p>
                <div class="flex justify-between items-center mb-4">
                    <span class="text-lg font-bold text-green-600">RWF {{ number_format($item->price, 2) }}</span>
                    <span class="px-3 py-1 rounded-full text-sm font-semibold 
                        {{ $item->status === 'available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </div>
                <p class="text-gray-500 text-sm mb-4">{{ $item->category }}</p>
                <div class="flex gap-2">
                    <a href="{{ route('menu.edit', $item->item_id) }}" class="flex-1 bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded text-center">
                        Edit
                    </a>
                    <form method="POST" action="{{ route('menu.destroy', $item->item_id) }}" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-8">
                <p class="text-gray-500">No menu items yet. <a href="{{ route('menu.create') }}" class="text-blue-500">Create one now</a></p>
            </div>
        @endforelse
    </div>
</div>
@endsection
