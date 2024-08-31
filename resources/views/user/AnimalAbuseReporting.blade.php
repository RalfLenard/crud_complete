<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Sixteen Clothing HTML Template</title>

    <!-- Bootstrap core CSS -->
    <link href="/user/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="/user/assets/css/fontawesome.css">
    <link rel="stylesheet" href="/user/assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="/user/assets/css/owl.css">

    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
        }
        .full-height {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa; /* Light background color */
        }
        .form-container {
            width: 100%;
            max-width: 600px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .form-container h2 {
            margin-bottom: 1rem;
            font-size: 1.5rem;
            color: #333;
        }
        .form-container .form-group {
            margin-bottom: 1rem;
        }
        .form-container .form-control {
            border-radius: 5px;
            border: 1px solid #ced4da;
            padding: 0.75rem 1.25rem;
            font-size: 1rem;
        }
        .form-container .btn {
            border-radius: 5px;
            padding: 0.75rem 1.25rem;
            font-size: 1rem;
        }
        .form-container .btn-primary {
            background-color: #007bff;
            border: none;
            color: #ffffff;
        }
        .form-container .btn-primary:hover {
            background-color: #0056b3;
        }
        .form-container .btn-secondary {
            background-color: #6c757d;
            border: none;
            color: #ffffff;
        }
        .form-container .btn-secondary:hover {
            background-color: #5a6268;
        }


    /* Ensuring navbar is on top */
    .navbar {
      z-index: 1000; /* High z-index to avoid overlap */
    }
  
    </style>

</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="" style="position: relative; top: 0;">
      <header class="" style="position: relative; top: 0;">
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="{{url('home')}}">
          <h2>Sixteen <em>Clothing</em></h2>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{url('home')}}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="{{url('report/abuse')}}">Report Animal Abuse</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('chatify')}}">Message</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Notification</a>
            </li>

            @if(Route::has('login'))
            @auth
            <!-- Display user profile and logout links -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }}
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
              </div>
            </li>
            @else
            <li class="nav-item">
              <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('register') }}" class="btn btn-success btn-sm">Register</a>
            </li>
            @endauth
            @endif
          </ul>
        </div>
      </div>
    </nav>
    </header>

    <!-- Page Content -->
    <div class="full-height">
        <div class="form-container">
            <h2>Report Animal Abuse</h2>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('report.abuse.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="description">Description (Optional)</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                </div>

                <h5 class="mt-4 mb-3">Upload Photos (Optional)</h5>

                <div class="form-group">
                    <label for="photos1">Photo 1</label>
                    <input type="file" class="form-control" id="photos1" name="photos1" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="photos2">Photo 2</label>
                    <input type="file" class="form-control" id="photos2" name="photos2" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="photos3">Photo 3</label>
                    <input type="file" class="form-control" id="photos3" name="photos3" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="photos4">Photo 4</label>
                    <input type="file" class="form-control" id="photos4" name="photos4" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="photos5">Photo 5</label>
                    <input type="file" class="form-control" id="photos5" name="photos5" accept="image/*">
                </div>

                <h5 class="mt-4 mb-3">Upload Videos (Optional)</h5>

                <div class="form-group">
                    <label for="videos1">Video 1</label>
                    <input type="file" class="form-control" id="videos1" name="videos1" accept="video/*">
                </div>

                <div class="form-group">
                    <label for="videos2">Video 2</label>
                    <input type="file" class="form-control" id="videos2" name="videos2" accept="video/*">
                </div>

                <div class="form-group">
                    <label for="videos3">Video 3</label>
                    <input type="file" class="form-control" id="videos3" name="videos3" accept="video/*">
                </div>

                <button type="submit" class="btn btn-primary">Submit Report</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="/user/vendor/jquery/jquery.min.js"></script>
    <script src="/user/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Additional Scripts -->
    <script src="/user/assets/js/custom.js"></script>
    <script src="/user/assets/js/owl.js"></script>
    <script src="/user/assets/js/slick.js"></script>
    <script src="/user/assets/js/isotope.js"></script>
    <script src="/user/assets/js/accordions.js"></script>

    <script language="text/Javascript"> 
        cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
        function clearField(t){                   //declaring the array outside of the
            if(!cleared[t.id]){                    //function to keep flag throughout 
                cleared[t.id] = 1;                //entire page and to use it throughout
                t.value=''; 
                t.style.color='#000';
            } 
        } 
    </script>

</body>

</html>
