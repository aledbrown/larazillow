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
        $this->authorize('nonAdmin', Listing::class);

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
                    ->filter($filters)
                    ->withCount('images')
                    ->paginate()
                    ->withQueryString()
            ]
        );
    }

    public function create()
    {
        $this->authorize('create', Listing::class);

        return inertia(
            'Agent/Create'
        );
    }

    public function store(Request $request)
    {
        $this->authorize('create', Listing::class);

        $validatedData = $request->validate([
            'beds' => 'required|integer|min:0|max:20',
            'baths' => 'required|integer|min:0|max:20',
            'area' => 'required|integer|min:15|max:1500',
            'city' => 'required',
            'code' => 'required',
            'street' => 'required',
            'street_nr' => 'required|integer|min:1|max:1000',
            'price' => 'required|integer|min:1|max:20000000',
        ]);

        // Associate new Listings to Logged-in User
        $request->user()->listings()->create($validatedData);

        return redirect()->route('agent.listing.index')
            ->with('success', 'Listing was created!');
    }

    public function destroy(Listing $listing)
    {
        $this->authorize('delete', $listing);

        $listing->deleteOrFail();
        return redirect()->back()
            ->with('success', 'Listing was deleted!');
    }

    public function restore(Listing $listing)
    {
        $this->authorize('restore', $listing);

        $listing->restore();
        return redirect()->back()->with('success', 'Listing was restored!');
    }

    public function edit(Listing $listing)
    {
        $this->authorize('update', $listing);

        return inertia(
            'Agent/Edit',
            [
                'listing' => $listing
            ]
        );
    }

    public function update(Request $request, Listing $listing)
    {
        $this->authorize('update', $listing);

        $listing->update(
            $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'required|integer|min:15|max:1500',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|min:1|max:1000',
                'price' => 'required|integer|min:1|max:20000000',
            ])
        );
        return redirect()->route('agent.listing.index')
            ->with('success', 'Listing was updated!');
    }



}
