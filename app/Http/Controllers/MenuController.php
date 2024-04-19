<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use App\Models\MenuCategory;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('menuCategory')->get();
        return view('admin/menus/menus', compact('menus'));
    }

    public function create()
    {
        $categories = MenuCategory::all();
        return view('admin/menus/create', compact('categories'));
    }

    public function store(Request $request)
    {

        // dd($request);
        // $request->validate([
        //     'menu_name' => 'required|string|max:255',
        //     'menu_description' => 'required|string|max:255',
        //     'menu_price' => 'required|numeric|min:0',
        //     'category_id' => 'required|exists:menu_category,category_id',
        //     'menu_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        $imagePath = $request->file('menu_image')->store('images','public');
        dd($request->category_id);

        Menu::create([
            'menu_name' => $request->menu_name,
            'menu_description' => $request->menu_description,
            'menu_price' => $request->menu_price,
            'category_id' => $request->category_id,
            'menu_image' => $imagePath
        ]);

        // $menu->menuimage = $imagePath;
        // $menu->save();

        // $data = $request->all();
        // Menu::create($data);

        return redirect('menus')->with('success', 'Menu created successfully.');
    }

    public function edit(Menu $menu)
    {
        $categories = MenuCategory::all();
        return view('admin/menus/edit', compact('menu', 'categories'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'menu_name' => 'required|string|max:255',
            'menu_description' => 'required|string|max:255',
            'menu_price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:menu_category,category_id',
            'menu_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $menu->menu_name = $request->menu_name;
        $menu->menu_description = $request->menu_description;
        $menu->menu_price = $request->menu_price;
        $menu->category_id = $request->category_id;

        if ($request->hasFile('menu_image')) {
            $imagePath = $request->file('menu_image')->store('../../../public/anotherImages', 'public');
            $menu->menu_image = $imagePath;
        }

        $menu->save(); 

        return redirect('menus')->with('success', 'Menu updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        Storage::delete('public/' . $menu->image);
        $menu->delete();

        return redirect('menus')->with('success', 'Menu deleted successfully.');
    }
}