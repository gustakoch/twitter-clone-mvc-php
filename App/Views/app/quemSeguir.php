<nav class="navbar navbar-expand-lg menu">
	<div class="container">
	  <div class="navbar-nav">
	  	<a class="menuItem" href="/timeline">
	  		Home
	  	</a>

	  	<a class="menuItem" href="/sair">
	  		Sair
	  	</a>
			<img src="/img/twitter_logo.png" class="menuIco" />
	  </div>
	</div>
</nav>

<div class="container mt-5">
	<div class="row pt-2">
		
		<div class="col-md-3">

			<div class="perfil">
				<div class="perfilTopo">

				</div>

				<div class="perfilPainel">
					
					<div class="row mt-2 mb-2">
						<div class="col mb-2">
							<span class="perfilPainelNome">
								<?= $this->view->infoUsuario['nome'] ?>
							</span>
						</div>
					</div>

					<div class="row mb-2">

						<div class="col">
							<span class="perfilPainelItem">Tweets</span><br />
							<span class="perfilPainelItemValor">
								<?= $this->view->totalTweets['total_tweets'] ?>
							</span>
						</div>

						<div class="col">
							<span class="perfilPainelItem">Seguindo</span><br />
							<span class="perfilPainelItemValor">
								<?= $this->view->totalSeguindo['total_seguindo'] ?>
							</span>
						</div>

						<div class="col">
							<span class="perfilPainelItem">Seguidores</span><br />
							<span class="perfilPainelItemValor">
								<?= $this->view->totalSeguidores['total_seguidores'] ?>
							</span>
						</div>

					</div>

				</div>
			</div>

		</div>

		<div class="col-md-6">
			
			<div class="row mb-2">
				<div class="col">
					<div class="card">
						<div class="card-body">
							<form method="get" action="/quem_seguir">
								<div class="input-group mb-3">
									<input type="text" name="search" class="form-control" placeholder="Quem você está procurando?">
									<div class="input-group-append">
										<button class="btn btn-primary" type="submit">Procurar</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<?php foreach ($this->view->usuarios as $index => $usuario) { ?>
				<div class="row mb-2">
					<div class="col">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<?= $usuario['nome'] ?>
									</div>
								
									<div class="col-md-6 d-flex justify-content-end">
										<div>

											<?php if ($usuario['seguindo'] == 0) { ?>
												<a href="/acao?acao=seguir&id=<?= $usuario['id'] ?>" class="btn btn-success">Seguir</a>
												<a href="/acao?acao=deixarDeSeguir&id=<?= $usuario['id'] ?>" class="btn btn-warning disabled">Deixar de seguir</a>
											<?php } ?>
											<?php if ($usuario['seguindo'] == 1) { ?>
												<a href="/acao?acao=seguir&id=<?= $usuario['id'] ?>" class="btn btn-success disabled">Seguir</a>
												<a href="/acao?acao=deixarDeSeguir&id=<?= $usuario['id'] ?>" class="btn btn-warning">Deixar de seguir</a>
											<?php } ?>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>

		</div>
	</div>
</div>