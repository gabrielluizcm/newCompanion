<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JogadoresModel extends CI_Model { 

    private $table = 'Jogadores';
    private $primaryKey = 'codJogador';
    private $codJogador;
    private $codPartida;
    private $nome;
    private $cor;
    private $pontuacao;
    private $mapping = [
        'codJogador' => 'codJogador',
        'codPartida' => 'codPartida',
        'pontuacao' => 'pontuacao',
        'nome' => 'nome',
        'cor' => 'cor'
    ];

    /**
     * busca um jogador pelo código
     * 
     * @param int cod
     * @return JogadoresModel or false
     */
    public function key ($cod) {
        $result = $this->db->where("{$this->primaryKey} = {$cod}")->get($this->table)->result_array();
        if ($result) {
            $jogador = $this->setAtributos($result[0]);
            return $jogador;
        }
        else
            return false;
    }
    
    /**
     * retorna um array com os jogadores já cadastrados na partida
     * 
     * @return array or false
     */
    public function partida($codPartida) {
        $result = $this->db->where("codPartida = {$codPartida}")->get($this->table)->result_array();
        $arrJogadores = [];
        if ($result) {
            foreach ($result as $item)
                $arrJogadores[] = $this->setAtributos($item);
            return $arrJogadores;
        }
        else
            return false;
    }

    /**
     * insere um novo jogador no banco
     */
    public function save() {
        $data = [];
        foreach ($this->mapping as $key => $value)
            $data[$key] = $this->$value;
        $this->db->insert($this->table, $data);
        $this->codJogador = $this->db->insert_id();
    }

    /**
     * atualiza um jogador no banco
     */
    public function update() {
        $this->db->where("{$this->primaryKey} = {$this->codJogador}");
        $data = [];
        foreach ($this->mapping as $key => $value)
            $data[$key] = $this->$value;
        $this->db->update($this->table, $data);
    }

    /**
     * remove um registro de jogador
     */
    public function remove() {
        $this->db->where("{$this->primaryKey} = {$this->codJogador}");
        $this->db->delete($this->table);
    }

    /**
     * preenche um objeto com seus atributos
     * 
     * @param array $dados
     * @return JogadoresModel
     */
    private function setAtributos($dados) {
        $jogador = new JogadoresModel;
        foreach ($this->mapping as $key => $value)
            $jogador->$key = $dados[$value];
        return $jogador;
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
     * Get the value of codJogador
     */ 
    public function getCodJogador()
    {
        return $this->codJogador;
    }

    /**
     * Set the value of codJogador
     *
     * @return  self
     */ 
    public function setCodJogador($codJogador)
    {
        $this->codJogador = $codJogador;

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
     * Get the value of pontuacao
     */ 
    public function getPontuacao()
    {
        return $this->pontuacao;
    }

    /**
     * Set the value of pontuacao
     *
     * @return  self
     */ 
    public function setPontuacao($pontuacao)
    {
        $this->pontuacao = $pontuacao;

        return $this;
    }

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of cor
     */ 
    public function getCor()
    {
        return $this->cor;
    }

    /**
     * Set the value of cor
     *
     * @return  self
     */ 
    public function setCor($cor)
    {
        $this->cor = $cor;

        return $this;
    }
}
?>