<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Container\Attributes\Authenticated;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //ALL LISTING
    public  function index()
    {
        return view('listings.index', [
            'listings' => Listing::latest()
                ->filter(request(['tag', 'search']))
                ->paginate(4)
        ]);
    }
    //SHOW SINGLE LISTING
    public  function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }
    public  function create()
    {
        return view('listings.create');
    }
    public  function store(Request $request)
    {
        $formfields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);
        if ($request->hasFile('logo')) {
            $formfields['logo'] = $request
                ->file('logo')
                ->store('logos', 'public');
        }
        $formfields['user_id'] = auth()->id();
        Listing::create($formfields);
        return redirect('/')
            ->with('success', 'Listing created successfully');
    }
    public function edit(Listing $listing)
    {
        // dd($listing->description);
        return view('listings.edit', ['listing' => $listing]);
    }
    public function update(Request $request, Listing $listing)
    {
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        $formfields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'website' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);
        if ($request->hasFile('logo')) {
            $formfields['logo'] = $request
                ->file('logo')
                ->store('logos', 'public');
        }
        //using below the regular method "->"
        $listing->update($formfields);
        return redirect('/')
            ->with('success', 'Listing updated successfully!');
    }
    public function destroy(Listing $listing)
    {
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        $listing->delete();
        return redirect('/')->with('success', 'Listing Deleted Successfully!');
    }
    public function manage()
    {
        return view('listings.manage', [
            'listings' => auth()
                ->user()->listings
        ]);
    }
}
