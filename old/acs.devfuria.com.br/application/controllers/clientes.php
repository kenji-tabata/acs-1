<?php

class Clientes extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('loggedin'))
            redirect(base_url(), 'refresh');
    }

    /**
     *  Lista de clientes.
     */
    function index() {
        $data['titulo'] = 'Clientes';
        $data['menu_ativo'] = 'inicio';

        $this->load->model('clientes_model');
        $data['clientes'] = $this->clientes_model->todos_clientes();

        $this->load->view('header', $data);
        $this->load->view('menu', $data);
        $this->load->view('clientes/lista', $data);
        $this->load->view('sidebar');
        $this->load->view('footer');
    }

    /**
     * Deleta um cliente e seus usuarios.
     */
    function deletar($id) {
        $this->load->model('clientes_model');
        $this->clientes_model->deletar($id);

        $this->load->model('usuarios_model');
        $this->usuarios_model->deletar_usuarios($id);

        redirect(base_url() . 'clientes', 'refresh');
    }

    /**
     * Carrega um formulario novo, ou de um cliente existente.
     */
    function formulario($id=null) {
        $data['titulo'] = 'Formulário Cliente';
        $data['menu_ativo'] = 'inicio';

        $this->load->model('clientes_model');
        $data['cliente'] = $this->clientes_model->cliente($id);

        $this->load->view('header', $data);
        $this->load->view('menu', $data);
        $this->load->view('clientes/formulario', $data);
        $this->load->view('sidebar');
        $this->load->view('footer');
    }

    /**
     * Salva um novo cliente, ou atualiza um antigo.
     */
    function salvar() {
        $this->load->library('form_validation');

        $data['id']             =  $this->input->post('id');
        $data['nome']           =  $this->input->post('nome');
        $data['url_form_terc']  =  $this->input->post('url_form_terc');
        $data['credito']        =  $this->input->post('credito');
        $data['status']         =  $this->input->post('status');

        $config = array(
            array(
                'field' => 'nome',
                'label' => 'Nome',
                'rules' => 'required|min_length[4]|max_length[200]'
            ),
            array(
                'field' => 'url_form_terc',
                'label' => 'URL',
                'rules' => 'required|max_length[50]|alpha'
            ),
            array(
                'field' => 'credito',
                'label' => 'Crédito',
                'rules' => 'required|is_natural'
            ),
            array(
                'field' => 'status',
                'label' => 'Status',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);


        if ($this->form_validation->run() == FALSE) {
            $this->formulario($data['id']);
        } else {
            $this->load->model('clientes_model');
            $this->clientes_model->salvar($data);

            redirect(base_url() . 'clientes', 'refresh');
        }
    }

}

?>