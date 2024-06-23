<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\SiteImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

class SiteController extends Controller
{
    public function create()
    {
        return view('sites.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'siteName' => 'required|string|max:255',
            'siteDescription' => 'required|string',
        ]);

        // Create a new Site instance and save the data
        $site = new Site();
        $site->name = $validatedData['siteName'];
        $site->description = $validatedData['siteDescription'];
        $site->save();

        // Redirect or return a response
        return redirect()->back()->with('success', 'Site posted successfully');
    }

    public function sites()
{
    // Retrieve all sites from the database
    $sites = Site::all();

    // Return a view with the sites data
    return view('virtual_sites', compact('sites'));
}


    public function showPostImageForm()
{
    // Retrieve all sites
    $sites = Site::all();
    return view('postimage', compact('sites'));
}

public function postImage(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'site_id' => 'required|exists:sites,id',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'description' => 'required',
    ]);

    // Handle the image upload
    $index = SiteImage::where('site_id', $validatedData['site_id'])->count(); // Count existing images for this site
    $imageName = $index . '-' . Str::slug($validatedData['description']) . '.' . $request->image->extension();
    $request->image->move(public_path('import_marizipano/tiles'), $imageName);
    $imagePath = 'import_marizipano/tiles/' . $imageName; // Store the relative path to the image

    // Save the image path in the database
    $siteImage = new SiteImage;
    $siteImage->site_id = $validatedData['site_id'];
    $siteImage->image_path = $imagePath;
    $siteImage->description = $validatedData['description'];
    $siteImage->save();

    // Redirect or return a response
    return redirect()->back()->with('success', 'Image posted successfully');
}



// Show the edit form
public function edit($id)
{
    $image = SiteImage::findOrFail($id);
    return response()->json($image);
}

// Update the image
public function update(Request $request, $id)
{
    // Validate the request data
    $validatedData = $request->validate([
        'description' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120', // Optional: image is not required
    ]);

    // Find the image record
    $image = SiteImage::findOrFail($id);
    $image->description = $validatedData['description'];

    // If a new image is uploaded, handle the upload
    if ($request->hasFile('image')) {
        $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('import_marizipano/tiles'), $imageName);
        $imagePath = 'import_marizipano/tiles/' . $imageName;
        $image->image_path = $imagePath;
    }

    // Save the updated image
    $image->save();

    return redirect()->back()->with('success', 'Image updated successfully');
}

// Show the confirm delete form
public function confirmDelete($id)
{
    $image = SiteImage::findOrFail($id);
    return response()->json($image);
}

// Delete the image
public function destroy($id)
{
    // Find the image record
    $image = SiteImage::findOrFail($id);

    // Delete the image file from the server
    if (file_exists(public_path($image->image_path))) {
        unlink(public_path($image->image_path));
    }

    // Delete the image record from the database
    $image->delete();

    return redirect()->back()->with('success', 'Image deleted successfully');
}
public function index()
{
    // Retrieve all sites
    $sites = Site::all();

    // Return the view with site data
    return view('viewsites', ['sites' => $sites]);
}


public function viewProcessing($site_id)
{
    $site = Site::findOrFail($site_id);
    $images = $site->images; // Assuming there is a relationship defined in the Site model

    return view('view_processing', compact('site', 'images'));
}

public function showImages($id)
{
    // Retrieve the site based on the $id
    $site = Site::findOrFail($id);

    // Retrieve all images associated with the site
    $images = $site->images; // This assumes 'images' is the relationship method in your Site model

    // Return the view with the site and its images
    return view('site.images', compact('site', 'images'));
}
public function index2(Request $request)
{
   
    $search = $request->query('search');
    $sitesQuery = Site::query();

    if ($search) {
        $sitesQuery->where('name', 'like', '%' . $search . '%');
    }

    $sites = $sitesQuery->paginate(10); // Adjust '10' to your desired items per page

    return view('sites.index', compact('sites'));
}
public function delete(Request $request, $site_id)
{
    try {
        // Find the site by ID
        $site = Site::findOrFail($site_id);

        // Delete the site
        $site->delete();

        // Return a JSON response indicating success
        return response()->json(['message' => 'Site deleted successfully.']);

    } catch (\Exception $e) {
        // Return a JSON response indicating failure
        return response()->json(['message' => 'Failed to delete site.'], 500);
    }
}


}
