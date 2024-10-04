<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body class="antialiased">
    <form method="POST" action="{{ url('/add-color')}}">
        @csrf
        @if(isset($color))
            <input type="hidden" name="id" value="{{ $color->id }}">
        @endif
        <label for="color">Color's name: </label>
        <input type="text" name="color" id="color">
        <br>
        <input type="submit" name="submit" id="submit" value="Send">
    </form>
    <br>
    <div class="history">
        <ul>
            @if(!empty($colors))
                @foreach ($colors as $color)
                <li>
                    {{ $color->getName() }}
                   <!-- <form method="GET" action="{{ url('/edit-color/'.$color->id) }}">
                        <button type="submit">Edit</button>
                    </form>-->

                    <form method="POST" action="{{ url('/delete-color/'.$color->id) }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $color->id }}">
                        <button type="submit">Delete</button>
                    </form>
                </li>
                @endforeach
            @else
                <li>Empty list.</li>
            @endif
        </ul>
    </div>
</body>
</html>
