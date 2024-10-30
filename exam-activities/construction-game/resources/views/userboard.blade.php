<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Nabil L. A.">
        <title>CG - Your boards </title>
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
                        <li class="list-group-item m-1"><a class="ms-3 link-underline link-underline-opacity-0 link-light" href="./home.blade.php">Home</a></li>
                    </ul>
                    <form class="d-flex  me-5 ms-3" action="{{route('logout')}}" method="POST">
                        @csrf
                        <button class="btn btn-outline-primary me-2 ms-5" type="submit">Logout</button>
                    </form>
                </div>
          </div>

        <style>
            .custom-shadow {
                border: 3px solid rgba(28, 63, 132, 0.2);
                box-shadow: 4px 8px 12px rgba(28, 63, 132, 0.2);
            }  
        </style>
          
        </nav>
      </header>
    <body class="antialiased bg-light">
        <div class="container d-flex justify-content-center  text-light mt-5 mb-5">
            <div class="card bg-dark custom-shadow text-light rounded mt-3 position-relative " style="max-width: 60rem;">
                <div class="card-header bg-light text-dark">
                    <h3 class="text-center m-3">Select an option</h3>
                </div>
                <form action="{{ route('updateBoard', ['id' => $board->getId()]) }}" method="POST">
                    @csrf
        
                
                    <div class="d-flex flex-wrap justify-content-center mt-3">
                        @foreach ($allFiguresOptions as $figureOption)
                            <div class="d-flex flex-column align-items-center m-1 col-xs-2 col-sm-2">
                                <img src="data:{{ $figureOption->getTypeImage() }};base64,{{ base64_encode($figureOption->getImage()) }}" 
                                     width="40" height="40" class="img-fluid mb-2" />
                                <input type="radio" id="figureChosen" name="figureChosen" value="{{ $figureOption->getId() }}" class="form-check-input">
                            </div>
                        @endforeach
                    </div>
                    <br>
                    <div class="d-flex flex-wrap justify-content-center mt-5">
                        @foreach ($figures as $figure)
                            <div class="col-2 d-flex flex-column align-items-center m-1">
                                <img src="data:{{ $figure->getTypeImage() }};base64,{{ base64_encode($figure->getImage()) }}" 
                                     width="150" height="150" class="img-fluid mb-2" />
                                <input type="checkbox" id="figureEdit" name="figureEdit[]" value="{{ $figure->getId() }}" class="form-check-input">
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary mt-3 mb-3 ">Update Board</button>
                    </div>
                </form>
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
