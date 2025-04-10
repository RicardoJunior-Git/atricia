<?php 
require_once 'header.php';
require_once './imovel/function.php';
// Modal e script específicos foram incorporados neste arquivo
$pagina = 'tipo_imovel.php';
?>

<style>
    .row {
        margin-bottom: 2%;
    }
</style>
<body>
<div class="container-fluid">
    <?php require_once 'nav.php'; ?>
    <div class="row">  
        <div class="col-sm-10"> <!-- o sm seria o breakpoint small para o design responsivo -->
            <h4 class="font-weight-bolder">
                Tipos de Imovel
            </h4>
        </div>
        <div class="col-sm-2">
            <button 
                class="btn btn-primary btn-block"
                data-toggle="modal"
                data-target="#modalCadastrarTipo"
                title="Cadastrar tipo de usuário">
                Cadastrar Tipo de Imovel
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
                            <th>Tipo de Imóvel</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php  
                        $listar = ListarTipoImovel();
                        if(is_array($listar)){
                            if(count($listar) > 0){
                                foreach($listar as $l){
                    ?>
                        <tr>
                            <td class="text-center">
                                <?php echo $l['id']; ?>
                            </td>
                            <td>
                                <?php echo $l['tipoImovel']; ?>
                            </td>
                            <td class="text-center">
                                <button 
                                    class="btn btn-info editarTipo" 
                                    title="editar"
                                    data-toggle="modal"
                                    data-target="#modalAlterarTipo"
                                    data-id="<?php echo $l['id']; ?>"
                                    data-tipo="<?php echo $l['tipoImovel']; ?>">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button 
                                    class="btn btn-danger excluirTipo" 
                                    title="excluir"
                                    data-toggle="modal"
                                    data-target="#modalExcluirTipo"
                                    data-tipo="<?php echo $l['tipoImovel']; ?>">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </td>
                        </tr>
                    <?php  
                                }
                            } else {
                                echo '<tr><td colspan="3" class="text-center">Sem registro</td></tr>';
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
                Voltar
            </a>
        </div>
    </div>
</div>



<!-- Scripts para preencher os modais com os dados do botão clicado -->
<script>
// Preencher dados no modal de Alterar
$('#modalAlterarTipo').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget); 
  var id = button.data('id'); 
  var tipo = button.data('tipo'); 

  var modal = $(this);
  modal.find('#tipoId').val(id);
  modal.find('#novoTipo').val(tipo);
});

// Preencher dados no modal de Excluir
$('#modalExcluirTipo').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var tipo = button.data('tipo');

  var modal = $(this);
  modal.find('#tipoExcluirNome').text(tipo);
  modal.find('#tipoExcluirValor').val(tipo);
});
</script>

<?php  
if(!empty($_POST)){
    if(isset($_POST['actionTipo'])){
        if($_POST['actionTipo'] == "CadastrarTipo"){
            CadastrarTipoUsuario(
                $_POST['tipoUsuario'],
                $pagina
            );
        }
        else if($_POST['actionTipo'] == "AlterarTipo"){
            AlterarTipoUsuario(
                $_POST['id'],
                $_POST['novoTipo'],
                $pagina
            );
        }
        else if($_POST['actionTipo'] == "ExcluirTipo"){
            ExcluirTipoUsuario(
                $_POST['tipoUsuario'],
                $pagina
            );
        }
    }
}
?>
<!-- Inclua os modais -->
<?php require_once './equipe/modal.php'; ?>

</body>
