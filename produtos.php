<?php
// Valida a sessão do usuário logado.
include_once('login_valida_acesso.php');

// Conexão com banco de dados.
require_once("conexao_mysql.php");

$erro = false;
$message = '';

if (isset($_POST['idProduto'])) {
	include('produtos_deleta.php');
}

if (isset($_POST['btProdutos'])) {
	include('produtos_cadastro.php');
}
?>
<div class="group-space">	
	<div class="row-fluid">
		<div class="span8">
			<h4>Produtos</h4>
		</div>
		<div class="span4">
			<a id="btNovo" href="javascript:void(0);" onclick="$('#cadProdutos').slideDown();$('#btNovo').hide();" class="btn btn-success pull-right">
				<i class="icon icon-plus icon-white"></i> Novo
			</a>
		</div>
		<form method="POST" id="cadProdutos" <?php if (!$erro) { echo 'style="display:none;"'; }; ?> onsubmit="return valForm('cadProdutos');">
			<div class="row-fluid">
				<div class="span12">
					<input name="produto" data-label="Produto" class="input-block-level required" type="text" placeholder="Produto">
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<input name="preco" class="input-block-level" type="text" placeholder="Preço" onkeydown="backspace(this,event);" onkeypress="reais(this,event);return apenasNum(event);">
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<select name="medida">
						<option value="unid">Unidade</option>
						<option value="g">Gramas</option>
						<option value="kg">Kilogramas</option>
						<option value="lts">Litros</option>
						<option value="cx">Caixa</option>
					</select>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<label>Imagem:</label>
					<input name="imagem" type="file" value="Adicionar imagem" />
				</div>
			</div>
			<div class="row-fluid">
				<button type="submit" name="btProdutos" class="btn btn-primary">Salvar</button>
				<button type="button" onclick="$('#cadProdutos').slideUp();$('#btNovo').show();" class="btn-link">Cancelar</button>
			</div>
		</form>
	</div>
	<?php echo $message; ?>
</div>
<?php
	// Lista os produtos cadastrados.
	$MySQL = "SELECT * FROM produtos WHERE usuario = '".$_SESSION['idUsuario']."' ORDER BY nome";
	$Busca = mysql_query($MySQL) or die(mysql_error());
	$Cont = mysql_num_rows($Busca);

	if ($Cont == 0) {
		echo '<div class="group-space show-border">
				<div class="row-fluid">
					<p>Você ainda não cadastrou nenhum produto.</p>
				</div>
			</div>';
	} else {
		while ($res = mysql_fetch_array($Busca)) {
			$image = $res['imagem'] == '' ? 'noPhoto.jpg' : $res['imagem'];

			echo '<div class="group-space show-border">
					<div class="row-fluid">
						<div class="span3">
							<img src="produtos/'.$image.'" width="48" />
						</div>
						<div class="span6">
							<div class="row">
								'.$res['nome'].'
							</div>
							<div class="row">
								<strong>R$ '.number_format($res['preco'], 2, ",", "").'</strong> '.$res['medida'].'
							</div>
						</div>
						<div class="span3">
							<form id="delProduto'.$res['id'].'" name="delProduto'.$res['id'].'" method="POST">
								<div class="btn-group pull-right">
									<a class="btn"><i class="icon-pencil"></i></a>
									<a href="javascript:void(0)" onclick="mensagem(\'delProduto'.$res['id'].'\', \'A exclusão deste produto é inrreversível. Deseja realmente excluir?\');" class="btn">
										<i class="icon-trash"></i>
										<input type="hidden" name="idProduto" value="'.$res['id'].'" />
									</a>
								</div>
							</form>
						</div>
					</div>
				</div>';
		}
	}
?>