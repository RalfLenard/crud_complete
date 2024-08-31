<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Free Bootstrap Admin Template : Binary Admin</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="/admin/assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="/admin/assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="/admin/assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
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
                    <img src="/admin/assets/img/find_user.png" class="user-image img-responsive"/>
                    </li>
                
                    
                    <li>
                        <a href="{{url('home')}}"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
                    </li>

                     <li>
                        <a href="{{ url('animal-profiles') }}"><i class="fa fa-square-o fa-3x"></i>Animal List</a>
                    </li>  

                    <li>
                        <a active-menu href="{{ url('adoption-requests') }}"><i class="fa fa-square-o fa-3x"></i>Adoption Request</a>
                    </li>

                    <li>
                        <a class="active-menu" href="{{ url('report/abuse') }}"><i class="fa fa-square-o fa-3x"></i>Animal Report</a>
                    </li>

                     <li>
                        <a href="{{ url('approved-requests') }}"><i class="fa fa-square-o fa-3x"></i>Set Meeting</a>
                    </li>

                    <li>
                        <a href="{{ url('appointments') }}"><i class="fa fa-square-o fa-3x"></i>Meeting Scheduled</a>
                    </li>
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     
                        <div class="panel panel-default">
                        <div class="panel-heading">
                             Advanced Tables
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Description</th>
                                            <th>Photo 1</th>
                                            <th>Photo 2</th>
                                            <th>Photo 3</th>
                                            <th>Photo 4</th>
                                            <th>Photo 5</th>
                                            <th>video 1</th>
                                            <th>video 2</th>
                                            <th>video 3</th>
                                            <th>Update</th>
                                            <th>Delete</th>


                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach ($abuses as $abuse)
                                        <tr class="odd gradeX">
                                            <td>{{ $abuse->description }}</td>

                                            <td>
                                            @if($abuse->photos1)
                                                <img width="40px" height="40px" src="{{ Storage::url($abuse->photos1) }}" class="card-img-top" >
                                            @else
                                                <p>No image available.</p>
                                            @endif
                                            </td>

                                            <td>
                                            @if($abuse->photos2)
                                                <img width="40px" height="40px" src="{{ Storage::url($abuse->photos2) }}" class="card-img-top" >
                                            @else
                                                <p>No image available.</p>
                                            @endif
                                            </td>

                                            <td>
                                            @if($abuse->photos3)
                                                <img width="40px" height="40px" src="{{ Storage::url($abuse->photos3) }}" class="card-img-top" >
                                            @else
                                                <p>No image available.</p>
                                            @endif
                                            </td>

                                            <td>
                                            @if($abuse->photos4)
                                                <img width="40px" height="40px" src="{{ Storage::url($abuse->photos4) }}" class="card-img-top" >
                                            @else
                                                <p>No image available.</p>
                                            @endif
                                            </td>

                                            <td>
                                            @if($abuse->photos5)
                                                <img width="40px" height="40px" src="{{ Storage::url($abuse->photos5) }}" class="card-img-top" >
                                            @else
                                                <p>No image available.</p>
                                            @endif
                                            </td>

                                            <td>
                                                @if($abuse->videos1)
                                                    <video width="320" height="240" controls>
                                                        <source src="{{ Storage::url($abuse->videos1) }}" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                @else
                                                    <p>No video available.</p>
                                                @endif
                                            </td>

                                             <td>
                                                @if($abuse->videos2)
                                                    <video width="320" height="240" controls>
                                                        <source src="{{ Storage::url($abuse->videos2) }}" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                @else
                                                    <p>No video available.</p>
                                                @endif
                                            </td>

                                             <td>
                                                @if($abuse->videos3)
                                                    <video width="320" height="240" controls>
                                                        <source src="{{ Storage::url($abuse->videos3) }}" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                @else
                                                    <p>No video available.</p>
                                                @endif
                                            </td>

                                            
                                            <td>
                                            <a href="" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="" method="POST" style="display:inline;">
                                                @csrf
                                            <td>    
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </td>
                                            </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>


                         
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="/admin/assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="/admin/assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="/admin/assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="/admin/assets/js/custom.js"></script>
    
   
</body>
</html>
