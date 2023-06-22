<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\User_group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

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
        $usergroups = User_group::orderBy('id')->get();
        $navitem = 'pengguna';
        $navitemchild = 'daftar-pengguna';

        //render view with posts
        return view('users.index', compact('users', 'navitem', 'navitemchild', 'usergroups'));
    }

    /**
     * Menampilkan form tambah user baru
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usergroups = User_group::orderBy('id')->get();
        $navitem = 'pengguna';
        $navitemchild = 'daftar-pengguna';

        // render view
        return view('users.create', compact('navitem', 'navitemchild', 'usergroups'));
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
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'password' => 'required|string|max:100',
            'role' => 'required',
        ]);

        if ($request->hasFile('avatar')) {
            //upload avatar
            /* $image = $request->file('avatar');
            $avatarName = $image->hashName();
            $image->storeAs('public/images', $avatarName); */

            //upload avatar
            $image = $request->file('avatar');
            $avatarName = $image->hashName();

            $imagePath = 'assets-dashboard/img/avatar/' . $avatarName;
            Image::make($image)
                ->save(public_path($imagePath));

            //create user with avatar
            User::create([
                'avatar' => $avatarName,
                'name' => $request->name,
                'role' => $request->role,
                'password' => Hash::make($request->password),
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        } else {
            // create user with default avatar
            User::create([
                'avatar' => 'default-avatar3.jpg',
                'name' => $request->name,
                'role' => $request->role,
                'password' => Hash::make($request->password),
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        }

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
        $usergroups = User_group::orderBy('id')->get();
        $navitem = 'pengguna';
        $navitemchild = 'daftar-pengguna';

        //return view
        return view('users.show', compact('user', 'navitem', 'navitemchild', 'usergroups'));
    }

    /**
     * Menampilkan form edit data user
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $usergroups = User_group::orderBy('id')->get();
        $navitem = 'pengguna';
        $navitemchild = 'daftar-pengguna';

        // return view
        return view('users.edit', compact('user', 'navitem', 'navitemchild', 'usergroups'));
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
        // Validate form
        $this->validate($request, [
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'password' => 'required|string|max:100',
            'role' => 'required',
        ]);

        // Check if email has changed
        if ($request->email !== $user->email) {
            // Validate email uniqueness
            $this->validate($request, [
                'email' => 'unique:users,email',
            ]);
        }

        //check if avatar is uploaded
        if ($request->hasFile('avatar')) {

            //upload new avatar
            $image = $request->file('avatar');
            $avatarName = $image->hashName();

            $imagePath = 'assets-dashboard/img/avatar/' . $avatarName;
            Image::make($image)
                ->save(public_path($imagePath));

            if ($user->avatar != 'default-avatar3.jpg') {
                //delete old avatar
                $oldImagePath = public_path('assets-dashboard/img/avatar/' . $user->avatar);
                File::delete($oldImagePath);
            }

            //update user with new avatar
            $user->update([
                'avatar' => $avatarName,
                'name' => $request->name,
                'role' => $request->role,
                'password' => Hash::make($request->password),
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        } else {
            //update user without avatar
            $user->update([
                'name' => $request->name,
                'role' => $request->role,
                'password' => Hash::make($request->password),
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
        //delete old image
        $oldImagePath = public_path('assets-dashboard/img/avatar/' . $user->avatar);
        File::delete($oldImagePath);
        //delete post
        $user->delete();
        //redirect to index
        return redirect()->route('users.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
