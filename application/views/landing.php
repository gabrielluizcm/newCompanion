	<title>%nome%</title>
	<link rel="stylesheet" href=<?=site_url('assets/landing/landing.css')?>>
	<script src="<?=site_url('assets/landing/landing.js')?>"></script>
	<script>let base_url = "<?=site_url()?>";</script>
</head>
<body>
	<div class="container-fluid">
		<div class="col-12">
			<h3 class="display-3 text-center">
				%NOME ZADA%
			</h3>
		</div>
		<div class="col-12">
			<h4 class="display-4 text-center" id="boasVindas">
			Seja muito bem vindo ao %nome%!
			</h4>
		</div>
		<div class="row justify-content-around" id="opcoes">
			<div class="col-10 col-md-4 opcao text-center">
				<h5 class="display-5">
					<b>Você quer se juntar à uma partida?</b>
				</h5>
					<div class="form-row justify-content-around">
						<div class="col-6">
							<input type="text" id="codPartida" name="codPartida" class="form-control codigo" placeholder="Código da partida" data-mask="00000">
						</div>
						<div class="col-6">
							<input type="text" name="senha" id="senha" class="form-control" placeholder="Senha" maxlength="10" required 
								data-toggle="tooltip" data-placement="top" title="Não precisa senha se tu for o criador da partida!">
						</div>
						<button type="submit" class="form-control btn btn-primary" id="entrada">Entrar na partida</button>
					</div>
			</div>
			<div class="col-10 col-md-4 opcao text-center">
				<h5 class="display-5">
					<b>Ou criar uma nova?</b>
				</h5>
				<?= form_open('landing/criar')?>
					<div class="form-row justify-content-around">
						<div class="col-6">
							<select name="codJogo"
									id="codJogo"
									class="form-control custom-select"
									required>
									<option value="">Selecione um jogo</option>
								<?php foreach ($listaJogos as $jogo): ?>
									<option value="<?= $jogo->getCod(); ?>"><?= $jogo->getNome(); ?></option>
								<?php endforeach;?>
							</select>
						</div>
						<div class="col-6">
							<input type="text" name="senha" id="senha" class="form-control" placeholder="Senha" maxlength="10" required>
						</div>
					</div>
					<button type="submit" class="form-control btn btn-primary">Criar partida</button>
				<?= form_close();?>
			</div>
		</div>
	</div>
</body>