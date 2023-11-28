<?php
require_once './app/model/model.php';
require_once 'config.php';
class pageModel extends model{
    function __construct()
    {
        $this->db = new PDO("mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DB.";charset=utf8",MYSQL_USER, MYSQL_PASS);
    }

    public function verificar()
    {
        session_start();
        if (!isset($_SESSION['USER_ID'])) {
            die();
        }
    }

    public function getSocios()
    {
        $query = $this->db->prepare('SELECT * FROM socios');
        $query->execute();
        $socios = $query->fetchAll(PDO::FETCH_OBJ);

        return $socios;
    }

    public function getSocio($id)
    {
        $query = $this->db->prepare('SELECT * FROM socios WHERE ID = ?');
        $query->execute([$id]);
        $socio = $query->fetch(PDO::FETCH_OBJ);

        return $socio;
    }
    
    function createSocio($nombre,$suscripcion,$rol){
        $querry = $this->db->prepare('INSERT INTO socios (nombre, suscripcion, rol) VALUES (? ,?, ?)');
        $querry->execute([$nombre,$suscripcion,$rol]);
    }

    function deleteSocio($id){
        $querry = $this->db->prepare('DELETE FROM socios WHERE ID = ?');
        $querry->execute([$id]);
        $querry = $this->db->prepare('DELETE FROM usuarios WHERE ID = ?');
        $querry->execute([$id]);
    }

    function updateSocio($nombre, $suscripcion, $rol,$id){
        $querry = $this->db->prepare('UPDATE socios SET nombre = ?, suscripcion = ?, rol = ? WHERE ID = ?');
        $querry->execute([$nombre,$suscripcion,$rol,$id]);
    }

    function obtenerPlan($id){
        $querry = $this->db->prepare('SELECT * FROM subscripciones WHERE ID_subscripcion = ?');
        $querry->execute([$id]);
        $plan = $querry->fetch(PDO::FETCH_OBJ);
        return $plan;
    }

    function cambiarNombre($id, $nombre){
        $querry = $this->db->prepare('UPDATE usuarios SET nombre = ? WHERE ID = ?');
        $querry->execute([$nombre,$id]);
        $querry = $this->db->prepare('UPDATE socios SET nombre = ? WHERE ID = ?');
        $querry->execute([$nombre,$id]);
    }
}
