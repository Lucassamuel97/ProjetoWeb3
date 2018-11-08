<?php $this->incluirVisao('util/menu.php');?>
<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="#">Livros</a>
			</li>
			<li class="breadcrumb-item active">Cadastro</li>
		</ol>
		
		<div class="row">
			<div class="col-12">
				<h2>Livros </h2>

				<?php if ($sucesso) : ?>
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<?= $sucesso ?>
					</div>
				<?php endif ?>

				<form action="<?= URL_RAIZ . 'livros' ?>" method="POST" enctype="multipart/form-data" id="validate">           
					<div class="form-group">
						<div class="form-row">

							<div class="col-md-6">
								<label class="control-label" for="titulo"> Titulo *</label>
								<input id="titulo" name="titulo" placeholder="Digite o Titulo" class="form-control <?=$this->getErroCss('titulo') ?>" value="<?= $this->getPost('titulo') ?>">
								<?php $this->incluirVisao('util/formErro.php', ['campo' => 'titulo']) ?>
							</div>

							<div class="col-md-3">
								<label for="ano"> Ano: </label>
								<input id="ano" name="ano" type="text" placeholder="Digite o Ano" class="form-control <?=$this->getErroCss('ano') ?>" value="<?= $this->getPost('ano') ?>">
								<?php $this->incluirVisao('util/formErro.php', ['campo' => 'ano']) ?>
							</div>

							<div class="col-md-6">
								<label for="autor"> Autor: </label>
								<input id="autor" name="autor" type="text" placeholder="Digite o Autor" class="form-control <?=$this->getErroCss('autor') ?>" value="<?= $this->getPost('autor') ?>">
								<?php $this->incluirVisao('util/formErro.php', ['campo' => 'autor']) ?>
							</div>
							<div class="col-md-3">
								<label for="q_exemplares"> Quantidade de exemplares: </label>
								<input id="q_exemplares" name="q_exemplares" type="text" placeholder="Digite o Numero" class="form-control <?=$this->getErroCss('q_exemplares') ?>" value="<?= $this->getPost('q_exemplares') ?>">
								<?php $this->incluirVisao('util/formErro.php', ['campo' => 'q_exemplares']) ?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="form-row">
							<button type="submit" class="btn btn-primary mr-md-3"><i class="fa fa-floppy-o" aria-hidden="true"></i> Cadastrar</button>
							<a href="<?= URL_RAIZ . 'livros' ?>" class="btn btn-danger text-light"><i class="fa fa-reply" aria-hidden="true"></i> Voltar</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>