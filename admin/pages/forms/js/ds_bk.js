 $(document).ready(function() {
   
   $("#idaseg").change(function() {
      $.get("segserv_js.php", "idaseg=" + $("#idaseg").val(), function(data) {
         $("#idservaf").html(data);
         console.log(data);
      });
   });

   $("#iidaseg").change(function() {
      
      $.get("regservxaseg_js.php", "idaseg=" + $("#iidaseg").val(), function(data) {
         $("#idservaf").html(data);
         console.log(data);
      });
      /**/
      const iidaseg=$("#iidaseg").val();
      jQuery.ajax({
                 type: "POST",  
                 url: "tblserxaseg_js.php",
                 async: false,
                  data: {iidaseg: iidaseg},
                 success:function(data){
                  console.log(data);
               
                  document.getElementById("tablaservicios").innerHTML = data;
                 },
                  error:function (){}
                });
   });

});

 function fdelserv(idaseg, idservaf) {
   // Eliminar servicio de la aseguradora
   
   jQuery.ajax({
                 type: "POST",  
                 url: "delserxaseg_js.php",
                 async: false,
                  data: {idaseg: idaseg, idservaf: idservaf},
                 success:function(data){
                  console.log(data);
                  //alert(data);
                 },
                  error:function (){}
                });
   armatablaserxaseg(idaseg);
 }
   / *   */
   function fregservxaseg(id) {
      const iidaseg = document.getElementById("iidaseg").value;
      const idservaf = document.getElementById("idservaf").value;
      
      jQuery.ajax({
                 type: "POST",  
                 url: "registservxaseg_js.php",
                 async: false,
                  data: {iidaseg: iidaseg, idservaf: idservaf},
                 success:function(data){
                  console.log(data);
                  
                 },
                  error:function (){}
                });
      armatablaserxaseg(iidaseg);
   }
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
 function armatablaserxaseg(idaseg) {
    // Arma Tabla de Servicios X Aseguradora
   //
   jQuery.ajax({
                 type: "POST",  
                 url: "armatblserxaseg_js.php",
                 async: false,
                  data: {idaseg: idaseg},
                 success:function(data){
                  console.log(data);
                  document.getElementById("tablaservicios").innerHTML = data;
                 },
                  error:function (){}
                });
 } // End Function

 /* - - - - - - - - - - - - - - - - - - -*/
 function faproprov(idprov) {
   btnaprobarx='btnaprobar'+idprov;
   
   Swal.fire({
              title: 'Seguro Aprobar?',
              text: "...",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si'
            }).then((result) => {
              if (result.isConfirmed) {
               /*. . . . . . . . . . . */
               jQuery.ajax({
                  type: "POST",  
                  url: "aprobprovee_js.php",
                  async: false,
                  data: {idprov: idprov},
                  success:function(data){
                     console.log(data);
                     if (data=='1') {
                        conf=true;
                     }
                  },
                  error:function (){}
               }); // end jQuery
               /* . . . . . . . . .*/
                Swal.fire(
                  'Aprobado!',
                  'Proveedor...',
                  'success'
                );document.getElementById(`${btnaprobarx}`).disabled = true;
              }
            }) // end SweetAlert  if (conf) {location.reload(); }
            
 } // End Function
 /*. . . . . . . . . . . . . . . . . . . . . . . . . . */
 function fvalidrif(nrorif) {
       const tprif = document.getElementById("tprif").value;
       const rif = tprif+nrorif;

       jQuery.ajax({
         type: "POST",  
         url: "validrif_js.php",
         async: false,
         data: {rif: rif},
         success:function(data){
            console.log(data);
            
            if (data=='1') {
               document.getElementById("rif").value="";
               document.getElementById("tprif").focus();
               Swal.fire(
                  'RIF',
                  'Ya Registrado!!!',
                  'error'
               )
            }
         },
         error:function (){}
   }); // end jQuery
 }

 function fregesp(id) {
   const idprov = document.getElementById("idprov").value;

   jQuery.ajax({
         type: "POST",  
         url: "regespprov_js.php",
         async: false,
         data: {idprov: idprov, id: id},
         success:function(data){
            console.log(data);
         },
         error:function (){}
   }); // end jQuery
 }

 /* Validacion de horario de Medico (updhorar.php) */
 function hvalidacion() {
            const pacxdia =  parseInt(document.getElementById('pacxdia').value);
            const pacconseg =  parseInt(document.getElementById('pacconseg').value);
            const pacsinseg =  parseInt(document.getElementById('pacsinseg').value);
            const totpacientes =pacconseg+pacsinseg;
            if (pacxdia!=totpacientes) { 
                Swal.fire({
                icon: 'error',
                title: 'Cantidad Pacientes'
                })
                return false;
            }
            const validado = validahoras();
            if (!validado) {
               Swal.fire({
                icon: 'error',
                title: 'Error En Horas'
                })
                return false;
            }
            
        } // fin hvalidacion

        function validahoras(argument) {
           /* Valida las hora de los dias, Desde y/o Hasta */
            const dlunes =  parseInt(document.getElementById('dlunes').value);
            const hlunes =  parseInt(document.getElementById('hlunes').value);
            const dmartes =  parseInt(document.getElementById('dmartes').value);
            const hmartes =  parseInt(document.getElementById('hmartes').value);
            const dmiercoles =  parseInt(document.getElementById('dmiercoles').value);
            const hmiercoles =  parseInt(document.getElementById('hmiercoles').value);
            const djueves =  parseInt(document.getElementById('djueves').value);
            const hjueves =  parseInt(document.getElementById('hjueves').value);
            const dviernes =  parseInt(document.getElementById('dviernes').value);
            const hviernes =  parseInt(document.getElementById('hviernes').value);
            const dsabado =  parseInt(document.getElementById('dsabado').value);
            const hsabado =  parseInt(document.getElementById('hsabado').value);
            const ddomingo =  parseInt(document.getElementById('ddomingo').value);
            const hdomingo =  parseInt(document.getElementById('hdomingo').value);
            
            if (!isNaN(dlunes) && !isNaN(hlunes)){
               if (hlunes<=dlunes) {
                  document.getElementById('dlunes').value='';
                  document.getElementById('hlunes').value='';
                  return false;
               }
            }else if(isNaN(dlunes) && !isNaN(hlunes)){
               return false;
            }else if(!isNaN(dlunes) && isNaN(hlunes)){
                  return false;
            }
            

            if (!isNaN(dmartes) && !isNaN(hmartes)){
               if (hmartes<=dmartes) {
                  document.getElementById('dmartes').value='';
                  document.getElementById('hmartes').value='';
                  return false;
               }
            }else if(isNaN(dmartes) && !isNaN(hmartes)){
               return false;
            }else if(!isNaN(dmartes) && isNaN(hmartes)){
               return false;
            }
            
            if (!isNaN(dmiercoles) && !isNaN(hmiercoles)){
               if (hmiercoles<=dmiercoles) {
                  document.getElementById('dmiercoles').value='';
                  document.getElementById('hmiercoles').value='';
                  return false;
               }
            }else if(isNaN(dmiercoles) && !isNaN(hmiercoles)){
               return false;
            }else if(!isNaN(dmiercoles) && isNaN(hmiercoles)){
               return false;
            }


            if (!isNaN(djueves) && !isNaN(hjueves)){
               if (hjueves<=djueves) {
                  document.getElementById('djueves').value='';
                  document.getElementById('hjueves').value='';
                  return false;
               }
            }else if(isNaN(djueves) && !isNaN(hjueves)){return false;}else if(!isNaN(djueves) && isNaN(hjueves)){return false;}

            if (!isNaN(dviernes) && !isNaN(hviernes)){
               if (hviernes<=dviernes) {
                  document.getElementById('dviernes').value='';
                  document.getElementById('hviernes').value='';
                  return false;
               }
            }else if(isNaN(dviernes) && !isNaN(hviernes)){return false;}else if(!isNaN(dviernes) && isNaN(hviernes)){return false;}


            if (!isNaN(dsabado) && !isNaN(hsabado)){
               if (hsabado<=dsabado) {
                  document.getElementById('dsabado').value='';
                  document.getElementById('hsabado').value='';
                  return false;
               }
            }else if(isNaN(dsabado) && !isNaN(hsabado)){return false;}else if(!isNaN(dsabado) && isNaN(hsabado)){return false;}

            if (!isNaN(ddomingo) && !isNaN(hdomingo)){
               if (hdomingo<=ddomingo) {
                  document.getElementById('ddomingo').value='';
                  document.getElementById('hdomingo').value='';
                  return false;
               }
            }else if(isNaN(ddomingo) && !isNaN(hdomingo)){return false;}else if(!isNaN(ddomingo) && isNaN(hdomingo)){return false;}
            /* Ori
            if (!isNaN(dmartes) && !isNaN(hmartes)){alert('Bien'); return true;
            }else if(isNaN(dmartes) && !isNaN(hmartes)){alert('error 1'); return false;
            }else if(!isNaN(dmartes) && isNaN(hmartes)){alert('error 2'); return false;} */
            return true;
        }

