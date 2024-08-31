<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AnimalProfile;


class HomeController extends Controller
{
    public function homepage()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->usertype == 'user') {

                $animalProfiles = AnimalProfile::where('is_adopted', false)->get();
                
                return view('user.home', compact('animalProfiles'));
            } else {

                return view('admin.home');
            }
        } else {
            return redirect()->back();
        }
    }

    public function show($id)
{
    $animal = AnimalProfile::findOrFail($id);
    return view('user.AnimalProfile', compact('animal'));
}

}

