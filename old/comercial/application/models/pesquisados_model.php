<?php
class Pesquisados_model extends CI_Model {
    private $table = 'pesquisados';

    function __construct() {
        parent::__construct();
    }
    
    /* Retorna os dados de um pesquisado
     * filtrando pelo id do mesmo.
     * 
     * @access	public
     * @param	int    $id
     * @return  object or null
     */
    function pesquisado($id) {
        if ($id) {
            $this->db->where('id', $id);
            $query = $this->db->get($this->table);
            $pesquisado = $query->result();
            return $pesquisado[0];
        } else {
            return NULL;
        }       
    }
    
    /* Retorna os dados de um pesquisado
     * filtrando pelo cpf do mesmo.
     * 
     * @access	public
     * @param	string $cpf
     * @return  object or null
     */
    function pesquisado_cpf($cpf) {
        if ($cpf) {
            $this->db->where('cpf', $cpf);
            $query = $this->db->get($this->table);
            $pesquisado = $query->result();
            if($pesquisado)
                return $pesquisado[0];
            else
                return NULL;
        } else {
            return NULL;
        }       
    }
    
    /* Retorna os dados de todos os pesquisados
     * de um determinado cliente, filtrando pelo id do mesmo.
     * 
     * @access	public
     * @param	int    $id_cliente
     * @return  array
     */
    function pesquisados($id_cliente) {
        $this->db->where('id_cliente', $id_cliente);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get($this->table);
        $pesquisados = $query->result();
        
        return $pesquisados;
    }
    
    /**
     * Retorna todos os pesquisados do sistema.
     * 
     * @access public
     * @param  void
     * @return array
     */
    function todos_pesquisados(){
        $this->db->select("{$this->table}.id, 
                           {$this->table}.nome, 
                           {$this->table}.email, 
                           {$this->table}.cpf, 
                           {$this->table}.data_nascimento, 
                           {$this->table}.sexo, 
                           {$this->table}.id_cliente, 
                           clientes.nome   AS nome_cliente, 
                           clientes.status AS status_cliente, 
                           clientes.credito");
        $this->db->from($this->table);
        $this->db->join('clientes', 
                        "{$this->table}.id_cliente = clientes.id",
                        'left');                   
                           
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Salva os dados de um pesquisado,
     * se ele existir sera atualizado, senao 
     * sera inserido.
     * 
     * @access public
     * @param  array $data
     * @return int
     */
    function salvar($data) {
        if ($data['id']) {
            $this->db->where('id', $data['id']);
            $this->db->update($this->table, $data);
        } else {
            $this->db->insert($this->table, $data);
            $data['id'] = $this->db->insert_id();
        }
        return $data['id'];
    }    
    
    /**
     * Deleta um pesquisado.
     * 
     * @access public
     * @param  int $id
     * @return void
     */
    function deletar($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }    
    
}
