<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->view('modules/imports.php');
		$this->load->helper('form');
		$this->load->database();
		$this->load->model(['JogosModel', 'PartidasModel']);
	}

	public function index()	{
		// Carrega a lista de jogos disponíveis
		$data['listaJogos'] = $this->JogosModel->listaJogos();

		// Seta na view e renderiza
		$this->load->view('landing', $data);
	}

	public function criar() {
		// Se o código do jogo for válido
		if ($this->JogosModel->clear()->codigo($this->input->post('codJogo'))) {
			$partida = new PartidasModel;
			$partida->setCodJogo($this->input->post('codJogo'));
			$partida->setSenha($this->input->post('senha'));
			$partida->save();
			redirect('jogadores/index/'.$partida->getCodPartida());
		} else
			redirect(site_url());
	}
}
?>