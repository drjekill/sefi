<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public $autoload = array(
        "libraries" => array( "session" )
    );

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
    }

    public function index()
    {
        $this->loadTemplates("dashboard", array() );
    }

    public function facturas(){
       
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('facturas');
            $crud->columns('Codigo_Edificio','Codigo_Factura','Codigo_Rubro','Numero_Comprobante','Fecha_vto','Importe');
            $crud->display_as('Codigo_Rubro','rubros')
                 ->display_as('Codigo_Edificio','Edificio');            
            $crud->set_relation('Codigo_Edificio','edificios','Direccion_Edificio');
            $crud->set_relation('Codigo_Rubro','rubros','Descripcion');
            $crud->set_relation('Codigo_Proveedor','proveedores','Nombre');
            $crud->set_relation('Codigo_Propietario','propietarios','Nombre_Propietario');
            $output = $crud->render();
            $this->_example_output($output);
    }



    public function _example_output($output = null)
    {
        $this->loadTemplates('facturas.php',$output);
    }
}
