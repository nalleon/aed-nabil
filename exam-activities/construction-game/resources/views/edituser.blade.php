<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Nabil L. A.">
        <title>CG - Edit User </title>
        <link rel="stylesheet" href="./style/login.css">
    </head>
    <body class="antialiased">
        <div class="main-container">
            <h2>Admin: {{session('username')}}</h2>

            <h2>Editing userEdit: {{ $userEdit->getName() }}</h2>

            <form action="{{ route('updateuser', ['id' => $userEdit->getId()]) }}" method="POST">
                @csrf
                
                <label for="id">ID:</label>
                <input type="text" id="userId" name="userId" value="{{ $userEdit->getId() }}" readonly>
                <br>
                <label for="username">Name:</label>
                <input type="text" id="username" name="username" value="{{ $userEdit->getName() }}" required>
                <br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Leave blank to keep current password">
                <br>
                <label for="role">Role:</label>
                <select id="role" name="role">
                    <option value="2" {{ $userEdit->getRol() === '2' ? 'selected' : '' }}>admin</option>
                    <option value="1" {{ $userEdit->getRol() === '1' ? 'selected' : '' }}>usuario</option>
                </select>                
                <br>
                <br>
                <button type="submit">Update</button>
            </form>
            <br>
            <form action="{{ route('deleteuser', ['id' => $userEdit->getId()]) }}" method="POST">
                @csrf
                <input type="submit" name="delete" value="Delete"></input>
            </form>  
            <br>
            <div class="back">
                <form action="{{ route('manageusers') }}" method="GET">
                    <input type="submit" value="Back">
                </form>
            </div>
        </div>
    </body>
</html>