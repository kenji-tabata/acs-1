<?php
class Acesso extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    /**
     *  Tela de login.
     */
    function index() {
        $data['titulo'] = 'Acesso';
        
        $this->load->view('login/header', $data);
        $this->load->view('login/form');
        $this->load->view('login/footer');
    }

    /**
     *  Logando-se no sistema.
     */
    function login() {
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'usuario',
                'label' => 'Nome do usuário',
                'rules' => 'required|min_length[4]|max_length[50]|htmlspecialchars'
            ),
            array(
               'field' => 'senha',
               'label' => 'Senha',
               'rules' => 'required|min_length[4]|max_length[50]|htmlspecialchars|callback__verifica_dados_login'
            )
        );
        $this->form_validation->set_rules($config);
        
        //die(base_url());
        if ($this->form_validation->run() == FALSE)
            $this->index();
        else
            redirect(base_url().'inicio', 'refresh');
     
    }
    
    /**
     * Verifica se o login e senha estão corretos e se o usuário esta ativo,
     * caso seja o primeiro acesso o metodo login ira gravar a senha.
     */
    function _verifica_dados_login(){
        
        # Recebe os dados
        $data['usuario'] = $this->input->post('usuario');
        $data['senha']   = $this->input->post('senha');

        # Tenta logar-se
        $this->load->model('usuarios_model');
        $usuario = $this->usuarios_model->login($data);
        
        # Se encontrou um usuário...
        if ( $usuario ) {
            
            # Se for ativo...
            if($usuario->status != 'desativado'){
                
                /*
                 * Logar ---------------------------------- // 
                 */
                # Cria as sessions necessárias                
                $this->load->model('clientes_model');
                $newdata = array(
                    'id_usuario'     => $usuario->id,
                    'nome_usuario'   => $usuario->nome,
                    'usuario'        => $usuario->usuario,
                    'tipo'           => $usuario->tipo,
                    'id_cliente'     => $usuario->id_cliente,
                    'cliente_master' => $this->clientes_model->is_master($usuario->id_cliente),
                    'loggedin'       => TRUE
                );
                
                $this->session->set_userdata($newdata);
                return TRUE;
                // ---------------------------------------- //

                
            } else {
                $this->form_validation->set_message('_verifica_dados_login', 'O usuário esta desativado no sistema.');
                return FALSE;
            }
        } else {
            $this->form_validation->set_message('_verifica_dados_login', 'O nome de usuário ou a senha estão incorretos.');
            return FALSE;
        }
    }

    /**
     *  Deslogando-se no sistema.
     */
    function logout() {
        $this->session->sess_destroy();
        $this->index();
    }
    
}