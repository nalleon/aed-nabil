<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Nabil L. A.">
        <title>CG - Login </title>
        <link rel="stylesheet" href="{{asset('style/animations.css')}}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <header>
            <nav class="navbar navbar-dark bg-dark text-light navbar-expand-lg mb-5 ">
            <div class="container-fluid">
                <h4 class="mt-2 me-2 ms-5"><i class="ms-3 bi bi-buildings-fill text-light"></i> Construction Game </h4>
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
            <div class="card bg-dark custom-shadow text-light rounded mt-3 position-relative w-75 col-10 col-md-6 col-lg-4"  >
                <div class="card-header bg-light text-dark">
                    <h3 class="text-center m-3">Login</h3>
                </div>
        
                <div class="card-body">
                    <form action="{{ url('/login') }}" method="POST" class="text-center">
                        @csrf
                        @if(session('message'))
                            <p class="text-center text-success">{{ session('message') }}</p>
                        @endif
        
                        <div class="row justify-content-center">
                            <div class="col-10 col-sm-8 col-md-10 mb-3">
                                <label for="username" class="form-label fw-bold">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username" required>
                            </div>
        
                            <div class="col-10 col-sm-8 col-md-10 mb-3">
                                <label for="password" class="form-label fw-bold">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                            </div>
        
                            <div class="col-8 col-sm-8 col-md-4 d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </div>
        
                        <p class="mt-3">Don't have an account? <a href="{{route('register')}}" class="text-decoration-none">Click here</a></p>
                    </form>
                </div>
            </div>
        </div>
        
    </body>
</html>