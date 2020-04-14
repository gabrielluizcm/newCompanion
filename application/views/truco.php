<title>%nome%</title>
<link rel="stylesheet" href="<?= site_url('assets/truco/truco.css') ?>">
<script src="<?= site_url('assets/truco/truco.js') ?>"></script>
<script>
	let base_url = "<?= site_url() ?>";
	let criador = "<?= $criador ?>"
	let codPartida = "<?= $partida->getCodPartida() ?>"
</script>
</head>

<body>
	<div class="container-fluid">
		<div class="titulo">
			<div class="col-12">
				<h3 class="display-3 text-center">
					<span><?= $jogo->getNome() ?></span>
				</h3>
			</div>
			<div class="col-12">
				<h4 class="display-4 text-center" id="boasVindas">
					<span>Partida <?= $partida->getCodPartida() ?></span>
					<?php if($criador):?>
						<br><span>Senha <?= $partida->getSenha() ?></span>
					<?php endif;?>
				</h4>
			</div>
		</div>
		<div class="row">
			<?php foreach ($jogadores as $equipe) : ?>
				<div class="col-12 col-md-6 equipe" style="background-color: <?= $equipe->getCor() ?>">
					<div class="col-12 text-center nomeEquipe">
						<?= $equipe->getNome(); ?>
					</div>
					<div class="col-12 text-center pontuacao" name="pontuacao">
						<?= $equipe->getPontuacao(); ?>
					</div>
					<?php if ($criador) : ?>
						<div class="row">
							<div class="col"></div>
							<div class="col-12 col-sm-8">
								<div class="row">
									<div class="col-0"></div>
									<div class="col-3 col-sm-3 col-md-3 col-xl-2">
										<button type="button" class="form-control btn btn-warning" name="subtrai">-</button>
									</div>
									<div class="col-6">
										<input type="hidden" value="<?= $equipe->getCodJogador() ?>">
										<input type="number" class="form-control" placeholder="Pontuacao">
									</div>
									<div class="col-3 col-sm-3 col-md-3 col-xl-2">
										<button type="button" class="form-control btn btn-success" name="add">+</button>
									</div>
									<div class="col-0"></div>
								</div>
							</div>
							<div class="col"></div>
						</div>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<!-- Modal ajuda -->
	<button type="button" class="btn btn-lg" data-toggle="modal" data-target="#ajudaModal" id="botaoModalAjuda">
		<i class="fas fa-question-circle"></i>
	</button>

	<div class="modal fade" id="ajudaModal" tabindex="-1" role="dialog" aria-labelledby="ajudaModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="ajudaModalLabel">Ajuda</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<h4>
						Força das cartas:
					</h4>
					<ol>
						<li>
							<h5>
								Manilhas:
							</h5>
							<ol>
								<li>
									Ás (1) de Espadas (Espadão)
								</li>
								<li>
									Ás (1) de Paus (Pauzão)
								</li>
								<li>
									7 de Espadas
								</li>
								<li>
									7 de Ouros
								</li>
							</ol>
						</li>
						<li>
							Todos os 3's
						</li>
						<li>
							Todos os 2's
						</li>
						<li>
							Áses (1's) de Copas e Paus
						</li>
						<li>
							Todos os 12's
						</li>
						<li>
							Todos os 11's
						</li>
						<li>
							Todos os 10's
						</li>
						<li>
							7's de Copas e Ouros
						</li>
						<li>
							Todos os 6's
						</li>
						<li>
							Todos os 5's
						</li>
						<li>
							Todos os 4's
						</li>
					</ol>
					<hr>
					<h4>
						Envido:
					</h4>
					<p>
						Em todos os casos, as cartas <b>10</b>, <b>11</b> e <b>12</b> valem <b>zero pontos</b> de envido, mas ainda contam para o bônus de naipe.
						<ul>
							<li>
								Caso não possua cartas de mesmo naipe, seus pontos de envido são o valor numérico mais alto (7 é o maior possível).
							</li>
							<li>
								Caso possua duas cartas do mesmo naipe, some o valor das duas e acrescente 20 (33 é o maior possível).
							</li>
						</ul>
					</p>
					<hr>
					<h4>
						Flor:
					</h4>
					<p>
						A flor só pode ser chamada quando possuir 3 cartas de mesmo naipe.
						Em caso de contestação, as cartas <b>10</b>, <b>11</b> e <b>12</b> valem <b>zero pontos</b>, mas ainda contam para a flor.
						Para somar os pontos, some o valor das três cartas e acrescente 30 (48 é o maior possível).
					</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Obrigado!</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Info -->
	<button type="button" class="btn btn-lg" data-toggle="modal" data-target="#infoModal" id="botaoModalInfo">
		<i class="fas fa-exclamation-circle"></i>
	</button>

	<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="infoModalLabel">Informações da partida</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<h4>
						Jogo: <?=$jogo->getNome()?>
					</h4>
					<h4>
						Partida: <?=$partida->getCodPartida()?>
					</h4>
					<?php if ($criador): ?>
						<h4>
							Senha: <?=$partida->getSenha()?>
						</h4>
					<?php endif;?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Obrigado!</button>
				</div>
			</div>
		</div>
	</div>
</body>

</html>