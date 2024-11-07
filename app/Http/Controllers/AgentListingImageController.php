<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgentListingImageController extends Controller
{
    public function create(Listing $listing)
    {
        $listing->load(['images']);

        return inertia(
            'Agent/ListingImage/Create',
            ['listing' => $listing]
        );
    }

    public function store(Listing $listing, Request $request)
    {
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('images/'.$listing->id, 'public');
                $listing->images()->save(new ListingImage([
                    'filename' => $path
                ]));
            }
        }
        return redirect()->back()->with('success', 'Images were uploaded!');
    }

    public function destroy(Listing $listing, ListingImage $image)
    {
        Storage::disk('public')->delete($image->filename);
        $image->delete();
        return redirect()->back()->with('success', 'Image was deleted!');
    }
}