/* Valido Fecha de Sintomatologia no sea menor a la actual (reghist.php) */
function verifecha(params) {
   const fecsint =document.getElementById('fecsint').value;
   
   const date1 = new Date(fecsint);
   const date2 = new Date();
   if (date1.getTime()>date2.getTime()){
      Swal.fire({
         icon: 'error',
         title: 'Error En Fecha'
         });
         document.getElementById('fecsint').value='';
         return false;
   } 
   
}
function verfeccita(idcita) { // verifica si la cita es la fecha actual, para preguntar si desea cambiarla para dia aactual
   
   jQuery.ajax({
      type: "POST",  
      url: "verfeccita_js.php",
      async: false,
      data: {idcita: idcita},
      success:function(data){
         console.log(data);
         if (data=='1') {
            Swal.fire({
               title: 'Fecha Mayor a la Actual',
               text: "Cita Se Registrara Con La Fecha Actual !",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Continuar'
             }).then((result) => {
               if (result.isConfirmed) {
                 //Swal.fire('Deleted!','Your file has been deleted.','success')
                 window.location.href="reghist.php?pac="+idcita; // Fecha Mayor
               }
             })
         }else if(data=='0'){
            window.location.href="reghist.php?pac="+idcita;  // Fecha Igual
         }
      },
      error:function (){}
}); // end jQuery
   //return false;
}

