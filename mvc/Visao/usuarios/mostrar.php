<?php $this->incluirVisao('util/menu.php');?>
<div class="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Usuário</a>
      </li>
      <li class="breadcrumb-item active">Mostrar</li>
    </ol>
    
    <div class="row">
      <div class="col-12">
        <h2>Usuário</h2>
  
        <form action="<?= URL_RAIZ . 'usuarios' ?>" method="post" class="margin-bottom">         
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="nome">* Nome</label>
                <input class="form-control" id="nome" name = "nome" type="text" value="<?= $registro->getNome() ?>" disabled>
              </div>
              <div class="col-md-6">
                <label for="senha">* Senha</label>
                <input class="form-control" id="senha" name="senha" type="password" placeholder="Senha indisponível" disabled>
              </div>
            </div>
          </div>  
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-5">
                <label for="endereco">Endereço</label>
                <input class="form-control" id="endereco" name = "endereco" type="text" value="<?= $registro->getEndereco() ?>" disabled>
              </div>
              <div class="col-md-5">
                <label for="bairro">Bairro</label>
                <input class="form-control" id="bairro" name="bairro" type="text" value = "<?= $registro->getBairro() ?>" disabled>
              </div>
              <div class="col-md-2">
                <label for="numero">Numero</label>
                <input class="form-control" id="numero" name="numero" type="text" value = "<?= $registro->getNumero() ?>" disabled>
              </div>
            </div>
          </div>  
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-3">
                <label for="rg">Rg</label>
                <input class="form-control" id="rg" name = "rg" type="text" value="<?= $registro->getRg() ?>"  disabled>
              </div>
              <div class="col-md-3">
                <label for="cpf">CPF</label>
                <input class="form-control" id="cpf" name="cpf" type="text" value = "<?= $registro->getCpf() ?>" disabled>
              </div>
              <div class="col-md-3">
                <label for="data_nasc">Data Nascimento</label>
                <input class="form-control" id="data_nasc" name="data_nasc" type="date" value = "<?= $registro->getDataNascimento() ?>" disabled>
              </div>
              <div class="col-md-3">
                <label for="admin">Tipo de usuario</label>              
                <select id="admin" name="admin" class="form-control" disabled>
                  <option value="0" <?php echo $registro->isAdmin() == "0" ? 'selected' : '' ?> >Usuario</option>
                  <option value="1" <?php echo $registro->isAdmin() == "1" ? 'selected' : '' ?> >Administrador</option>
                </select>
              </div>
            </div>
          </div>                                              
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-2">
               <button class="btn btn-success btn-block" type="submit" value="cadastrar" name="cadastrar"> Cadastrar </button> 
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


