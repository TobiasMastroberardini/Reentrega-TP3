<?php
require_once './app/controller/controller.php';
include_once './app/model/subscripciones.model.php';
include_once './app/view/apiView.php';


class subscripcionesController extends controller
{

    private $model;

    function __construct()
    {
        parent::__construct();
        $this->model = new subscripcionesModel();
    }

    function get($params = [])
    {

        if (empty($params)) {
            $subscripciones = $this->model->getSubs();

            $this->view->response($subscripciones, 200);
        } else {
            $subscripcion = $this->model->getSub($params[':ID']);
            if (!empty($subscripcion)) {
                if (isset($params[':subrecurso']) && $params[':subrecurso']) {
                    switch ($params[':subrecurso']) {
                        case 'tipo':
                            $this->view->response($subscripcion->tipo, 200);
                            break;
                        case 'precio':
                            $this->view->response($subscripcion->precio, 200);
                            break;
                        case 'duracion':
                            $this->view->response($subscripcion->duracion, 200);
                            break;
                        case 'caracteristicas':
                            $this->view->response($subscripcion->caracteristicas, 200);
                            break;
                        default:
                            $this->view->response(
                                'La subscripcion no contiene ' . $params[':subrecurso'] . '.',
                                404
                            );
                            break;
                    }
                } else {
                    $this->view->response($subscripcion, 200);
                }
            } else {
                $this->view->response(
                    'la subscripcion con el id=' . $params[':ID'] . ' no existe.',
                    404
                );
            }
        }
    }

    function getCreciente()
    {
        $subscripciones = $this->model->getCreciente();
        $this->view->response($subscripciones, 200);
    }
    function getDecreciente()
    {
        $subscripciones = $this->model->getDecreciente();
        $this->view->response($subscripciones, 200);
    }


    function create($params = [])
    {
        $body = $this->getData();
        $tipo = $body->tipo;
        $caracteristicas = $body->caracteristicas;
        $duracion = $body->duracion;
        $precio = $body->precio;

        if (empty($tipo) || empty($caracteristicas) || empty($precio) || empty($duracion)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->createSub($tipo, $caracteristicas, $precio, $duracion);

            // es buena práctica es devolver el recurso creado
            $subscripcion = $this->model->getSub($id);
            $this->view->response($subscripcion, 201);
        }
    }

    function delete($params = [])
    {
        $id = $params[':ID'];
        $subscripcion = $this->model->getSub($id);
        if ($subscripcion) {
            $this->model->deleteSub($id);
            $this->view->response("subscripcion id=$id eliminado con éxito", 200);
        } else
            $this->view->response("subscripcion id=$id not found", 404);
    }

    function update($params = [])
    {
        $id = $params[':ID'];
        $subscripcion = $this->model->getSub($id);

        if ($subscripcion) {
            $body = $this->getData();
            $tipo = $body->tipo;
            $caracteristicas = $body->caracteristicas;
            $duracion = $body->duracion;
            $precio = $body->precio;
            $this->model->updateSub($tipo, $caracteristicas, $precio, $duracion, $id);
            $this->view->response("sub id=$id actualizada con éxito", 200);
        } else {
            $this->view->response("sub id=$id not found", 404);
        }
    }
}
