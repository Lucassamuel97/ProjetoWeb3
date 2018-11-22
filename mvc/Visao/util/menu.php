<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
  <a class="navbar-brand" href="<?= URL_RAIZ . 'home' ?>">
    <img class="logo" src="<?= URL_IMG.'logo.png'?>">
  </a>
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Home">
        <a class="nav-link" href="<?= URL_RAIZ . 'home' ?>">
          <i class="fa fa-home" aria-hidden="true"></i>
          <span class="nav-link-text">Home</span>
        </a>
      </li>
      <?php if ($usuario->isAdmin()): ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Livros">
          <a class="nav-link" href="<?= URL_RAIZ . 'livros' ?>">
            <i class="fa fa-book" aria-hidden="true"></i>
            <span class="nav-link-text">Livros</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Leitores">
          <a class="nav-link" href="<?= URL_RAIZ . 'usuarios' ?>">
            <i class="fa fa-users"></i>
            <span class="nav-link-text">Usuarios</span>
          </a>
        </li>
      <?php endif?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Empréstimo">
          <a class="nav-link" href="<?= URL_RAIZ . 'emprestimo/criar' ?>">
            <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
            <span class="nav-link-text">Empréstimos</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Devolução">
          <a class="nav-link" href="<?= URL_RAIZ . 'devolucao' ?>">
            <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
            <span class="nav-link-text">Devolução</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Relatórios">
          <a class="nav-link" href="<?= URL_RAIZ . 'relatorio' ?>">
            <i class="fa fa-file-text" aria-hidden="true"></i>
            <span class="nav-link-text">Relatórios</span>
          </a>
        </li>
    </ul>
    <!-- FINAL MENU -->
    <ul class="navbar-nav sidenav-toggler">
      <li class="nav-item">
        <a class="nav-link text-center" id="sidenavToggler">
          <i class="fa fa-fw fa-angle-left"></i>
        </a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link">
          <i class="fa fa-university" aria-hidden="true"></i> Biblioteca UTFPR</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=URL_RAIZ . 'usuarios/'.$usuario->getId().'/editar'?>">
            <i class="fa fa-user-circle" aria-hidden="true"></i> Usuário: <?=$usuario->getNome()?> 
          </a>
          </li>
          <li class="nav-item">
            <form action="<?= URL_RAIZ . 'login' ?>" method="post" class="inline">
              <input type="hidden" name="_metodo" value="DELETE">
              <a href="" class="nav-link" onclick="event.preventDefault(); this.parentNode.submit()">
                <i class="fa fa-fw fa-sign-out"></i>Sair
              </a>
            </form>
          </li>
        </ul>
      </div>
    </nav>