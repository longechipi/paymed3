//--------- FUNCION PARA CALCULAR EDAD AUTOMATICAMENTE ----------//
function calcedad(fecha) {
    jQuery.ajax({
        type: "POST",
        url: "../utils/calcula_edad.php",
        data: { fecha: fecha },
            success: function(data) {
                const edad = parseInt(data);
                document.getElementById("edad").value = data;
            }
    });
}
//////////////////////////////////////////////////////////////////