function showerrormess() { // Muestra mensaje que opcion esta fuera de fecha
   Swal.fire({
      icon: 'error',
      title: 'Error: Fuera De Fecha'
      });return false;
}

/*    */ 
function fdelmedicina(id) { // Elimina medicamento del informe medico (reghist_3.php)

   jQuery.ajax({
              type: "POST",  
              url: "delmedicina_js.php",
              async: false,
               data: {id: id},
              success:function(data){
               console.log(data);
               
               //document.getElementById("tablaservicios").innerHTML = data;
              },
               error:function (){}
             });
             location.reload();
}

//function faddimagenologia() {
//   const codestudiotext=document.getElementById("codestudio").value;

//}
/*   add examen Imagenologia    */
var btnaddexamimg = document.getElementById('btnaddexamimg');
   btnaddexamimg.addEventListener('click',
  function(){
    //var selectedOption = this.options[select.selectedIndex]; var estudio = selectedOption.text; var codestudio = selectedOption.value;
    var codestudio = document.getElementById("codestudio").value;
    var options=document.getElementsByTagName("option");
    var sel = document.getElementById("codestudio");
    var estudio= sel.options[sel.selectedIndex].text;    
    
    var idpac = document.getElementById("idpac").value;
    var idcita = document.getElementById("idcita").value;
    var codserv = document.getElementById("codserv").value;
    var codzona = document.getElementById("codzona").value;

    //console.log(selectedOption.value + ': ' + selectedOption.text);
   idxexamen='';
   // ajax para registrar examen de imagen
   jQuery.ajax({
      type: "POST",  
      url: "regexaimg_js.php",
      async: false,
       data: {idpac: idpac, idcita: idcita, codserv: codserv, codzona: codzona, codestudio: codestudio, tipo: 'Imagenologia'},
      success:function(data){
       console.log(data);
       idxexamen=data;
       
       //document.getElementById("tablaservicios").innerHTML = data;
      },
       error:function (){}
     });
     //location.reload();
   // fin ajax
   if (idxexamen=='0') { //ya registrado
      return false;
    }
   var row = document.getElementById("rowtblimagenologia");
   var x = row.insertCell(-1);
   x.innerHTML = "<button type='button' id='"+idxexamen+"'class='btn btn-danger' onclick='delxexamen(this.id)' ><i class='fa fa-trash'></i></button><strong> -"+estudio+".</strong>";
   
  }); // End addEventListener

