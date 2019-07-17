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
				<div class="col tweetBox">
					<form action="/tweet" method="post">
						<textarea name="tweet" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="O que você está pensando?"></textarea>
						
						<?php if ($this->view->validaTweet == 'error') { ?>
							<div class="row">
								<div class="col">
									<small class="text text-danger">*Seu tweet precisa ter ao menos 3 caracteres...</small>
								</div>
							</div>
						<?php } ?>

						<div class="col mt-2 d-flex justify-content-end">
							<button type="submit" class="btn btn-primary">Tweet</button>
						</div>

					</form>
				</div>
			</div>

			<?php foreach ($this->view->tweets as $index => $tweet) { ?>
				<div class="row tweet">
					<div class="col">
						<p><strong><?= $tweet['nome'] ?></strong> <span class="text text-muted">- <small><?= $tweet['data'] ?></small></span></p>
						<p><?= $tweet['tweet'] ?></p>

						<br />
						<?php if ($tweet['id_usuario'] == $_SESSION['id']) { ?>
							<form>
								<div class="col d-flex justify-content-end">
									<a href="/remover_tweet?id_tweet=<?= $tweet['id_tweet'] ?>" type="submit" class="btn btn-danger btn-sm">Remover</a>
								</div>
							</form>
						<?php } ?>
					</div>
				</div>
			<?php } ?>

		</div>

		<div class="col-md-3">
			<div class="quemSeguir">
				<span class="quemSeguirTitulo">Quem seguir</span><br />
				<hr />
				<a href="/quem_seguir" class="quemSeguirTxt">Procurar por pessoas conhecidas</a>
			</div>
		</div>

	</div>
</div>