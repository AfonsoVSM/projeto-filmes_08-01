<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
	$titulo="";
	$sinopse="";
	$idioma="";
	$data_lancamento="";
	$quantidade=0;

	if(isset($_POST['titulo'])){
		$titulo=$_POST['titulo'];
	}
	else{
		echo '<script>alert("É obrigatorio o preenchimento do titulo.");</script>';
	}
	if(isset($_POST['sinopse'])){
		$sinopse = $_POST['sinopse'];
	}
	if(isset($_POST['quantidade']) && is_numeric($_POST['quantidade'])){
		$quantidade= $_POST['quantidade'];
	}
	if(isset($_POST['idioma'])){
		$idioma=$_POST['idioma'];
	}
	if(isset($_POST['data_lancamento'])){
		$data_lancamento=$_POST['data_lancamento'];
}
$con=new mysqli("localhost","root","","filmes");

if($con->connect_errno!=0){
	echo "Ocorreu um erro no acesso à base de dados.<br>".$con->connect_error;
	exit;
}
else{
	
	$sql='insert into filmes(titulo,sinopse,idioma,quantidade,data_lancamento)values(?,?,?,?,?)';
		$stm=$con->prepare( $sql);
		if($stm!=false){

			$stm->bind_param('sssis',$titulo,$sinopse,$idioma,$quantidade,$data_lancamento);
			$stm->execute();
			$stm->close();

			echo '<script>alert ("Livro adicionado com sucesso");</script>';

			echo 'Aguarde um momento.A reencaminhar página';
			header("refresh:5;url=index.php");
		}
		else{
			echo ($con->error);
			echo "Aguarde um momento.A reencaminhar página";
			header("refresh:5;url=index.php");
		}
		}//end if-if($con->connect_errno!=0)
}//if($_SERVER´['REQUEST_METHOD']=="POST")
else{ //else if($_SERVER['REQUEST_METHOD']=="POST")
  ?>

  	<!DOCTYPE html>
  	<html>
  	<head>
  		<meta charset="ISO_8859-1">
  		<title>Adicionar filmes</title>
  	</head>
  	<body>
  	<h1>Adicionar filmes</h1>
  	<form action="filmes_create.php" method="post">
  	<label>Titulo</label><input type="text" name="titulo" required><br>
  	<label>Sinopse</label><input type="text" name="sinopse"><br>
  	<label>Quantidade</label><input type="text" name="quantidade"><br>
  	<label>Idioma</label><input type="text" name="idioma"><br>
  	<label>Data lancamento</label><input type="date" name="data_lancamento"><br>
  	<input type="submit" name="enviar"><br>
  	</form>
  	</body>
  	</html>

<?php
 }//end if-if($_SERVER['REQUEST_METHOD']=="POST")
?>