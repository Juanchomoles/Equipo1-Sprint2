<?php
global $error;
require 'Clases/Cliente.php';
require 'Clases/ValidarParticular.php';
require 'Clases/Particular.php';


$name = $_POST['nombre'] ?? '';
$lastName = $_POST['apellidos'] ?? '';
$residence = $_POST['domicilio'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ? intval($_POST['phone']) : 0;
$dni = $_POST['dni'] ?? 0;
$dniLetter = $_POST['dniLetter'] ?? '';
$password = $_POST['contraseña'] ?? '';
$clienteP = new Particular(1, $name, $lastName, $residence, $dni, $phone, $email, $password);
$particular = new ValidarParticular();

try {
    $result = $particular->validateALL($clienteP);
}
catch(Exception $e){
    $error = $e->getMessage();
}

?>

<html>
<head>
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<h2>Validación</h2>
<ul>
    <li><?php echo $error ?? 'Todo Correcto' ?></li>
</ul>
</body>
</html>