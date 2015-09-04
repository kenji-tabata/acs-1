<?php
class Poms extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('loggedin') && !$this->session->userdata('usuario_externo')) {
            redirect(base_url(), 'refresh');
        }
    }

    /* Lista Poms
     */
    function index() {
        $data['titulo']     = 'Poms Lista';
        $data['menu_ativo'] = 'poms';

        $this->load->model('poms/poms_model');
        $data['pesquisados'] = $this->poms_model->pesquisados($this->session->userdata('id_cliente'));
        $this->load->model('clientes_model');
        $data['cliente']     = $this->clientes_model->cliente($this->session->userdata('id_cliente'));

        $this->load->view('header', $data);
        $this->load->view('menu', $data);
        $this->load->view('poms/lista', $data);
        $this->load->view('footer');
    }

    /* Formulário Poms
     */
    function formulario($id_pesquisado) {
        $data['titulo']     = 'Poms Formulário';
        $data['menu_ativo'] = 'poms';

        $this->load->model('poms/poms_model');
        $data['adjetivos_nomes'] = $this->poms_model->adjetivos();
        $data['poms_pesquisado'] = $this->poms_model->pesquisado($id_pesquisado);

        $this->load->model('pesquisados_model');
        $data['pesquisado'] = $this->pesquisados_model->pesquisado($id_pesquisado);

        $this->load->view('header', $data);
        $this->load->view('menu', $data);
        $this->load->view('poms/formulario', $data);
        $this->load->view('footer');
    }

    /* Salvar o Formulário do Poms
     */
    function salvar() {

        # Recebe dados
        $data['id_pesquisado']   = $this->input->post('id_pesquisado');

        for($i=1; $i <= 65; $i++){
            $array_resultado[$i] = $this->input->post($i);

            # valida?
            if(!$array_resultado[$i])
                redirect(base_url().'poms/poms/', 'refresh');
        }
        $data['array_resultado'] = $array_resultado;

        $this->load->model('poms/poms_model');
        $this->poms_model->salvar($data);

        if( !$this->session->userdata('usuario_externo') ) {

            redirect(base_url().'poms/poms/', 'refresh');
        }
        else {
            //echo show_error (utf8_decode('Seu teste foi preenchido com sucesso.'), 500, utf8_decode('Teste preenchido com sucesso.'));
            redirect(base_url().'poms/poms/', 'refresh');
        }
    }

    /* Deleta um formulario/teste do poms
     */
    function deletar($id_pesquisado) {
        $this->load->model('poms/poms_model');
        $this->poms_model->deletar_pesquisado($id_pesquisado);

        redirect(base_url().'poms/poms/', 'refresh');
    }


    /**
     * Processar Poms de um pesquisado
     *
     * Se debitar
     *      processa
     * Se não
     *      @TODO: deve mostar um mensagem que não foi possível
     *             processar por insuficiência de créditos
     *
     * @param type $id_pesquisado
     */
    function processar($id_pesquisado) {
        $this->load->model('clientes_model');
        $quanto = 1;

        if($this->clientes_model->retSaldo($this->session->userdata('id_cliente')) >= $quanto){
            # Debitar
            $this->clientes_model->debitar( $this->session->userdata('id_cliente'), $quanto);

            # Mudar status
            $this->load->model('poms/poms_model');
            $this->poms_model->processar($id_pesquisado);
        }

        redirect(base_url().'poms/poms/', 'refresh');
    }


    /* Resultado individual do Poms
     */
    function resultado_individual($id_pesquisado) {
        $this->load->model('pesquisados_model');
        $data['pesquisado'] = $this->pesquisados_model->pesquisado($id_pesquisado);

        $this->load->model('poms/poms_model');
        $data['poms_pesquisado'] = $this->poms_model->pesquisado($id_pesquisado);

        $this->load->library('poms/poms_calc');
        $this->poms_calc->setResultados($data['poms_pesquisado']->str_resultado);
        $data['row_score']  = $this->poms_calc->row_score;
        $data['tscore']     = $this->poms_calc->tscore;

        $this->load->library('poms/poms_graf');
        $data['poms_graf'] = $this->poms_graf;

        $this->load->library('pdf/fpdf.php');
        $this->load->library('pdf/pdfwritetag.php');
        $data['fpdf'] = $this->pdfwritetag;

        $this->load->library('poms/poms_laudos');
        $data['laudo'] = $this->poms_laudos->getLaudo($data['tscore']);

        $this->load->view('poms/resultado_individual', $data);
    }


    /* Resultado por grupo do Poms
     */
    function resultado_grupo() {
        $ids_pesquisados = $this->input->get('ids_pesquisados');

        $total_pesquisados = count($ids_pesquisados);

        $this->load->model('pesquisados_model');
        $this->load->model('poms/poms_model');
        $this->load->library('poms/poms_calc');

        foreach ($ids_pesquisados as $id_pesquisado) {
            $data['pesquisados'][$id_pesquisado]['pesquisado']      = $this->pesquisados_model->pesquisado($id_pesquisado);
            $data['pesquisados'][$id_pesquisado]['poms_pesquisado'] = $this->poms_model->pesquisado($id_pesquisado);

            $this->poms_calc->setResultados($data['pesquisados'][$id_pesquisado]['poms_pesquisado']->str_resultado);

            $data['pesquisados'][$id_pesquisado]['row_score']  = $this->poms_calc->row_score;
            $data['pesquisados'][$id_pesquisado]['tscore']     = $this->poms_calc->tscore;
            $this->poms_calc->row_score = '';
            $this->poms_calc->tscore    = '';
        }

        $data['media']['row_score']->tensao     = 0;
        $data['media']['row_score']->depressao  = 0;
        $data['media']['row_score']->raiva      = 0;
        $data['media']['row_score']->vigor      = 0;
        $data['media']['row_score']->fadiga     = 0;
        $data['media']['row_score']->confusao   = 0;

        $data['media']['tscore']->tensao        = 0;
        $data['media']['tscore']->depressao     = 0;
        $data['media']['tscore']->raiva         = 0;
        $data['media']['tscore']->vigor         = 0;
        $data['media']['tscore']->fadiga        = 0;
        $data['media']['tscore']->confusao      = 0;

        foreach ($data['pesquisados'] as $id_pesquisado => $pesquisado) {

            $data['media']['row_score']->tensao     += isset($pesquisado['row_score']->tensao)      ? $pesquisado['row_score']->tensao : 0;
            $data['media']['row_score']->depressao  += isset($pesquisado['row_score']->depressao)   ? $pesquisado['row_score']->depressao : 0;
            $data['media']['row_score']->raiva      += isset($pesquisado['row_score']->raiva)       ? $pesquisado['row_score']->raiva : 0;
            $data['media']['row_score']->vigor      += isset($pesquisado['row_score']->vigor)       ? $pesquisado['row_score']->vigor : 0;
            $data['media']['row_score']->fadiga     += isset($pesquisado['row_score']->fadiga)      ? $pesquisado['row_score']->fadiga : 0;
            $data['media']['row_score']->confusao   += isset($pesquisado['row_score']->confusao)    ? $pesquisado['row_score']->confusao : 0;

            $data['media']['tscore']->tensao        += isset($pesquisado['tscore']->tensao)     ? $pesquisado['tscore']->tensao : 0;
            $data['media']['tscore']->depressao     += isset($pesquisado['tscore']->depressao)  ? $pesquisado['tscore']->depressao : 0;
            $data['media']['tscore']->raiva         += isset($pesquisado['tscore']->raiva)      ? $pesquisado['tscore']->raiva : 0;
            $data['media']['tscore']->vigor         += isset($pesquisado['tscore']->vigor)      ? $pesquisado['tscore']->vigor : 0;
            $data['media']['tscore']->fadiga        += isset($pesquisado['tscore']->fadiga)     ? $pesquisado['tscore']->fadiga : 0;
            $data['media']['tscore']->confusao      += isset($pesquisado['tscore']->confusao)   ? $pesquisado['tscore']->confusao : 0;
        }

        $data['media']['row_score']->tensao     = (int)($data['media']['row_score']->tensao / $total_pesquisados);
        $data['media']['row_score']->depressao  = (int)($data['media']['row_score']->depressao / $total_pesquisados);
        $data['media']['row_score']->raiva      = (int)($data['media']['row_score']->raiva / $total_pesquisados);
        $data['media']['row_score']->vigor      = (int)($data['media']['row_score']->vigor / $total_pesquisados);
        $data['media']['row_score']->fadiga     = (int)($data['media']['row_score']->fadiga / $total_pesquisados);
        $data['media']['row_score']->confusao   = (int)($data['media']['row_score']->confusao / $total_pesquisados);

        $data['media']['tscore']->tensao     = (int)($data['media']['tscore']->tensao / $total_pesquisados);
        $data['media']['tscore']->depressao  = (int)($data['media']['tscore']->depressao / $total_pesquisados);
        $data['media']['tscore']->raiva      = (int)($data['media']['tscore']->raiva / $total_pesquisados);
        $data['media']['tscore']->vigor      = (int)($data['media']['tscore']->vigor / $total_pesquisados);
        $data['media']['tscore']->fadiga     = (int)($data['media']['tscore']->fadiga / $total_pesquisados);
        $data['media']['tscore']->confusao   = (int)($data['media']['tscore']->confusao / $total_pesquisados);

        $this->load->library('poms/poms_graf');
        $data['poms_graf'] = $this->poms_graf;

        $this->load->library('pdf/fpdf.php');
        $data['fpdf'] = $this->fpdf;

        $this->load->view('poms/resultado_grupo', $data);
    }

    function download_formulario_pdf(){
        $this->load->helper('download');

        $dados = file_get_contents("application/views/poms/formulario.pdf");
        $nome = 'formulario_poms.pdf';
        force_download($nome, $dados);
    }

}
