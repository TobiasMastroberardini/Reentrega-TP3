<?php
require_once './app/controller/controller.php';
require_once './app/model/auth.model.php';
include_once './app/view/apiView.php';

class authController extends controller {
    private $model;

    function __construct()
    {
        parent::__construct();
        $this->model = new authModel();
    }

    function registrar(){
        if(!empty ($_POST['nombre-registro']) && !empty($_POST['email-registro']) && !empty($_POST['contraseña-registro']) && !empty($_POST['subscripcion-registro'])){
            $nombre = $_POST['nombre-registro'];
            $email = $_POST['email-registro'];
            $contraseña = password_hash($_POST['contraseña-registro'], PASSWORD_BCRYPT);
            $subscripcion = $_POST['subscripcion-registro'];
            $this->model->guardarUsuario($nombre,$email,$contraseña,$subscripcion);
        }
        else{
        }
    }

    function iniciarSesion(){
        $email = $_POST['email'];
        $password = $_POST['contraseña'];
        $user = $this->model->obtenerEmail($email);
        if ($user && (password_verify($password, $user->contraseña))) {
            $this->model->iniciarSesion($user);
        } else {
           
        }
    }

    function cerrarSesion(){
        $this->model->cerrarSesion();
    }
}