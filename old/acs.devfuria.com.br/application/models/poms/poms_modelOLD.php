<?php
class Poms_model extends CI_Model {
    private $table = 'poms';
    
    function __construct() {
        parent::__construct();
    }
    
    /* Salva e atualiza um resultado do Poms.
     * 
     * @access	 public
     * @param	 array
     * @return   void
     */
    function salvar($data) {
        $data['status'] = 'preenchido';
        $data['str_resultado'] = $this->_array_to_str_resultado($data['array_resultado']);
        
        unset($data['array_resultado']);
        
        if(!$this->pesquisado($data['id_pesquisado']))
            $this->db->insert($this->table, $data);
        else {
            $this->db->where('id_pesquisado', $data['id_pesquisado']);
            $this->db->update($this->table, $data);
        }    
    }
    
    /* Processa um pesquisado para o metodo poms.
     * 
     * @access	 public
     * @param	 int
     * @return   void
     */
    function processar($id_pesquisado) {
        $data['status'] = 'processado';
        
        $this->db->where('id_pesquisado', $id_pesquisado);
        $this->db->update($this->table, $data); 
    }
    
    /*  Retorna a lista de todos os pesquisados 
     *  para o metodo poms filtrando pelo cliente.
     * 
     *  @access	 public
     *  @param	 int
     *  @return  array
     */
    function pesquisados($id_cliente) {
        $this->db->select('pesquisados.id,
                           pesquisados.nome, 
                           pesquisados.email, 
                           pesquisados.cpf, 
                           pesquisados.sexo,'.
                           $this->table.'.status');
        $this->db->from('pesquisados');
        $this->db->join($this->table, 
                        'pesquisados.id = '.$this->table.'.id_pesquisado', 
                        'left');
        $this->db->where('pesquisados.id_cliente', $id_cliente);
        $this->db->order_by('pesquisados.id', 'DESC');
        $query = $this->db->get();

        return $query->result();
    }
    
    /*  Retorna apenas um pesquisado
     *  para o metodo poms filtrando pelo id do mesmo.
     * 
     *  @access	 public
     *  @param	 int
     *  @return  object, null
     */
    function pesquisado($id_pesquisado) {
        $this->db->where('id_pesquisado', $id_pesquisado);
        $query = $this->db->get($this->table);
        $pesquisado = $query->result();
        
        if(count($pesquisado) != 1)
            return NULL;
        else {
            $pesquisado[0]->str_resultado = $this->_str_resultado_to_array($pesquisado[0]->str_resultado);
            return $pesquisado[0];
        }
    }
    
    /* Pega a string de resultado do poms ex: '1_3, 2_4, 3_5 etc...'
     * e retorna um array ex: $array ('1' => '3', '2' => '4', '3' => '5' etc..)
     * 
     *  @access	 private
     *  @param	 string
     *  @return  array
     */
    function _str_resultado_to_array($str_resultado) {
        $explode = explode(',', $str_resultado);
        $adjetivos_pontuacao = array();
        
        foreach ($explode as $valor) {
            $pontuacao = explode('_', trim($valor));
            $adjetivos_pontuacao[$pontuacao[0]] = $pontuacao[1];
        }
        
        return $adjetivos_pontuacao;
    }
    
    /* Pega um array ex: $array ('1' => '3', '2' => '4', '3' => '5' etc..)
     * e retorna uma string de resultado do poms ex: '1_3, 2_4, 3_5 etc...'
     * 
     *  @access	 private
     *  @param	 array
     *  @return  string
     */
    function _array_to_str_resultado($array_resultado) {
        $str_resultado = '';
        
        foreach ($array_resultado as $nr_questao => $valor) {
            $str_resultado .= ($nr_questao == 65) ? $nr_questao.'_'.$valor : $nr_questao.'_'.$valor.', ';
        }

        return $str_resultado;
    }
    
    /* Deletar um teste do poms de um pesquisado.
     * 
     * @access	 public
     * @param	 int
     * @return   void
     */
    function deletar_pesquisado($id_pesquisado) {
        $this->db->where("{$this->table}.id_pesquisado", $id_pesquisado);
        $this->db->delete($this->table);
    }
    
    /*  Retorna o nome de todos os
     *  adjetivos do poms.
     * 
     *  @access	 public
     *  @return  array
     */
    function adjetivos() {
        return array(
            1=>'amistoso',
            2=>'tenso',
            3=>'bravo',
            4=>'esgotado',
            5=>'infeliz',
            6=>'sereno',
            7=>'animado',
            8=>'confuso',
            9=>'arrependido',
            10=>'agitado',
            11=>'apático',
            12=>'mau humurado',
            13=>'preocupado com os outros',
            14=>'triste',
            15=>'ativo',
            16=>'aponto de explodir',
            17=>'resmungão',
            18=>'abatido',
            19=>'energético',
            20=>'apavorado',			
            21=>'sem esperança',
            22=>'relaxado',
            23=>'desvalorizado',
            24=>'rancoroso',
            25=>'simpático',
            26=>'intranquilo',
            27=>'inquieto',
            28=>'incapaz de concentrar-se',
            29=>'cansado',
            30=>'cooperador',
            31=>'iritado',
            32=>'desanimado',
            33=>'ressentido',
            34=>'nervoso',
            35=>'sozinho',
            36=>'miserável',
            37=>'atordoado',
            38=>'alegre',
            39=>'amargurado',
            40=>'exausto',
            41=>'ansioso',
            42=>'briguento',
            43=>'bondoso',
            44=>'deprimido',
            45=>'desesperado',
            46=>'preguiçoso',
            47=>'rebelde',
            48=>'abandonado',
            49=>'aborrecido',
            50=>'desorientado',
            51=>'alerta',
            52=>'decepcionado',
            53=>'furioso',
            54=>'eficiente',
            55=>'confiante',
            56=>'cheio de energia',
            57=>'genioso',
            58=>'inútil',
            59=>'esquecido',
            60=>'sem preocupação',
            61=>'aterrorizado',
            62=>'culpado',
            63=>'rigoroso',
            64=>'inseguro',
            65=>'fatigado'
        );
    }
}
