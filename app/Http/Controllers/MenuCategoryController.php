<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuCategory;

class MenuCategoryController extends Controller
{
    public function handleAjaxRequest(Request $request)
    {
        if ($request->has('do') && $request->input('do') == 'Add') {
            return $this->addCategory($request);
        } elseif ($request->has('do') && $request->input('do') == 'Delete') {
            return $this->deleteCategory($request);
        }
    }

    protected function addCategory(Request $request)
    {
        $categoryName = $request->input('category_name');

        $existingCategory = MenuCategory::where('category_name', $categoryName)->exists();

        if ($existingCategory) {
            return response()->json([
                'alert' => 'Warning',
                'message' => 'This category name already exists!'
            ]);
        }

        MenuCategory::create([
            'category_name' => $categoryName
        ]);

        return response()->json([
            'alert' => 'Success',
            'message' => 'The new category has been inserted successfully!'
        ]);
    }

    protected function deleteCategory(Request $request)
    {
        $categoryId = $request->input('category_id');

        MenuCategory::where('category_id', $categoryId)->delete();

        return response()->json([
            'alert' => 'Success',
            'message' => 'The category has been deleted successfully!'
        ]);
    }
}
