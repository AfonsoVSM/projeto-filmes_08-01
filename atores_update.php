<?php

if($_SERVER['REQUEST_METHOD']='POST'){
	$nome="";
	$nacionalidade="";
	$data="";

	if(isset($_POST['nome'])){
		$nome=$_POST['nome'];
	}
	if(isset($_POST['nacionalidade'])){
		$sinopse = $_POST['nacionalidade'];
	}
	if(isset($_POST['data'])&& is_numeric($_POST['data'])){
		$data= $_POST['data'];

	}

$con = new mysqli("localhost","root","","atores");

if($con->connect_errno!=0){
	echo "Ocorreu um erro no acesso à base de dados.<br>". $con->connect_error;
	exit;
}
else{
	$sql="insert into atores(nome, nacionalidade,data(?,?,?);";
	$stm = $con->prepare ($sql);

	if($stm!=false){
		$stm->bind_param("ssssi",$nome,$nacionalidade,$data);
		$stm->execute();
		$stm->execute();
		$stm->close();

		echo '<script>alert("Ator alterado com sucesso!!");</script>';
		echo "Aguarde um momento.A reencaminhar página";
		header('refresh:5;url=index.php');

	}
	else{
}
	}
}
else{
	echo "<h1>Houve um erro ao processar o seu pedido! <br>Irá ser reencaminhado!</h1>";
	header("refresh:5; url=index.php");
}