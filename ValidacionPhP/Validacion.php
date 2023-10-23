<?php
require 'Clases/Cliente.php';
require 'Clases/ValidarParticular.php';
require 'Clases/Particular.php';


$name = $_POST['nombre'] ?? '';
$lastName = $_POST['apellidos']?? '';
$residence = $_POST['domicilio']?? '';
$email = $_POST['email']?? '';
$phone = $_POST['phone']? intval($_POST['phone']) : 0;
$dni = $_POST['dni']?? 0;
$dniLetter = $_POST['dniLetter']?? '';
$password = $_POST['contraseña']?? '';

$clienteP = new Particular(1, $name, $lastName, $residence, $dni, $phone, $email, $password);
$particular = new ValidarParticular();

$result = $particular->validateALL($clienteP);


?>

<html>
<head>
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
    <body>
        <h2>Validación</h2>
    <ul>
        <li>Nombre: <?php echo $result[0]; ?></li>
        <li>Apellido: <?php echo $result[1]; ?></li>
        <li>Domicilio: <?php echo $result[2]; ?></li>
        <li>Email : <?php echo $result[3]; ?></li>
        <li>Contraseña: <?php echo $result[4]; ?></li>
        <li>Telefono: <?php echo $result[5]; ?></li>
        <li>DNI: <?php echo $result[6]; ?></li>
    </ul>
    </body>
</html>