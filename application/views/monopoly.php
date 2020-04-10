<title>%nome%</title>
    <link rel="stylesheet" href="<?=site_url('assets/monopoly/monopoly.css')?>">
	<script src="<?=site_url('assets/monopoly/monopoly.js')?>"></script>
	<script>
		let base_url = "<?=site_url()?>";
		let criador = "<?=$criador?>"
		let codPartida = "<?=$partida->getCodPartida()?>"
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
			<div class="col-8 divTabela text-center">
				<h4 class="display-5">
					<b>Controle da partida</b>
				</h4>
                <table class="table table-hover table-bordered table-responsive-sm">
					<th scope="col">#</th>
					<th scope="col">Jogador</th>
					<th scope="col">Pontuação</th>
					<?php if ($criador): ?>
						<th scope="col">Ações</th>
					<?php endif;?>
					<?php foreach($jogadores as $jogador): ?>
						<tr style="color: <?=$jogador->getCor()?>">
							<th scope="row"><?=$jogador->getCodJogador()?></th>
							<td><?=$jogador->getNome()?></td>
							<td id="valorJogador<?=$jogador->getCodJogador()?>">R$ <span class="money"><?=number_format($jogador->getPontuacao(),2)?></span></td>
							<?php if ($criador): ?>
								<td>
									<div class="row justify-content-center">
										<div class="col-sm-12 col-md-4 col-lg-3 col-xl-2">
											<a type="button" data-toggle="modal" data-target='#modalAdd<?=$jogador->getCodJogador()?>'>
												<i class="fas fa-plus"></i>
											</a>
										</div>
										<div class="col-sm-12 col-md-4 col-lg-3 col-xl-2">
											<a type="button" data-toggle="modal" data-target='#modalSub<?=$jogador->getCodJogador()?>'>
												<i class="fas fa-minus"></i>
											</a>
										</div>
										<div class="col-sm-12 col-md-4 col-lg-3 col-xl-2">
											<a type="button" data-toggle="modal" data-target='#modalTransfer<?=$jogador->getCodJogador()?>'>
												<i class="fas fa-random"></i>
											</a>
										</div>
									</div>
								</td>
							<?php endif;?>
						</tr>
						<!-- MODAIS -->
						<?php if ($criador): ?>
							<!-- ADD -->
							<div class="modal fade col-12" id="modalAdd<?=$jogador->getCodJogador()?>" tabindex="-1" role="dialog" aria-labelledby="tituloModalAdd" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="tituloModalAdd">Depositar valor para: <?=$jogador->getNome()?></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
												<div class="form-group">
													<label for="valorAdd<?=$jogador->getCodJogador()?>">Quanto deseja depositar?</label>
													<div class="input-group mb-3">
														<div class="input-group-prepend">
															<span class="input-group-text">R$</span>
														</div>
														<input type="hidden" value="<?=$jogador->getCodJogador()?>">
														<input type="text" class="form-control formModal money" min='0'
															name="valorAdd<?=$jogador->getCodJogador()?>" id="valorAdd<?=$jogador->getCodJogador()?>">
													</div>
												</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
											<button type="submit" class="btn btn-primary" data-dismiss="modal" name="deposito">Depositar</button>
										</div>
									</div>
								</div>
							</div>
							<!-- SUB -->
							<div class="modal fade col-12" id="modalSub<?=$jogador->getCodJogador()?>" tabindex="-1" role="dialog" aria-labelledby="tituloModalSub" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="tituloModalSub">Cobrar valor de: <?=$jogador->getNome()?></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
												<div class="form-group">
													<label for="valorSub<?=$jogador->getCodJogador()?>">Quanto deseja retirar?</label>
													<div class="input-group mb-3">
														<div class="input-group-prepend">
															<span class="input-group-text">R$</span>
														</div>
														<input type="hidden" value="<?=$jogador->getCodJogador()?>">
														<input type="text" class="form-control formModal money" min='0'
															name="valorSub<?=$jogador->getCodJogador()?>" id="valorSub<?=$jogador->getCodJogador()?>">
													</div>
												</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
											<button type="submit" class="btn btn-danger" data-dismiss="modal" name="saque">Retirar</button>
										</div>
									</div>
								</div>
							</div>
							<!-- TRANSFER -->
							<div class="modal fade col-12" id="modalTransfer<?=$jogador->getCodJogador()?>" tabindex="-1" role="dialog" aria-labelledby="tituloModalTransfer" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="tituloModalTransfer">Transferência de valores</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
												<div class="row">
													<div class="col-6">
														<div class="form-group">
															<label for="valorTransfer<?=$jogador->getCodJogador()?>">Quanto deseja transferir?</label>
															<div class="input-group mb-3">
																<div class="input-group-prepend">
																	<span class="input-group-text">R$</span>
																</div>
																<input type="hidden" value="<?=$jogador->getCodJogador()?>">
																<input type="text" class="form-control formModal money" min='0'
																	name="valorTransfer<?=$jogador->getCodJogador()?>" id="valorAdd<?=$jogador->getCodJogador()?>">
															</div>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label for="playerTransfer<?=$jogador->getCodJogador()?>">Para qual jogador?</label>
															<select name="destinatario<?=$jogador->getCodJogador()?>" id="<?=$jogador->getCodJogador()?>" class="form-control formModal destinatario">
																<?php foreach ($jogadores as $item): ?>
																	<?php if ($item->getCodJogador() != $jogador->getCodJogador()):?>
																		<option value="<?=$item->getCodJogador()?>"><?=$item->getNome()?></option>
																	<?php endif;?>
																<?php endforeach;?>
															</select>
														</div>
													</div>
												</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
											<button type="submit" class="btn btn-primary" data-dismiss="modal" name="transfere">Transferir</button>
										</div>
									</div>
								</div>
							</div>
						<?php endif;?>
						<!-- FIM DOS MODAIS -->
					<?php endforeach; ?>
                </table>
			</div>
		</div>
    </div>
</body>