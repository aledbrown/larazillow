<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentListingController extends Controller
{
    use AuthorizesRequests;

    // public function __construct()
    // {
    //     $this->authorizeResource(Listing::class, 'listing');
    // }

    public function index()
    {
        return inertia(
            'Agent/Index',
            ['listings' => Auth::user()->listings]
        );
    }

    public function destroy(Listing $listing)
    {
        $this->authorize('delete', $listing);

        $listing->deleteOrFail();
        return redirect()->back()
            ->with('success', 'Listing was deleted!');
    }

}
