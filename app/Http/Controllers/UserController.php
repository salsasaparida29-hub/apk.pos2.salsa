<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of users
     */
    public function index(SearchRequest $request)
    {
        $keyword = $request->input('search');

        if ($keyword) {

            $users = User::whereRaw(
                "MATCH(name, email) AGAINST(? IN BOOLEAN MODE)",
                [$keyword]
            )
            ->paginate(10)
            ->withQueryString();

        } else {

            $users = User::paginate(10)
                ->withQueryString();
        }

        return view('users.index', compact('users'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    /**
     * Store new user
     */
    public function store(StoreRequest $request)
    {
        $dataReq = $request->validated();

        $data['name'] = $dataReq['name'];
        $data['email'] = $dataReq['email'];
        $data['password'] = Hash::make($dataReq['password']);
        $data['role_id'] = $dataReq['role_id'];

        User::create($data);

        return redirect()
            ->route('admin.users')
            ->with('success', 'User berhasil dibuat');
    }

    /**
     * Edit form
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update user
     */
    public function update(UpdateRequest $request, User $user)
    {
        $dataReq = $request->validated();

        $user->name = $dataReq['name'];
        $user->email = $dataReq['email'];
        $user->role_id = $dataReq['role_id'];

        if (!empty($dataReq['password'])) {

            $user->password = Hash::make($dataReq['password']);
        }

        $user->save();

        return redirect()
            ->route('admin.users.edit', $user->id)
            ->with('success', 'User updated');
    }

    /**
     * Delete user
     */
public function destroy(User $user)
{
    // cek apakah user punya data penjualan
    if ($user->penjualan()->count() > 0) {

        return back()->with('success','User deleted' );
    }

    $user->delete();

    return back()->with(
        'success',
        'User berhasil dihapus'
    );
}
}
