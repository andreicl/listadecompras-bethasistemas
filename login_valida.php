<?php
// Seta as sessões necessárias para uso do sistema.
@session_start();

// Verifica se foi enviado as variáveis do post.
if(isset($_POST['email']) && $_POST['email'] != "" && $_POST['senha'] != "") {
	// Conexão com banco de dados.
	require_once("conexao_mysql.php");

	// Trata os valores enviados por post.
	$LoginPost = addslashes($_POST['email']);
	$SenhaPost = addslashes($_POST['senha']);
	$Login = $LoginPost;
	$Senha = md5($SenhaPost);

	// Verifica se existe usuário cadastrado com o login e senha informado.
	$MySQL = "SELECT * FROM usuarios WHERE email = '".$Login."' && password = '".$Senha."'";
	$Busca = mysql_query($MySQL) or die(mysql_error());
	$Res = mysql_fetch_assoc($Busca);
	$Cont = mysql_num_rows($Busca);

	// Verifica se achou algum usuário cadastrado.
	if ($Cont == 0) {
		$message = '<div class="alert alert-error">
					  <button data-dismiss="alert" class="close" type="button">×</button>
					  <strong>Ops!</strong> Verifique seu login e senha!.
					</div>';
	} else if ($Cont == 1) {
		// Sessões criadas.
		$_SESSION['idUsuario'] = $Res['id'];
		$_SESSION['usuario'] = $Res['nome'];
		$_SESSION['email'] = $Res['email'];
		$_SESSION["idServer"] = session_id();
	}
} else {
	$message = '<div class="alert alert-error">
					  <button data-dismiss="alert" class="close" type="button">×</button>
					  <strong>Atenção:</strong> Para prosseguir, é necessário informar um login e uma senha!.
					</div>';
}
?>