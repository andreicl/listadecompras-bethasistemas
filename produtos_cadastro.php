<?php
// Valida a sess�o do usu�rio logado.
include_once('login_valida_acesso.php');

// Verifica se foi enviado as vari�veis do post.
if(isset($_POST['produto']) && $_POST['produto'] != "") {
	// Conex�o com banco de dados.
	require_once("conexao_mysql.php");

	$MySQL = "SELECT * FROM produtos WHERE nome= '".addslashes($_POST['produto'])."' && usuario = '".$_SESSION['idUsuario']."'";
	$Busca = mysql_query($MySQL) or die(mysql_error());
	$Cont = mysql_num_rows($Busca);

	if ($Cont == 0) {
		$imagem = '';
		$preco = addslashes($_POST['preco']);

		$preco = strtr($preco, ".", "");
		$preco = strtr($preco, ",", ".");
		$preco = strtr($preco, " ", "");

		include('upload_imagem.php');

		echo $imagem;

		$sql = "INSERT INTO produtos VALUES (NULL, '".addslashes($_POST['produto'])."', '".$preco."', '".addslashes($_POST['medida'])."', '".$imagem."', '".$_SESSION['idUsuario']."', now())";
		$res = mysql_query($sql) or die ('Erro ao cadastrar produto: '.mysql_error());

		$message = '<div id="yes" class="alert alert-success">
						  <button data-dismiss="alert" class="close" type="button">�</button>
						  <strong>Parab�ns:</strong> Produto cadastrado com sucesso.
						</div>
						<script>setTimeout( function () {
							$("#yes").slideUp();
						}, 5000);</script>';
	} else {
		$message = '<div class="alert alert-error">
					  <button data-dismiss="alert" class="close" type="button">�</button>
					  <strong>Ops!</strong> J� existe um produto com este nome!.
					</div>';
	}
} else {
	$erro = true;
	$message = '<div class="alert alert-error">
					  <button data-dismiss="alert" class="close" type="button">�</button>
					  <strong>Aten��o:</strong> O nome do produto � obrigat�rio!
					</div>';
}
?>