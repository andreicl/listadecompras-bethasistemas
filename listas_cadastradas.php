<?php
// Valida a sess�o do usu�rio logado.
include_once('login_valida_acesso.php');

// Verifica se foi enviado as vari�veis do post.
if(isset($_POST['lista']) && $_POST['lista'] != "") {
	// Conex�o com banco de dados.
	require_once("conexao_mysql.php");

	$MySQL = "SELECT * FROM listas WHERE nome= '".addslashes($_POST['lista'])."' && usuario = '".$_SESSION['idUsuario']."'";
	$Busca = mysql_query($MySQL) or die(mysql_error());
	$Cont = mysql_num_rows($Busca);

	if ($Cont == 0) {
	
		$sql = "INSERT INTO listas VALUES (NULL, '".addslashes($_POST['lista'])."', '', '".$_SESSION['idUsuario']."','I', now())";
		$res = mysql_query($sql) or die ('Erro ao cadastrar lista: '.mysql_error());

		$message = '<div id="yes" class="alert alert-success">
						  <button data-dismiss="alert" class="close" type="button">�</button>
						  <strong>Parab�ns:</strong> Lista cadastrada com sucesso.
						</div>
						<script>setTimeout( function () {
							$("#yes").slideUp();
						}, 5000);</script>';
	} else {
		$message = '<div class="alert alert-error">
					  <button data-dismiss="alert" class="close" type="button">�</button>
					  <strong>Ops!</strong> J� existe uma lista com este nome!.
					</div>';
	}
} else {
	$erro = true;
	$message = '<div class="alert alert-error">
					  <button data-dismiss="alert" class="close" type="button">�</button>
					  <strong>Aten��o:</strong> O nome da lista � obrigat�rio!
					</div>';
}
?>