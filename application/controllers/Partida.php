<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partida extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->view('modules/imports.php');
		$this->load->helper('form');
		$this->load->database();
		$this->load->model(['JogosModel', 'PartidasModel', 'JogadoresModel']);
	}

	public function controle($codPartida)	{
        // Carrega os dados
        $partida = $this->PartidasModel->clear()->codigo($codPartida);
        $jogo = $this->JogosModel->clear()->codigo($partida->getCodJogo());
        $jogadores = $this->JogadoresModel->clear()->partida($codPartida);

        // Seta o array de dados da view
        $dados = [
            'partida' => $partida,
            'jogo' => $jogo,
            'jogadores' => $jogadores,
            'criador' => true
        ];

        // Carrega a view referente ao jogo
        $this->load->view($jogo->getNomeView(), $dados);
    }

    public function jogador($codPartida) {
        // Carrega os dados
        $partida = $this->PartidasModel->clear()->codigo($codPartida);
        $jogo = $this->JogosModel->clear()->codigo($partida->getCodJogo());
        $jogadores = $this->JogadoresModel->clear()->partida($codPartida);

        // Seta o array de dados da view
        $dados = [
            'partida' => $partida,
            'jogo' => $jogo,
            'jogadores' => $jogadores,
            'criador' => false
        ];

        // Carrega a view referente ao jogo
        $this->load->view($jogo->getNomeView(), $dados);
    }

    /**
     * retorna por JSON o placar dos jogadores
     */
    public function atualizaPlacar() {
        // Busca a informação dos jogadores
        $jogadores = $this->JogadoresModel->clear()->partida($this->input->post('codPartida'));

        // Monta um array com as pontuações
        $array = [];
        foreach($jogadores as $jogador)
            $array[] = $jogador->getPontuacao();

        // Retorna em JSON
        echo json_encode($array);
        return json_encode($array);
    }
    
}
?>