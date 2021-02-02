<?php
header("Content-Type: application/json");
include_once("../../clases/clase_usuario.php");
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST': //Guardar
        echo "Guardar";
        $_POST = json_decode(file_get_contents('php://input'), true);
        $user = new User($_POST['nombre'],$_POST['apellido'],$_POST['fechaNacimiento'],$_POST['pais']);
        $user->guardarUsuario();
        $resultado['mensaje'] = "Guardar usuario, información:" . json_encode($_POST);
        echo json_encode($resultado);
        break;
    case 'GET':
        if (isset($_GET['id'])) {
            User::obtenerUsuario($_GET['id']);
        } else {
            User::obtenerUsuarios();
        }
        break;
    case 'PUT':
        $_PUT = json_decode(file_get_contents('php://input'), true);
        $user = new User($_PUT['nombre'],$_PUT['apellido'],$_PUT['fechaNacimiento'],$_PUT['pais']);
        $user->actualizarUsuario($_GET['id']);

        $resultado['mensaje'] = "Actualizar un usuario con el id: " . $_GET['id'] .  ', Información a actualizar' . json_encode($_PUT);
        echo json_encode($resultado);
        break;
    case 'DELETE':
        User::eliminarUsuario($_GET['id']);
        $resultado['mensaje'] = "Eliminar un usuario con el id: " . $_GET['id'];
        echo json_encode($resultado);
        break;
}
class Usuario
{
}
