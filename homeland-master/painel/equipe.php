<?php  
	require_once 'header.php';
	require_once './equipe/function.php';
	require_once './equipe/modal.php';
	require_once './equipe/script.php';
	$pagina = 'equipe.php';
?>
<style>
	.row{
		margin-bottom: 2%;
	}
</style>
<body>
	<div class="container-fluid">
		<?php require_once 'nav.php'; ?>
		<div class="row">
			<div class="col-sm-10">
				<h4 class="font-weight-bolder">
					Equipe
				</h4>
			</div>
			<div class="col-sm-2">
				<button 
					class="btn btn-primary btn-block"
					data-toggle="modal"
					data-target="#cadastrar"
					title="cadastrar membro da equipe">
					+ Equipe
				</button>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th class="text-center">ID</th>
								<th>Nome</th>
								<th>E-mail</th>
								<th class="text-center">Status</th>
								<th class="text-center">Registrado em</th>
								<th>Tipo</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						<?php  
							$listar = ListarEquipe();
							if(is_array($listar)){
								if(count($listar) > 0){
									foreach($listar as $l){
                                        if($l['status'] == "1"){
                                            $badge = 'badge-success';
                                            $flag = 'ativo';
                                        }
                                        else if($l['status'] == "0"){
                                            $badge = 'badge-danger';
                                            $flag = 'inativo';
                                        }
						?>
							<tr>
								<td class="text-center">
									<?php echo $l['id']; ?>
								</td>
								<td>
									<?php echo $l['usuario']; ?>
								</td>
								<td>
									<?php echo $l['email']; ?> 
								</td>
								<td class="text-center">
									<span class="badge <?php echo $badge; ?>">
										<?php echo $flag; ?>
									</span>
								</td>
								<td class="text-center">
									<?php echo date("d/m/y", strtotime($l['data'])); ?>
								</td>
								<td>
									<?php echo $l['tipo']; ?>
								</td>
								<td class="text-center">
									<button 
										class="btn btn-info editar" 
										title="editar"
										data-toggle="modal"
										data-target="#editar"
                                        data-cd="<?php echo $l['id']; ?>"
                                        data-usuario="<?php echo $l['usuario']; ?>"
                                        data-email="<?php echo $l['email']; ?>"
                                        data-tipo="<?php echo $l['idTipo']; ?>">
										<i class="bi bi-pencil"></i>
									</button>

									<button 
										class="btn btn-warning status" 
										title="status"
										data-toggle="modal"
										data-target="#status"
                                        cd="<?php echo $l['id']; ?>"
                                        status="<?php echo $l['status']; ?>">
										<i class="bi bi-arrow-clockwise"></i>
									</button>

									<button 
										class="btn btn-success senha" 
										title="senha"
										data-toggle="modal"
										data-target="#senha"
                                        cd="<?php echo $l['id']; ?>">
										<i class="bi bi-key-fill"></i>
									</button>

									<button 
										class="btn btn-danger excluir" 
										title="excluir"
										data-toggle="modal"
										data-target="#excluir"
                                        cd="<?php echo $l['id']; ?>">
										<i class="bi bi-trash3"></i>
									</button>

								</td>
							</tr>
						<?php  
									}
								}
								else{
									echo '<tr><td colspan="7">Sem registro</td></tr>';
								}
							}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 offset-sm-5">
				<a href="index.php" class="btn btn-outline-warning btn-block">
					voltar
				</a>
			</div>
		</div>
	</div>
	
<?php  
	if(!empty($_POST)){
		if($_POST['actionEquipe'] == "Cadastrar"){
			CadastrarEquipe(
				$_POST['usuario'],
				$_POST['email'],
				$_POST['senha'],
				$_POST['tipoUsuario'],
				$pagina
			);
		}
		else if($_POST['actionEquipe'] == 'Salvar'){
			EditarEquipe(
				$_POST['id_usuario'],
				$_POST['usuario'],
				$_POST['email'],
				$_POST['tipoUsuario'],
				$pagina
			);
		}
		else if($_POST['actionEquipe'] == 'Alterar'){
			AlterarStatus(
				$_POST['id_usuario'],
				$_POST['status'],
				$pagina
			);
		}
		else if($_POST['actionEquipe'] == 'Gerar Nova Senha'){
			if($_POST['senha'] == $_POST['confirm_senha']){
				TrocarSenha($_POST['id_usuario'], $_POST['senha'], $pagina);
			}
			else{
				Erro("As senhas digitadas não são iguais!");
			}
		}
		else if($_POST['actionEquipe'] == 'Excluir'){
			ExcluirEquipe($_POST['id_usuario'], $pagina);
		}
	}
?>
</body>
