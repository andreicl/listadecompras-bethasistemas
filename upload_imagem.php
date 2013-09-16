<?php
// Valida a sessão do usuário logado.
include_once('login_valida_acesso.php');

/**
 * Uploadify
 * Copyright (c) 2012 Reactive Apps, Ronnie Garcia
 * Released under the MIT License <http://www.opensource.org/licenses/mit-license.php>
 */
if (!empty($_FILES['imagem'])) {
	// Valido a extenção do arquivo
	// $fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileTypes = array('jpg','jpeg','JPG','JPEG','png','PNG'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);

	if (in_array($fileParts['extension'],$fileTypes)) {
		// Recebe a separa as variaveis enviadas por mim
		$tempFile = $_FILES['Filedata']['tmp_name'];
		$targetPath = $_SERVER['DOCUMENT_ROOT'].'/produtos/';
		
		$ext = substr($_FILES['Filedata']['name'], strlen($_FILES['Filedata']['name'])-3, 3);

		$MySQL = "SELECT id
					FROM produtos
				ORDER BY id DESC
				   LIMIT 1";
		$search = mysql_query($MySQL) or die("Erro ao verificar ultima foto: ".mysql_error());
		$res    = mysql_fetch_assoc($search);

		$newPhoto = $res['photoID'] + 1;

		$targetFile  = rtrim($targetPath,'/').'/'.$gallerieID."-".$newPhoto.".".$ext;
		$targetName  = $newPhoto.".".$ext;

		// Move para o servidor
		move_uploaded_file($tempFile, $targetFile);
		resize($targetFile, $targetFile, 100, 48, 36);

		// Função que grava a foto no banco
		$imagem = $targetName;
	} else {
		echo 'Arquivo no formato inválido!';
	}
}

// Redimensiona imagens
function resize($origem, $destino, $quality, $width, $height){
	$max_width = null;
	$max_height = null;
	$image = $origem;

	if ($max_width === null) {
		$max_width = $width;
	}

	if ($max_height === null) {
		$max_height = $height;
	}

	$size = GetImageSize($image);
	$width = $size[0];
	$height = $size[1];

	$x_ratio = $max_width / $width;
	$y_ratio = $max_height / $height;

	if (($width <= $max_width) && ($height <= $max_height)) {
		$tn_width = $width;
		$tn_height = $height;
	} else if (($x_ratio * $height) < $max_height) {
		$tn_height = ceil($x_ratio * $height);
		$tn_width = $max_width;
	} else {
		$tn_width = ceil($y_ratio * $width);
		$tn_height = $max_height;
	}

	$src = ImageCreateFromJpeg($image);

	if(function_exists('imagecopyresampled')){
		$dst = imageCreateTrueColor($tn_width,$tn_height);

		if(!@imagecopyresampled($dst,$src,0,0,0,0,$tn_width,$tn_height,$width,$height)){
			imagecopyresized($dst,$src,0,0,0,0,$tn_width,$tn_height,$width,$height);
		}
	} else {
		$dst = imagecreate($tn_width,$tn_height);
		imagecopyresized($dst,$src,0,0,0,0,$tn_width,$tn_height,$width,$height);
	}

	ImageJpeg($dst, $destino, $quality);
	ImageDestroy($src);
	ImageDestroy($dst);
}
?>