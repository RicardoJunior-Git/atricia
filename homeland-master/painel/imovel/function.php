<?php  
	function CadastrarImovel($nm_endereço, $nr_Imovel, $ds_complemento, $nm_bairro, $id_cidade, 
	$cd_postal, $id_tipo_imovel, $qt_suite, $qt_sala_estar, $qt_quarto, $qt_banheiro, $qt_lavabo, 
	$qt_vaga_garagem, $qt_sala_jantar, $qt_cozinha, $ic_area_externa, $ic_piscina, $ic_edicula, $ic_churrasqueira,
	$ds_imovel, $id_proprietario, $ds_imovel, $id_proprietario, $dt_registro_imovel, $id_usuario_registro,
	$cd_senha, $id_tipo_usuario){
		global $con;	
		$sql = 'insert into tb_imovel set
				nm_endereço = ?,
				nr_Imovel = ?,
				ds_complemento,
				nm_bairro varchar(80) not null,
				id_cidade int not null,
				cd_postal varchar(10) not null,
				id_tipo_imovel tinyint not null,
				qt_suite tinyint default '0',
				qt_sala_estar tinyint default '0',
				qt_quarto tinyint default '0',
				qt_banheiro tinyint default '0',
				qt_lavabo tinyint default '0',
				qt_vaga_garagem tinyint default '0',
				qt_sala_jantar tinyint default '0',
				qt_cozinha tinyint default '0',
				ic_area_externa char(1) default '0',
				ic_piscina char(1) default '0',
				ic_edicula char(1) default '0',
				ic_churrasqueira char(1) default '0',
				ds_imovel longtext not null,
				id_proprietario int not null,
				dt_registro_imovel datetime not null default current_timestamp,
				id_usuario_registro smallint not null,
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

	function ListarTipoImovel(){
		global $con;
		$sql = 'select cd_tipo_imovel, nm_tipo_imovel
				from tb_tipo_imovel 
				order by nm_tipo_imovel asc';
		$res = $con->prepare($sql);
		$res->execute();
		$res->store_result();
		$res->bind_result($id, $tipoImovel);
		$listar = [];
		while($res->fetch()){
			$listar[] = [
				'id'=>$id,
				'tipoImovel'=>$tipoImovel
			];
		}
		$res->close();
		return $listar;
	}

	function ListarCorretor(){
		global $con;

		$sql = 'select
				cd_usuario, nm_usuario
				from tb_usuario
				where
				id_tipo_usuario = 2';
		$res = $con->prepare($sql);
		$res->execute();
		$res->store_result();
		$res->bind_result($id, $corretor);
		$listar = [];
		while($res->fetch()){
			$listar[] = [
				'id'			=>$id,
				'corretot'	=>$corretor
			];
		}
		$res->close();
		return $listar;
	}


	// Functions para o tipo de usuário //

	function CadastrarTipoIomvel($tipoImovel, $pagina){
		global $con;
		$sql = 'insert into tb_tipo_imovel set nm_tipo_imovel = ?';
		$res = $con->prepare($sql);
		if($res === false){
			$res->close();
			Erro("Erro ao preparar a instrução para cadastrar o tipo de imovel!");
		}
		if(!$res->bind_param('s', $tipoImovel)){
			$res->close();
			Erro("Erro ao vincular os parâmetros para adicionar um novo tipo de imovel!");
		}
		if($res->execute()){
			$res->close();
			Confirma("Novo tipo de imovel adicionado!", $pagina);
		} else {
			$res->close();
			Erro("Não houve uma adição de tipo de imovel!");
		}

	}

	function AlterarTipoImovel($id, $novoTipo, $pagina){
		global $con;
		$sql = 'UPDATE tb_tipo_imovel SET nm_tipo_imovel = ? WHERE cd_tipo_imovel = ?';
		$res = $con->prepare($sql);
		if($res === false){
			Erro("Erro ao preparar a instrução para alterar o tipo de imovel!");
		}
		if(!$res->bind_param('si', $novoTipo, $id)){
			$res->close();
			Erro("Erro ao vincular os parâmetros para alterar o tipo de imovel!");
		}
		if($res->execute()){
			$res->close();
			Confirma("Tipo de imovel alterado com sucesso!", $pagina);
		} else {
			$res->close();
			Erro("Tipo de imovel não alterado!");
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