<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\MenuCategory;
use App\Models\WebsiteSetting;
use App\Models\ImageGallery;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $menuCategories = MenuCategory::all();
        $websiteSettings = WebsiteSetting::all();
        $menus = Menu::all();
        $imageGalleries = ImageGallery::all();
        return view('home', ['menuCategories' => $menuCategories, 'websiteSettings' => $websiteSettings, 
                            'menu'=>$menus, 'imageGalleries'=>$imageGalleries]);
    }
}