/*---- Elimina Examen Imagenologia -----*/
function delxexamen(id) {
   var idpac = document.getElementById("idpac").value;
   var idcita = document.getElementById("idcita").value;
   // ajax para Eliminar examen de imagen
   jQuery.ajax({
      type: "POST",  
      url: "delexaimg_js.php",
      async: false,
       data: {id: id, idpac: idpac, idcita: idcita, tipo:'Imagenologia'},
      success:function(data){
       console.log(data);
       datos1 = []; 
       datos1= data;
      
       //document.getElementById("tablaservicios").innerHTML = data;
      },
       error:function (){}
     });// fin ajax
      document.getElementById("tblimagenologia").deleteRow(0);

      var table = document.getElementById("tblimagenologia");
      // Create an empty <tr> element and add it to the 1st position of the table:
      var row = table.insertRow(0);
      row.id = "rowtblimagenologia";
      //row.setAttribute("id", rowtblimagenologia);
      
     //var row = document.getElementById("rowtblimagenologia");
     
     const alldatos = datos1.split('|');
     
      for (let i = 0; i < alldatos.length-1; i++) {
         console.log(alldatos[i]);

         const allcampos = alldatos[i].split(';');
         const idxexamen=allcampos[0];
         const estudio=allcampos[1];

         //console.log(allcampos[0]);
         //console.log(allcampos[1]);

         //var x = row.insertCell(-1);
         //x.innerHTML = "<button type='button' id='"+idxexamen+"'class='btn btn-danger' onclick='delxexamen(this.id)' ><i class='fa fa-trash'></i></button><strong> -"+estudio+"</strong>";
         var cell1 = row.insertCell(0);
         cell1.innerHTML = "<button type='button' id='"+idxexamen+"'class='btn btn-danger' onclick='delxexamen(this.id)' ><i class='fa fa-trash'></i></button><strong> -"+estudio+".</strong>";        
         /*if (document.getElementById("rowtblimagenologia") !== null) {alert("The element exists");}else {alert("The element does not exist");}*/         
      }
     /*
     var table = document.getElementById("tblimagenologia");
     var row = table.insertRow(0);
     var cell1 = row.insertCell(0);
     cell1.innerHTML = "NEW CELL1";*/
     //location.reload();  
}

