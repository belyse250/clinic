@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold mb-6">Add New Menu Item</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('menu.store') }}">
            @csrf

            <div class="mb-4">
                <label for="item_name" class="block text-gray-700 text-sm font-bold mb-2">Item Name</label>
                <input type="text" id="item_name" name="item_name" value="{{ old('item_name') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                <textarea id="description" name="description" rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500">{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price (RWF)</label>
                    <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500">
                </div>

                <div>
                    <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                    <select id="category" name="category"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500">
                        <option value="">Select Category</option>
                        <option value="appetizer">Appetizer</option>
                        <option value="main">Main Course</option>
                        <option value="dessert">Dessert</option>
                        <option value="beverage">Beverage</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>

            <div class="mb-6">
                <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                <select id="status" name="status" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500">
                    <option value="available">Available</option>
                    <option value="unavailable">Unavailable</option>
                </select>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Add Item
                </button>
                <a href="{{ route('menu.index') }}" class="flex-1 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
