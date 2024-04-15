<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ImageGallery;



class GalleryController extends Controller
{
    public function addImage(Request $request)
    {
        // Validate the request
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle the uploaded file
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            
            // Store the image in the public storage folder under 'images'
            $path = $image->storeAs('images', $imageName, 'public');

            // Save the image path to the database or do other operations
            // Assuming you have a model Image to save the info to database
            // Image::create(['name' => $imageName, 'path' => $path]);

            return response()->json(['success' => 'Image uploaded successfully', 'path' => $path]);
        }

        return response()->json(['error' => 'Failed to upload image']);
    }

    public function index()
    {
        $images = ImageGallery::all();
        return view('admin/gallery', compact('images'));
    }

    // Store a new image
    public function store(Request $request)
    {
        $request->validate([
            'image_name' => 'required|string|max:255',
            'gallery_image' => 'required|image|max:2048', // Validation for image uploads
        ]);

        // Handle the uploaded image file
        $imagePath = $request->file('gallery_image')->store('images', 'public');

        // Create new image record in database
        ImageGallery::create([
            'image_name' => $request->image_name,
            'image' => $imagePath, // This stores the path of the uploaded image
        ]);

        return redirect()->route('admin/gallery')->with('success', 'Image added successfully!');
    }

    // Delete an image
    public function destroy($id)
    {
        $image = ImageGallery::findOrFail($id); // Use image_id to find the image

        // Delete the image file from storage
        Storage::delete('public/' . $image->image);

        // Delete the image record from database
        $image->delete();

        return redirect()->route('admin/gallery')->with('success', 'Image deleted successfully!');
    }

}
