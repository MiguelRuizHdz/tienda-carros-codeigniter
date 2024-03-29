<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once( APPPATH.'/libraries/REST_Controller.php' );
use Restserver\Libraries\REST_Controller;

class Productos extends REST_Controller {

    public function __construct() {

        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Origin: *");

        // Ejecutar constructor del padre
        parent::__construct();
        // cargar base de datos
        $this->load->database();

    }

    public function todos_get( $pagina = 0 ) {

        $pagina = $pagina * 10;

        $query = $this->db->query('SELECT * FROM `productos` limit '. $pagina .',10');

        $respuesta = array(
            'error' => FALSE,
            'productos' => $query->result_array()
        );

        $this->response( $respuesta );
    }

    public function por_tipo_get( $tipo=0, $pagina = 0 ) {

        if( $tipo == 0 ){
            $respuesta = array(
                'error' => TRUE, 
                'mensaje' => 'Falta el parámetro de tipo', 
            );
            $this->response( $respuesta, REST_Controller::HTTP_BAD_REQUEST );
            return;
        }

        $pagina = $pagina * 10;

        $query = $this->db->query('SELECT * FROM `productos` WHERE linea_id = '. $tipo .'  limit '. $pagina .',10');

        $respuesta = array(
            'error' => FALSE,
            'productos' => $query->result_array()
        );

        $this->response( $respuesta );
    }

    public function buscar_get( $termino = 'No especifico' ) {
        
        // LIKE

        $query = $this->db->query("SELECT * FROM `productos` WHERE producto LIKE '%". $termino ."%'");

        $respuesta = array(
            'error' => FALSE,
            'termino' => $termino,
            'productos' => $query->result_array()
        );

        $this->response( $respuesta );
    }

}