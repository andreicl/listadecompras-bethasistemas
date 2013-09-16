<?php
// Starta as sessões
@session_start();

// Verifica se todas as sessões estão setadas.
if(!isset($_SESSION["idServer"]) || $_SESSION["idServer"] != session_id()) {
	$message = '<div class="alert alert-error">
				  <button data-dismiss="alert" class="close" type="button">×</button>
				  <strong>Ops!</strong> Faça seu login no sistema!.
				</div>';
	echo "<script>window.location = 'index.php';</script>";
}
?>