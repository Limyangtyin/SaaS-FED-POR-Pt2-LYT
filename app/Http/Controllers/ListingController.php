<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Termwind\Components\Li;

class ListingController extends Controller
{
    public function index()
    {
        $listings = Listing::paginate(10);
        $trashedCount = Listing::onlyTrashed()->latest()->get()->count();
        return view('listings.index', compact(['listings', 'trashedCount',]));
    }

    public function show(Listing $listing)
    {
        return view('listings.show', compact(['listing',]));
    }

    public function create(): View
    {
        return view('listings.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $rules = ([
            'title' => ['string', 'required', 'min:3', 'max:255'],
            'description' => ['string', 'required'],
            'salary' => ['numeric', 'required'],
            'city' => ['string', 'required', 'min:3', 'max:255'],
            'state' => ['string', 'required'],
            'tags' => ['array', 'required'],
            'company' => ['string', 'required'],
            'address' => ['string', 'required'],
            'phone' => ['string', 'required'],
            'email' => ['email:rfc', 'required'],
            'requirements' => ['string', 'required'],
            'benefits' => ['string', 'required']
        ]);

        $validatedData = $request->validate($rules);
        $validatedData['user_id'] = Auth::id();

        if (!isset($validatedData['tags'])) {
            $validatedData['tags'] = [];
        }

        // Store
        $listing = Listing::create([
            'user_id' => $validatedData['user_id'],
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'salary' => $validatedData['salary'],
            'city' => $validatedData['city'],
            'state' => $validatedData['state'],
            'tags' => $validatedData['tags'],
            'company' => $validatedData['company'],
            'address' => $validatedData['address'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'requirements' => $validatedData['requirements'],
            'benefits' => $validatedData['benefits'],

        ]);

        return redirect(route('listings.index'))->withSuccess("Added '{$listing->title}'.");
    }
//        $request->validate([
//            'title' => 'required|string|max:255',
//            'description' => 'required|string',
//            'salary' => 'required|numeric',
//            'city' => 'required|string|max:255',
//            'tags' => 'required|array',
//        ]);
//
//        $listing = new Listing([
//            'title' => $request->input('title'),
//            'description' => $request->input('description'),
//            'salary' => $request->input('salary'),
//            'city' => $request->input('city'),
//            'tags' => $request->input('tags'),
//        ]);
//
//        $listing->save();
//
//        return redirect()->route('listings.index')->with('success', 'Listing created successfully');

    public function edit(Listing $listing)
    {
        return view('listings.edit', compact('listing'));
    }

    // Handle the update request
    public function update(Request $request, Listing $listing)
    {
        $request->validate([
            'title' => ['string', 'required', 'min:3', 'max:255'],
            'description' => ['string', 'required'],
            'salary' => ['numeric', 'required'],
            'city' => ['string', 'required', 'min:3', 'max:255'],
            'tags' => ['array', 'required'],
        ]);

        $listing->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'salary' => $request->input('salary'),
            'city' => $request->input('city'),
            'tags' => $request->input('tags'),
        ]);

        return redirect()->route('listings.index')->with('success', 'Listing updated successfully');
    }

    /**
     * Show form to confirm deletion of user resource from storage
     */
    public function delete(Listing $listing)
    {
        return view('listings.delete', compact(['listing',]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect(route('listings.index'));
    }

    /**
     * Return view showing all users in the trash
     */
    public function trash(): View
    {
        $listings = Listing::onlyTrashed()->orderBy('deleted_at')->paginate(10);
        return view('listings.trash', compact(['listings',]));
    }

    /**
     * Restore user from the trash
     *
     * @param $user_id
     * @return RedirectResponse
     */
    public function restore($user_id): RedirectResponse
    {
        $listing = Listing::onlyTrashed()->find($user_id);
        $listing->restore();
        return redirect(route('listings.trash'));
    }

    /**
     * Permanently remove all users that are in the trash
     *
     * @return RedirectResponse
     */
    public function empty(): RedirectResponse
    {
        $listings = Listing::onlyTrashed()->get();
//        $trashCount = $users->count();
        foreach($listings as $listing){
            $listing->forceDelete(); // This deletes the soft-deleted listing
        }
        return redirect(route('listings.trash'))->with('success', 'Listing permanently deleted.');
    }

    /**
     * Restore all users in the trash to system
     *
     * @return RedirectResponse
     */
    public function recoverAll(): RedirectResponse
    {
        $listings = Listing::onlyTrashed()->get();
        $trashCount = $listings->count();
        foreach($listings as $listing){
            $listing->restore(); // This restores the soft-deleted user
        }
        return redirect(route('listings.trash'));
    }
}
