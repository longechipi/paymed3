<?php
include('../layouts/header.php');
require('../conf/conexion.php');
?>

<div class="layout-wrapper layout-content-navbar">
<div class="layout-container">
<?php include("../layouts/menu.php"); ?>
<div class="layout-page">
<?php include("../layouts/navbar.php"); ?>

<div class="content-wrapper">
<div class="container-fluid flex-grow-1 container-p-y">
<div class="row">
<div class="col-lg-12 mb-12 order-0">
<div class="card">
<div class="d-flex align-items-end row">
<div class="col-12">
<div class="card-body">
<h5 class="card-title text-primary mb-3">Perfil</h5>

<div class="row">
<div class="col-xl-12">
	
<?php 
	if($privilegios == 2){
		include('../html/view/perfil/medico.php');
		include('../layouts/modals/add-horarios.php');
	}elseif($privilegios == 1){
		include('../html/view/perfil/admin.php');
	}else{
		include('../html/view/perfil/asistente.php');
	}

?>
</div>
</div>



</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php include('../layouts/footer.php') ?>
<div class="content-backdrop fade"></div>
</div>
</div>
</div>
<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>

<?php include('../layouts/script.php') ?>
<script>
$('#upd_datos').submit(function(e){
e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../model/perfil/udp_datos.php",
        data: $("#upd_datos").serialize(),
        success: function(data){
			console.log(data);
            // if(data == 1){
            //     Swal.fire({
            //         title: 'Registro Exitoso!',
            //         text: 'Se ha registrado correctamente la Clinica',
            //         icon: 'success',
            //         confirmButtonColor: "#007ebc",
            //         confirmButtonText: 'Aceptar'
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             window.location.href = "regcli.php";
            //         }
            //     });
            // }else{
            //     Swal.fire({
            //         title: 'Error!',
            //         text: 'Ocurrio un Error al Registrar la Clinica',
            //         icon: 'error',
            //         confirmButtonText: 'Aceptar'
            //     });
            // }
        }
    }) 
})

$('#form2').submit(function(e){
e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../model/perfil/upd_bancos.php",
        data: $("#form2").serialize(),
        success: function(data){
			console.log(data);
            // if(data == 1){
            //     Swal.fire({
            //         title: 'Registro Exitoso!',
            //         text: 'Se ha registrado correctamente la Clinica',
            //         icon: 'success',
            //         confirmButtonColor: "#007ebc",
            //         confirmButtonText: 'Aceptar'
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             window.location.href = "regcli.php";
            //         }
            //     });
            // }else{
            //     Swal.fire({
            //         title: 'Error!',
            //         text: 'Ocurrio un Error al Registrar la Clinica',
            //         icon: 'error',
            //         confirmButtonText: 'Aceptar'
            //     });
            // }
        }
    }) 
})

$("#idpais").change(function() {
		$.get("../model/reg_clinica/pais.php", "idpais=" + $("#idpais").val(), function(data) {
		$("#id_estado").html(data);
	});
});

$("#id_estado").change(function() {
		$.get("../model/reg_clinica/estado.php", "id_estado=" + $("#id_estado").val(), function(data) {
		$("#id_municipio").html(data);
	});
});

$("#id_municipio").change(function() {
		$.get("../model/reg_clinica/municipio.php", "id_municipio=" + $("#id_municipio").val(), function(data) {
		$("#id_parroquia").html(data);
	});
});

$('#id_estado, #id_parroquia, #id_municipio, #idpais, #idespmed').select2({
	theme: 'bootstrap-5',
	width: '100%',
});
$('#user').DataTable({
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
    });
	$('#user2').DataTable({
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
    });
	$('#user3').DataTable({
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
    });
</script>
</body>

</html>