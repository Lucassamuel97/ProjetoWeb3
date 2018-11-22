<?php $this->incluirVisao('util/menu.php');?>
<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="#">Relatórios</a>
			</li>
			<li class="breadcrumb-item active">Emprestimos</li>
		</ol>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h2>Livros mais Emprestados</h2>
				<?php if ($usuario->isAdmin()) : ?>
					<div class="form-group">
						<div class="alert alert-info" role="alert">
							<h5>Obs :<small> O relatorio possui os dados relativos a todos os usuarios.</small></h5>
						</div>
					</div>  
				<?php endif ?>
				<form method="get" id="form_pag">       
					<input type="hidden" name="pagina" value="0" id="pagina">                                           
				</form>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Titulo</th>
							<th>Autor</th>
							<th>Ano</th>
							<th>Quant Emprestimos</th>
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
							<td><?= $registros[$i]['autor']  ?></td>
							<td><?= $registros[$i]['emprestimos']?></td>
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