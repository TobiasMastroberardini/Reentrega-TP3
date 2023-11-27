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

    function ShowSubs($params = [])
    {
        if (empty($params)) {
            $subs = $this->model->getSubs();
            return $this->view->response($subs, 200);
        } else {
            $sub = $this->model->getSub($params[":ID"]);
            if (!empty($sub)) {
                return $this->view->response($sub, 200);
            }
        }
    }

    function addSubs()
    {
        $body = $this->getData();
        $tipo = $body->tipo;
        $caracteristicas = $body->caracteristicas;
        $duracion = $body->duracion;
        $precio = $body->precio;
        $this->model->createSub($tipo, $caracteristicas, $precio, $duracion);
        $this->view->response('la subscripcion fue agregada con exito', 201);
    }
    
    function deleteSubs($params = [])
    {
        $id = $params[':ID'];
        $sub = $this->model->getSub($id);
        if ($sub) {
            $this->model->deleteSub($id);
            $this->view->response("sub id=$id eliminado con éxito", 200);
        } else
            $this->view->response("sub id=$id not found", 404);
    }

    function updateSubs($params = []){
        $id = $params[':ID'];
        $sub = $this->model->getSub($id);

        if ($sub) {
            $body = $this->getData();
            $tipo = $body->tipo;
            $caracteristicas = $body->caracteristicas;
            $duracion = $body->duracion;
            $precio = $body->precio;
            $this->model->updateSub($tipo, $caracteristicas, $precio, $duracion,$id);
            $this->view->response("sub id=$id actualizada con éxito", 200);
        }
        else 
            $this->view->response("sub id=$id not found", 404);

    }

    public function getSubscripcionesOrdenadas($params = []) {
    // Verifica si los parámetros 'order' y 'sort' están presentes en la solicitud
    if(isset($_GET['order']) && isset($_GET['sort'])){
        $order = $_GET['order'];
        $sort = $_GET['sort'];
        // Llama a la función del modelo para obtener las subscripciones ordenadas
        $subscripciones = $this->model->getSubscripcionesOrdenadas($order, $sort);
        // Verifica si se obtuvieron resultados y responde según sea necesario
        if($subscripciones){
            $this->view->response($subscripciones, 200);
        } else {
            $this->view->response('Error, no se han podido obtener las subscripciones', 500);
        } 
    } else {
        // Si no se proporcionan los parámetros necesarios, responde con un mensaje de error
        $this->view->response('Parámetros de ordenación no proporcionados', 400);
    }
    }

}
