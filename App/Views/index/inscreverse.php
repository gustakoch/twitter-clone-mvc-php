<div class="container">
  <div class="d-flex justify-content-center mt-5">
    <div class="card" style="width: 36rem;">
      <div class="card-body">

        <div class="d-flex justify-content-center">
          <img src="/img/twitter_logo.png" />
        </div>

        <div class="row">
          <div class="col">
            <h2>Crie sua conta</h2>
          </div>
        </div>

        <?php if ($this->view->validacaoError == 'error') { ?>
          <div class="row">
            <div class="col">
              <small class="text text-danger">*Erro ao cadastrar usuário. Verifique se todos os campos foram devidamente preenchidos!</small>
            </div>
          </div>
        <?php } ?>

        <div class="row">
          <div class="col">
            
            <form action="/registrar" method="post">
              <div class="form-group">
                <input type="text" class="form-control" name="nome" placeholder="Nome de usuário...">
              </div>
              
              <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="E-mail...">
              </div>

              <div class="form-group">
                <input type="password" class="form-control" name="senha" placeholder="Senha...">
              </div>

              <div class="mt-4 mb-4">
                <small class="form-text">
                  Ao inscrever-se, você concorda com os Termos de Serviço e com as Políticas de Privacidade, incluindo o Uso de Cookies. Outras pessoas poderão encontrar você pelo e-mail ou número de telefone fornecido · Opções de Privacidade
                </small>
              </div>
              <button type="submit" class="btn btn-primary btn-block">Inscrever-se</button>
            </form>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>
  