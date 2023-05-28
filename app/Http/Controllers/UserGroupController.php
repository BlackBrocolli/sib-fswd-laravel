<?php

namespace App\Http\Controllers;

use App\Models\User_group;
use Illuminate\Http\Request;

class UserGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get user groups data and sort by ID
        $usergroups = User_group::orderBy('id')->get();
        $navitem = 'pengguna';
        $navitemchild = 'grup-pengguna';

        // render view with user groups data
        return view('usergroups.index', compact('usergroups', 'navitem', 'navitemchild'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User_group  $user_group
     * @return \Illuminate\Http\Response
     */
    public function show(User_group $user_group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User_group  $user_group
     * @return \Illuminate\Http\Response
     */
    public function edit(User_group $user_group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User_group  $user_group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User_group $user_group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User_group  $user_group
     * @return \Illuminate\Http\Response
     */
    public function destroy(User_group $user_group)
    {
        //
    }
}
