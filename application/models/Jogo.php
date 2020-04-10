<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jogo extends CI_Model {

    private $table = 'Jogos';
    private $primaryKey = 'cod';
    private $cod;
    private $nome;
    private $mapping = [
        'cod' => 'cod',
        'nome' => 'nome'
    ];

    /**
     * retorna um array com a lista de jogos cadastrados
     */
    public function listaJogos() {
        $result = $this->db->get($this->table)->result_array();
        if (count($result) > 0) {
            $arrJogos = [];
            foreach ($result as $item) {
                $jogo = new Jogo;
                $this->setAtributos($jogo, $item);
                $arrJogos[] = $jogo;
            }
            return $arrJogos;
        }
        else
            return false;
    }

    private function setAtributos($objeto, $dado) {
        foreach ($this->mapping as $key => $value)
            $objeto->$key = $dado[$value];
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
}
?>