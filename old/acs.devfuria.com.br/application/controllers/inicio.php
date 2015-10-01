<?php
class Inicio extends CI_Controller {

    function __construct() {
        parent::__construct();
        
        if (!$this->session->userdata('loggedin')) {
            redirect(base_url(), 'refresh');
        }
    }
    
    /**
     *  Tela inicial
     */
    function index() {
        $data['titulo']     = 'Tela inicial';
        $data['menu_ativo'] = 'inicio';
        
        $this->load->view('header', $data);
        $this->load->view('menu', $data);
        $this->load->view('sidebar');
        $this->load->view('footer');
    }
}