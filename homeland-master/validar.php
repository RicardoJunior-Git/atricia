<?php 
	function ValidarLogin($email, $senha){
		global $con;

		$sql = 'select cd_usuario, nm_usuario
				from tb_usuario 
				where
				nm_email = ? and 
				cd_senha = sha2(?, 256) and
				st_usuario = 1';
		$res = $con->prepare($sql);
		if($res===false){
			$res->close();
			die("Erro ao conectar " . $con->error);
		}
		if(!$res->bind_param('ss', $email, $senha)){
			$res->close();
			die("Erro ao receber parâmetros " . $res->error);
		}
		if(!$res->execute()){
			$res->close();
			die("erro ao executar " . $con->error);
		}
		if($res->bind_result($id, $usuario)){
			if($res->fetch()){
				session_start();
				$_SESSION['id'] = $id;
				$_SESSION['usuario'] = $usuario;
				Confirma("Bem vindo ".$usuario, "painel/index.php");
			}
			else{
				$res->close();
				Erro("Erro ao tentar login!");
			}
		}
	}

	function Confirma($msg, $pagina){
		echo '
			<script>
				alert("'.$msg.'");
				location.href = "'.$pagina.'";
			</script>
		 ';
	}

	function Erro($msg){
		echo '
			<script>
				alert("'.$msg.'");
				history.go(-1);
			</script>
		 ';
	}
?>