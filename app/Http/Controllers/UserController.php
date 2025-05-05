<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Properties;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    if ($request->ajax()) {
        $data = User::with('roles')->latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('roles', function ($user) {
                return $user->getRoleNames()->map(function($role){
                    return '<span class="badge bg-success">' . $role . '</span>';
                })->implode(' ');
            })
            ->addColumn('action', function ($row) {
                $btn = '<a href="' . route('users.show', $row->id) . '" class="btn btn-info btn-sm me-1">
                            <i class="fa-solid fa-list me-1"></i> Lihat
                        </a>';

                if (auth()->user()->can('user-edit')) {
                    $btn .= '<a href="' . route('users.edit', $row->id) . '" class="btn btn-primary btn-sm me-1">
                                <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                            </a>';
                }

                if (auth()->user()->can('user-delete')) {
                    $btn .= '<form method="POST" action="' . route('users.destroy', $row->id) . '" class="d-inline" onsubmit="return confirm(\'Yakin ingin menghapus user ini?\')">';
                    $btn .= csrf_field();
                    $btn .= method_field('DELETE');
                    $btn .= '<button type="submit" class="btn btn-danger btn-sm">
                                <i class="fa-solid fa-trash me-1"></i> Hapus
                            </button>';
                    $btn .= '</form>';
                }

                return $btn;
            })
            ->rawColumns(['roles', 'action'])
            ->make(true);
    }

    return view('users.index');
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $roles = Role::pluck('name', 'name')->all();

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $user = User::find($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        FacadesDB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}