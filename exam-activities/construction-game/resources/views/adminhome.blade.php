<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Nabil L. A.">
        <title>CG - Admin Home </title>
        <link rel="stylesheet" href="{{asset('style/animations.css')}}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>
    <header>
        <nav class="navbar navbar-dark bg-dark text-light navbar-expand-lg mb-5 ">
          <div class="container-fluid">
              <h4 class="mt-2 me-2 ms-5"><i class="ms-3 bi bi-buildings-fill text-light"></i> Construction Game </h4>
              <button class="navbar-toggler bg-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navBar" aria-controls="navBar" aria-expanded="true" aria-label="Toggle navigation" >
                <span class="navbar-toggler-icon"></span>
              </button>
                <div id="navBar" class="collapse navbar-collapse">
                    <ul class="d-flex align-items-start navbar-nav me-auto mb-2 mb-lg-0 ms-5">
                        <li class="list-group-item m-1"><a class="ms-3 link-underline link-underline-opacity-0 link-light" href="{{route('adminhome')}}">Home</a></li>
                        <li class="list-group-item m-1"><a class="ms-3 link-underline link-underline-opacity-0 link-light" href="{{route('manageusers')}}">Manage users</a></li>
                        <li class="list-group-item m-1"><a class="ms-3 link-underline link-underline-opacity-0 link-light" href="{{route('figureupload')}}">Manage figures</a></li>
                    </ul>
                    <form class="d-flex  me-5 ms-3" action="{{route('logout')}}" method="POST">
                        @csrf
                        <button class="btn btn-outline-primary me-2 ms-5" type="submit">Logout</button>
                    </form>
                </div>
          </div>

 
        </nav>
    </header>
      <style>
        .custom-shadow {
            border: 3px solid rgba(28, 63, 132, 0.2);
            box-shadow: 4px 8px 12px rgba(28, 63, 132, 0.2);
        }  
    </style>
    </head>
    <body class="antialiased">
        <div class="container d-flex justify-content-center text-light mt-5 mb-5">
            <div class="card bg-dark custom-shadow text-light rounded mt-3 position-relative w-100 col-lg-10">
                <div class="card-header bg-light text-dark">
                    <h3 class="text-center m-3">Admin: {{session('username')}}</h3>
                </div>
                <div class="row mt-5 justify-content-center w-100">
                    <ul class="list-unstyled w-100 px-5">
                        <li class="d-flex justify-content-between align-items-center mx-auto px-4 py-3 mb-3 border rounded w-100">
                            <a href="{{route('manageusers')}}" class="link-offset-1 link-underline link-underline-opacity-0 link-light fw-bold fs-4">
                                Manage users
                            </a>
                        </li>
                        <li class="d-flex justify-content-between align-items-center mx-auto px-4 py-3 mb-3 border rounded w-100">
                            <a href="{{route('figureupload')}}"  class="link-offset-1 link-underline link-underline-opacity-0 link-light fw-bold fs-4">
                                Manage figures
                            </a>
                        </li>
                    </ul>
                </div>
                <br>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>