<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdoptionRequest;
use App\Models\AnimalProfile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AdoptionRequestController extends Controller
{
    /**
     * Display the adoption form for a specific animal.
     */
    public function showAdoptionForm(AnimalProfile $animalprofile)
    {
        return view('user.AdoptionRequestForm', ['animalprofile' => $animalprofile]);
    }

    /**
     * Handle the submission of an adoption request.
     */
    public function submitAdoptionRequest(Request $request, $id)
    {
        // Find the animal profile
        $animalprofile = AnimalProfile::findOrFail($id);

        // Validate the request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string',
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'question1' => 'required|string|max:1000',
            'question2' => 'required|string|max:1000',
            'question3' => 'required|string|max:1000',
            'valid_id' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'valid_id_with_owner' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Store the uploaded files
        $validIdPath = $request->file('valid_id')->store('valid_ids', 'public');
        $validIdWithOwnerPath = $request->file('valid_id_with_owner')->store('valid_ids_with_owners', 'public');

        // Create a new adoption request
        $adoptionRequest = new AdoptionRequest();
        $adoptionRequest->animal_id = $animalprofile->id;
        $adoptionRequest->animal_name = $animalprofile->name;
        $adoptionRequest->first_name = $validatedData['first_name'];
        $adoptionRequest->last_name = $validatedData['last_name'];
        $adoptionRequest->gender = $validatedData['gender'];
        $adoptionRequest->phone_number = $validatedData['phone_number'];
        $adoptionRequest->address = $validatedData['address'];
        $adoptionRequest->salary = $validatedData['salary'];
        $adoptionRequest->question1 = $validatedData['question1'];
        $adoptionRequest->question2 = $validatedData['question2'];
        $adoptionRequest->question3 = $validatedData['question3'];
        $adoptionRequest->valid_id = $validIdPath;
        $adoptionRequest->valid_id_with_owner = $validIdWithOwnerPath;
        $adoptionRequest->user_id = Auth::id(); // Set the user_id to the currently authenticated user's ID
        $adoptionRequest->status = 'Pending';
        $adoptionRequest->save();

        // Mark the animal as adopted
        //$animalprofile->is_adopted = true;
        //$animalprofile->save();

        // Log the success message for debugging
        Log::info('Adoption request submitted successfully for animal ID: ' . $animalprofile->id);

        return redirect()->route('adopt.show', ['animalprofile' => $animalprofile->id])
                         ->with('success', 'Adoption request submitted.');
    }

    /**
     * Display all submitted adoption requests for admins.
     */
    public function submitted()
    {
        $adoption = AdoptionRequest::all();
        return view('admin.AdoptionRequested', compact('adoption'));
    }

    /**
     * Approve an adoption request.
     */
   public function approveAdoption($id)
    {
        $adoptionRequest = AdoptionRequest::findOrFail($id);
        $animalProfile = AnimalProfile::findOrFail($adoptionRequest->animal_id);

        // Mark the adoption request as approved
        $adoptionRequest->status = 'Form Approved';
        $adoptionRequest->approved = true; // Mark as approved
        $adoptionRequest->save();

        // Mark the animal as adopted
        $animalProfile->is_adopted = true;
        $animalProfile->save();

        return redirect()->route('admin.adoption.requests')->with('success', 'Adoption request approved.');
    }

    public function rejectAdoption($id)
    {
        $adoptionRequest = AdoptionRequest::findOrFail($id);
        $animalProfile = AnimalProfile::findOrFail($adoptionRequest->animal_id);

        // Mark the adoption request as rejected
        $adoptionRequest->status = 'Rejected';
        $adoptionRequest->approved = false; // Mark as not approved
        $adoptionRequest->save();

        // Optionally, mark the animal as available again
        $animalProfile->is_adopted = false;
        $animalProfile->save();

        return redirect()->route('admin.adoption.requests')->with('success', 'Adoption request rejected.');
    }


}
