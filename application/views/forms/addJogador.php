<title>%nome%</title>
    <link rel="stylesheet" href="<?=site_url('assets/jogador/jogador.css')?>">
    <script src="<?=site_url('assets/jogador/jogador.js')?>"></script>
    <script>
        base_url = "<?= site_url() ?>"
        codPartida = "<?=$partida->getCodPartida()?>"
        nomeJogo = "<?=$jogo->getNome()?>"
    </script>
</head>
<body>
	<div class="container-fluid">
		<div class="col-12">
			<h3 class="display-3 text-center">
				<?= $jogo->getNome() ?>
			</h3>
		</div>
		<div class="col-12">
			<h4 class="display-4 text-center" id="boasVindas">
			Partida <?= $partida->getCodPartida() ?> / Senha <?= $partida->getSenha() ?>
			</h4>
		</div>
		<div class="row justify-content-around">
			<div class="col-10 col-md-4 opcao text-center">
				<h5 class="display-5">
                    <?php if ($jogadores && $jogo->getNome() == 'Truco'):
                            if (count($jogadores) == 2):  // Máximo de player no truco ?>
                                <b>Máximo de equipes adicionados!</b>
                            <?php else: ?>
                                <b>Adicionar equipe</b>
                            <?php endif; ?>
                    <?php else: ?>
                        <b>Adicionar mais um jogador?</b>
                    <?php endif;?>
				</h5>
                <?= form_open('jogadores/criar')?>
                    <input type="hidden" value="<?=$partida->getCodPartida()?>" id="codPartida" name="codPartida">
                    <input type="hidden" value="<?=$jogo->getCod()?>" id="codJogo" name="codJogo">
                    <div class="form-row justify-content-around">
						<div class="col-lg-8">
                            <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome do Jogador" maxlength="30"
                                <?= $jogadores && $jogo->getNome() == 'Truco' && count($jogadores) == 6 ? 'disabled' : ''?>>
						</div>
						<div class="col-lg-4">
							<select class="form-control" name="cor" id="cor" style="color:red;" required <?= $jogadores && $jogo->getNome() == 'Truco' && count($jogadores) == 2 ? 'disabled' : ''?>>
                                <option value="red">Vermelho</option>
                                <option value="orange">Laranja</option>
                                <option value="green">Verde</option>
                                <option value="blue">Azul</option>
                                <option value="purple">Roxo</option>
                                <option value="deeppink">Rosa</option>
                                <option value="turquoise">Turquesa</option>
                                <option value="black">Preto</option>
                            </select>
						</div>
                    </div>
				    <button type="submit" class="form-control btn btn-primary" <?= $jogadores && $jogo->getNome() == 'Truco' && count($jogadores) == 2 ? 'disabled' : ''?>> Inserir</button>
				<?= form_close(); ?>
			</div>
			<div class="col-10 col-md-4 opcao text-center">
				<h5 class="display-5">
                    <?php if ($jogo->getNome() == 'Truco'): ?>
                        <b>Equipes inscritas:</b>
                    <?php else: ?>
                        <b>Jogadores já inscritos:</b>
                    <?php endif;?>
                </h5>
                <div class="row justify-content-around">
                    <?php if (isset($jogadores) && $jogadores) :?>
                        <?php foreach ($jogadores as $jogador): ?>
                            <div name="jogadorIncluso" class="col-12 col-sm-3">
                                <span style="color: <?=$jogador->getCor()?>">
                                    <input type="hidden" value="<?= $jogador->getCodJogador() ?>">
                                    <?=$jogador->getNome();?>
                                    <i class="fas fa-xs fa-user-slash hidden" title="Remover Jogador"></i>
                                </span> 
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <h5 class="display-5">
                                Nenhum jogador ainda :(
                            </h5>
                        </div>
                    <?php endif; ?>
                </div>
			</div>
        </div>
        <div class="row justify-content-around">
            <div class="col-6 text-center">
                <button class="btn btn-lg btn-primary" id="botaoIniciar"
                    <?= !(isset($jogadores) && count($jogadores) >= 2) ? 'disabled' : ''?>>
                    Iniciar Partida!
                </button>
            </div>
        </div>
    </div>
</body>