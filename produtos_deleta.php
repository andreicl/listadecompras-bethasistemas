<?php
// Valida a sessão do usuário logado.
include_once('login_valida_acesso.php');

// Verifica se foi enviado as variáveis do post.
if(isset($_POST['idProduto']) && $_POST['idProduto'] != "") {
	// Conexão com banco de dados.
	require_once("conexao_mysql.php");

	
		$sql = "DELETE FROM produtos WHERE id = ".addslashes($_POST['idProduto'])." LIMIT 1";
		$res = mysql_query($sql) or die (mysql_error());

		$message = '<div id="yes" class="alert alert-success">
						  <button data-dismiss="alert" class="close" type="button">×</button>
						  <strong>Parabéns:</strong> Produto excluído com sucesso.
						</div>
						<script>setTimeout( function () {
							$("#yes").slideUp();
						}, 5000);</script>';
} else {
	$erro = true;
	$message = '<div class="alert alert-error">
					  <button data-dismiss="alert" class="close" type="button">×</button>
					  <strong>Atenção:</strong> não foram enviados todos os dados!
					</div>';
}
?>