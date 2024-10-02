$("#idpais").change(function(){				
    $.get("../utils/direcciones/estado.php","idpais="+$("#idpais").val(), function(data){
        $("#id_estado").html(data);
    });
});

$("#id_estado").change(function(){				
    $.get("../utils/direcciones/municipio.php","id_estado="+$("#id_estado").val(), function(data){
        $("#id_municipio").html(data);
    });
});

$("#id_municipio").change(function(){
    $.get("../utils/direcciones/parroquia.php","id_municipio="+$("#id_municipio").val(), function(data){
        $("#id_parroquia").html(data);
    });
});
//-------- SELECT 2 ---------//
$('#id_estado, #id_parroquia, #id_municipio, #idpais').select2({
    theme: 'bootstrap-5',
    width: '100%',
});