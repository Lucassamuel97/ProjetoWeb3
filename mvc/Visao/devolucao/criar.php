<?php $this->incluirVisao('util/menu.php');?>
<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="#">Devolução</a>
			</li>
			<li class="breadcrumb-item active">Seleção</li>
		</ol>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h2>Devolução de livros</h2>
				<?php if ($sucesso) : ?>
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<?= $sucesso ?>
					</div>
				<?php endif ?>
				<form method="get" id="form_pag">       
					<input type="hidden" name="pagina" value="0" id="pagina">                                          
				</form>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Cod.</th>
							<th>Descrição</th>
							<th>Data de empréstimo</th>
							<th>Ação</th>
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
								<td><?= $registros[$i]['titulo'] ?></td>
								<td><?= $registros[$i]['data_formatada']  ?></td>
								<td>
									<form action="<?= URL_RAIZ . 'devolucao'?>" method="post">
										<input type="hidden" name="idemprestimo" value="<?=$registros[$i]['id']?>">
										<button type="submit" class="btn btn-danger">Devolução</button>
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
						<?= $registros[$i]['paginacao']  ?>
					</ul>
				</nav>
			</div>	
		</div>
	</div>
</div>