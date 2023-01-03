<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = Profile::get();
        return view('profiles.index', ['profiles' => $profiles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|unique:profiles|max:30',
            'profile_pic' => 'nullable|url|max:2048',
        ]);

        $profile = new Profile;
        $profile->username = $validatedData['username'];
        $profile->profile_pic = $validatedData['profile_pic'];
        $profile->user_id = Auth::id();
        $profile->save();

        session()->flash('message', 'Profile was successfully created!');
        return redirect()->route('profiles.show', ['id' => Auth::user()->profile->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::findOrFail($id);
        return view('profiles.show', ['profile' => $profile]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = Profile::findOrFail($id);
        return view('profiles.edit', ['profile' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $profile = Profile::findOrFail($id);

        $validatedData = $request->validate([
            'username' => [
                'required',
                'max:30',
                Rule::unique('profiles')->ignore($id),],
            'profile_pic' => 'nullable|url|max:2048',
        ]);

        $profile->username = $validatedData['username'];
        $profile->profile_pic = $validatedData['profile_pic'];
        $profile->user_id = Auth::id();
        $profile->save();

        if ($profile->wasChanged()) {
            session()->flash('message', 'Profile was successfully edited!');
        }
        return redirect()->route('profiles.show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);
        $user_id = $profile->user->id;
        $profile->delete();

        return redirect()->route('users.show', ['id' => $user_id])->with('message', 'Profile was successfully deleted');
    }
}
