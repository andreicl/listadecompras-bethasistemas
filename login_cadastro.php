<?php
// Verifica se foi enviado as vari�veis do post.
if(isset($_POST['email']) && $_POST['email'] != "" && $_POST['senha'] != "") {
	// Conex�o com banco de dados.
	require_once("conexao_mysql.php");

	$MySQL = "SELECT * FROM usuarios WHERE email = '".addslashes($_POST['email'])."'";
	$Busca = mysql_query($MySQL) or die(mysql_error());
	$Cont = mysql_num_rows($Busca);

	if ($Cont == 0) {
		$sql = "INSERT INTO usuarios VALUES (NULL, '".addslashes($_POST['nome'])."', '".addslashes($_POST['email'])."', '".addslashes(md5($_POST['senha']))."', now())";
		$res = mysql_query($sql) or die ('Erro ao cadastrar usu�rio: '.mysql_error());

		$message = '<div class="alert alert-success">
						  <button data-dismiss="alert" class="close" type="button">�</button>
						  <strong>Parab�ns:</strong> Seu cadastro foi efetuado com sucesso! Fa�a seu login para acessar sua conta.
						</div>';
	} else {
		$message = '<div class="alert alert-error">
					  <button data-dismiss="alert" class="close" type="button">�</button>
					  <strong>Ops!</strong> J� existe um usu�rio com este e-mail!.
					</div>';
	}
} else {
	$message = '<div class="alert alert-error">
					  <button data-dismiss="alert" class="close" type="button">�</button>
					  <strong>Aten��o:</strong> Para prosseguir, � necess�rio preencher todos os campos!.
					</div>';
}
?>