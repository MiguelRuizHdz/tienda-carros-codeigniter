<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once( APPPATH.'/libraries/REST_Controller.php' );
use Restserver\Libraries\REST_Controller;

class Lineas extends REST_Controller {

    public function __construct() {

        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Origin: *");

        // Ejecutar constructor del padre
        parent::__construct();
        // cargar base de datos
        $this->load->database();

    }

    // categorias
    public function index_get() {

        $query = $this->db->query('SELECT * FROM `lineas`');

        $respuesta = array(
            'error' => FALSE,
            'lineas' => $query->result_array()
        );

        $this->response( $respuesta );
    }

}