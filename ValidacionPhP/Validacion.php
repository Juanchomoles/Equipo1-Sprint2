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
$tipo_usuario = "Particular";
$rs = "razon social";

$clienteP = new Particular(1, $name, $lastName, $residence, $dni, $phone, $email, $password);
$private = new ValidarParticular();
try {
    $pdo = new PDO("mysql:host=mysql-server;dbname=db_project_team1", "root", "secret");
}
catch (PDOException $e) {
    die("Error en la conexión a la base de datos: " . $e->getMessage());
}

try {
    $result = $private->validateALL($clienteP);


    $pdo->beginTransaction();
    $clientCreate = "INSERT INTO client (type_user, user_name, passwd, name, last_name, dni, address, email, phone, target_num, business_name) 
    VALUES (:tipo_usuario,'',:password, :name,:lastname, :dni, :residence, :email, :phone, '', :rs)";

    $client = $pdo->prepare($clientCreate);

    $client->bindParam(':tipo_usuario', $tipo_usuario);
    $client->bindParam(':name', $name);
    $client->bindParam(':lastname', $lastName);
    $client->bindParam(':residence', $residence);
    $client->bindParam(':dni', $dni);
    $client->bindParam(':phone', $phone);
    $client->bindParam(':rs', $rs);
    $client->bindParam(':email', $email);
    $client->bindParam(':password', $password);

    $client->execute();

    $id = $pdo->lastInsertId();

    $privateCreate = "INSERT INTO private (id) VALUES (:id)";

    $private = $pdo->prepare($privateCreate);

    $private->bindParam(':id', $id);

    $private->execute();

    $pdo->commit();

} catch (PDOException $err) {
    $pdo->rollBack();
    echo "Error " . $err->getMessage();
} catch (Exception $e) {
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
