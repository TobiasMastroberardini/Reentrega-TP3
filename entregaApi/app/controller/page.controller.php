<?php
require_once './app/controller/controller.php';
require_once './app/model/page.model.php';
include_once './app/view/apiView.php';

class pageController extends controller{
    private $model;

    function __construct()
    {
        parent::__construct();
        $this->model = new pageModel();
    }

    function ShowSocios($params = [])
    {
        if(empty($params)){
            $socios = $this->model->getSocios();
            return $this->view->response($socios,200);
          }
          else {
            $socio = $this->model->getSocio($params[":ID"]);
            if(!empty($socio)) {
              return $this->view->response($socio,200);
            }
      
    }}

    function addSocios(){
        $body = $this->getData();
        $nombre = $body->nombre;
        $suscripcion = $body->suscripcion;
        $rol = $body->rol;
        $this->model->createSocio($nombre, $suscripcion, $rol);
        $this->view->response('el socio fue agregada con exito', 201);
    }

    function deleteSocios($params = [])
    {
        $id = $params[':ID'];
        $socio = $this->model->getSocio($id);
        if ($socio) {
            $this->model->deleteSocio($id);
            $this->view->response("socio id=$id eliminado con éxito", 200);
        } else
            $this->view->response("socio id=$id not found", 404);
    }

    function updateSocio($params = []){
        $id = $params[':ID'];
        $socio = $this->model->getSocio($id);

        if ($socio) {
            $body = $this->getData();
            $nombre = $body->nombre;
            $suscripcion = $body->suscripcion;
            $rol = $body->rol;
            $this->model->updateSocio($nombre, $suscripcion, $rol,$id);
            $this->view->response("socio id=$id actualizado con éxito", 200);
        }
        else 
            $this->view->response("socio id=$id not found", 404);
    }

    function mostrarNoticias(){
        $this->model->verificar();
    }
}
