	<title>%nome%</title>
	<link rel="stylesheet" href=<?=site_url('assets/landing/landing.css')?>>
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
				<?= form_open('landing/entrar')?>
					<div class="form-group">
						<input type="number" id="codPartida" class="form-control" placeholder="Código da partida">
						<button type="submit" class="form-control btn btn-primary">Entrar na partida</button>
					</div>
				<?= form_close(); ?>
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
							<input type="text" name="senha" id="senha" class="form-control" placeholder="Senha Mestra" maxlength="10" required>
						</div>
					</div>
					<button type="submit" class="form-control btn btn-primary">Criar partida</button>
				<?= form_close();?>
			</div>
		</div>
	</div>
</body>