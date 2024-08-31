<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdoptionRequest;
use App\Models\Meeting;
use Carbon\Carbon;

class MeetingController extends Controller
{
    // Show the list of all approved adoption requests
    public function showApprovedAdoptionRequests()
    {
        // Get all approved adoption requests with the related animal data, excluding those with scheduled meetings
        $approvedRequests = AdoptionRequest::with('animalProfile')
            ->where('approved', true)
            ->whereDoesntHave('meetings') // Exclude requests with existing meetings
            ->get();

        // Return the view with the approved requests
        return view('admin.Meeting', compact('approvedRequests'));
    }

    // Show the form to schedule a meeting
    

    // Handle the scheduling of the meeting
   public function scheduleMeeting(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'adoption_request_id' => 'required|exists:adoption_requests,id',
            'meeting_date' => 'required|date_format:Y-m-d h:i A', // Validate 12-hour format with AM/PM
        ]);

        // Convert the date from 12-hour format to 24-hour format for MySQL
        $meetingDate = Carbon::createFromFormat('Y-m-d h:i A', $request->input('meeting_date'))->format('Y-m-d H:i:s');

        // Check if a meeting already exists for the same adoption_request_id and meeting_date
        $existingMeeting = Meeting::where('adoption_request_id', $request->input('adoption_request_id'))
                                  ->where('meeting_date', $meetingDate)
                                  ->first();

        if ($existingMeeting) {
            // If a meeting already exists, return an error message
            return redirect()->back()->withErrors('A meeting is already scheduled for this user at the selected time.');
        }

        // Create a new meeting
        $meeting = new Meeting();
        $meeting->adoption_request_id = $request->input('adoption_request_id');
        $meeting->meeting_date = $meetingDate; // Use the converted date format
        $meeting->status = 'Scheduled';
        $meeting->save();

        // Redirect to the meetings list with a success message
        return redirect()->route('admin.approved.requests')->with('success', 'Meeting scheduled successfully.');
    }


    // View the list of all appointments
    public function viewAppointmentList()
    {
        // Retrieve all scheduled appointments with related adoption request data
        $appointments = Meeting::with(['adoptionRequest.user', 'adoptionRequest.animalProfile'])
                               ->orderBy('meeting_date', 'asc')
                               ->get();

        // Return the view with the appointments
        return view('admin.AppointmentList', compact('appointments'));
    }

    // Method to fetch appointments by date
    public function getAppointmentsByDate(Request $request)
    {
        // Validate the incoming date
        $date = $request->query('date');

        // Fetch meetings scheduled for the selected date
        $appointments = Meeting::whereDate('meeting_date', $date)
                               ->with(['adoptionRequest.user', 'adoptionRequest.animalProfile'])
                               ->get();

        // Return the appointments as JSON
        return response()->json($appointments);
    }

    public function getAllAppointments()
    {
        $appointments = Meeting::with(['adoptionRequest.user', 'adoptionRequest.animalProfile'])
                                ->orderBy('meeting_date', 'asc')
                                ->get();
                                
        return response()->json($appointments);
    }


    public function update(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'appointment_id' => 'required|exists:meetings,id',
            'meeting_date' => 'required|date_format:Y-m-d\TH:i',
        ]);

        // Find the appointment by ID
        $appointment = Meeting::find($request->appointment_id);

        if ($appointment) {
            // Update the meeting date
            $appointment->meeting_date = $request->meeting_date;
            $appointment->save();

            // Return success response
            return response()->json(['success' => true]);
        }

        // Return failure response if appointment not found
        return response()->json(['success' => false], 404);
    }

}
