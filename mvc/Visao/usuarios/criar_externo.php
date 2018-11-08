<?php $this->incluirVisao('util/menu.php');?>

<div class="container">
  <div class="card card-register mx-auto mt-5">
    <div class="card-header"> 
      <div class="text-right">
        <a class="btn btn-danger" href="<?= URL_RAIZ . 'login' ?>"">Cancelar</a>
      </div>
      <h2>Cadastrar Usuário!</h2> 
    </div>    
    <div class="card-body">
      <form action="<?= URL_RAIZ . 'usuarios' ?>" method="post" class="margin-bottom">
        <div class="form-group">
          <div class="alert alert-info" role="alert">
            <h5><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Atenção<small> Todos os campos com * são Obrigatórios</small></h5>
          </div>
        </div>           
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-6">
              <label for="nome">* Nome</label>
              <input class="form-control <?= $this->getErroCss('nome') ?>" id="nome" name = "nome" type="text" placeholder="Digite o Nome" value="<?= $this->getPost('nome') ?>">
              <?php $this->incluirVisao('util/formErro.php', ['campo' => 'nome']) ?>
            </div>
            <div class="col-md-6">
              <label for="senha">* Senha</label>
              <input class="form-control <?= $this->getErroCss('senha') ?>" id="senha" name="senha" type="password" placeholder="Digite a senha">
               <?php $this->incluirVisao('util/formErro.php', ['campo' => 'senha']) ?>
            </div>
          </div>
        </div>  
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-5">
              <label for="endereco">Endereço</label>
              <input class="form-control <?= $this->getErroCss('endereco') ?>" id="endereco" name = "endereco" type="text" placeholder="Digite o Endereço" value="<?= $this->getPost('endereco') ?>">
              <?php $this->incluirVisao('util/formErro.php', ['campo' => 'endereco']) ?>
            </div>
            <div class="col-md-5">
              <label for="bairro">Bairro</label>
              <input class="form-control <?= $this->getErroCss('bairro') ?>" id="bairro" name="bairro" type="text" placeholder="Digite a Bairro" value = "<?= $this->getPost('bairro') ?>">
               <?php $this->incluirVisao('util/formErro.php', ['campo' => 'bairro']) ?>
            </div>
            <div class="col-md-2">
              <label for="numero">Numero</label>
              <input class="form-control <?= $this->getErroCss('numero') ?>" id="numero" name="numero" type="text" placeholder="Digite a numero" value = "<?= $this->getPost('numero') ?>">
               <?php $this->incluirVisao('util/formErro.php', ['campo' => 'numero']) ?>
            </div>
          </div>
        </div>  
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-3">
              <label for="rg">Rg</label>
              <input class="form-control <?= $this->getErroCss('rg') ?>" id="rg" name = "rg" type="text" placeholder="Digite o Rg" value="<?= $this->getPost('rg') ?>">
              <?php $this->incluirVisao('util/formErro.php', ['campo' => 'rg']) ?>
            </div>
            <div class="col-md-3">
              <label for="cpf">CPF</label>
              <input class="form-control <?= $this->getErroCss('cpf') ?>" id="cpf" name="cpf" type="text" placeholder="Digite a cpf" value = "<?= $this->getPost('cpf') ?>">
               <?php $this->incluirVisao('util/formErro.php', ['campo' => 'cpf']) ?>
            </div>
            <div class="col-md-3">
              <label for="data_nasc">Data Nascimento</label>
              <input class="form-control <?= $this->getErroCss('data_nasc') ?>" id="data_nasc" name="data_nasc" type="date" placeholder="Digite a Data Nascimento" value = "<?= $this->getPost('data_nasc') ?>">
               <?php $this->incluirVisao('util/formErro.php', ['campo' => 'data_nasc']) ?>
            </div>
            <div class="col-md-3">
              <label for="admin">Tipo de usuario</label>              
              <select id="admin" name="admin" class="form-control">
                <option value="0" <?php echo $this->getPost('admin') == "0" ? 'selected' : '' ?> >Usuario</option>
                <option value="1" <?php echo $this->getPost('admin') == "1" ? 'selected' : '' ?> >Administrador</option>
              </select>
              <?php $this->incluirVisao('util/formErro.php', ['campo' => 'admin']) ?>
            </div>
          </div>
        </div>                                              
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-2">
             <button class="btn btn-success btn-block" type="submit" value="cadastrar" name="cadastrar"> Cadastrar </button> 
           </div>
           <div class="col-md-2">
            <button class="btn btn-warning btn-block" type="reset" >Limpar Dados</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
</div>


