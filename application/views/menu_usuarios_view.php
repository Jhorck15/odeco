<script>
    $(function () {
        $.get('<?php echo base_url("menu_usuarios/funcionario") ?>', function(funcionarios) {
            funcionario = $.parseJSON(funcionarios);
            $.each(funcionario, function(index, val) {
                $('#usuarios').append('<option value="'+val.id_funcionario+'">'+val.nombres+' '+val.apellidos+'- '+val.detallecargo+'</option>');
            });
        });

        $("body").on("submit", "#form_menu", function(e){
            e.preventDefault();
            $.ajax({
                url: "<?php echo base_url('menu_usuarios/savemenu')?>",
                type: "POST",
                dataType: 'JSON',
                data: $('#form_menu').serialize(),
                success: function(d) {
                    if (d.status) {
                        alert('Los datos fueron guardados correctamente');
                        window.location.href='<?php echo base_url() ?>login/inicio';
                    }
                    else {
                        alert("Error al guardar los datos");
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error al insertar los datos');
                }
            });
        });

        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });    
    });

    function editar_opciones(){
        var id_funcionario = $('select[name=usuarios]').val();
        var datos ={'id_funcionario':id_funcionario};
        $.ajax({
            data:datos,
            type:'POST',
            url:'<?php echo base_url()?>menu_usuarios/asignacionmenu',
            beforeSend:function(){},
            success:function(response){
                $('#opciones').html(response);
            }
        });
    }
</script>

<div class="panel panel-flat" id="eso">
    <div class="panel-heading">
        <h5 class="panel-title">ASIGNACIÓN DE MENÚ</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
            </ul>
        </div>
    </div>
    
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Menus: </label>
                    <select name="usuarios" id="usuarios" class="form-control" OnChange="editar_opciones();">
                        <option value="">Seleccione...</option>
                    </select>
                </div>
            </div>
        </div>        
    </div>

    <form id="form_menu">
        <div class="panel-body checkbox checkbox-switchery switchery-lg" id="opciones">
        </div>
    </form>
</div>
