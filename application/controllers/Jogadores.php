<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jogadores extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->view('modules/imports.php');
		$this->load->helper('form');
		$this->load->database();
		$this->load->model(['JogosModel', 'PartidasModel', 'JogadoresModel']);
	}

	public function index($codPartida)	{
        // Carrega a partida
        $partida = $this->PartidasModel->clear()->codigo($codPartida);

        // Carrega o jogo
        $jogo = $this->JogosModel->clear()->codigo($partida->getCodJogo());

        // Carrega os jogadores já cadastrados
        $jogadores = $this->JogadoresModel->clear()->partida($codPartida);

        // Seta o array de dados da view
        $dados = [
            'partida' => $partida,
            'jogo' => $jogo,
            'jogadores' => $jogadores
        ];

        // Renderiza a view
        $this->load->view('forms/addJogador', $dados);
    }
    
    public function criar() {
        // Monta um objeto com os dados do post
        $jogador = new JogadoresModel;
        $jogador->setCodPartida($this->input->post('codPartida'));
        $jogador->setNome($this->input->post('nome'));
        $jogador->setCor($this->input->post('cor'));

        // Verifica a pontuação inicial de acordo com o jogo
        $jogo = $this->JogosModel->clear()->codigo($this->input->post('codJogo'));
        $jogador->setPontuacao($jogo->getPontuacaoInicial());

        // Salva no banco
        $jogador->save();

        // Recarrega a página
        redirect('jogadores/index/'.$this->input->post('codPartida'));
    }

    public function adicionarPontuacao() {
        // Carrega o jogador
        $jogador = $this->JogadoresModel->clear()->key($this->input->post('codJogador'));

        // Soma o depósito à pontuação antiga
        $nova = $jogador->getPontuacao() + floatval($this->input->post('valor'));

        // Atualiza o objeto e salva
        $jogador->setPontuacao($nova);
        $jogador->update();

        // Retorna o novo valor por JSON
        echo json_encode($jogador->getPontuacao());
    }

    public function diminuirPontuacao() {
        // Carrega o jogador
        $jogador = $this->JogadoresModel->clear()->key($this->input->post('codJogador'));

        // Subtrai o saque da pontuação antiga
        $nova = $jogador->getPontuacao() - floatval($this->input->post('valor'));

        // Atualiza o objeto e salva
        $jogador->setPontuacao($nova);
        $jogador->update();

        // Retorna o novo valor por JSON
        echo json_encode($jogador->getPontuacao());
    }

    public function transferirPontuacao() {
        // Carrega os jogadores
        $playerOrigem = $this->JogadoresModel->clear()->key($this->input->post('codJogador'));
        $playerDestino = $this->JogadoresModel->clear()->key($this->input->post('jogadorTransf'));

        // Calcula as novas pontuações
        $novaOrigem = $playerOrigem->getPontuacao() - floatval($this->input->post('valor'));
        $novaDestino = $playerDestino->getPontuacao() + floatval($this->input->post('valor'));

        // Atualiza os registros
        $playerOrigem->setPontuacao($novaOrigem);
        $playerDestino->setPontuacao($novaDestino);
        $playerOrigem->update();
        $playerDestino->update();

        // Retorna os novos valores por JSON
        echo json_encode($playerOrigem->getPontuacao().' '.$playerDestino->getPontuacao());

    }

}
?>