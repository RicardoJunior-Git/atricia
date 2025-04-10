<script>
    $(document).on('click', '.editar' , function(){
        const{cd, usuario, email, tipo} = $(this).data();
        const modal= $('.modal');
        modal.find("#cd").val(cd);
        modal.find("#usuario").val(usuario);
        modal.find("#email").val(email);
        modal.find("#tipoUsuario").val(tipo);
    });


    $(document).on('click', '.status',function(){
        var cd = $(this).attr('cd');
        var status = $(this).attr('status');
        $('.modal #cd').val(cd);
        $('.modal #status').val(status);

    });

    $(document).on('click', '.senha',function(){
        var cd = $(this).attr('cd');
        $('.modal #cd').val(cd);
    });

    $(document).on('click', '.excluir',function(){
        var cd = $(this).attr('cd');
        $('.modal #cd').val(cd);
    });

</script>