<?php
class Usuarios extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('loggedin')) {
            redirect(base_url(), 'refresh');
        }
    }

    /**
     *  Lista de Usuários.
     *  
     */
    function index() {
        $data['titulo']     = 'Usuários Lista';
        $data['menu_ativo'] = 'inicio';

        $this->load->model('usuarios_model');
        if($this->session->userdata('cliente_master')){
            $data['usuarios'] = $this->usuarios_model->todos_usuarios();
        } else {
            $data['usuarios'] = $this->usuarios_model->usuarios($this->session->userdata('id_cliente'));
        }    

        $this->load->view('header', $data);
        $this->load->view('menu', $data);
        $this->load->view('usuarios/lista', $data);
        $this->load->view('sidebar');
        $this->load->view('footer');
    }

    
    /*
     * Deletar usuario.
     */
    function deletar($id) {
        $this->load->model('usuarios_model');
        $this->usuarios_model->deletar($id);

        redirect(base_url() . 'usuarios/', 'refresh');
    }

    /*
     * Carregar formulário
     */
    function formulario($id_usuario=null) {
        $data['titulo']     = 'Usuários Formulário';
        $data['menu_ativo'] = 'inicio';

        $this->load->model('usuarios_model');
        $data['usuario'] = $this->usuarios_model->usuario($id_usuario);
        
        $this->load->model('clientes_model');
        $data['clientes'] = $this->clientes_model->todos_clientes();

        $this->load->view('header', $data);
        $this->load->view('menu', $data);
        $this->load->view('usuarios/formulario', $data);
        $this->load->view('sidebar');
        $this->load->view('footer');
    }

    /*
     *  Salva um usuario, pode atualizar ou criar.
     */
    function salvar() {
        $this->load->library('form_validation');

        $data['id']         = $this->input->post('id');
        $data['id_cliente'] = $this->input->post('id_cliente');
        $data['nome']       = $this->input->post('nome');
        $data['usuario']    = $this->input->post('usuario');
        $data['status']     = $this->input->post('status');
        $data['tipo']       = $this->input->post('tipo');


        $config = array(
            array(
                'field' => 'nome',
                'label' => 'Nome',
                'rules' => 'required|min_length[4]|max_length[200]'
            ),
            array(
                'field' => 'usuario',
                'label' => 'Usuário',
                'rules' => 'required|min_length[4]|max_length[50]'
            ),
            array(
                'field' => 'status',
                'label' => 'Status',
                'rules' => 'required'
            ),
            array(
                'field' => 'tipo',
                'label' => 'Tipo',
                'rules' => 'required'
            ),
            array(
                'field' => 'id_cliente',
                'label' => 'Cliente',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);


        if ($this->form_validation->run() == FALSE) {
            $this->formulario($data['id']);
        } else {
            $this->load->model('usuarios_model');
            $this->usuarios_model->salvar($data);

            redirect(base_url() . 'usuarios/', 'refresh');
        }
    }

    function form_senha() {
        $data['titulo']     = 'Alterar senha';
        $data['menu_ativo'] = 'inicio';


        $this->load->view('header', $data);
        $this->load->view('menu', $data);
        $this->load->view('usuarios/form_senha', $data);
        $this->load->view('sidebar');
        $this->load->view('footer');
    }

    function salvar_senha() {
        $this->load->library('form_validation');

        $data['id']        = $this->input->post('id');
        $data['senha']     = $this->input->post('senha');
        $data['confsenha'] = $this->input->post('confsenha');
        
        $config = array(
            array(
                'field' => 'senha',
                'label' => 'Nova senha',
                'rules' => 'required|min_length[4]|max_length[20]|matches[confsenha]'
            ),
            array(
                'field' => 'confsenha',
                'label' => 'Redigite a senha',
                'rules' => 'required|min_length[4]|max_length[20]'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->form_senha();
        } else {
            $this->load->model('usuarios_model');
            $this->usuarios_model->salvar_senha($data['id'], $data['senha']);
            
            $this->msg_senha();
        }
    }
    
    function msg_senha() {
        $data['titulo'] = 'Mensagem Senha';
        $data['menu_ativo'] = 'inicio';

        $this->load->view('header', $data);
        $this->load->view('menu', $data);
        $this->load->view('usuarios/msg_senha');
        $this->load->view('sidebar');
        $this->load->view('footer');
    }

}
