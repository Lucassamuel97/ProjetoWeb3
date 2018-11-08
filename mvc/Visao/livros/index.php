<?php $this->incluirVisao('util/menu.php');?>
<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="#">Livros</a>
			</li>
			<li class="breadcrumb-item active">Listagem</li>
		</ol>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h2>Livros</h2>
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
							<div class="col-md-2 pt-2">
								<a class="btn btn-success btn-block mt-4 text-light" href="<?= URL_RAIZ . 'livros/criar'?>"><i class="fa fa-plus" aria-hidden="true"></i> Cadastro </a>
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
							<th>Quantidade ex.</th>
							<th>Ano</th>
							<th>Ações</th>
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
								<td><?= $livros[$i]['id'] ?></td>
								<td><?= $livros[$i]['titulo'] ?></td>
								<td><?= $livros[$i]['autor']  ?></td>
								<td><?= $livros[$i]['q_exemplares']?></td>
								<td><?= $livros[$i]['ano']?></td>
								<td>
									<a href="<?= URL_RAIZ . 'livros/' . $livros[$i]['id'] ?>" title="Mostrar" class="mr-md-2">
										<i class="fa fa-eye" aria-hidden="true"></i>
									</a>

									<a href="<?= URL_RAIZ . 'livros/' . $livros[$i]['id'] . '/editar' ?>" title="Editar" class="text-info mr-md-2">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									</a>

									<form id="formdeletar" action="<?= URL_RAIZ . 'livros/' . $livros[$i]['id'] ?>" method="post" class="inline text-danger">
										<input type="hidden" name="_metodo" value="DELETE">
										<a href="" title="Deletar" onclick="event.preventDefault(); this.parentNode.submit()">
											<i class="fa fa-trash" aria-hidden="true"></i>
										</a>
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