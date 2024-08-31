<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Free Bootstrap Admin Template : Binary Admin</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="admin/assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="admin/assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="admin/assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="admin/assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

   <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }
        h2, h4 {
            text-align: center;
        }
        #calendar {
            margin: 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }

        .highlighted-date {
            background-color: #ffeb3b !important; /* Change this to your preferred color */
            border-radius: 5px;
            color: #000;
        }
        
        /* Modal Styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;

        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

         #calendar {
            margin: 20px auto;
            height: 5in; /* Set calendar height to 5 inches */
            width: 6in; /* Set calendar width to 6 inches */
        }
    </style>


</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Binary admin</a> 
            </div>
  <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">

                @if(Route::has('login'))

                @auth
                <x-app-layout>
    
                </x-app-layout>
                @else
                
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login</a>
                <a href="{{ route('register') }}" class="btn btn-success btn-sm">Register</a>

                @endauth

                @endif
              
            
 </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                <li class="text-center">
                    <img src="admin/assets/img/find_user.png" class="user-image img-responsive"/>
                    </li>
                
                    
                    <li>
                        <a href="{{url('home')}}"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
                    </li>

                    <li>
                        <a href="{{ url('animal-profiles') }}"><i class="fa fa-square-o fa-3x"></i>Animal List</a>
                    </li>   

                     <li>
                        <a href="{{ url('adoption-requests') }}"><i class="fa fa-square-o fa-3x"></i>Adoption Request</a>
                    </li>   

                    <li>
                        <a href="{{ url('animal-abuse-reports') }}"><i class="fa fa-square-o fa-3x"></i>Animal Report</a>
                    </li> 

                    <li>
                        <a href="{{ url('approved-requests') }}"><i class="fa fa-square-o fa-3x"></i>Set Meeting</a>
                    </li>

                    <li>
                        <a class="active-menu" href="{{ url('appointments') }}"><i class="fa fa-square-o fa-3x"></i>Meeting Scheduled</a>
                    </li>

                   
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                             
                 <!-- /. ROW  -->
<div class="container">
    <h2 style="color:Red; font-size: 20px;">Scheduled Meetings</h2>

    <div id="calendar"></div> <!-- Calendar placeholder -->

    <!-- Button to show all appointments -->
    <div class="">
        <button id="show-all-appointments" style="margin: 20px; padding: 10px 20px; border: solid, 2px, black;">Show All Meetigs</button>
    </div>

    <div class="mt-4">
        <h4 id="selected-date-heading" style="margin-bottom:10px; font-size:20px;">Meetings for <span id="selected-date">All Dates</span></h4>
        <table class="table table-striped" id="appointments-table">
            <thead>
                <tr>
                    <th>Meeting Date</th>
                    <th>Adopter Name</th>
                    <th>Animal Name</th>
                    <th>Update Schedule</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($appointment->meeting_date)->format('d-m-Y H:i') }}</td>
                        <td>{{ $appointment->adoptionRequest->user->name ?? 'N/A' }}</td>
                        <td>{{ $appointment->adoptionRequest->animalProfile->name ?? 'N/A' }}</td>
                        <td>
                            <!-- Update button that triggers the modal -->
                            <button class="btn btn-warning update-schedule-btn" data-id="{{ $appointment->id }}" data-date="{{ $appointment->meeting_date }}">Update</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Update Schedule Modal -->
<div id="updateScheduleModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Update Meeting Schedule</h2>
        <form id="updateScheduleForm">
            @csrf
            <input type="hidden" name="appointment_id" id="appointment_id">
            <div class="form-group">
                <label for="new_meeting_date">New Meeting Date and Time:</label>
                <input type="datetime-local" name="meeting_date" id="new_meeting_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Schedule</button>
        </form>
    </div>
</div>


             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="admin/assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="admin/assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="admin/assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="admin/assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="admin/assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="admin/assets/js/custom.js"></script>
    <!-- jQuery (required for FullCalendar AJAX operations) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var selectedDate = null;

    // Add CSRF token to AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Initialize FullCalendar
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        dateClick: function(info) {
            if (selectedDate) {
                document.querySelector(`.fc-day[data-date="${selectedDate}"]`).classList.remove('highlighted-date');
            }

            selectedDate = info.dateStr;
            info.dayEl.classList.add('highlighted-date');
            fetchAppointmentsForDate(info.dateStr);
        }
    });

    calendar.render();

    function fetchAppointmentsForDate(date) {
        $.ajax({
            url: '{{ route("admin.appointments.byDate") }}',
            method: 'GET',
            data: { date: date },
            success: function(response) {
                $('#selected-date').text(date);
                populateAppointmentsTable(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching appointments:', textStatus, errorThrown);
                alert('Failed to fetch appointments. Please try again.');
            }
        });
    }

    function populateAppointmentsTable(appointments) {
        var tbody = $('#appointments-table tbody');
        tbody.empty();

        if (appointments.length === 0) {
            tbody.append('<tr><td colspan="4">No appointments found.</td></tr>');
        } else {
            $.each(appointments, function(index, appointment) {
                tbody.append(`
                    <tr>
                        <td>${appointment.meeting_date}</td>
                        <td>${appointment.adoption_request.user ? appointment.adoption_request.user.name : 'N/A'}</td>
                        <td>${appointment.adoption_request.animal_profile ? appointment.adoption_request.animal_profile.name : 'N/A'}</td>
                        <td><button class="btn btn-warning update-schedule-btn" data-id="${appointment.id}" data-date="${appointment.meeting_date}">Update</button></td>
                    </tr>
                `);
            });
        }
    }

    $('#show-all-appointments').on('click', function() {
        $('#selected-date').text('All Dates');
        $.ajax({
            url: '{{ route("admin.appointments.all") }}',
            method: 'GET',
            success: function(response) {
                populateAppointmentsTable(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching all appointments:', textStatus, errorThrown);
                alert('Failed to fetch all appointments. Please try again.');
            }
        });
    });

    var modal = document.getElementById('updateScheduleModal');
    var span = document.getElementsByClassName('close')[0];

    $(document).on('click', '.update-schedule-btn', function() {
        var id = $(this).data('id');
        var date = $(this).data('date');
        $('#appointment_id').val(id);
        $('#new_meeting_date').val(new Date(date).toISOString().slice(0, 16));
        modal.style.display = 'block';
    });

    span.onclick = function() {
        modal.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }

    $('#updateScheduleForm').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: '{{ route("admin.appointments.update") }}',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                modal.style.display = 'none';
                fetchAppointmentsForDate($('#selected-date').text());
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error updating schedule:', textStatus, errorThrown);
                alert('Failed to update schedule. Please try again.');
            }
        });
    });
});

</script>
    
   
</body>
</html>
















































