<?php  
	function CadastrarEquipe($usuario, $email, $senha, $tipoUsuario, $pagina){
		global $con;
		$sql = 'insert into tb_usuario set
				nm_usuario = ?,
				nm_email = ?,
				cd_senha = sha2(?, 256), 
				id_tipo_usuario = ?';
		$res = $con->prepare($sql);
		if($res===false){
			$res->close();
			Erro("erro ao preparar instrução");
		}
		if(!$res->bind_param('sssi', $usuario, $email, $senha, $tipoUsuario)){
			$res->close();
			Erro("erro ao receber parâmetros!");
		}
		if($res->execute()){
			$res->close();
			Confirma("Usuário cadastrado com sucesso!", $pagina);
		}
		else{
			$res->close();
			Erro("Usuário não cadastrado!");
		}
	}

	function EditarEquipe($id, $usuario, $email, $tipoUsuario, $pagina) {
		global $con;
		$sql = 'update tb_usuario set 
				nm_usuario = ?,
				nm_email = ?,
				id_tipo_usuario = ?
				where cd_usuario = ?';
		$res = $con->prepare($sql);
		if($res === false){
			$res->close();
			Erro("Erro ao preparar a instrução para editar!");
		}
		if(!$res->bind_param('ssii', $usuario, $email, $tipoUsuario, $id)){
			$res->close();
			Erro("Erro ao vincular os parâmetros para edição!");
		}
		if($res->execute()){
			$res->close();
			Confirma("Usuário editado com sucesso!", $pagina);
		} else {
			$res->close();
			Erro("Usuário não editado!");
		}
	}
	
	function ExcluirEquipe($id, $pagina) {
		global $con;
		$sql = 'delete from tb_usuario where cd_usuario = ?';
		$res = $con->prepare($sql);
		if($res === false){
			$res->close();
			Erro("Erro ao preparar a instrução para excluir!");
		}
		if(!$res->bind_param('i', $id)){
			$res->close();
			Erro("Erro ao vincular os parâmetros para exclusão!");
		}
		if($res->execute()){
			$res->close();
			Confirma("Usuário excluído com sucesso!", $pagina);
		} else {
			$res->close();
			Erro("Usuário não excluído!");
		}
	}
	

	function AlterarStatus($id, $status, $pagina){
		global $con;
		$sql='update tb_usuario set st_usuario = ? where cd_usuario = ?';
		$res = $con->prepare($sql);
		$res ->bind_param('si', $status, $id);
		if ($res->execute()){
			Confirma("Status alterado com sucesso!", $pagina);
		}

	}

	function TrocarSenha($id, $senha, $pagina) {
		global $con;
		$sql = 'update tb_usuario set cd_senha = sha2(?, 256) where cd_usuario = ?';
		$res = $con->prepare($sql);
		if($res === false){
			$res->close();
			Erro("Erro ao preparar a instrução para trocar a senha!");
		}
		if(!$res->bind_param('si', $senha, $id)){
			$res->close();
			Erro("Erro ao vincular os parâmetros para troca de senha!");
		}
		if($res->execute()){
			$res->close();
			Confirma("Senha alterada com sucesso!", $pagina);
		} else {
			$res->close();
			Erro("A senha não foi alterada!");
		}
	}
	

	function ListarEquipe(){
		global $con;

		$sql = 'select
				cd_usuario, nm_usuario, nm_email, st_usuario, dt_registro_usuario,
				id_tipo_usuario, nm_tipo_usuario
				from tb_usuario 
				inner join tb_tipo_usuario on id_tipo_usuario = cd_tipo_usuario
				order by nm_usuario asc';
		$res = $con->prepare($sql);
		$res->execute();
		$res->store_result();
		$res->bind_result($id, $usuario, $email, $status, $dataRegistro, $idTipo, $tipoUsuario);
		$listar = [];
		while($res->fetch()){
			$listar[] = [
				'id'			=>$id,
				'usuario'	=>$usuario,
				'email'		=>$email,
				'status'	=>$status,
				'data'		=>$dataRegistro,
				'idTipo' 	=>$idTipo,
				'tipo'		=>$tipoUsuario
			];
		}
		$res->close();
		return $listar;
	}

	function ListarTipoUsuario(){
		global $con;
		$sql = 'select cd_tipo_usuario, nm_tipo_usuario 
				from tb_tipo_usuario 
				order by nm_tipo_usuario asc';
		$res = $con->prepare($sql);
		$res->execute();
		$res->store_result();
		$res->bind_result($id, $tipoUsuario);
		$listar = [];
		while($res->fetch()){
			$listar[] = [
				'id'=>$id,
				'tipoUsuario'=>$tipoUsuario
			];
		}
		$res->close();
		return $listar;
	}




	// Functions para o tipo de usuário //

	function CadastrarTipoUsuario($tipoUsuario, $pagina){
		global $con;
		$sql = 'insert into tb_tipo_usuario set nm_tipo_usuario = ?';
		$res = $con->prepare($sql);
		if($res === false){
			$res->close();
			Erro("Erro ao preparar a instrução para cadastrar o tipo de usuário!");
		}
		if(!$res->bind_param('s', $tipoUsuario)){
			$res->close();
			Erro("Erro ao vincular os parâmetros para adicionar um novo tipo de usuário!");
		}
		if($res->execute()){
			$res->close();
			Confirma("Novo tipo de usuário adicionado!", $pagina);
		} else {
			$res->close();
			Erro("Não houve uma adição de tipo de usuário!");
		}

	}



	function AlterarTipoUsuario($id, $novoTipo, $pagina){
		global $con;
		$sql = 'UPDATE tb_tipo_usuario SET nm_tipo_usuario = ? WHERE cd_tipo_usuario = ?';
		$res = $con->prepare($sql);
		if($res === false){
			Erro("Erro ao preparar a instrução para alterar o tipo de usuário!");
		}
		if(!$res->bind_param('si', $novoTipo, $id)){
			$res->close();
			Erro("Erro ao vincular os parâmetros para alterar o tipo de usuário!");
		}
		if($res->execute()){
			$res->close();
			Confirma("Tipo de usuário alterado com sucesso!", $pagina);
		} else {
			$res->close();
			Erro("Tipo de usuário não alterado!");
		}
	}
	
	
	function ExcluirTipoUsuario($tipoUsuario, $pagina){
		global $con;
		$sql = 'DELETE FROM tb_tipo_usuario WHERE nm_tipo_usuario = ?';
		$res = $con->prepare($sql);
		if($res === false){
			Erro("Erro ao preparar a instrução para deletar o tipo de usuário!");
		}
		if(!$res->bind_param('s', $tipoUsuario)){
			$res->close();
			Erro("Erro ao vincular os parâmetros para deletar o tipo de usuário!");
		}
		if($res->execute()){
			$res->close();
			Confirma("Tipo de usuário excluído com sucesso!", $pagina);
		} else {
			$res->close();
			Erro("Tipo de usuário não excluído!");
		}
	}
	

	


?>