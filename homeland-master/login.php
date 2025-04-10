<?php  
	require_once 'header.php';
	require_once 'conect.php';
	require_once 'validar.php';
	
?>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4 offset-sm-4">
				<div class="card">
					<div class="card-header text-center bg-white">
						<img src="images/moleza-semfundo.png" class="img-fluid" alt="">
					</div>
					<div class="card-body">
						<form method="post" class="form-group">
							<input 
								type="email" 
								class="form-control" 
								name="email" 
								placeholder="seu e-mail" 
								required>
							<br>
							<input 
								type="password"
								class="form-control"
								name="senha"
								placeholder="sua senha"
								required>
							<br>
							<input 
								type="submit"
								class="btn btn-success btn-block text-white"
								name="action"
								value="Entrar"> 
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php  
		if(!empty($_POST)){
			if($_POST['action'] == "Entrar"){
				ValidarLogin($_POST['email'], $_POST['senha']);
			}
		}
	?>
	
</body>