<?php
class Real_equipe extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        
        if (!$this->session->userdata('loggedin') && !$this->session->userdata('usuario_externo'))
            redirect(base_url(), 'refresh');
    }
    
    /* Lista Real Equipe
     */
    function index() {
        $data['titulo']     = 'Real Equipe Lista';
        $data['menu_ativo'] = 'real_equipe';
        
        $this->load->model('real_equipe/real_equipe_model');
        $data['equipes'] = $this->real_equipe_model->equipes($this->session->userdata('id_cliente'));
        
        $this->load->view('header', $data);
        $this->load->view('menu', $data);
        $this->load->view('real_equipe/lista', $data);
        $this->load->view('footer');
    }
    
    /* Carrega o formulario para criar ou editar a equipe do Real Equipe
     */
    function formulario_equipe($id_real_equipe=NULL) {
        $data['titulo'] = 'Real Equipe - Equipe';
        
        $this->load->model('pesquisados_model');
        $data['todos_pesquisados'] = $this->pesquisados_model->pesquisados($this->session->userdata('id_cliente'));
        
        $data['equipe_pesquisados'] = array();
        
        if($id_real_equipe){
            $this->load->model('real_equipe/real_equipe_model');
            $data['equipe_dados'] = $this->real_equipe_model->equipe($id_real_equipe);
            
            $this->load->model('real_equipe/real_equipe_pesquisados_model');
            $data['equipe_pesquisados'] = $this->real_equipe_pesquisados_model->pesquisados_equipe($data['equipe_dados']->id);
            
            // Retira da lista de 'todos os pesquisados' os pesquisados que estão na equipe.
            foreach ($data['equipe_pesquisados'] as $equipe_pesquisado) {
                foreach ($data['todos_pesquisados'] as $key => $todos_pesquisados) {
                    if($equipe_pesquisado->id_pesquisado == $todos_pesquisados->id){
                        unset ($data['todos_pesquisados'][$key]);
                    }
                }
            }
        }
       
        $this->load->view('real_equipe/form_equipe', $data);
    }
    
    /* Salva o formulário para criar ou editar a equipe do Real Equipe
     */
    function formulario_equipe_salvar(){
         $pesquisados       = $this->input->post('pesquisado');
         $id_real_equipe    = $this->input->post('real-equipe-dialog-id');
         $id_cliente        = $this->input->post('real-equipe-dialog-id-cliente');
         $equipe_nome       = $this->input->post('real-equipe-dialog-nome-equipe');
         $equipe_status     = $this->input->post('real-equipe-dialog-status-equipe');
         $equipe_status     = ($equipe_status == 'nao_preenchido') ? 'preenchido' : $equipe_status;
         
         $i = 0;
         
         foreach ($pesquisados as $pesquisado) {
             $equipe_pesquisados[$i]['id_pesquisado']  = $pesquisado['id-pesquisado'];
             $equipe_pesquisados[$i]['str_resultado']  = $pesquisado['str-resultado'];
             $equipe_pesquisados[$i]['lider']          = $pesquisado['lider'];
             $equipe_pesquisados[$i]['preenchido']     = $pesquisado['preenchido'];
             
             $i++;
             
             if($pesquisado['preenchido'] == 'nao')
                 $equipe_status = 'nao_preenchido';
         }
         
         $this->load->model('real_equipe/real_equipe_model');
         $id_real_equipe = $this->real_equipe_model->salvar(
                 array( 'id'            => $id_real_equipe,
                        'id_cliente'    => $id_cliente,
                        'nome'          => $equipe_nome,
                        'status'        => $equipe_status
                     )
         );
         
         $this->load->model('real_equipe/real_equipe_pesquisados_model');
         $this->real_equipe_pesquisados_model->deletar_equipe($id_real_equipe);
         
         foreach ($equipe_pesquisados as $equipe_pesquisado) {
             $equipe_pesquisado['id_real_equipe'] = $id_real_equipe;
             $this->real_equipe_pesquisados_model->inserir($equipe_pesquisado);
         }
    }
    
    /* Deleta uma equipe e seus participantes.
     */
    function deletar_equipe($id) {
        $this->load->model('real_equipe/real_equipe_model');
        $this->real_equipe_model->deletar($id);
        
        $this->load->model('real_equipe/real_equipe_pesquisados_model');
        $this->real_equipe_pesquisados_model->deletar_equipe($id);
        
        redirect(base_url().'real_equipe/real_equipe', 'refresh');
    }
    
    /* Abre links para os formulários dos participantes da equipe.
     */
    function equipe_pesquisados($id) {
        $data['id_real_equipe'] = $id;
        
        $this->load->model('clientes_model');
        $data['cliente'] = $this->clientes_model->cliente($this->session->userdata('id_cliente'));
        
        $this->load->model('real_equipe/real_equipe_pesquisados_model');
        $data['pesquisados'] = $this->real_equipe_pesquisados_model->pesquisados_equipe($id);
        
        $this->load->view('real_equipe/equipe_pesquisados', $data);
    }
    
    /* Abre/Carrega o formulário para o pesquisado.
     */
    function formulario_pesquisado($id_real_equipe, $id_pesquisado) {
        $data['titulo']         = 'Real Equipe Formulário';
        $data['menu_ativo']     = 'real_equipe';
        
        $this->load->model('pesquisados_model');
        $data['pesquisado_dados'] = $this->pesquisados_model->pesquisado($id_pesquisado);
        
        $this->load->model('real_equipe/real_equipe_model');
        $data['equipe_dados'] = $this->real_equipe_model->equipe($id_real_equipe);
        $data['frases'] = $this->real_equipe_model->frases();        
        
        $this->load->model('real_equipe/real_equipe_pesquisados_model');
        $data['lider']                  = $this->real_equipe_pesquisados_model->get_lider($id_real_equipe);
        $data['pesquisado_real_equipe'] = $this->real_equipe_pesquisados_model->pesquisado_equipe($id_real_equipe, $id_pesquisado);
        
        $this->load->helper('string_resultado');
        if($data['pesquisado_real_equipe']->str_resultado)
            $data['array_resultado'] = _str_resultado_to_array($data['pesquisado_real_equipe']->str_resultado);
        else
            $data['array_resultado'] = array();
        
        $this->load->view('header', $data);
        $this->load->view('menu', $data);
        $this->load->view('real_equipe/form_pesquisado');
        $this->load->view('footer');
    }
    
    /**
     *  Salva o formulario do Real Equipe de um pesquisado.
     */
    function formulario_pesquisado_salvar(){
        
        # Transforma o array em string
        $this->load->helper('string_resultado');
        $str_resultado = _array_to_str_resultado($this->input->post('frases'), 50);
        
        # Somente se o usuario desativar o javascript.
        if($str_resultado['valor_vazio']){
            die('Preencha todos os campos.');
        }
        
        $data['id_real_equipe'] = $this->input->post('id_real_equipe');
        $data['id_pesquisado']  = $this->input->post('id_pesquisado');
        $data['str_resultado']  = $str_resultado['str_resultado'];
        $data['lider']          = $this->input->post('lider');
        $data['preenchido']     = 'sim';
        
        $this->load->model('real_equipe/real_equipe_pesquisados_model');
        $this->real_equipe_pesquisados_model->update($data);
        
        $equipe_status = $this->input->post('equipe_status');
        
        switch ($equipe_status) {
            case 'processado':
                $data_equipe['id']     = $data['id_real_equipe'];
                $data_equipe['status'] = 'preenchido';
                $this->load->model('real_equipe/real_equipe_model');
                $this->real_equipe_model->salvar($data_equipe);
                break;
            case 'nao_preenchido':
                $pesquisados = $this->real_equipe_pesquisados_model->pesquisados_equipe($data['id_real_equipe']);
                $data_equipe['status'] = 'preenchido';
                foreach ($pesquisados as $pesquisado) {
                    if($pesquisado->preenchido == 'nao')
                        $data_equipe['status'] = 'nao_preenchido';
                }
                if( $data_equipe['status'] == 'preenchido'){
                    $data_equipe['id']     = $data['id_real_equipe'];
                    $data_equipe['status'] = 'preenchido';
                    $this->load->model('real_equipe/real_equipe_model');
                    $this->real_equipe_model->salvar($data_equipe);
                }
                break;
            case 'preenchido':
                // Nao precisa fazer nada.
                break;
            default:
                break;
        }
        
        if( !$this->session->userdata('usuario_externo') )
            redirect(base_url().'real_equipe/real_equipe', 'refresh');
        else
            echo show_error (utf8_decode('Seu teste foi preenchido com sucesso.'), 500, utf8_decode('Teste preenchido com sucesso.'));
    }
    
    /**
     * Processar Real Equipe de uma equipe
     * 
     * Se tem saldo
     *      processa
     * Se não
     *      @TODO: deve mostar um mensagem que não foi possível
     *             processar por insuficiência de créditos
     * 
     * @param type $id_pesquisado 
     */
    function processar($id_equipe) {
        # Models
        $this->load->model('clientes_model');        
        $this->load->model('real_equipe/real_equipe_pesquisados_model');
        
        # Busca dados
        $id_cliente = $this->session->userdata('id_cliente');
        $total_pesq_equipe = $this->real_equipe_pesquisados_model->pesquisados_equipe($id_equipe);
        $total_pesq_equipe = count($total_pesq_equipe);
        $saldo             = $this->clientes_model->retSaldo($id_cliente, $total_pesq_equipe);  ;
        
        # Se positivo então pode processar...
        if( $saldo >= $total_pesq_equipe ){
            # Debitar
            $this->clientes_model->debitar($id_cliente, $total_pesq_equipe);
            
            # Mudar status
            $this->load->model('real_equipe/real_equipe_model');
            $this->real_equipe_model->processar($id_equipe);            
        }else{
            # TODO, msg
        } 
        
        redirect(base_url().'real_equipe/real_equipe/', 'refresh');       
    }    
    
    /**
     * Resultado do real equipe
     */
    function resultado($id_equipe) {
        $data = array();

        # Carregar os pesquisados
        $this->load->model('real_equipe/real_equipe_pesquisados_model');
        $data['pesquisados'] = $this->real_equipe_pesquisados_model->pesquisados_equipe($id_equipe);
        $total_pesq_equipe = count($data['pesquisados']);

        # Efetua o cálculo...
        $this->load->library('real_equipe/real_equipe_calc');
        $this->load->helper('string_resultado');
        
        $media_resultado = array();
        $media_resultado['rh']  = 0;
        $media_resultado['et']  = 0;
        $media_resultado['per'] = 0;
        $media_resultado['rec'] = 0;
        $media_resultado['int'] = 0;
        $media_resultado['tof'] = 0; 
        
        foreach($data['pesquisados'] as $pesquisado){
            $pesquisado->resultado = array();

            # Transforma 
            $str_resultado = _str_resultado_to_array($pesquisado->str_resultado, 50);
            
            # resultado de cada pesquisado
            $this->real_equipe_calc->setResultado($str_resultado);
            $pesquisado->resultado = $this->real_equipe_calc->resultado;            
//            var_dump($pesquisado->resultado);            
            
            # Média dos resultados
            $media_resultado['rh']  += $pesquisado->resultado['rh'];
            $media_resultado['et']  += $pesquisado->resultado['et'];
            $media_resultado['per'] += $pesquisado->resultado['per'];
            $media_resultado['rec'] += $pesquisado->resultado['rec'];
            $media_resultado['int'] += $pesquisado->resultado['int'];
            $media_resultado['tof'] += $pesquisado->resultado['tof'];             
//            var_dump($media_resulado);            
        }
        
        $media_resultado['rh']  = $media_resultado['rh']  / $total_pesq_equipe;
        $media_resultado['et']  = $media_resultado['et']  / $total_pesq_equipe;
        $media_resultado['per'] = $media_resultado['per'] / $total_pesq_equipe;
        $media_resultado['rec'] = $media_resultado['rec'] / $total_pesq_equipe;
        $media_resultado['int'] = $media_resultado['int'] / $total_pesq_equipe;
        $media_resultado['tof'] = $media_resultado['tof'] / $total_pesq_equipe; 
//        var_dump($data['pesquisados'], $media_resulado); die(); 
//        
        # Atribuição final
        # para enchergar o resultado em grupo lá na view
        $data['media_resultado'] = $media_resultado;
		
		
		# Calcula o número do laudo...
		$autoritario = $media_resultado['et'];
		$democratico = $media_resultado['rh'];
		if($autoritario > $democratico){
			if($autoritario > 50){
				$nr_laudo = 1;
			}else{
				$nr_laudo = 2;
			}
		}else{
			if($democratico < 50){
				$nr_laudo = 3;
			}else{
				$nr_laudo = 4;
			}
		}
        $data['num_laudo'] = $nr_laudo; # atribue para a view
        // ***************************************************************** //
        
//        # Carregar o gráfico
//        $this->load->library('real_equipe/real_equipe_graf');
//        $data['real_equipe_graf'] = $this->real_equipe_graf;

        # Carregar o gráfico
        $this->load->library('real_equipe/real_equipe_graf_new');
        $data['real_equipe_graf_new'] = $this->real_equipe_graf_new;
        
        # Carregar o pdf
        $this->load->library('pdf/fpdf.php');
        $data['fpdf'] = $this->fpdf;
        
        # View
        $this->load->view('real_equipe/resultado', $data);
    } 
    
    function download_formulario_pdf(){
        $this->load->helper('download');
        
        $dados = file_get_contents("application/views/real_equipe/formulario.pdf");
        $nome = 'formulario_real_equipe.pdf';
        force_download($nome, $dados);        
    }    
    
}
?>