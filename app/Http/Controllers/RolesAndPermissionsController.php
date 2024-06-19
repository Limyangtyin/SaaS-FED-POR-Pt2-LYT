<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsController extends Controller
{
    public static function middleware(): array
    {
        return[
            'role:Admin'
        ];
    }

    function __construct(){
        $this->middleware('password.confirm');


//        Gate::define('can delete admin', function(User $loggedInUser, User $userToDelete) {
//            return $loggedInUser->hasRole('Admin') && $loggedInUser->id !== $userToDelete->id && !$userToDelete->hasRole('Admin');
//        });
//
//        Gate::define('can delete staff', function(User $loggedInUser, User $userToDelete) {
//            return $loggedInUser->hasRole('Admin') && $userToDelete->hasRole('Staff');
//        });
//
//        Gate::define('can delete client', function(User $loggedInUser, User $userToDelete) {
//            return ($loggedInUser->hasRole('Admin') || $loggedInUser->hasRole('Staff')) && $userToDelete->hasRole('Client');
//        });
    }

    public function index(){
        // build the user-selector dropdown array for the view
        $select = new User;
        $select->id = 0;
        $select->name = 'Please select';

        $excludeRoles = [];
        // don't allow admins to be deleted unless pass the rule defined earlier
        if (!auth()->user()->can('can delete admins')){
            $excludeRoles[] = 'Admin';
        }

        $roles = Role::whereNotIn('name', $excludeRoles)
            // ALERT: agnostic of guard_name here!
        ->with('users')->get();

        // build a list of users for the dropdown
        $users = User::query()->with('roles')->get();

        return view('admin.roles_editor', [
            'roles' => $roles,
            'users' => $users->prepend($select),
            'canEdit' => auth()->user()->can('assign roles'),
            'canDeleteAdmins' => auth()->user()->can('can delete admins'),
            'canDeleteStaffs' => auth()->user()->can('can delete staffs'),
            'canDeleteClients' => auth()->user()->can('can delete clients'),
        ]);
    }

    public function store(Request $request){
//        dd(auth()->user()->getAllPermissions()); // Check the user's permissions

        \abort_unless($request->user()->can('assign roles'), '403',
        'You do not have permission to make Role assignments');

        $rules = [
            'member_id' => 'exists:users,id',
            'role_id' => 'exists:roles,id',
        ];

        $request->validate($rules);

        $member = User::find($request->input('member_id'));
        $role = Role::find($request->input('role_id'));

        // if member already has the role, flash message and return
        if($member->hasRole($role)){
            // optionally flash a session error message
            // flash()->warning('Note: Member already has the selected role. No action taken.');

            return redirect(route('admin.permissions'));
        }

        // do the assignment
        $member->assignRole($role);

        // optionally flash a success message
        // flash()->success($role->name. 'role assigned to'. $member->name. '.');
        if ($role->name === 'Staff' && $member->hasAnyRole('Client', 'Admin')) {
            $member->removeRole('Client');
            $member->removeRole('Admin');
        }
        if ($role->name === 'Admin' && $member->hasAnyRole('Staff', 'Client')) {
            $member->removeRole('Staff');
            $member->removeRole('Client');
        }
        if ($role->name === 'Client' && $member->hasAnyRole('Admin', 'Staff')) {
            $member->removeRole('Admin');
            $member->removeRole('Staff');
        }

        return redirect(route('admin.permissions'))->with('success', 'Role Created.Updated successfully');
    }

    public function destroy(Request $request){
        \abort_unless($request->user()->can('assign roles'), 403,
            'You do not have permission to make Role assignments');

        $rules = [
            'member_id' => 'exists:users,id',
            'role_id' => 'exists:roles,id',
        ];

        $request->validate($rules);

        $member = User::find($request->input('member_id'));
        $role = Role::find($request->input('role_id'));

        // cannot remove if doesn't already have it
        if($member->hasRole($role)) {
            // flash a session error message
            // flash()->warning('Note: Member does not have the selected role. No action taken.');

            return redirect(route('admin.permissions'));
        }

        // Prevent tampering with admins
        if($role->name === 'Admin' && $request->user()->cannot('can delete admins')){
            // flash()->warning('Action could not be taken.');
            return redirect(route('admin.permissions'));
        }

        // Prevent tampering with staffs
        if($role->name === 'Staff' && $request->user()->cannot('can delete staffs')){
            // flash()->warning('Action could not be taken.');
            return redirect(route('admin.permissions'));
        }

        // do the actual removal
        $member->removeRole($role);

        return redirect(route('admin.permissions'))->with('success', 'Role deleted successfully');
    }
}
