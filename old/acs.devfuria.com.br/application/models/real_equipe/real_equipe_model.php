<?php
class Real_equipe_model extends CI_Model {
    private $table = 'real_equipe';
    
    function __construct() {
        parent::__construct();
    }
    
    /* Retorna todas as equipes de um determinado cliente.
     * 
     * @access	 public
     * @param	 int
     * @return   array
     */
    function equipes($id_cliente) {
        $this->db->where('id_cliente', $id_cliente);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    /* Retorna apenas uma determinada equipe.
     * 
     * @access	 public
     * @param	 int
     * @return   object or null
     */
    function equipe($id) {
        $this->db->where('id', $id);
        $query  = $this->db->get($this->table);
        $equipe = $query->result();
        if($equipe)
            return $equipe[0];
        else 
            return NULL;
    }
    
    
    function processar($id) {
        $data['status'] = 'processado';
        
        $this->db->where('id', $id);
        $this->db->update($this->table, $data); 
    }    
    
   
    
    
    /* Salva uma equipe e retorna seu id.
     * 
     * @access	 public
     * @param	 array
     * @return   int
     */
    function salvar($data) {
        if($data['id']){
            $this->db->where('id', $data['id']);
            $this->db->update($this->table, $data);
        } else {
            $this->db->insert($this->table, $data); 
            $data['id'] = $this->db->insert_id();
        }
        
        return $data['id'];
    }
    
    /* Deleta uma equipe.
     * 
     * @access	 public
     * @param	 int
     * @return   void
     */
    function deletar($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
    
    /* Retorna as frases do real equipe.
     * 
     * @access	 public
     * @param	 void
     * @return   array
     */
    function frases() {
        return array(
            1 => array('invertida' => 'nao', 'frase' => 'É cordial e acessível com seus liderados?'),
            11 => array('invertida' => 'nao', 'frase' => 'Faz com que os membros do seu grupo/equipe saibam o que é esperado de você como líder?'),            
            21 => array('invertida' => 'nao', 'frase' => 'Utiliza-se de palavras estimulantes para incentivar o grupo/equipe?'),
            31 => array('invertida' => 'nao', 'frase' => 'Trata de problemas complexos com eficiência?'),
            36 => array('invertida' => 'nao', 'frase' => 'Mantém seu grupo trabalhando unido como uma equipe?'),
            41 => array('invertida' => 'nao', 'frase' => 'Permite completa liberdade de trabalho aos membros do grupo/equipe?'),
            2 => array('invertida' => 'nao', 'frase' => 'Preocupa-se em fazer com que seja agradável para as pessoas pertencerem ao seu grupo/equipe?'),
            12 => array('invertida' => 'nao', 'frase' => 'Encoraja a utilização de procedimentos uniformes?'),
            22 => array('invertida' => 'nao', 'frase' => 'Utiliza-se de argumentos convincentes?'),
            32 => array('invertida' => 'sim', 'frase' => 'Deixa-se perder em detalhes?'),
            37 => array('invertida' => 'nao', 'frase' => 'Resolve os conflitos que ocorrem no seu grupo/equipe?'),
            42 => array('invertida' => 'nao', 'frase' => 'Permite que os membros do grupo/equipe usem julgamentos próprios na solução de problemas?'),
            3 => array('invertida' => 'nao', 'frase' => 'Aceita colocar em prática as sugestões que são feitas pelo grupo/equipe?'),
            13 => array('invertida' => 'nao', 'frase' => 'Utiliza-se dos membros do seu grupo/equipe para testar suas idéias?'),            
            23 => array('invertida' => 'nao', 'frase' => 'Argumenta persuasivamente em defesa dos seus pontos de vista?'),
            33 => array('invertida' => 'nao', 'frase' => 'Consegue complicar as coisas de maneira clara?'),
            38 => array('invertida' => 'nao', 'frase' => 'Preocupa-se para que o trabalho do grupo/equipe seja coordenado?'),
            43 => array('invertida' => 'nao', 'frase' => 'Encoraja os membros do seu grupo/equipe a tomarem iniciativa?'),
            4 => array('invertida' => 'nao', 'frase' => 'Trata todos os membros do seu grupo/equipe de igual para igual?'),
            14 => array('invertida' => 'nao', 'frase' => 'Esclarece as atitudes que toma para os membros do grupo/equipe?'),
            24 => array('invertida' => 'nao', 'frase' => 'É um orador muito persuasivo?'),
            34 => array('invertida' => 'nao', 'frase' => 'Restabelece a ordem em ambiente tumultuado?'),
            39 => array('invertida' => 'nao', 'frase' => 'Auxilia os membros do seu grupo a resolverem suas divergências?'),            
            44 => array('invertida' => 'nao', 'frase' => 'Permite que os membros do seu grupo/equipe trabalhem de forma que melhor lhes convenha?'),
            5 => array('invertida' => 'nao', 'frase' => 'Comunica mudanças com antecedência?'),
            15 => array('invertida' => 'nao', 'frase' => 'Decide o que deve ser feito e como deve ser feito?'),
            25 => array('invertida' => 'nao', 'frase' => 'É hábil em argumentar?'),
            35 => array('invertida' => 'sim', 'frase' => 'Fica confuso quando muitas solicitações são feitas ao mesmo tempo?'),
            40 => array('invertida' => 'nao', 'frase' => 'Mantém o grupo/equipe fortemente unido?'),
            45 => array('invertida' => 'nao', 'frase' => 'Determina uma tarefa e permite que os membros do grupo/equipe a levem a adiante?'),
            6 => array('invertida' => 'sim', 'frase' => 'Conserva-se distante dos membros do seu grupo/equipe?'),
            16 => array('invertida' => 'nao', 'frase' => 'Designa membros do seu grupo/equipe para realizar tarefas específicas?'),
            26 => array('invertida' => 'sim', 'frase' => 'Não é um orador muito convincente?'),
            46 => array('invertida' => 'nao', 'frase' => 'Faz com que os membros do seu grupo/equipe se sintam a vontade na realização de um trabalho?'),
            7 => array('invertida' => 'nao', 'frase' => 'Preocupa-se com o bem-estar dos membros do grupo/equipe?'),
            17 => array('invertida' => 'nao', 'frase' => 'Certifica-se de que a sua função deve ser entendida pelos membros do seu grupo/equipe?'),
            27 => array('invertida' => 'nao', 'frase' => 'Comunica-se com convicção?'),
            47 => array('invertida' => 'sim', 'frase' => 'É relutante em permitir qualquer liberdade de ação aos membros do grupo/equipe?'),
            8 => array('invertida' => 'nao', 'frase' => 'É aberto a mudanças?'),
            18 => array('invertida' => 'nao', 'frase' => 'Programa trabalho a ser realizado?'),
            28 => array('invertida' => 'nao', 'frase' => 'É um líder que leva inspiração ao seu grupo/equipe?'),
            48 => array('invertida' => 'nao', 'frase' => 'Permite um alto grau de inciativa ao grupo/equipe?'),
            9 => array('invertida' => 'sim', 'frase' => 'Recusa-se a dar explicações das suas ações de comando para os membros do seu grupo/equipe?'),
            19 => array('invertida' => 'nao', 'frase' => 'Define as atribuições de cada membro do grupo/equipe?'),
            29 => array('invertida' => 'nao', 'frase' => 'Convence os outros de que as idéias dele trarão vantagens ao grupo/equipe?'),
            49 => array('invertida' => 'nao', 'frase' => 'Confia na capacidade do grupo/equipe em julgar bem?'),
            10 => array('invertida' => 'sim', 'frase' => 'Age sem consultar os membros do seu grupo/equipe?'),
            20 => array('invertida' => 'nao', 'frase' => 'Solicita que os membros do grupo/equipe sigam normas e regulamentos?'),
            30 => array('invertida' => 'nao', 'frase' => 'Inspira entusiasmo por um projeto?'),
            50 => array('invertida' => 'nao', 'frase' => 'Permite que o grupo/equipe estabeleça o próprio ritmo de trabalho?')
        );
    }
 }
