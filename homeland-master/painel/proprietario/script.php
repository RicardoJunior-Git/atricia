<script>
    $(document).on('click', '.editar' , function(){
        const{cd, proprietario, telefone, email, idCorretor} = $(this).data();
        const modal= $('.modal');
        modal.find("#cd").val(cd);
        modal.find("#proprietario").val(proprietario);
        modal.find("#telefone").val(telefone);
        modal.find("#email").val(email);
        modal.find("#idCorretor").val(idCorretor);
    });

    $(document).on('click', '.excluir',function(){
        var cd = $(this).attr('cd');
        $('.modal #cd').val(cd);
    });
</script>