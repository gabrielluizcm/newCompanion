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

	public function index($codPartida)	{
        // Carrega os dados
        $partida = $this->PartidasModel->clear()->codigo($codPartida);
        $jogo = $this->JogosModel->clear()->codigo($partida->getCodJogo());
        $jogadores = $this->JogadoresModel->clear()->partida($codPartida);

        // Seta o array de dados da view
        $dados = [
            'partida' => $partida,
            'jogo' => $jogo,
            'jogadores' => $jogadores
        ];

        // Carrega a view referente ao jogo
        $this->load->view($jogo->getNomeView(), $dados);
	}
}
?>