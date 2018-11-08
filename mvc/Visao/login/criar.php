<div id="telaLogin">
  <div class="container">
    <div class="card card-login mx-auto mt-5 fundo">
      <div class="card-header"><div class="text-center"><img src="<?= URL_IMG . 'logo.png' ?>"></div></div>
      <div class="card-body">
        <form action="<?= URL_RAIZ . 'login' ?>" method="post" class="margin-bottom">
          <div class="form-group">
            <label for="nome">Nome:</label>
            <input class="form-control  <?= $this->getErroCss('login') ?>" id="nome" type="text" name="nome" aria-describedby="emailHelp" placeholder="Digite o Nome">
          </div>
          <div class="form-group">
            <label for="senha">Senha:</label>
            <input class="form-control <?= $this->getErroCss('login') ?>" id="senha" name="senha" type="password" placeholder="Digite a senha" >
            <?php $this->incluirVisao('util/formErro.php', ['campo' => 'login']) ?>
          </div>
          <div class="form-group">
            <div class="form-check">
              <a class="link_padrao"  href="<?= URL_RAIZ . 'usuarios/criar' ?>">Não tem um usuário? Cadastrar-se aqui!</a>
            </div>
          </div>
          <button class="btn btn-primary btn-block" type="submit" value="entrar" name="entrar">Login</button>
        </form>
      </div>
    </div>
  </div>
</div>
