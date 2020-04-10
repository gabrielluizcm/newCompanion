<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PartidasModel extends CI_Model {

    private $table = 'Partidas';
    private $primaryKey = 'codPartida';
    private $codPartida;
    private $codJogo;
    private $senha;
    private $mapping = [
        'codPartida' => 'codPartida',
        'codJogo'   => 'codJogo',
        'senha' => 'senha'
    ];

    /**
     * cria o registro de uma nova partida
     */
    public function save() {
        $data = [];
        foreach($this->mapping as $key => $value) 
            $data[$key] = $this->$value;
        $this->db->insert($this->table, $data);
        $this->codPartida = $this->db->insert_id();
    }

    /**
     * busca uma partida por código
     * 
     * @return PartidasModel
     */
    public function codigo($cod) {
        $query = $this->db->where("{$this->primaryKey} = {$cod}")->get($this->table)->result_array()[0];
        return $this->setAtributos($query);
    }

    /**
     * preenche um objeto com seus atributos
     * 
     * @param array $dados
     * @return PartidasModel
     */
    private function setAtributos($dados) {
        $partida = new PartidasModel;
        foreach ($this->mapping as $key => $value)
            $partida->$key = $dados[$value];
        return $partida;
    }

    /**
     * limpa o where
     * 
     * @return PartidasModel
     */
    public function clear() {
        $this->db->reset_query();
        return $this;
    }


    /**
     * Get the value of codPartida
     */ 
    public function getCodPartida()
    {
        return $this->codPartida;
    }

    /**
     * Set the value of codPartida
     *
     * @return  self
     */ 
    public function setCodPartida($codPartida)
    {
        $this->codPartida = $codPartida;

        return $this;
    }

    /**
     * Get the value of codJogo
     */ 
    public function getCodJogo()
    {
        return $this->codJogo;
    }

    /**
     * Set the value of codJogo
     *
     * @return  self
     */ 
    public function setCodJogo($codJogo)
    {
        $this->codJogo = $codJogo;

        return $this;
    }

    /**
     * Get the value of senha
     */ 
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     *
     * @return  self
     */ 
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }
}
?>