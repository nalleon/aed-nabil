<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="author" content="Nabil L.A.">
</head>
<body>
<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
    <div>
        <label for="name">Nombre:</label>    
        <input type="text" name="name"></input>
        <span style="color: red;">*</span>
    </div>
    </br>
    <div>
        <label for="email">Correo:</label>    
        <input type="text" name="email"></input>
        <span style="color: red;">*</span>
    </div>
    </br>
    <div>
        <label for="email">Página web:</label>    
        <input type="text" name="email"></input>
    </div>
    </br>
    <div>
        <label for="comment">Comentario:</label>
        <textarea name="comment" id="comment"></textarea>
    </div>
    </br>
    <div>
        <label for="gender">Género:</label>
        <input type="radio" name="gender" id="gender-male" value="male"/>
        <label for="gender-male">Másculino</label>
        <input type="radio" name="gender" id="gender-female" value="female"/>
        <label for="gender-female">Femenino</label>
        <input type="radio" name="gender" id="gender-other" value="other"/>
        <label for="gender-other">Otro</label>
        <span style="color: red;">*</span>
    </div>

    <input type="submit" name="submit" value="Enviar"></input>
</form>

<?php
    if (!empty($_POST)) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $gender = $_POST["gender"];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<p>Correo: Dato ingresado correctamente</p><br>";
        } else {
            echo "<p style=\"color: red\">Correo: El correo es ínvalido </p><br>";
        }
    
        if (!empty($name)) {
            echo "<p>Nombre: Dato ingresado correctamente</p><br>";
        } else {
            echo "<p style=\"color: red\">Nombre: El nombre no ha sido introducido</p><br>";
        }
    
        if (!empty($gender)) {
            echo "<p>Género: Dato ingresado correctamente</p><br>";
        } else {
            echo "<p style=\"color: red\">Género: El género no ha sido seleccionado</p><br>";
        }
    }
?>

</body>
</html>