<?php
// Starta as sess�es
@session_start();

// Verifica se todas as sess�es est�o setadas.
if(!isset($_SESSION["idServer"]) || $_SESSION["idServer"] != session_id()) {
	$message = '<div class="alert alert-error">
				  <button data-dismiss="alert" class="close" type="button">�</button>
				  <strong>Ops!</strong> Fa�a seu login no sistema!.
				</div>';
	echo "<script>window.location = 'index.php';</script>";
}
?>