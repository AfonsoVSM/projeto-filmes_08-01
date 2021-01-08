<?php
	session_star();
	if ($_SERVER['REQUEST_METHOD']=="POST"){

		if(isset($_POST['user_name']) && isset ($_POST['password'])){
			$utilizador = $_POST['user_name'];
			$password = $_POST['password'];

			$con = new mysqli ("localhost", "root", "", "filmes");

			if ($con->connect_errno!=0){
				echo "Ocorreu um erro no acesso á base de dados. <br>" .$con->connect_errno;
				exit;
			}
			else{
				$sql = "Select *from utilizadores where user_name=? and password=?";
				$stm = $con->prepare ($sql);
				if ($stm!=false){
					$stm->execute();
					$res = $stm->get_result();
					if($res->num_rows==1){
						$_SESSION['login']="correto";
					}
					else{
						$_SESSION['login']="incorreto";
					}
					header("refresh:5; url=index.php");
				}
				else{
					echo "Ocorreu um erro no aceso á base de dados.<br> STM:".$con->connect_error;
					exit;
				}
			}
		}
	}