<?php

include_once('login_valida_acesso.php');

// Conexão com banco de dados.
require_once("conexao_mysql.php");

$erro = false;
$message = '';

if (isset($_POST['btListas'])) {
	include('listas_cadastradas.php');
}

?>
<div class="group-space">	
	<div class="row-fluid">
		<div class="span8">
			<h4>Listas de Compras</h4>
		</div>
		<div class="span4">
			<a id="btNovo" href="javascript:void(0);" onclick="$('#cadListas').slideDown();$('#btNovo').hide();" class="btn btn-success pull-right">
				<i class="icon icon-plus icon-white"></i> Novo
			</a>
		</div>
	</div>
	<form method="POST" id="cadListas" <?php if (!$erro) { echo 'style="display:none;"'; }; ?> onsubmit="return valForm('cadListas');">
			<div class="row-fluid">
				<div class="span12">
					<input name="lista" data-label="Lista" class="input-block-level required" type="text" placeholder="Lista">
				</div>
			</div>
			<div class="row-fluid">
				<button type="submit" name="btListas" class="btn btn-primary">Salvar</button>
				<button type="button" onclick="$('#cadListas').slideUp();$('#btNovo').show();" class="btn-link">Cancelar</button>
			</div>
	</form>
	<?php echo $message; ?>
</div>
<?php
	// Lista as Listas Cadastradas.
	$MySQL2 = "SELECT * FROM listas WHERE usuario = '".$_SESSION['idUsuario']."' ORDER BY nome";
	$Busca2 = mysql_query($MySQL2) or die(mysql_error());
	$Cont2 = mysql_num_rows($Busca2);

	if ($Cont2 == 0) {
		echo '<div class="group-space show-border"><div class="row-fluid">
				<p>Você ainda não cadastrou nenhuma lista.</p>
			</div></div>';
	} else {
		while ($res2 = mysql_fetch_array($Busca2)) {
			echo '<div class="group-space show-border">
					<div class="row-fluid">
						<div class="span9">
							'.$res2['nome'].'<br />
							<strong>Total R$ '.number_format($res2['total'], 2, ",", "").'</strong>
						</div>
						<div class="span3 btn-group pull-right">
							<a class="btn"><i class="icon-pencil"></i></a>
							<a class="btn"><i class="icon-trash"></i></a>
						</div>
					</div>
				</div>';
		}
	}
?>