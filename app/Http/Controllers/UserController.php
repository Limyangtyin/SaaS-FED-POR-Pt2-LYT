<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use MongoDB\Driver\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loggedInUser = auth()->user();

        if ($loggedInUser->hasRole('Client')) {
            return redirect()->route('users.show', $loggedInUser);
        }

        $users = User::paginate(10);
        $trashedCount = User::onlyTrashed()->latest()->get()->count();
        return view('users.index', compact(['users', 'trashedCount',]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        // Validate
        $rules = [
            'name' => ['string', 'required', 'min:3', 'max:128'],
            'email' => ['required', 'email:rfc', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(4)->letters(),],
        ];
        $validated = $request->validate($rules);

        // Store
        $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]
        );

        $user->hasRole('Client');

        return redirect(route('users.index'))
            ->withSuccess("Added '{$user->name}'.");
    }

    /**
     * Display the specified resource
     */
    public function show(User $user): View
    {
        return view('users.show', compact(['user',]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $loggedInUser = auth()->user();

        if ($loggedInUser->hasRole('Staff') && !$user->hasRole('Client') && $loggedInUser->id !== $user->id) {
            return redirect()->route('users.index')->with('warning', 'Note: As Staff, you can only edit users with the Client role or yourself.');
        }

        return view('users.edit', compact(['user']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if (empty($request['password'])) {
            unset($request['password']);
            unset($request['password_confirmation']);
        }
        // Validate
        $rules = [
            'name' => [
                'string',
                'required',
                'min:3',
                'max:128'
            ],
            'email' => [
                'required',
                'email:rfc',
                Rule::unique('users')->ignore($user),
            ],
            'password' => [
                'sometimes',
                'confirmed',
                Password::min(4)->letters(), // ->uncompromised(),
            ],
            'password_confirmation' => [
                'sometimes',
                'required_unless:password,null',
            ],

        ];
        $validated = $request->validate($rules);

        // Store
        $user->update(
            $validated
//            [
//                'name' => $validated['name'],
//                'email' => $validated['email'],
//                'password' => $validated['password'],
//                'updated_at' => now(),
//            ]
        );

        return redirect(route('users.show', $user))
            ->withSuccess("Updated {$user->name}.");
    }


    /**
     * Show form to confirm deletion of user resource from storage
     */
    public function delete(User $user)
    {
        $loggedInUser = auth()->user();

        if ($loggedInUser->hasRole('Admin') && $loggedInUser->id === $user->id) {
            return redirect()->route('users.index')->with('warning', 'Note: As Admin, you cannot delete yourself.');
        }

        if ($loggedInUser->hasRole('Staff') && !$user->hasRole('Client')) {
            return redirect()->route('users.index')->with('warning', 'Note: As Staff, you can only delete users with the role Client.');
        }

        if ($loggedInUser->hasRole('Client') && $loggedInUser->id !== $user->id) {
            return redirect()->route('users.index')->with('warning', 'Note: As Client, you can only delete yourself.');
        }
        return view('users.delete', compact(['user',]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function forceDestroy($id)
    {
        $user = User::onlyTrashed()->find($id);

        $user->forceDelete(); // This deletes the soft-deleted user

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }


    /**
     * Return view showing all users in the trash
     */
    public function trash()
    {
        $loggedInUser = auth()->user();

        if (!$loggedInUser->hasRole('Admin')) {
            return redirect()->route('users.index')->with('warning', 'Note: Only Admin can access trash view.');
        }

        $users = User::onlyTrashed()->orderBy('deleted_at')->paginate(10);
        return view('users.trash', compact(['users',]));
    }

    /**
     * Restore user from the trash
     *
     * @param $id
     * @return RedirectResponse
     */
    public function restore($id): RedirectResponse
    {
        $user = User::onlyTrashed()->find($id);
        $user->restore();
        return redirect(route('users.trash'));
    }

    /**
     * Permanently remove all users that are in the trash
     *
     * @return RedirectResponse
     */
    public function empty(): RedirectResponse
    {
        $users = User::onlyTrashed()->get();
//        $trashCount = $users->count();
        foreach ($users as $user) {
            $user->forceDelete(); // This deletes the soft-deleted user
        }
        return redirect(route('users.trash'))->with('success', 'User permanently deleted.');
    }

    /**
     * Restore all users in the trash to system
     *
     * @return RedirectResponse
     */
    public function recoverAll(): RedirectResponse
    {
        $users = User::onlyTrashed()->get();
        $trashCount = $users->count();
        foreach ($users as $user) {
            $user->restore(); // This restores the soft-deleted user
        }
        return redirect(route('users.trash'));
    }

}
