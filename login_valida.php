<?php
// Seta as sess�es necess�rias para uso do sistema.
@session_start();

// Verifica se foi enviado as vari�veis do post.
if(isset($_POST['email']) && $_POST['email'] != "" && $_POST['senha'] != "") {
	// Conex�o com banco de dados.
	require_once("conexao_mysql.php");

	// Trata os valores enviados por post.
	$LoginPost = addslashes($_POST['email']);
	$SenhaPost = addslashes($_POST['senha']);
	$Login = $LoginPost;
	$Senha = md5($SenhaPost);

	// Verifica se existe usu�rio cadastrado com o login e senha informado.
	$MySQL = "SELECT * FROM usuarios WHERE email = '".$Login."' && password = '".$Senha."'";
	$Busca = mysql_query($MySQL) or die(mysql_error());
	$Res = mysql_fetch_assoc($Busca);
	$Cont = mysql_num_rows($Busca);

	// Verifica se achou algum usu�rio cadastrado.
	if ($Cont == 0) {
		$message = '<div class="alert alert-error">
					  <button data-dismiss="alert" class="close" type="button">�</button>
					  <strong>Ops!</strong> Verifique seu login e senha!.
					</div>';
	} else if ($Cont == 1) {
		// Sess�es criadas.
		$_SESSION['idUsuario'] = $Res['id'];
		$_SESSION['usuario'] = $Res['nome'];
		$_SESSION['email'] = $Res['email'];
		$_SESSION["idServer"] = session_id();
	}
} else {
	$message = '<div class="alert alert-error">
					  <button data-dismiss="alert" class="close" type="button">�</button>
					  <strong>Aten��o:</strong> Para prosseguir, � necess�rio informar um login e uma senha!.
					</div>';
}
?>