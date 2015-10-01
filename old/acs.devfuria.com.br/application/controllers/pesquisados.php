<?php
class Pesquisados extends CI_Controller {

    function __construct() {
        parent::__construct();
        
        if (!$this->session->userdata('loggedin') && !$this->session->userdata('usuario_externo')) {
            redirect(base_url(), 'refresh');
        }
    }
    
    /*
     * Lista de Pesquisados.  
     */
    function index() {

        $data['titulo']     = 'Pesquisados Lista';
        $data['menu_ativo'] = 'inicio';

        $this->load->model('pesquisados_model');
        if($this->session->userdata('cliente_master')){
            $data['pesquisados'] = $this->pesquisados_model->todos_pesquisados();
        } else {
            $data['pesquisados'] = $this->pesquisados_model->pesquisados($this->session->userdata('id_cliente'));
        }    
        
        
        $this->load->view('header', $data);
        $this->load->view('menu', $data);
        $this->load->view('pesquisados/lista', $data);
    	$this->load->view('sidebar');
        $this->load->view('footer');
    }

    /*
     * Carregar formulário
     */
    function formulario($id_pesquisado=null) {
        $data['titulo']     = 'Pesquisados Formulário';
        $data['menu_ativo'] = 'inicio';

        $this->load->model('pesquisados_model');
        $data['pesquisado'] = $this->pesquisados_model->pesquisado($id_pesquisado);
        
        $this->load->model('clientes_model');
        $data['clientes'] = $this->clientes_model->todos_clientes();
 
        if(!$this->session->userdata('usuario_externo')){
            $this->load->view('header', $data);
            $this->load->view('menu', $data);
            $this->load->view('pesquisados/formulario', $data);
            $this->load->view('sidebar');
            $this->load->view('footer');
        } else {
            $this->load->view('formularios_externos/form_pesquisado/header', $data);
            $this->load->view('pesquisados/formulario', $data);
            $this->load->view('formularios_externos/form_pesquisado/footer');
        }
    }    

    
    /*
     *  Salva um pesquisado, pode atualizar ou criar.
     */
    function salvar() {
        $data['id']              = $this->input->post('id');
        $data['id_cliente']      = $this->input->post('id_cliente');
        $data['nome']            = $this->input->post('nome');
        $data['email']           = $this->input->post('email');
        $data['cpf']             = $this->input->post('cpf');
        $data['data_nascimento'] = $this->input->post('dtNasc');
        $data['sexo']            = $this->input->post('sexo');

        $this->load->library('form_validation');        
        $config = array(
            array(
                'field' => 'nome',
                'label' => 'Nome',
                'rules' => 'required|min_length[4]|max_length[200]'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email|min_length[4]|max_length[200]'
            ),
            array(
                'field' => 'cpf',
                'label' => 'CPF',
                'rules' => 'required|exact_length[14]'
            ),
            array(
                'field' => 'dtNasc',
                'label' => 'Data de nascimento',
                'rules' => 'required|exact_length[10]'
            ),
            array(
                'field' => 'sexo',
                'label' => 'Sexo',
                'rules' => 'required'
            ),
            array(
                'field' => 'id_cliente',
                'label' => 'Cliente',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        # Grava se validou
        if ($this->form_validation->run() == FALSE) {
            $this->formulario($data['id']);
        } else {
            $this->load->model('pesquisados_model');
            $data['id'] = $this->pesquisados_model->salvar($data);
            if(!$this->session->userdata('usuario_externo'))
                redirect(base_url() . 'pesquisados/', 'refresh');
            else{
                $metodo = $this->session->userdata('metodo');
                $pesquisado = (object) $data;
                
                switch ($metodo) {
                    case 'poms':
                        $data['titulo']     = 'Poms Formulário';

                        $this->load->model('poms/poms_model');
                        $data['adjetivos_nomes'] = $this->poms_model->adjetivos();
                        $data['poms_pesquisado'] = $this->poms_model->pesquisado($pesquisado->id);

                        $this->load->model('pesquisados_model');
                        $data['pesquisado'] = $this->pesquisados_model->pesquisado($pesquisado->id);

                        $this->load->view('formularios_externos/form_pesquisado/header', $data);
                        $this->load->view('poms/formulario', $data);
                        $this->load->view('formularios_externos/form_pesquisado/footer');
                        break;
                        
                    case 'realequipe':
                        $data['titulo']           = 'Formulario Real Equipe';
                        $data['pesquisado_dados'] = $pesquisado;
                        
                        $outros = $this->session->userdata('outros');

                        $this->load->model('real_equipe/real_equipe_model');
                        
                        $data['equipe_dados'] = $this->real_equipe_model->equipe($outros);
                        $data['frases']       = $this->real_equipe_model->frases();
                        $this->load->model('real_equipe/real_equipe_pesquisados_model');

                        $this->real_equipe_pesquisados_model->inserir(array(
                            'id_real_equipe' => $outros,
                            'id_pesquisado'  => $pesquisado->id,
                            'lider'          => 'nao',
                            'preenchido'     => 'nao'
                        ));

                        $data['lider']                  = $this->real_equipe_pesquisados_model->get_lider($outros);
                        $data['pesquisado_real_equipe'] = $this->real_equipe_pesquisados_model->pesquisado_equipe($outros, $pesquisado->id);

                        $this->load->view('formularios_externos/form_pesquisado/header', $data);
                        $this->load->view('real_equipe/form_pesquisado');
                        $this->load->view('formularios_externos/form_pesquisado/footer');
                        break;

                    default:
                        break;
                }
                
            }
        }
    }
    
    /*
     * Deletar pesquisado.
     */
    function deletar($id_pesquiado) {
        $this->load->model('pesquisados_model');
        $this->pesquisados_model->deletar($id_pesquiado);
        
        $this->load->model('real_equipe/real_equipe_pesquisados_model');
        $this->real_equipe_pesquisados_model->deletar_pesquisado($id_pesquiado);
        
        $this->load->model('poms/poms_model');
        $this->poms_model->deletar_pesquisado($id_pesquiado);     
        
        $this->index();
    }
}
