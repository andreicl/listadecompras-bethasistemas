<?php
// Starta a sessão no navegador.
@session_start();

if (isset($_GET['login']) && $_GET['login'] == "send") {
	session_unset();
	session_destroy();
}

// Variáveis diversas.
$login = false;
$message = '';

// Verifico se foi enviado o POST.
if (isset($_POST['btLogin'])) {
	include_once('login_valida.php');
} else if (isset($_POST['btCadastro'])) {
	include_once('login_cadastro.php');
}

// Verifica se o ID da sessão é igual a do servidor.
if (isset($_SESSION['idServer']) && $_SESSION['idServer'] == session_id()) {
	$login = true;
}

// Adiciono o header padrão do sistema.
include('header.php');

// Se estiver logado, exibo os menus.
if ($login) {
	$inicio = 'active';
	$listas = '';
	$produtos = '';

	if (isset($_POST['btListas'])) {
		$inicio = '';
		$listas = 'active';
		$produtos = '';
	}

	if (isset($_POST['btProdutos']) || isset($_POST['idProduto'])) {
		$inicio = '';
		$listas = '';
		$produtos = 'active';
	}
	
	echo ' <div class="tabbable">
				<ul class="nav nav-tabs">
					<li class="'.$inicio.'">
						<a href="index.php">
							<i class="icon-home icon-white"></i> Início
						</a>
					</li>
					<li class="'.$listas.'">
						<a href="#tab2" data-toggle="tab">
							<i class="icon-th-list icon-white"></i> Listas
						</a>
					</li>
					<li class="'.$produtos.'">
						<a href="#tab3" data-toggle="tab">
							<i class="icon icon-tasks icon-white"></i> Produtos
						</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane '.$inicio.'" id="tab1">';
						include("inicio.php");
			  echo '</div>
					<div class="tab-pane '.$listas.'" id="tab2">';
						include("listas.php");
			  echo '</div>
					<div class="tab-pane '.$produtos.'" id="tab3">';
						include("produtos.php");
			  echo '</div>
				</div>
			</div>';
} else {
	echo '<div id="login" class="group-space">
			<form id="formCad" method="POST" class="form-signin" style="display:none;">
				<h4 class="form-signin-heading">Me cadastrando</h4>
				'.$message.'
				<input type="text" name="nome" class="input-block-level" placeholder="Nome">
				<input type="text" name="email" class="input-block-level" placeholder="E-mail">
				<input type="password" name="senha" class="input-block-level" placeholder="Senha">
				<button name="btCadastro" class="btn btn-large btn-primary btn-success" type="submit">Cadastrar</button>
				<a href="javascript:void(0);" onclick="$(\'#formCad\').slideUp();$(\'#formLogin\').slideDown();">Cancelar</a>
			</form>

			<form id="formLogin" method="POST" class="form-signin">
				<h4 class="form-signin-heading">Acessando minha conta</h4>
				'.$message.'
				<input type="text" name="email" class="input-block-level" placeholder="E-mail">
				<input type="password" name="senha" class="input-block-level" placeholder="Senha">
				<button name="btLogin" class="btn btn-large btn-primary btn-success" type="submit">Acessar</button>
				<a href="javascript:void(0);" onclick="$(\'#formCad\').slideDown();$(\'#formLogin\').slideUp();">Fazer meu cadastro</a>
			</form>
		</div>';
}

// Adiciono o footer padrão do sistema.
include('footer.php');
?>