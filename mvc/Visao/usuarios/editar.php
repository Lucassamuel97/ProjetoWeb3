<?php $this->incluirVisao('util/menu.php'); ?>
<div class="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Usuário</a>
      </li>
      <li class="breadcrumb-item active">Cadastro</li>
    </ol>
    
    <div class="row">
      <div class="col-12">
        <h2>Usuário</h2>

        <?php if ($sucesso) : ?>
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= $sucesso ?>
          </div>
        <?php endif ?>
        
        <form action="<?= URL_RAIZ . 'usuarios/' . $registro->getId() ?>" method="POST" id="validate">           
          <input type="hidden" name="_metodo" value="PATCH">
          <div class="form-group">
            <div class="alert alert-info" role="alert">
              <h5><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Atenção<small> Todos os campos com * são Obrigatórios</small></h5>
            </div>
          </div>           
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="nome">* Nome</label>
                <input class="form-control <?= $this->getErroCss('nome') ?>" id="nome" name = "nome" type="text" placeholder="Digite o Nome" value="<?php 
                  if(!empty($registro->getNome())){
                    echo $registro->getNome();
                  }else{
                    echo $this->getPost('nome');
                  }?>">
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
                <input class="form-control <?= $this->getErroCss('endereco') ?>" id="endereco" name = "endereco" type="text" placeholder="Digite o Endereço" value="<?php 
                  if(!empty($registro->getEndereco())){
                    echo $registro->getEndereco();
                  }else{
                    echo $this->getPost('endereco');
                  }?>">
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'endereco']) ?>
              </div>
              <div class="col-md-5">
                <label for="bairro">Bairro</label>
                <input class="form-control <?= $this->getErroCss('bairro') ?>" id="bairro" name="bairro" type="text" placeholder="Digite a Bairro" value = "<?php 
                  if(!empty($registro->getBairro())){
                    echo $registro->getBairro();
                  }else{
                    echo $this->getPost('bairro');
                  }?>">
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'bairro']) ?>
              </div>
              <div class="col-md-2">
                <label for="numero">Numero</label>
                <input class="form-control <?= $this->getErroCss('numero') ?>" id="numero" name="numero" type="text" placeholder="Digite a numero" value = "<?php 
                  if(!empty($registro->getNumero())){
                    echo $registro->getNumero();
                  }else{
                    echo $this->getPost('numero');
                  }?>">
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'numero']) ?>
              </div>
            </div>
          </div>  
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-3">
                <label for="rg">Rg</label>
                <input class="form-control <?= $this->getErroCss('rg') ?>" id="rg" name = "rg" type="text" placeholder="Digite o Rg" value="<?php 
                  if(!empty($registro->getRg())){
                    echo $registro->getRg();
                  }else{
                    echo $this->getPost('rg');
                  }?>">
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'rg']) ?>
              </div>
              <div class="col-md-3">
                <label for="cpf">CPF</label>
                <input class="form-control <?= $this->getErroCss('cpf') ?>" id="cpf" name="cpf" type="text" placeholder="Digite a cpf" value = "<?php 
                  if(!empty($registro->getCpf())){
                    echo $registro->getCpf();
                  }else{
                    echo $this->getPost('cpf');
                  }?>">
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'cpf']) ?>
              </div>
              <div class="col-md-3">
                <label for="data_nasc">Data Nascimento</label>
                <input class="form-control <?= $this->getErroCss('data_nasc') ?>" id="data_nasc" name="data_nasc" type="date" placeholder="Digite a Data Nascimento" value = "<?php 
                  if(!empty($registro->getDatanascimento())){
                    echo $registro->getDatanascimento();
                  }else{
                    echo $this->getPost('data_nasc');
                  }?>">
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'data_nasc']) ?>
              </div>
              <?php if ($usuario->isAdmin()): ?>
              <div class="col-md-3">
                <label for="admin">Tipo de usuario</label>              
                <select id="admin" name="admin" class="form-control">
                  <option value="0" <?php echo $registro->isAdmin() == "0" ? 'selected' : '' ?> >Usuario</option>
                  <option value="1" <?php echo $registro->isAdmin() == "1" ? 'selected' : '' ?> >Administrador</option>
                </select>
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'admin']) ?>
              </div>
              <?php endif ?>
            </div>
          </div>                                              
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-2">
               <button class="btn btn-success btn-block" type="submit" value="cadastrar" name="cadastrar"> Gravar </button> 
             </div>
             <div class="col-md-2">
              <a href="<?= URL_RAIZ . 'usuarios' ?>" class="btn btn-danger btn-block text-light"><i class="fa fa-reply" aria-hidden="true"></i> Voltar</a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>


