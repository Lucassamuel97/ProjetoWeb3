<?php $this->incluirVisao('util/menu.php');?>
<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="#">Livros</a>
			</li>
			<li class="breadcrumb-item active">Mostrar</li>
		</ol>
		
		<div class="row">
			<div class="col-12">
				<h2>Livros </h2>
				<form action="<?= URL_RAIZ . 'livros' ?>" method="POST" enctype="multipart/form-data" id="validate">           
					<div class="form-group">
						<div class="form-row">
							<div class="col-md-6">
								<label for="titulo">Título: </label>
								<input class="form-control" id="titulo" name="titulo" type="text" disabled placeholder="Digite o Título" value="<?= $livro->getTitulo() ?>">
							</div>
							<div class="col-md-3">
								<label for="ano"> Ano: </label>
								<input class="form-control" id="ano" name="ano" type="text" disabled placeholder="Digite o Ano" value="<?=$livro->getAno() ?>">
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-3">
								<label for="autor"> Autor: </label>
								<input class="form-control" id="autor" name="autor" type="text" disabled placeholder="Digite o Autor" value="<?= $livro->getAutor() ?>">
							</div>
							<div class="col-md-3">
								<label for="q_exemplares"> Quantidade de exemplares: </label>
								<input class="form-control" id="q_exemplares" name="q_exemplares" type="text" disabled placeholder="Digite o Numero" value="<?= $livro->getQ_exemplares() ?>">
							</div>
							<div class="col-md-3">
								<label> Quantidade Ex. Emprestados: </label>
								<input class="form-control" type="text" disabled placeholder="Digite o Numero" value="<?= $livro->getQ_emprestados() ?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="form-row">
							<a href="<?= URL_RAIZ . 'livros' ?>" class="btn btn-danger text-light"><i class="fa fa-reply" aria-hidden="true"></i> Voltar</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>