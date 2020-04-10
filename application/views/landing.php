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
				<?= form_open(site_url('landing/entrar'))?>
					<div class="form-group">
						<input type="number" id="codPartida" class="form-control" placeholder="Código da partida">
						<button type="submit" class="form-control btn btn-sm btn-primary">Entrar na partida</button>
					</div>
				<?php form_close(); ?>
			</div>
			<div class="col-10 col-md-4 opcao text-center">
				<h5 class="display-5">
					<b>Ou criar uma nova?</b>
				</h5>
				<?=  form_open(site_url('landing/criar'))?>
					<div class="form-group">
						<select name="codJogo"
								id="codJogo"
								class="form-control selectpicker">
						<?php foreach ($listaJogos as $jogo): ?>
							<option value="" selected>Selecione um jogo</option>
							<option value="<?= $jogo->getCod(); ?>"><?= $jogo->getNome(); ?></option>
						<?php endforeach;?>
						</select>
						<button type="submit" class="form-control btn btn-sm btn-primary">Entrar na partida</button>
					</div>
				<?php form_close();?>
			</div>
		</div>
	</div>
</body>