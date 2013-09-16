<?php
// Valida a sessão do usuário logado.
include_once('login_valida_acesso.php');

// Verifica se foi enviado as variáveis do post.
if(isset($_POST['lista']) && $_POST['lista'] != "") {
	// Conexão com banco de dados.
	require_once("conexao_mysql.php");

	$MySQL = "SELECT * FROM listas WHERE nome= '".addslashes($_POST['lista'])."' && usuario = '".$_SESSION['idUsuario']."'";
	$Busca = mysql_query($MySQL) or die(mysql_error());
	$Cont = mysql_num_rows($Busca);

	if ($Cont == 0) {
	
		$sql = "INSERT INTO listas VALUES (NULL, '".addslashes($_POST['lista'])."', '', '".$_SESSION['idUsuario']."','I', now())";
		$res = mysql_query($sql) or die ('Erro ao cadastrar lista: '.mysql_error());

		$message = '<div id="yes" class="alert alert-success">
						  <button data-dismiss="alert" class="close" type="button">×</button>
						  <strong>Parabéns:</strong> Lista cadastrada com sucesso.
						</div>
						<script>setTimeout( function () {
							$("#yes").slideUp();
						}, 5000);</script>';
	} else {
		$message = '<div class="alert alert-error">
					  <button data-dismiss="alert" class="close" type="button">×</button>
					  <strong>Ops!</strong> Já existe uma lista com este nome!.
					</div>';
	}
} else {
	$erro = true;
	$message = '<div class="alert alert-error">
					  <button data-dismiss="alert" class="close" type="button">×</button>
					  <strong>Atenção:</strong> O nome da lista é obrigatório!
					</div>';
}
?>