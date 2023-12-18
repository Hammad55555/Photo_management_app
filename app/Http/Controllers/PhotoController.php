<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Photo;

class YourController extends Controller
{
    public function yourMethod()
    {
        // Example usage of DB facade
        $result = DB::table('your_table')->select('your_column')->get();

        // Rest of your code...
    }
}

class PhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('photos.create'); // Assuming you have a Blade view for creating a new photo
    }

    public function index()
    {
        $photos = Photo::all(); // Assuming you have a "photos" table in your database

        return view('photos.index', compact('photos'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'folderName' =>  'nullable',
            'user_id' => 'required'
        ]);

        // Create a new Photo instance and set its attributes using the validated data
        $photo = new Photo;
        $photo->title = $validatedData['title'];
        $photo->folderName = $validatedData['folderName']; // Set the folderName attribute
        $photo->user_id = $validatedData['user_id']; // Set the user_id attribute

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/photos', $imageName);
            $photo->image = $imageName;
        }

        // Save the Photo instance to the database
        $photo->save();

        return redirect()->route('photos.index')->with('success', 'Photo added successfully!');
    }

    public function show($id)
    {
        $photo = Photo::findOrFail($id);
        $photosByFolder = Photo::all()->groupBy('folderName');

        return view('photos.show', ['photo' => $photo, 'photosByFolder' => $photosByFolder]);
    }

    public function edit(Photo $photo)
    {
        return view('photos.edit', compact('photo'));
    }

    public function update(Request $request, $id)
    {
        // Validate and update the photo
        $request->validate([
            'title' => 'required',
            // Add validation rules for other fields if needed...
        ]);

        $photo = Photo::findOrFail($id);
        $photo->title = $request->title;

        // Handle image update logic here...

        $photo->save();

        return redirect()->route('photos.index')->with('success', 'Photo updated successfully!');
    }

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        $photo->delete();

        return redirect()->route('photos.index')->with('success', 'Photo deleted successfully!');
    }

    public function searchAndDeleteDuplicates(Request $request)
    {
        // Your logic to search for duplicate titles
        $duplicates = Photo::select('title')
            ->groupBy('title')
            ->havingRaw('COUNT(title) > 1')
            ->pluck('title');

        // Delete duplicates
        Photo::whereIn('title', $duplicates)->delete();

        return redirect()->route('photos.index')->with('success', 'Duplicate titles deleted successfully!');
    }

    // Add more methods for other photo management actions
}

// ...
