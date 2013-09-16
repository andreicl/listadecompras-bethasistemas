<?php
// Verifica se foi enviado as variáveis do post.
if(isset($_POST['email']) && $_POST['email'] != "" && $_POST['senha'] != "") {
	// Conexão com banco de dados.
	require_once("conexao_mysql.php");

	$MySQL = "SELECT * FROM usuarios WHERE email = '".addslashes($_POST['email'])."'";
	$Busca = mysql_query($MySQL) or die(mysql_error());
	$Cont = mysql_num_rows($Busca);

	if ($Cont == 0) {
		$sql = "INSERT INTO usuarios VALUES (NULL, '".addslashes($_POST['nome'])."', '".addslashes($_POST['email'])."', '".addslashes(md5($_POST['senha']))."', now())";
		$res = mysql_query($sql) or die ('Erro ao cadastrar usuário: '.mysql_error());

		$message = '<div class="alert alert-success">
						  <button data-dismiss="alert" class="close" type="button">×</button>
						  <strong>Parabéns:</strong> Seu cadastro foi efetuado com sucesso! Faça seu login para acessar sua conta.
						</div>';
	} else {
		$message = '<div class="alert alert-error">
					  <button data-dismiss="alert" class="close" type="button">×</button>
					  <strong>Ops!</strong> Já existe um usuário com este e-mail!.
					</div>';
	}
} else {
	$message = '<div class="alert alert-error">
					  <button data-dismiss="alert" class="close" type="button">×</button>
					  <strong>Atenção:</strong> Para prosseguir, é necessário preencher todos os campos!.
					</div>';
}
?>