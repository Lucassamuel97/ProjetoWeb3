<?php $this->incluirVisao('util/menu.php');?>
<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="#">Livros</a>
			</li>
			<li class="breadcrumb-item active">Editar</li>
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

				<form action="<?= URL_RAIZ . 'livros/' . $livro->getId() ?>" method="POST" id="validate">           
					<input type="hidden" name="_metodo" value="PATCH">
					<div class="form-group">
						<div class="form-row">							
							<div class="col-md-6">
								<label class="control-label" for="titulo"> Titulo *</label>
								
								<input id="titulo" name="titulo" placeholder="Digite o Titulo" class="form-control <?=$this->getErroCss('titulo') ?>" value="<?php 
								if(!empty($livro->getTitulo())){
									echo $livro->getTitulo();
									}else{
										echo $this->getPost('titulo');
									}?>">
									<?php $this->incluirVisao('util/formErro.php', ['campo' => 'titulo']) ?>
								</div>

								<div class="col-md-3">
									<label for="ano"> Ano: </label>
									<input id="ano" name="ano" type="text" placeholder="Digite o Ano" class="form-control <?=$this->getErroCss('ano') ?>"
									value="<?php 
									if(!empty($livro->getAno())){
										echo $livro->getAno();
										}else{
											echo $this->getPost('ano');
										}?>"
										>
										<?php $this->incluirVisao('util/formErro.php', ['campo' => 'ano']) ?>
									</div>
								</div>
								<div class="form-row">
									<div class="col-md-3">
										<label for="autor"> Autor: </label>
										<input id="autor" name="autor" type="text" placeholder="Digite o Autor" class="form-control <?=$this->getErroCss('autor') ?>"
										value="<?php 
										if(!empty($livro->getAutor())){
											echo $livro->getAutor();
											}else{
												echo $this->getPost('autor');
											}?>"
											>
											<?php $this->incluirVisao('util/formErro.php', ['campo' => 'autor']) ?>
										</div>
										<div class="col-md-3">
											<label for="q_exemplares"> Quantidade de exemplares: </label>
											<input id="q_exemplares" name="q_exemplares" type="text" placeholder="Digite o Numero" class="form-control <?=$this->getErroCss('q_exemplares') ?>"
											value="<?php 
											if(!empty($livro->getQ_exemplares())){
												echo $livro->getQ_exemplares();
												}else{
													echo $this->getPost('q_exemplares');
												}?>"
												>
												<?php $this->incluirVisao('util/formErro.php', ['campo' => 'q_exemplares']) ?>
											</div>

											<div class="col-md-3">
												<label> Quantidade Ex. Emprestados: </label>
												<input class="form-control" type="text" disabled placeholder="Digite o Numero" value="<?= $livro->getQ_emprestados() ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="form-row">
											<button type="submit" class="btn btn-success mr-md-3"><i class="fa fa-floppy-o" aria-hidden="true"></i> Gravar</button>
											<a href="<?= URL_RAIZ . 'livros' ?>" class="btn btn-danger text-light"><i class="fa fa-reply" aria-hidden="true"></i> Voltar</a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>