/* Boton Add  Examen laboratorio */
/*var selectlabb = document.getElementById('selectlab');
selectlabb.addEventListener('change', */
var btnaddexam = document.getElementById('btnaddexam');
btnaddexam.addEventListener('click',
  function(){ 
    //var selectedOption = this.options[select.selectedIndex];var idlab = selectedOption.value;var nombre = selectedOption.text;
    var idlab = document.getElementById("selectlab").value;
    var options=document.getElementsByTagName("option");
    var sel = document.getElementById("selectlab");
    var nombre= sel.options[sel.selectedIndex].text;    
    var idpac = document.getElementById("idpac").value;
    var idcita = document.getElementById("idcita").value;
    //console.log(selectedOption.value + ': ' + selectedOption.text);
   // ajax para registrar examen de Laboratorio
   
   jQuery.ajax({
      type: "POST",  
      url: "regexaimg_js.php",
      async: false,
       data: {idpac: idpac, idcita: idcita, idlab: idlab, nombre: nombre, tipo: 'Laboratorio'},
      success:function(data){
       console.log(data);
       esta=data;
       //document.getElementById("titulolab").style.visibility = "hidden";
      },
       error:function (){}
     });
     //location.reload();
   // fin ajax
   if (esta=='0') { //ya registrado
      return false;
    }
   var row = document.getElementById("rowtbllab");
   var x = row.insertCell(-1);
   x.innerHTML = "<button type='button' id='"+idlab+"'class='btn btn-danger' onclick='delxexamenlab(this.id)' ><i class='fa fa-trash'></i></button><strong> -"+nombre+".</strong>";
   
  }); // End addEventListener add examen laboratorio

  /* Elimina Examen de laboratorio  */
  function delxexamenlab(id) {
   var idpac = document.getElementById("idpac").value;
   var idcita = document.getElementById("idcita").value;
   // ajax para Eliminar examen de laboratorio
   jQuery.ajax({
      type: "POST",  
      url: "delexalab_js.php",
      async: false,
       data: {id: id, idpac: idpac, idcita: idcita, tipo:'Laboratorio'},
      success:function(data){
       console.log(data);
       datos1 = []; 
       datos1= data;
      },
       error:function (){}
     });// fin ajax
      document.getElementById("tbllaboratorio").deleteRow(0);

      var table = document.getElementById("tbllaboratorio");
      // Create an empty <tr> element and add it to the 1st position of the table:
      var row = table.insertRow(0);
      row.id = "rowtbllab";
     
     const alldatos = datos1.split('|');
      for (let i = 0; i < alldatos.length-1; i++) {
         console.log(alldatos[i]);
         const allcampos = alldatos[i].split(';');
         const idlab=allcampos[0];
         const nombre=allcampos[1];

         var cell1 = row.insertCell(0);
         cell1.innerHTML = "<button type='button' id='"+idlab+"'class='btn btn-danger' onclick='delxexamenlab(this.id)' ><i class='fa fa-trash'></i></button><strong> -"+nombre+".</strong>";
      }
     /*
     var table = document.getElementById("tblimagenologia");
     var row = table.insertRow(0);
     var cell1 = row.insertCell(0);
     cell1.innerHTML = "NEW CELL1";*/
     //location.reload();  
}
/* Busco Examenes al cargar pagina (reghist_2.php)*/
function buscaexamenes(idpac,idcita){

   jQuery.ajax({
      type: "POST",  
      url: "busexamenes_js.php",
      async: false,
       data: {idpac: idpac, idcita: idcita},
      success:function(data){
       console.log(data);
       var datosexamenes = JSON.parse(data);
       console.log(datosexamenes);
       //alert(datosexamenes[0].tipo)
       for (x of datosexamenes) {
         console.log(x.tipo + ' ' + x.idtbl);
         if (x.tipo=='Laboratorio') {
            var idlab=x.idtbl; var nombreexamen=x.nombreexamen;
            var row = document.getElementById("rowtbllab");
            var x = row.insertCell(-1);
            x.innerHTML = "<button type='button' id='"+idlab+"'class='btn btn-danger' onclick='delxexamenlab(this.id)' ><i class='fa fa-trash'></i></button><strong> -"+nombreexamen+".</strong>";
         }else if (x.tipo=='Imagenologia') {
            var idlab=x.idtbl; var nombreexamen=x.nombreexamen;
            var row = document.getElementById("rowtblimagenologia");
            var x = row.insertCell(-1);
            x.innerHTML = "<button type='button' id='"+idlab+"'class='btn btn-danger' onclick='delxexamen(this.id)' ><i class='fa fa-trash'></i></button><strong> -"+nombreexamen+".</strong>";
   
         }
       } // End For
       
      },
       error:function (){}
     });// fin ajax
}