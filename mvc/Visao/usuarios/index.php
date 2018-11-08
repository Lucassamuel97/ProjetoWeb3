<?php $this->incluirVisao('util/menu.php');?>
<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="#">Usuarios</a>
			</li>
			<li class="breadcrumb-item active">Listagem</li>
		</ol>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h2>Usuarios</h2>
				<form method="get" id="form_pag">       
					<div class="form-group">
						<div class="form-row">
							<div class="col-md-6">
								<label for="nome">Nome:</label>
								<input class="form-control" id="nome" name ="nome" type="text" placeholder="Filtre por Nome" value="<?= $this->getGet('nome')?>">
								<input type="hidden" name="pagina" value="0" id="pagina">
							</div>
							<div class="col-md-2 pt-2">
								<button class="btn btn-info btn-block mt-4" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Pesquisar </button>
							</div>
							<div class="col-md-2 pt-2">
								<a class="btn btn-success btn-block mt-4 text-light" href="<?= URL_RAIZ . 'usuarios/criar'?>"><i class="fa fa-plus" aria-hidden="true"></i> Cadastro </a>
							</div>
						</div>
					</div>                                             
				</form>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Cod.</th>
							<th>Descrição</th>
							<th>Ações</th>
						</tr>
					</thead>
					<tbody>

						<?php if (empty($registros) || count($registros) == 1) : ?>
							<tr>
								<td colspan="99" class="text-center">Nenhum Livro encontrado.</td>
							</tr>
						<?php endif ?>

						<?php  for ($i = 0; $i < count($registros)-1; $i++) : ?>
							<tr>
								<td><?= $registros[$i]['id'] ?></td>
								<td><?= $registros[$i]['nome'] ?></td>
								<td>
									<a href="<?= URL_RAIZ . 'usuarios/' . $registros[$i]['id'] ?>" title="Mostrar" class="mr-md-2">
										<i class="fa fa-eye" aria-hidden="true"></i>
									</a>

									<a href="<?= URL_RAIZ . 'usuarios/' . $registros[$i]['id'] . '/editar' ?>" title="Editar" class="text-info mr-md-2">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									</a>

									<form id="formdeletar" action="<?= URL_RAIZ . 'usuarios/' . $registros[$i]['id'] ?>" method="post" class="inline text-danger">
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
						<?= $registros[$i]['paginacao'] ?>
					</ul>
				</nav>
			</div>	
		</div>
	</div>
</div>