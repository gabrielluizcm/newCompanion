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
			$partida->setHashCriador($this->input->post('idCriador'));
			$partida->save();
			// Retorna o código da partida para o ajax
			echo $partida->getCodPartida();
		} else
			redirect(site_url());
	}

	public function entrar() {
		// Carrega a partida
		if ($partida = $this->PartidasModel->clear()->codigo($this->input->post('codPartida')))
			if ($partida->getHashCriador() == $this->input->post('idCriador') || $partida->getSenha() == $this->input->post('senha'))
				echo 1;
			else
				echo 0;
		else
			echo -1;
	}
}
?>