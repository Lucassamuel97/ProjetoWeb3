<?php $this->incluirVisao('util/menu.php');?>
<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="#">Empréstimo</a>
			</li>
			<li class="breadcrumb-item active">Seleção</li>
		</ol>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h2>Empréstimo</h2>
				<?php if ($sucesso) : ?>
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<?= $sucesso ?>
					</div>
				<?php endif ?>
				<?php if ($erros) :?>
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<?php
						foreach ($erros as $value){
							echo "$value <br />";	
						}
						?>
					</div>
				<?php endif ?>
				<form method="get" id="form_pag">       
					<div class="form-group">
						<div class="form-row">
							<div class="col-md-3">
								<label for="titulo">Título:</label>
								<input class="form-control" id="titulo" name ="titulo" type="text" placeholder="Filtre por título" value="<?= $this->getGet('titulo')?>">
								<input type="hidden" name="pagina" value="0" id="pagina">
							</div>
							<div class="col-md-3">
								<label for="autor">Autor:</label>
								<input class="form-control" id="autor" name ="autor" type="text" placeholder="Filtre por autor" value="<?= $this->getGet('autor')?>">
							</div>
							<div class="col-md-2">
								<label for="ano">Ano:</label>
								<input class="form-control" id="ano" name ="ano" type="text" placeholder="Filtre por ano" value="<?= $this->getGet('ano')?>">
							</div>
							<div class="col-md-2 pt-2">
								<button class="btn btn-info btn-block mt-4" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Pesquisar </button>
							</div>
						</div>
					</div>                                             
				</form>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Cod.</th>
							<th>Descrição</th>
							<th>Autor</th>
							<th>Ano</th>
							<th>Disponível</th>
							<th>Ação</th>
						</tr>
					</thead>
					<tbody>

						<?php if (empty($livros) || count($livros) == 1) : ?>
						<tr>
							<td colspan="99" class="text-center">Nenhum Livro encontrado.</td>
						</tr>
					<?php endif ?>

					<?php  for ($i = 0; $i < count($livros)-1; $i++) : ?>
						<tr>
							<td><?= $livros[$i]->getId()?></td>
							<td><?= $livros[$i]->getTitulo() ?></td>
							<td><?= $livros[$i]->getAutor() ?></td>
							<td><?= $livros[$i]->getAno()?></td>
							<td><?= $livros[$i]->getQ_exemplares() - $livros[$i]->getQ_emprestados()?></td>
							<td>
								<form action="<?= URL_RAIZ . 'emprestimo'?>" method="post">
									<input type="hidden" name="livro" value="<?=$livros[$i]->getId()?>">
									<button type="submit" class="btn btn-success">Emprestar</button>
								</form>
							</td>
						</tr>
					<?php endfor ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-7">
			<nav aria-label="Page navigation example" class="float-right">
				<ul class="pagination">
					<?= $livros[$i]['paginacao'] ?>
				</ul>
			</nav>
		</div>	
	</div>
</div>
</div>