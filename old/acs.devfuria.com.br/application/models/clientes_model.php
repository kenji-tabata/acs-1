<?php
class Clientes_model extends CI_Model {
    private $table = 'clientes';

    function __construct() {
        parent::__construct();
    }

    /**
     * Retorna todos os clientes do sistema
     * 
     * @access  public
     * @param   void
     * @return  array 
     */
    function todos_clientes() {
        $query = $this->db->get($this->table);
        return $query->result();
    } 
    
    
    
    /* Obtem os dados de um cliente,
     * filtrando pelo id do mesmo.
     * 
     * @access	public
     * @param	int
     * @return  object or null
     */
    function cliente($id_cliente) {
        if ($id_cliente) {
            $this->db->where('id', $id_cliente);
            $query = $this->db->get($this->table);
            $cliente = $query->result();
            return $cliente[0];
        } else {
            return NULL;
        }        
    }    
    
    /* Obtem os dados de um cliente,
     * filtrando pela url_form_terc do mesmo.
     * 
     * @access	public
     * @param	string
     * @return  object or null
     */
    function get_cliente_url_form_terc($url_form_terc) {
        $this->db->where('url_form_terc', $url_form_terc);
        $query = $this->db->get($this->table);
        $cliente = $query->result();
        if($cliente)
            return $cliente[0];
        else
            return NULL;
    }
    
    /**
     * Deleta um cliente, atraves do id
     * do mesmo.
     *
     * @access public 
     * @param  int $id_cliente 
     * @return void
     */
    function deletar($id_cliente) {
        $this->db->where('id', $id_cliente);
        $this->db->delete($this->table);
    }
    
    /**
     * Salva um cliente, cria ou atualiza os dados.
     * 
     * @access public 
     * @param  array $data
     * @return return int
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
    
    
    /**
     * Debitar siginifica incluir um registro de débito
     * 
     * <p>Só poderá debitar se o resultado de (credito - debito) for
     * maior ou igual a 1</p>
     * 
     * <p>Por enquanto o sistema apenas acrescenta uma unidade no campo
     * debito na tabela clientes</p>
     * 
     * 
     * @access  type public
     * @param   type $id_cliente
     * @return  boolean 
     */
//    function debitar($id) {
//
//        $this->db->where('id', $id);
//        $query = $this->db->get($this->table);
//        $cliente = $query->result();
//        $cliente = $cliente[0];
//
//        $saldo = $cliente->credito - $cliente->debito;
//        
//        if ($saldo >= 1){
//            $cliente->debito++;
//
//            $data['id']     = $cliente->id;
//            $data['debito'] = $cliente->debito;
//            $this->salvar($data);
//            
//            return TRUE;
//        }else{
//            return FALSE;
//        }
//
//    }
    
    
    function debitar($id_cliente, $quanto) {

        # Busca o cliente
        $this->db->where('id', $id_cliente);
        $query = $this->db->get($this->table);
        $cliente = $query->result();
        $cliente = $cliente[0];

        # Acrescenta o débito
        $cliente->debito = $cliente->debito + $quanto;

        # Salva o débito
        $data['id']     = $cliente->id;
        $data['debito'] = $cliente->debito;
        $this->salvar($data);
    }    
    
    function retSaldo($id){
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        $cliente = $query->result();
        $cliente = $cliente[0];

        $saldo = $cliente->credito - $cliente->debito;
        
        return $saldo;
    }
    
    
    /**
     * Indica se o cliente é um cliente master.
     * 
     * @access	public
     * @param	int
     * @return  boolean
     */
    function is_master($id){
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        $cliente = $query->result();
        if($cliente[0]->tipo == 'master'){
            return TRUE;
        } else {
            return FALSE;
        }
    }

    
}# end class