<?php
class Formularios_externos extends CI_Controller {

    const POMS       = "poms";
    const REAL_EQUIPE = "realequipe";

    function __construct() {
        parent::__construct();
    }

    /**
     * Checa a url do formulário externo para terceiros.
     *
     * @access public
     * @param  $metodo      = string compreendida por caracteres de a-z e _
     * @param  $url_cliente = string compreendida por caracteres de a-z passado no campo form_url_terc
     * @param  $outros      = mixed qualquer dado relevante ao metodo.
     */
    function valida_url($metodo, $url_cliente, $outros = NULL) {

        $this->load->model('clientes_model');
        $cliente = $this->clientes_model->get_cliente_url_form_terc($url_cliente);

        //var_dump($metodo, $url_cliente, $outros); die();


        // Valida se o cliente existe.
        if( $cliente == NULL) {
            echo show_error (utf8_decode('Desculpe mais você digitou a url errada, cliente inexistente'), 500, utf8_decode('Página não encontrada!'));
        } else {
            // Valida se o método existe.
            if(!method_exists($this, $metodo)){
                 echo show_error (utf8_decode('Desculpe mais você digitou a url errada, método inexistente'), 500, utf8_decode('Página não encontrada!'));
            } else {
                // Valida algo específico do método.
                if($this->$metodo($outros) == FALSE) {
                    echo show_error (utf8_decode('Desculpe mais você digitou a url errada, referente a parametros do método.'), 500, utf8_decode('Página não encontrada!'));
                } else {
                    // Sessão criada
                    $this->session->set_userdata(
                        array(
                            'usuario_externo' => TRUE,
                            'id_cliente'      => $cliente->id,
                            'cliente'         => serialize($cliente),
                            'metodo'          => $metodo,
                            'outros'          => $outros
                        )
                    );

                    // Tela de preenchimento do CPF.
                    $data['titulo']       = 'Formulário para terceiros';
                    switch ($metodo) {
                        case self::POMS:
                            $data['legenda'] = 'POMS';
                            break;

                        case self::REAL_EQUIPE:
                            $data['legenda'] = 'REAL EQUIPE';
                            break;
                    }

                    $this->load->view('formularios_externos/form_cpf/header', $data);
                    $this->load->view('formularios_externos/form_cpf/form_check_cpf');
                    $this->load->view('formularios_externos/form_cpf/footer');
                }
            }
        }
    }

    /**
     * Validação específica de cada método.
     */

    // Valida se a equipe existe.
    function realequipe($outros) {
        $this->load->model('real_equipe/real_equipe_model');
        $data['equipe'] = $this->real_equipe_model->equipe($outros);

        if($data['equipe'] == NULL)
            return FALSE;
        else
            if($data['equipe']->status === 'processado')
                 echo show_error (utf8_decode('Ha equipe procurada já esta finalizada.'), 500, utf8_decode('Equipe finalizada'));
            else
                return TRUE;
    }

    // Não há validação específica.
    function poms($outros) {
        return TRUE;
    }


    /**
     * Verifica se o cpf digitado,
     * existe no banco de dados
     */
    function valida_cpf() {

        $cpf = $this->input->post('cpf');

        $metodo         = $this->session->userdata('metodo');
        $outros         = $this->session->userdata('outros');
        $url_cliente    = unserialize($this->session->userdata('cliente'))->url_form_terc;

        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'cpf',
                'label' => 'Digite seu cpf',
                'rules' => 'required|exact_length[14]'
            )
        );
        $this->form_validation->set_rules($config);



        # Se não validou cpf...
        if ($this->form_validation->run() == FALSE) {

            $this->valida_url($metodo, $url_cliente, $outros);


        # Se validou cpf então...
        } else {

            # Procura um pesquisado por cpf
            $this->load->model('pesquisados_model');
            $pesquisado = $this->pesquisados_model->pesquisado_cpf($cpf);

            # Se não encontrar
            # abriremos o form para cadastrar
            # os dados do pesquisado.
            if(!$pesquisado){

                $data['titulo']          = 'Pesquisados Formulários';
                $data['pesquisado']->cpf = $cpf;

                $this->load->view('formularios_externos/form_pesquisado/header', $data);
                $this->load->view('pesquisados/formulario', $data);
                $this->load->view('formularios_externos/form_pesquisado/footer');

            }
            # Se encontrarmos
            # verificamos se preencheu ou não o teste
            else {

                # Se o teste já fora preenchido...
                if($this->check_teste_preenchido($metodo, $pesquisado->id, $outros)){
                    echo show_error (utf8_decode('Para novo preenchimento você deve solicitar exclusão do teste já existente.'), 500, utf8_decode('O sistema já possue o seu teste preenchido.'));
                }
                # Se o teste ainda não fora preenchido...
                else {

                    switch ($metodo) {
                        # Abre form do poms
                        case self::POMS:
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

                        # Abre form do real equipe
                        case self::REAL_EQUIPE:
                            $data['titulo']           = 'Formulario Real Equipe';
                            $data['pesquisado_dados'] = $pesquisado;

                            $this->load->model('real_equipe/real_equipe_model');
                            $data['equipe_dados'] = $this->real_equipe_model->equipe($outros);

                            $data['frases'] = $this->real_equipe_model->frases();

                            $this->load->model('real_equipe/real_equipe_pesquisados_model');

                            $data['lider']                  = $this->real_equipe_pesquisados_model->get_lider($outros);
                            $data['pesquisado_real_equipe'] = $this->real_equipe_pesquisados_model->pesquisado_equipe($outros, $pesquisado->id);

                            $this->load->view('formularios_externos/form_pesquisado/header', $data);
                            $this->load->view('real_equipe/form_pesquisado', $data);
                            $this->load->view('formularios_externos/form_pesquisado/footer');
                            break;

                        default:
                            echo "Erro: não foi possível abrir nenhum fomulário";
                            break;
                    }
                }
            }
        }
    }

    function check_teste_preenchido($metodo, $id_pesquisado, $outros) {

        switch ($metodo) {
            case self::POMS:
                $this->load->model('poms/poms_model');
                $pesquisado_poms = $this->poms_model->pesquisado($id_pesquisado);
                if(!$pesquisado_poms) {
                    $teste_preenchido = FALSE;
                } else {
                    $teste_preenchido = TRUE;
                }
                break;

            case self::REAL_EQUIPE:
                $this->load->model('real_equipe/real_equipe_pesquisados_model');
                $pesquisado_real_equipe = $this->real_equipe_pesquisados_model->pesquisado_equipe($outros, $id_pesquisado);
                if(!$pesquisado_real_equipe){
                    // Inserindo o novo pesquisado na equipe.
                    $this->real_equipe_pesquisados_model->inserir(array(
                        'id_real_equipe' => $outros,
                        'id_pesquisado'  => $pesquisado_real_equipe->id,
                        'lider'          => 'nao',
                        'preenchido'     => 'nao'
                    ));

                    $teste_preenchido = FALSE;
                }else
                    if($pesquisado_real_equipe->preenchido == 'nao')
                        $teste_preenchido = FALSE;
                    else
                        $teste_preenchido = TRUE;
                break;

            default:
                echo "Erro: não foi possível checar nenhum teste!";
                break;
        }

        return $teste_preenchido;
    }

}