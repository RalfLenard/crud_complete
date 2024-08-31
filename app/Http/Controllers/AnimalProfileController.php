<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AnimalProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnimalProfileController extends Controller
{
    /**
     * Show the form for creating a new animal profile.
     */
   

    /**
     * Store a newly created animal profile in storage.
     */
    public function store(Request $request)
        {
            $request->validate([
                'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'description' => 'required|string|max:255',
                'name' => 'required|string|max:100',
                'age' => 'required|integer|min:0',
                'medical_records' => 'required|string|max:1000',
            ]);

            // Handle file upload
            $profilePicturePath = $request->file('profile_picture')->store('animal_profiles', 'public');

            // Create animal profile
            AnimalProfile::create([
                'profile_picture' => $profilePicturePath,
                'description' => $request->description,
                'name' => $request->name,
                'age' => $request->age,
                'medical_records' => $request->medical_records,
            ]);

            return redirect()->back()->with('success', 'Animal profile uploaded successfully.');
        }



    /**
     * Display a listing of animal profiles.
     */
    public function list()
    {
        // Fetch all animal profiles
        $animalProfiles = AnimalProfile::where('is_adopted', false)->get();
        // Pass the profiles to the view
        return view('admin.AnimalProfileList', compact('animalProfiles'));
    }


    //
    public function destroy($id)
    {
        $animal = AnimalProfile::find($id);
        $animal->delete();

        return redirect()->back()->with('success', 'Animal profile deleted successfully.');
    }


        // update
       public function update(Request $request, $id)
    {
        $animal = AnimalProfile::find($id);

        // Update fields
        $animal->name = $request->input('name');
        $animal->description = $request->input('description');
        $animal->age = $request->input('age');
        $animal->medical_records = $request->input('medical_records');

        // Handle profile picture update if provided
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('animal_profiles', 'public');
            $animal->profile_picture = $path;
        }

        $animal->save();
        return redirect()->back()->with('success', 'Animal profile updated successfully.');
    }
}
