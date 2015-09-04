<?php
class Usuarios_model extends CI_Model {
    private $table = 'usuarios';
    
    function __construct() {
        parent::__construct();
    }

    /**
     * Esta função faz parte do processo de login.
     * 
     * @access	public
     * @param	array
     * @return  array or boolean
     */
    function login($data) {
        $this->db->where('usuario', $data['usuario']);
        $query   = $this->db->get($this->table);
        $usuario = $query->result();
        
        if(count($usuario) < 1){
            return FALSE;
        } else {
            if(empty($usuario[0]->senha)){
                $this->salvar_senha($usuario[0]->id, $data['senha']);
                return $usuario[0];
            } else {
                if($usuario[0]->senha != md5($data['senha'])){
                    return FALSE;
                } else {
                    return $usuario[0];
                }
            }
        }
    }
    
    /** 
     * Retorna todos os usuários de um determinado cliente.
     *
     * @access	public
     * @param   int $id_cliente
     * @return  array 
     */
    function usuarios($id_cliente) {
        $this->db->where('id_cliente', $id_cliente);
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    /**
     * Retorna todos os usuarios do sistema.
     * 
     * @access public
     * @param  void
     * @return array
     */
    function todos_usuarios(){
        $this->db->select("{$this->table}.id, 
                           {$this->table}.nome, 
                           {$this->table}.usuario, 
                           {$this->table}.status, 
                           {$this->table}.tipo, 
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
     * Retorna um usuário
     * filtrando pelo seu id.
     *
     * @access	public
     * @param   int $id
     * @return  object or null 
     */
    function usuario($id) {
        if($id){
            $this->db->where('id', $id);
            $query = $this->db->get($this->table);
            $usuario = $query->result();
            return $usuario[0];
        } else {
            return NULL;
        }    
    }

    /**
     * Deleta um usuário filtrando pelo seu id.
     *
     * @access	public
     * @param   int $id_usuario
     * @return  void
     */
    function deletar($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
    
    /**
     * Deleta usuários filtrando pelo id de um cliente.
     *
     * @access	public
     * @param   int $id_cliente
     * @return  void
     */
    function deletar_usuarios($id_cliente) {
        $this->db->where('id_cliente', $id_cliente);
        $this->db->delete($this->table);
    }    
    
    /**
     * Salva um usuário, se existir o id do mesmo, 
     * ele sera atualizado, senao ele sera inserido.
     *
     * @access	public
     * @param   array $data
     * @return  void
     */
    function salvar($data) {
        if ($data['id']) {
            $this->db->where('id', $data['id']);
            $this->db->update($this->table, $data);
        } else {
            $this->db->insert($this->table, $data);
        }
    }
    
    /**
     * Atualiza a senha de um usuario.
     * 
     * @access	public
     * @param   int, string
     * @return  void
     */
    function salvar_senha($id, $senha) {
        $data['senha'] = md5($senha);
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }
}