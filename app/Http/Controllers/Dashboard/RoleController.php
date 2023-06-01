<?php

namespace App\Http\Controllers\Dashboard;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class RoleController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_roles'])->only('index');
        $this->middleware(['permission:create_roles'])->only('create');
        $this->middleware(['permission:update_roles'])->only('edit');
        $this->middleware(['permission:delete_roles'])->only('destroy');

    }//end of constructor

    public function index(Request $request)
    {
        // $roles = role::whereRoleIs('admin')->where(function ($q) use ($request) {
            $roles = Role::latest()->paginate(5);

        return view('dashboard.roles.index', compact('roles'));

    }//end of index

    public
    function create()
    {
        return view('dashboard.roles.create');

    }//end of create

    public
    function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'permissions' => 'required|min:1'
        ]);

        $request_data = $request->all();

        //dd($request_data->permissions);
        $role = role::create($request_data);
        $role->syncPermissions($request->permissions);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.roles.index');

    }//end of store

    public
    function edit(role $role)
    {
        return view('dashboard.roles.edit', compact('role'));

    }//end of role

    public
    function update(Request $request, role $role)
    {
        $request->validate([
            'name' => 'required',
             'permissions' => 'required|min:1'
        ]);

        $request_data = $request->all();


        $role->update($request_data);

        $role->syncPermissions($request->permissions);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.roles.index');

    }//end of update

    public
    function destroy(role $role)
    {

        $role->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.roles.index');

    }//end of destroy

}//end of controller
