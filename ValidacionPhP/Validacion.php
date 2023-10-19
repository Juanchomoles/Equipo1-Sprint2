<?php

require_once 'ValidarCliente.php';


$name = $_POST['nombre'] ?? '';
$lastName = $_POST['apellidos']?? '';
$residence = $_POST['domicilio']?? '';
$email = $_POST['email']?? '';
$phone = $_POST['phone']? intval($_POST['phone']) : 0;
$dni = $_POST['dni']?? 0;
$dniLetter = $_POST['dniLetter']?? '';
$password = $_POST['contraseña']?? '';

$particular = new ValidarCliente(1, $name, $lastName, $residence, $dni,$dniLetter, $phone, $email, $password);

$errorName      = $particular->validateName($name);
$errorLastName  = $particular->validateName($lastName);
$errorResidence = $particular->validateName($residence);
$errorEmail     = $particular->validateEmail();
$errorPhone     = $particular->validatePhone();
$errorDNI       = $particular->validateDNI();
$errorPassword  = $particular->validatePassword();

?>

<html>
<head>
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
    <body>
        <h2>Validación</h2>
    <ul>
        <li>Nombre: <?php echo $errorName; ?></li>
        <li>Apellido: <?php echo $errorLastName; ?></li>
        <li>Domicilio: <?php echo $errorResidence; ?></li>
        <li>Email : <?php echo $errorEmail; ?></li>
        <li>Contraseña: <?php echo $errorPassword; ?></li>
        <li>Telefono: <?php echo $errorPhone; ?></li>
        <li>DNI: <?php echo $errorDNI; ?></li>
    </ul>
    </body>
</html>