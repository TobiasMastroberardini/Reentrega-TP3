<?php
require_once './app/model/model.php';
require_once 'config.php';

class subscripcionesModel extends model
{

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
        $subscripcion = $query->fetch(PDO::FETCH_OBJ);

        return $subscripcion;
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

    function getCreciente()
    {
        $query = $this->db->prepare('SELECT * FROM subscripciones ORDER BY tipo ASC');
        $query->execute();

        $subscripciones = $query->fetchAll(PDO::FETCH_OBJ);

        return $subscripciones;
    }

    function getDecreciente()
    {
        $query = $this->db->prepare('SELECT * FROM subscripciones ORDER BY tipo DESC');
        $query->execute();

        $subscripciones = $query->fetchAll(PDO::FETCH_OBJ);

        return $subscripciones;
    }
}
