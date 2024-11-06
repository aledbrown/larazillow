<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentListingController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request->only(['by', 'order'])
        ];

        return inertia(
            'Agent/Index',
            [
                'filters' => $filters,
                'listings' => Auth::user()
                    ->listings()
                    // ->mostRecent()
                    ->filter($filters)
                    ->paginate()
                    ->withQueryString()
            ]
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
