﻿﻿<?php
	
	require ("conexao.php");
	
	if (!$conexao)
	{
		echo "Não bombou";
	}
	
	$sql = "SELECT * FROM carrinho";
	
	$consulta = mysqli_query($conexao, $sql);
	
	
	while ($exibirRegistros = mysqli_fetch_array($consulta))
	{
		$codigo = $exibirRegistros[0];
		$nome = $exibirRegistros[1];
		$preco = $exibirRegistros[2];
		$imagem = $exibirRegistros[3];
		
		
		
		echo 'Nome do produto: '.$nome.'&nbsp;
		Preço: R$ '.number_format($preco,2,",",".").'
		<a href ="carrinho.php?acao=add&id='.$codigo.'"> Adicionar ao carrinho</a> </br>
		<img src="imagem/'.$exibirRegistros['imagem'].'" width="150"> </p>
		<hr/>';
		
	}
	
?>