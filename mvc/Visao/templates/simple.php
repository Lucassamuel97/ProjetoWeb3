<!DOCTYPE html>
<html>
<head>
    <title><?= APLICACAO_NOME ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= URL_CSS . 'reset.css' ?>">
    <link rel="stylesheet" href="<?= URL_CSS . 'bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?= URL_CSS . 'geral.css' ?>"> 
    <link rel="stylesheet" href="<?= URL_ICON . 'css/font-awesome.min.css' ?>">
</head>

<body class="bg-dark">

	<?php $this->imprimirConteudo() ?>



<script src="<?= URL_JS . 'jquery.min.js' ?>"></script>
<script src="<?= URL_JS . 'bootstrap.bundle.min.js' ?>"></script>
<!-- Scroll Top Plugin GSGD-->
<script src="<?= URL_JS . 'jquery.easing.min.js'?>"></script>
<script src="<?= URL_JS . 'geral.js' ?>"></script>

</body>

</html>
