<?php
require_once './app/model/model.php';
require_once 'config.php';

class subscripcionesModel extends model
{
    function __construct()
    {
        $this->db = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8", MYSQL_USER, MYSQL_PASS);
    }


    public function getSubs()
    {
        $query = $this->db->prepare('SELECT * FROM subscripciones');
        $query->execute();
        $subscripciones = $query->fetchAll(PDO::FETCH_OBJ);

        return $subscripciones;
    }

    public function getSub($id)
    {
        $query = $this->db->prepare('SELECT * FROM subscripciones WHERE ID_subscripcion = ?');
        $query->execute([$id]);
        $subscripcione = $query->fetch(PDO::FETCH_OBJ);

        return $subscripcione;
    }

    function createSub($tipo, $caracteristicas, $precio, $duracion)
    {
        $query = $this->db->prepare('INSERT INTO subscripciones (tipo, caracteristicas, precio, duracion) VALUES (? ,?, ?, ?)');
        $query->execute([$tipo, $caracteristicas, $precio, $duracion]);

        return $this->db->lastInsertId();
    }

    function deleteSub($id)
    {
        $query = $this->db->prepare('DELETE FROM subscripciones WHERE ID_subscripcion = ?');
        $query->execute([$id]);
    }

    function updateSub($tipo, $caracteristicas, $precio, $duracion, $id)
    {
        $query = $this->db->prepare('UPDATE subscripciones SET tipo = ?, caracteristicas = ?, precio = ?, duracion = ? WHERE ID_subscripcion = ?');
        $query->execute([$tipo, $caracteristicas, $precio, $duracion, $id]);
    }


    public function verificar()
    {
        session_start();
        if (!isset($_SESSION['USER_ID'])) {
            die();
        }
    }

    public function getSubsFiltro($sector, $precioMin, $precioMax, $duracionMin, $duracionMax)
    {
        $query = $this->db->prepare('SELECT * FROM subscripciones WHERE precio > ? AND precio < ? AND caracteristicas = ? AND duracion > ? AND duracion < ?');
        $query->execute([$precioMin, $precioMax, $sector, $duracionMin, $duracionMax]);
        $subscripciones = $query->fetchAll(PDO::FETCH_OBJ);

        return $subscripciones;
    }
    //

    function getCreciente()
    {
        $query = $this->db->prepare('SELECT * FROM subscripciones ORDER BY tipo ASC');
        $query->execute();

        $subscripciones = $query->fetchAll(PDO::FETCH_OBJ);

        return $subscripciones;
    }
    function getDecreciente()
    {
        $query = $this->db->prepare('SELECT * FROM productos ORDER BY tipo DESC');
        $query->execute();

        $subscripciones = $query->fetchAll(PDO::FETCH_OBJ);

        return $subscripciones;
    }
}
