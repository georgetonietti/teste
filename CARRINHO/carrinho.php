<?php 
    session_start(); 
    if(!isset($_SESSION['carrinho'])){ 
        $_SESSION['carrinho'] = array();	
    } //adiciona produto 
     
    if(isset($_GET['acao'])){ 
       
	   //ADICIONAR CARRINHO 
        if($_GET['acao'] == 'add'){ 
            $id = intval($_GET['id']); 
            if(!isset($_SESSION['carrinho'][$id])){ 
                $_SESSION['carrinho'][$id] = 1; 
            } else { 
                $_SESSION['carrinho'][$id] += 1; 
            } 
        } //REMOVER CARRINHO 
     
        if($_GET['acao'] == 'del'){ 
            $id = intval($_GET['id']); 
            if(isset($_SESSION['carrinho'][$id])){ 
                unset($_SESSION['carrinho'][$id]); 
            } 
        } 
           
   }
           
           
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>CARRINHO</title>
    </head>
    <body>
    <table>
        <caption><H1>Carrinho de Compras</H1></caption>
        <thead>
            <tr>
                <th width="244">Produto</th>
                <th width="79">Quantidade</th>
                <th width="89">Pre&ccedil;o</th>
                <th width="100">SubTotal</th>
                <th width="64">Remover</th>
            </tr>
        </thead>
        <form action="?acao=up" method="post">
        <tfoot>
            <tr>
                <td colspan="5"><input type="submit" value="Atualizar Carrinho" /></td>
            <tr>
            <td colspan="5"><a href="index.php">Continuar Comprando</a></td>
			<tr>
            <td colspan="5"><a href="finalizar.php">FINALIZAR PEDIDO</a></td>
        </tfoot>
        <tbody>
     <?php
        if(count($_SESSION['carrinho']) == 0){
          echo '
                <tr>
                    <td colspan="5">Não há produto no carrinho</td>
                </tr>
            ';
          } else {
                require("conexao.php");
                
				$total = 0;

				foreach($_SESSION['carrinho'] as $id => $qtd){
                        $sql   = "SELECT * FROM carrinho WHERE id= '$id'";
                        $consulta    = mysqli_query($conexao,$sql);
                        $exibirRegistros    = mysqli_fetch_array($consulta);
                        $nome  = $exibirRegistros['nome'];
                        $preco = number_format($exibirRegistros['preco'], 2, ',', '.');
                        $sub   = number_format($preco * $qtd, 2, ',', '.');
                        $total += $exibirRegistros['preco'] * $qtd;
                         echo '
                            <tr>       
                                <td>'.$nome.'</td>
                                <td><input type="text" size="3" name="prod['.$id.']" value="'.$qtd.'" /></td>
                                <td>R$ '.$preco.'</td>
                                <td>R$ '.$sub.'</td>
                                <td><a href="?acao=del&id='.$id.'">Remove</a></td>
                            </tr>';
						}
                }
                $total = number_format($total, 2, ',', '.');
                echo '<tr>                         
                            <td colspan="4">Total</td> 
							<td>R$ '.$total.'</td>
                    </tr>';
					
				$_SESSION['total']= $total;
			

                   ?>
        
         </tbody>
    </form>
 </table>
 
</body>
</html>