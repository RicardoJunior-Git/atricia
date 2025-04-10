<div class="modal fade" id="cadastrar" data-backdrop="static">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<form method="post" class="form-group">
				<div class="modal-header">
					<h4 class="font-weight-bolder">
						Cadastrar
					</h4>
				</div>
				<div class="modal-body">
					<input 
						type="text" 
						name="usuario"
						class="form-control"
						placeholder="Nome do usuário"
						required>
					<br>
					<input 
						type="email"
						name="email"
						class="form-control"
						placeholder="E-mail do usuário"
						required>
					<br>
					<input 
						type="password"
						name="senha"
						class="form-control"
						placeholder="Senha do usuário"
						required>
					<br>
					<select name="tipoUsuario" class="form-control">
						<option disabled selected>Selecione...</option>
						<?php  
							$listar = ListarTipoUsuario();
							if(is_array($listar)){
								if(count($listar) > 0){
									foreach($listar as $l){
						?>
										<option value="<?php echo $l['id']; ?>">
											<?php echo $l['tipoUsuario']; ?>
										</option>
						<?php  
									}
								}
							}
						?>
					</select>
				</div>

				<div class="modal-footer">
					<button 
						class="btn btn-secondary" 
						data-dismiss="modal">Fechar
					</button>
					<input 
						type="submit"
						class="btn btn-primary"
						name="actionEquipe"
						value="Cadastrar">
				</div>

			</form>
		</div>
	</div>
</div>



<div class="modal fade" id="editar" data-backdrop="static">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<form method="post" class="form-group">
				<div class="modal-header">
					<h4 class="font-weight-bolder">
						Alterar
					</h4>
				</div>
				<div class="modal-body">
					<input 
						type="text" 
						name="id_usuario"
						class="form-control"
						placeholder="Id do usuário"
						required>
					<br>

					<input 
						type="text" 
						name="usuario"
						class="form-control"
						placeholder="Nome do usuário"
						required>
					<br>

					<input 
						type="email"
						name="email"
						class="form-control"
						placeholder="E-mail do usuário"
						required>
					<br>

					
					<select name="tipoUsuario" class="form-control">
						<option disabled selected>Selecione...</option>
						<?php  
							$listar = ListarTipoUsuario();
							if(is_array($listar)){
								if(count($listar) > 0){
									foreach($listar as $l){
						?>
										<option value="<?php echo $l['id']; ?>">
											<?php echo $l['tipoUsuario']; ?>
										</option>
						<?php  
									}
								}
							}
						?>
					</select>
				</div>

				<div class="modal-footer">
					<button 
						class="btn btn-secondary" 
						data-dismiss="modal">Fechar
					</button>
					<input 
						type="submit"
						class="btn btn-info editar"
						name="actionEquipe"
						value="Salvar">
				</div>

			</form>
		</div>
	</div>
</div>




<div class="modal fade" id="status" data-backdrop="static">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<form method="post" class="form-group">
				<div class="modal-header">
					<h4 class="font-weight-bolder">
						Alterar Status
					</h4>
				</div>
				<div class="modal-body">
					<input 
						type="text" 
						name="id_usuario"
						class="form-control"
						placeholder="Id do usuário:"
						required>
				
					<select name="status" class="form-control">
						<option disabled selected>Selecione...</option>
						<option value="1">Ativo</option>
						<option value="0">Inativo</option>
					</select>
				</div>

				<div class="modal-footer">
					<button 
						class="btn btn-secondary" 
						data-dismiss="modal">Fechar
					</button>
					<input 
						type="submit"
						class="btn btn-warning alterar"
						name="actionEquipe"
						value="Alterar">
				</div>

			</form>
		</div>
	</div>
</div>




<div class="modal fade" id="senha" data-backdrop="static">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<form method="post" class="form-group">
				<div class="modal-header">
					<h4 class="font-weight-bolder">
						Gerar Nova Senha
					</h4>
				</div>
				<div class="modal-body">
					<input 
						type="text" 
						name="id_usuario"
						class="form-control"
						placeholder="Id do usuário"
						required>
					<br>
					<input 
						type="password"
						name="senha"
						class="form-control"
						placeholder="Digite a nova senha"
						required>
					<br>
					<input 
						type="password"
						name="confirm_senha"
						class="form-control"
						placeholder="Redigite a nova senha"
						required>
				</div>

				<div class="modal-footer">
					<button 
						class="btn btn-secondary" 
						data-dismiss="modal">Fechar
					</button>
					<input 
						type="submit"
						class="btn btn-success"
						name="actionEquipe"
						value="Gerar Nova Senha">
				</div>

			</form>
		</div>
	</div>
</div>







<div class="modal fade" id="excluir" data-backdrop="static">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<form method="post" class="form-group">
				<div class="modal-header">
					<h4 class="font-weight-bolder">
						Excluir Usuário
					</h4>
				</div>
				<div class="modal-body">
					<input 
						type="text" 
						name="id_usuario"
						class="form-control"
						placeholder="Id do usuário"
						required>
					<br>
					<p style="color:red;">Deseja realmente excluir esse item?</p>
				</div>
				<div class="modal-footer">
					<button 
						class="btn btn-secondary" 
						data-dismiss="modal">Fechar
					</button>
					<input 
						type="submit"
						class="btn btn-danger excluir"
						name="actionEquipe"
						value="Excluir">
				</div>
			</form>
		</div>
	</div>
</div>


<!-- Modal para Cadastrar Tipo de Usuário -->
<div class="modal fade" id="modalCadastrarTipo" tabindex="-1" role="dialog" aria-labelledby="modalCadastrarTipoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" action="tipo_usuario.php">
          <div class="modal-header">
            <h5 class="modal-title" id="modalCadastrarTipoLabel">Cadastrar Tipo de Usuário</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="form-group">
                  <label for="tipoUsuario">Tipo de Usuário</label>
                  <input type="text" class="form-control" name="tipoUsuario" id="tipoUsuario" required>
              </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="actionTipo" value="CadastrarTipo">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
          </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal para Alterar Tipo de Usuário -->
<div class="modal fade" id="modalAlterarTipo" tabindex="-1" role="dialog" aria-labelledby="modalAlterarTipoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" action="tipo_usuario.php">
          <div class="modal-header">
            <h5 class="modal-title" id="modalAlterarTipoLabel">Alterar Tipo de Usuário</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="form-group">
                  <label for="novoTipo">Novo Tipo de Usuário</label>
                  <input type="text" class="form-control" name="novoTipo" id="novoTipo" required>
              </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="id" id="tipoId">
            <input type="hidden" name="actionTipo" value="AlterarTipo">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Salvar Alteração</button>
          </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal para Excluir Tipo de Usuário -->
<div class="modal fade" id="modalExcluirTipo" tabindex="-1" role="dialog" aria-labelledby="modalExcluirTipoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" action="tipo_usuario.php">
          <div class="modal-header">
            <h5 class="modal-title" id="modalExcluirTipoLabel">Excluir Tipo de Usuário</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <p>Tem certeza que deseja excluir o tipo de usuário: <strong id="tipoExcluirNome"></strong>?</p>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="tipoUsuario" id="tipoExcluirValor">
            <input type="hidden" name="actionTipo" value="ExcluirTipo">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-danger">Excluir</button>
          </div>
      </form>
    </div>
  </div>
</div>