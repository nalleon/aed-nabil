<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body class="antialiased">
    @php
        $dataSecondsArray = [];

        for($i=0; $i < 3; $i++){
            $seconds = time();
            $dataSecondsArray[$i] = $seconds;
            sleep(1);
        }
        
    @endphp

    @foreach ($dataSecondsArray as $seconds ){
        <h1>Since 1-01-1970 have passed: {{$seconds}} seconds</h1>
    }
        
    @endforeach
</body>
</html>
