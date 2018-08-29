<?php
	session_start();
	require ("conexao.php");
		
	foreach($_SESSION['carrinho'] as $id => $qtd){
		$sql   = "SELECT * FROM carrinho WHERE id= '$id'";
                        $consulta    = mysqli_query($conexao,$sql);
                        $exibirRegistros    = mysqli_fetch_array($consulta);
                        $nome  = $exibirRegistros['nome'];
                        $preco = number_format($exibirRegistros['preco']);
                        $sub   = $preco * $qtd;
						$total = number_format($_SESSION['total']);
						
		$sqli = "INSERT INTO `produtos`.`meucarrinho` (`id_produto`, `quantidade`, `preco`, `sub`, `total`) VALUES ('$id', '$qtd', '$preco', '$sub', '$total')";
		
		mysqli_query($conexao,$sqli) or die("Erro ao tentar cadastrar registro");		
	}
	
	if($sqli == true){
		echo "<h1> Pedido Efetuado com Sucesso </h1>";
	}else{
		echo "<h1> Falha ao Efetuar o Pedido </h1>";
	}

	echo '<a href="index.php"> Pagina Inicial </a>';
?>