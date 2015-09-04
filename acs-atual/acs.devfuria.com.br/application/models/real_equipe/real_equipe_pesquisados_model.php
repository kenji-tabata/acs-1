<?php
class Real_equipe_pesquisados_model extends CI_Model {
    private $table = 'real_equipe_pesquisados';
    
    function __construct() {
        parent::__construct();
    }
    
    /* Retorna os pesquisados de uma determinanda equipe.
     * 
     * @access	 public
     * @param	 int
     * @return   array
     */
    function pesquisados_equipe($id_real_equipe) {
        $this->db->select("pesquisados.nome,
                           {$this->table}.id_pesquisado,
                           {$this->table}.str_resultado,
                           {$this->table}.lider,
                           {$this->table}.preenchido");
        $this->db->from('pesquisados');
        $this->db->join($this->table, 
                        "pesquisados.id = {$this->table}.id_pesquisado", 
                        'left');
        $this->db->where("{$this->table}.id_real_equipe", $id_real_equipe);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();

        return $query->result();
    }
    
    /* Retorna o lider de uma equipe se ele existir.
     * 
     * @access	 public
     * @param	 int
     * @return   object
     */
    function get_lider($id_real_equipe){
        $pesquisados = $this->pesquisados_equipe($id_real_equipe);
        $lider       = new stdClass();
        
        foreach ($pesquisados as $pesquisado) {
            if ($pesquisado->lider == 'sim')
                $lider = $pesquisado;
        }
        
        return $lider;
    }
    
    
    /* Retorna um pesquisado de uma determinanda equipe.
     * 
     * @access	 public
     * @param	 int, int
     * @return   object or NULL
     */
    function pesquisado_equipe($id_real_equipe, $id_pesquisado) {
        $this->db->where("{$this->table}.id_real_equipe", $id_real_equipe);
        $this->db->where("{$this->table}.id_pesquisado", $id_pesquisado);
        $query = $this->db->get($this->table);
        $pesquisado = $query->result();
        if($pesquisado)
            return $pesquisado[0];
        else
            return NULL;
    }
    
    /* Deletar todos os pesquisados de uma determinanda equipe.
     * 
     * @access	 public
     * @param	 int
     * @return   void
     */
    function deletar_equipe($id_real_equipe) {
        $this->db->where("{$this->table}.id_real_equipe", $id_real_equipe);
        $this->db->delete($this->table);
    }
    
    /* Deleta um pesquisado de todas as equipes que ele participa.
     * 
     * @access	 public
     * @param	 int
     * @return   void
     */
    function deletar_pesquisado($id_pesquisado) {
        $this->db->where("{$this->table}.id_pesquisado", $id_pesquisado);
        $this->db->delete($this->table);
    }
    
    /* Insere uma pesquisado em uma determinada equipe.
     * 
     * @access	 public
     * @param	 array
     * @return   void
     */
    function inserir($data) {
        $this->db->insert($this->table, $data); 
    }
    
    /* Atualiza uma pesquisado em uma determinada equipe.
     * 
     * @access	 public
     * @param	 array
     * @return   void
     */
    function update($data) {
        $this->db->where('id_real_equipe', $data['id_real_equipe']);
        $this->db->where('id_pesquisado', $data['id_pesquisado']);
        $this->db->update($this->table, $data); 
    }
}