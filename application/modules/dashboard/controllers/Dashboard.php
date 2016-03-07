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
        try{
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('facturas');
            $crud->columns('Codigo_Edificio','Codigo_Factura','Codigo_Rubro','Codigo_Proveedor','Numero_Comprobante','Fecha_vto','Importe');
            $crud->display_as('Codigo_Rubro','rubros')
                 ->display_as('Codigo_Proveedor','Proveedor')            
                 ->display_as('Codigo_Edificio','Edificio');            
            $crud->set_relation('Codigo_Edificio','edificios','Direccion_Edificio');
            $crud->set_relation('Codigo_Rubro','rubros','Descripcion');
            $crud->set_relation('Codigo_Proveedor','proveedores','Nombre');
            $crud->set_relation('Codigo_Propietario','propietarios','Nombre_Propietario');
            $output = $crud->render();
            $this->_example_output($output);

        }catch(Exception $e){
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }    

    public function liquidacion(){
        try{
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('liquidacion');
            $crud->columns('Codigo_Factura', 
                'Codigo_Edificio', 
                'Codigo_Rubro', 
                'Codigo_Proveedor', 
                'Numero_Comprobante', 
                'Fecha_vto', 
                'Importe');
            $crud->display_as('Codigo_Factura','Factura')
                 ->display_as('Codigo_Rubro','rubros')   
                 ->display_as('Codigo_Proveedor','Proveedor')            
                 ->display_as('Codigo_Edificio','Edificio')           
                 ->display_as('Codigo_Propietario','Propietario');           
            $crud->set_relation('Codigo_Factura','facturas','Codigo_Factura');
            $crud->set_relation('Codigo_Rubro','rubros','Descripcion');
            $crud->set_relation('Codigo_Proveedor','proveedores','Nombre');
            $crud->set_relation('Codigo_Edificio','edificios','Direccion_Edificio');
            $crud->set_relation('Codigo_Propietario','propietarios','Nombre_Propietario');
            $output = $crud->render();
            $this->_example_output($output);

        }catch(Exception $e){
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }

    public function prorrateo(){
        try{
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('prorrateo');
            $crud->columns('Codigo_Propietario',
                'Concepto_5',
                'Concepto_7',
                'Deuda',
                'Importe_Total',
                'Importe_Total_2do_vto',
                'Cobrado',
                'Saldo_Inicial'
                );
            $crud->display_as('Codigo_Propietario','Propietario');
            $crud->set_relation('Codigo_Propietario','propietarios','Nombre_Propietario');
            $output = $crud->render();
            $this->_example_output($output);

        }catch(Exception $e){
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }



    public function _example_output($output = null)
    {
        $this->loadTemplates('facturas.php',$output);
    }
}
