<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JogosModel extends CI_Model {

    private $table = 'Jogos';
    private $primaryKey = 'cod';
    private $cod;
    private $nome;
    private $pontuacaoInicial;
    private $nomeView;
    private $mapping = [
        'cod' => 'cod',
        'nome' => 'nome',
        'pontuacaoInicial' => 'pontuacaoInicial',
        'nomeView' => 'nomeView'
    ];

    /**
     * retorna um array com a lista de jogos cadastrados
     * 
     * @return array or false
     */
    public function listaJogos() {
        $result = $this->db->get($this->table)->result_array();
        if (count($result) > 0) {
            $arrJogos = [];
            foreach ($result as $item) 
                $arrJogos[] = $this->setAtributos($item);
            return $arrJogos;
        }
        else
            return false;
    }

    /**
     * busca um jogo pelo código
     * 
     * @param int $cod
     * @return JogosModel
     */
    public function codigo($cod) {
        $query = $this->db->where("{$this->primaryKey} = {$cod}")->get($this->table)->result_array()[0];
        return $this->setAtributos($query);
    }

    /**
     * preenche um objeto com seus atributos
     * 
     * @param array $dados
     * @return JogosModel
     */
    private function setAtributos($dados) {
        $jogo = new JogosModel;
        foreach ($this->mapping as $key => $value)
            $jogo->$key = $dados[$value];
        return $jogo;
    }

    /**
     * limpa o where
     * 
     * @return JogosModel
     */
    public function clear() {
        $this->db->reset_query();
        return $this;
    }


    /**
     * Get the value of cod
     */ 
    public function getCod()
    {
        return $this->cod;
    }

    /**
     * Set the value of cod
     *
     * @return  self
     */ 
    public function setCod($cod)
    {
        $this->cod = $cod;

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
     * Get the value of pontuacaoInicial
     */ 
    public function getPontuacaoInicial()
    {
        return $this->pontuacaoInicial;
    }

    /**
     * Set the value of pontuacaoInicial
     *
     * @return  self
     */ 
    public function setPontuacaoInicial($pontuacaoInicial)
    {
        $this->pontuacaoInicial = $pontuacaoInicial;

        return $this;
    }

    /**
     * Get the value of nomeView
     */ 
    public function getNomeView()
    {
        return $this->nomeView;
    }

    /**
     * Set the value of nomeView
     *
     * @return  self
     */ 
    public function setNomeView($nomeView)
    {
        $this->nomeView = $nomeView;

        return $this;
    }
}
?>