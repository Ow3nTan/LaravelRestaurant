<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use App\Models\MenuCategory;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    //
    public function index()
    {
        $menus = Menu::with('category')->get();
        return view('admin/menus/index', compact('menus'));
    }

    public function create()
    {
        $categories = MenuCategory::all();
        return view('admin/menus/create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_name' => 'required|string|max:255',
            'menu_category' => 'required|exists:menu_category,category_id',
            'menu_description' => 'required|string|max:200',
            'menu_price' => 'required|numeric',
            'menu_image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $path = $request->file('menu_image')->store('menus', 'public');
        Menu::create([
            'name' => $request->menu_name,
            'description' => $request->menu_description,
            'price' => $request->menu_price,
            'image' => $path,
            'category_id' => $request->menu_category
        ]);

        return redirect()->route('admin/menus.index')->with('success', 'Menu added successfully');
    }

    public function edit(Menu $menu)
    {
        $categories = MenuCategory::all();
        return view('/admin/menus.edit', compact('menu', 'categories'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'menu_name' => 'required|string|max:255',
            'menu_category' => 'required|exists:menu_category,category_id',
            'menu_description' => 'required|string|max:200',
            'menu_price' => 'required|numeric',
            'menu_image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('menu_image')) {
            $path = $request->file('menu_image')->store('menus', 'public');
            $menu->update(['image' => $path]);
        }

        $menu->update([
            'name' => $request->menu_name,
            'description' => $request->menu_description,
            'price' => $request->menu_price,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('admin/menus.index')->with('success', 'Menu updated successfully');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin/menus.index')->with('success', 'Menu deleted successfully');
    }
}
