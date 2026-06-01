<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // Display list of menu items
    public function index()
    {
        $menuItems = Menu::all();
        return view('restaurant.menu.index', compact('menuItems'));
    }

    // Show form for creating menu item
    public function create()
    {
        return view('restaurant.menu.create');
    }

    // Store menu item in database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'nullable|string',
            'status' => 'required|in:available,unavailable',
        ]);

        Menu::create($validated);

        return redirect()->route('menu.index')->with('success', 'Menu item created successfully');
    }

    // Show menu item
    public function show(Menu $menu)
    {
        return view('restaurant.menu.show', compact('menu'));
    }

    // Show form for editing menu item
    public function edit(Menu $menu)
    {
        return view('restaurant.menu.edit', compact('menu'));
    }

    // Update menu item in database
    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'nullable|string',
            'status' => 'required|in:available,unavailable',
        ]);

        $menu->update($validated);

        return redirect()->route('menu.index')->with('success', 'Menu item updated successfully');
    }

    // Delete menu item
    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('menu.index')->with('success', 'Menu item deleted successfully');
    }
}
