<?php
require_once './app/model/model.php';
require_once 'config.php';
class authModel extends model{
    public function __construct()
    {
        $this->db = new PDO("mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DB.";charset=utf8",MYSQL_USER, MYSQL_PASS);
    }

    public function guardarUsuario($nombre,$email,$contraseña,$subscripcion){
        $query = $this->db->prepare('INSERT INTO usuarios (nombre, email, contraseña, suscripcion) VALUES (? ,?, ?, ?)');
        $query->execute([$nombre,$email,$contraseña,$subscripcion]);
    }

    public function obtenerEmail($email){
            $query = $this->db->prepare('SELECT * FROM usuarios WHERE email = ?');
            $query->execute([$email]);
    
            $user = $query->fetch(PDO::FETCH_OBJ);
            return $user;
    }

    public function iniciarSesion($user){
        session_start();
        $_SESSION['USER_NOMBRE'] = $user->nombre;
        $_SESSION['USER_ID'] = $user->ID;
        $_SESSION['USER_EMAIL'] = $user->email;
        $_SESSION['USER_SUSCRIPCION'] = $user->suscripcion;
    }

    public function verificar(){
        session_start();
        if (!isset($_SESSION['USER_ID'])) {
            die();
        }
    }
    
    function cerrarSesion(){
        session_start();
        session_destroy();
    }
}