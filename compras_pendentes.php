<?php
include_once('login_valida_acesso.php');

// Conexão com banco de dados.
require_once("conexao_mysql.php");

// Lista as Listas Cadastradas.
$MySQL2 = "SELECT * FROM listas WHERE usuario = '".$_SESSION['idUsuario']."' ORDER BY nome";
$Busca2 = mysql_query($MySQL2) or die(mysql_error());
$Cont2 = mysql_num_rows($Busca2);

if ($Cont2 == 0) {
echo '<div class="group-space show-border"><div class="row-fluid">
		<p>Não há nenhuma lista pendente para compra.</p>
	</div></div>';
} else {
	echo '<div class="accordion" id="accordion2">';
	while ($res2 = mysql_fetch_array($Busca2)) {
		echo '<div class="accordion-group">
				<div class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse'.$res2['id'].'">
						'.$res2['nome'].'
					</a>
				</div>
				<div id="collapse'.$res2['id'].'" class="accordion-body collapse">
					<div class="accordion-inner">';
						include('lista_modelo.php');
				echo '</div>
				</div>
			</div>';
	}
	echo '</div>';
}
?>
