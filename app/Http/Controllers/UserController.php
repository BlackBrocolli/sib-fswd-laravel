<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Menampilkan tabel users
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get users
        $users = User::latest()->get();
        $navitem = 'pengguna';
        $navitemchild = 'daftar-pengguna';

        //render view with posts
        return view('users.index', compact('users', 'navitem', 'navitemchild'));
    }

    /**
     * Menampilkan form tambah user baru
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // render view
        return view('users.create');
    }

    /**
     * Memproses tambah data user baru
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'password' => 'required|string|max:100',
            'role' => ['required', Rule::in(['admin', 'staff'])],
        ]);

        //upload avatar
        $image = $request->file('avatar');
        $avatarName = $image->hashName();
        $image->storeAs('public/images', $avatarName);

        //create post
        User::create([
            'avatar' => "images/$avatarName",
            'name' => $request->name,
            'role' => $request->role,
            'password' => $request->password,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        //redirect to index
        return redirect()->route('users.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Menampilkan detail data user tertentu
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //return view
        return view('users.show', compact('user'));
    }

    /**
     * Menampilkan form edit data user
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // return view
        return view('users.edit', compact('user'));
    }

    /**
     * Proses edit data user
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //validate form
        $this->validate($request, [
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'password' => 'required|string|max:100',
            'role' => ['required', Rule::in(['admin', 'staff'])],
        ]);

        //check if avatar is uploaded
        if ($request->hasFile('avatar')) {
            //upload new avatar
            $image = $request->file('avatar');
            $avatarName = $image->hashName();
            $image->storeAs('public/images', $avatarName);

            //delete old image
            Storage::delete('public/' . $user->avatar);

            //update user with new avatar
            $user->update([
                'avatar' => "images/$avatarName",
                'name' => $request->name,
                'role' => $request->role,
                'password' => $request->password,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        } else {
            //update user without avatar
            $user->update([
                'name' => $request->name,
                'role' => $request->role,
                'password' => $request->password,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        }

        //redirect to index
        return redirect()->route('users.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Hapus data user
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //delete image
        Storage::delete('public/' . $user->avatar);
        //delete post
        $user->delete();
        //redirect to index
        return redirect()->route('users.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
