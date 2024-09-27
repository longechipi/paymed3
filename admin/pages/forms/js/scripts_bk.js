let monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September','October', 'November', 'December'];

let currentDate = new Date();
let currentDay = currentDate.getDate();
let monthNumber = currentDate.getMonth();
let currentYear = currentDate.getFullYear();

let dates = document.getElementById('dates');
let month = document.getElementById('month');
let year = document.getElementById('year');

let prevMonthDOM = document.getElementById('prev-month');
let nextMonthDOM = document.getElementById('next-month');

month.textContent = monthNames[monthNumber];
year.textContent = currentYear.toString();

prevMonthDOM.addEventListener('click', ()=>lastMonth());
nextMonthDOM.addEventListener('click', ()=>nextMonth());

var sw = 0;
//alert(year.textContent);

const writeMonth = (month) => {

    for(let i = startDay(); i>0;i--){
        dates.innerHTML += ` <div class="calendar__date calendar__item calendar__last-days">
            ${getTotalDays(monthNumber-1)-(i-1)}
        </div>`;
    }

    for(let i=1; i<=getTotalDays(month); i++){ 
        /*if(i===currentDay) {
            dates.innerHTML += ` <div class="calendar__date calendar__item calendar__today">${i}</div>`;
        }else{ */
			jQuery.ajax({
				 type: "POST",	
				 url: "buscacita.php",
                 async: false,
				  data: {dia: i, mes: month, ano: year.textContent},
				
				 success:function(data){
					sw = data[0];
					if(i===currentDay) {
						// Original dates.innerHTML += ` <div class="calendar__date calendar__item calendar__today">${i}</div>`;
                        dates.innerHTML += ` <div class="calendar__date calendar__item"><a  onclick="buscadias(${i},${month},${currentYear})"><p style="color:black; background:yellow; cursor:pointer;">${i}</p></a></div>`;
					}else{
						if(sw == '1'){
							//dates.innerHTML += ` <div class="calendar__date calendar__item"><a href="pages/forms/rpt_agenda.php?dia=${i}&mes=${month}&ano=${currentYear}"><p style="color:black; background:yellow">${i}</p></a></div>`;
                            //dates.innerHTML += ` <div class="calendar__date calendar__item"><a data-toggle="modal" href="#modalhour"><p style="color:black; background:yellow">${i}</p></a></div>`;
                            dates.innerHTML += ` <div class="calendar__date calendar__item"><a  onclick="buscadias(${i},${month},${currentYear})"><p style="color:black; background:yellow; cursor:pointer;">${i}</p></a></div>`;
						}else{
							//dates.innerHTML += ` <div class="calendar__date calendar__item"><a href="pages/forms/rpt_agenda.php?dia=${i}&mes=${month}&ano=${currentYear}"><p style="color:white">${i}</p></a></div>`;	
                            //dates.innerHTML += ` <div class="calendar__date calendar__item"><a data-toggle="modal" href="#modalhou"><p style="color:white">${i}</p></a></div>`;
                            dates.innerHTML += ` <div class="calendar__date calendar__item"><a onclick="buscadias(${i},${month},${currentYear})"><p style="color:white; cursor:pointer;">${i}</p></a></div>`;
						}
					}						
				 },
				  error:function (){}
				});
            /*dates.innerHTML += ` <div class="calendar__date calendar__item">${i}</div>`;   */			
        //}
    }
}


const getTotalDays = month => {
    if(month === -1) month = 11;

    if (month == 0 || month == 2 || month == 4 || month == 6 || month == 7 || month == 9 || month == 11) {
        return  31;

    } else if (month == 3 || month == 5 || month == 8 || month == 10) {
        return 30;

    } else {

        return isLeap() ? 29:28;
    }
}

const isLeap = () => {
    return ((currentYear % 100 !==0) && (currentYear % 4 === 0) || (currentYear % 400 === 0));
}

const startDay = () => {
    let start = new Date(currentYear, monthNumber, 1);
    return ((start.getDay()-1) === -1) ? 6 : start.getDay()-1;
}

const lastMonth = () => {
    if(monthNumber !== 0){
        monthNumber--;
    }else{
        monthNumber = 11;
        currentYear--;
    }

    setNewDate();
}

const nextMonth = () => {
    if(monthNumber !== 11){
        monthNumber++;
    }else{
        monthNumber = 0;
        currentYear++;
    }

    setNewDate();
}

const setNewDate = () => {
    currentDate.setFullYear(currentYear,monthNumber,currentDay);
    month.textContent = monthNames[monthNumber];
    year.textContent = currentYear.toString();
    dates.textContent = '';
    writeMonth(monthNumber);
}

writeMonth(monthNumber);

function buscadias(dia,mes,ano) {
    let idmed = document.getElementById("idmed").value;
    //month.textContent = monthNames[monthNumber];

    mess=parseInt(mes)+1;
    if (mess>'0' && mess<'10') {mess='0'+mess;}
    
    diaa=parseInt(dia)+1;
    if (dia>'0' && dia<'10') {dia='0'+dia;}
    str = ano+'-'+mess+'-'+dia+'T00:00:00';
    
    //const date = new Date("2022/10/24");
    ms = Date.parse(str);
    fecha = new Date(ms);

    //alert('convertida--'+fecha);
    //const hoy = fecha.getDate();  const mesActual = fecha.getMonth() + 1; 
    let fechaactual = new Date();
    fechaactual.setDate(fechaactual.getDate() - 1);
    console.log(fechaactual);
    if (fecha<fechaactual) {
        Swal.fire('Usted no ofrece consultas médicas ',
                        'para el día seleccionado.',
                        'error'
                        );
        return false;}
    /*----------------------------------------------------*/
    document.getElementById("fechaconsulta").value=str;

    //const weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
    const weekday = ["Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"];
    let day = weekday[fecha.getDay()];
    dia=day;
    
    //let day = weekday[diaa];
    jQuery.ajax({
                 type: "POST",  
                 url: "diascons_js.php",
                 async: false,
                  data: {idmed: idmed, dia: dia},
                 success:function(data){
                    if (data!='1') {
                        Swal.fire('Usted no ofrece consultas médicas ',
                        'para el día seleccionado.',
                        'error'
                        )
                        return false;
                    }else{
                        $('#modalhour').modal('show');
                    }

                 },
                  error:function (){}
                });
}
    /* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
function pacdeldia(idclinica) {
    const idmed = document.getElementById("idmed").value;
    const fechaconsulta = document.getElementById("fechaconsulta").value;
    document.getElementById('btncont').disabled = false;
    // limpia Select
    /*for (let i = $select.options.length; i >= 0; i--) {
        $select.remove(i);
      }*/

    jQuery.ajax({
                 type: "POST",  
                 url: "consxdias_js.php",
                 async: false,
                  data: {idmed: idmed, idclinica: idclinica, fechaconsulta: fechaconsulta},
                 success:function(data){
                    console.log(data);
                    const allarr = data.split("|"); console.log(allarr);
                    const datos1 = allarr[0];         console.log(datos1);
                    const datos2 = allarr[1];         console.log(datos2);
                    const datos = datos1.split(',');
                    
                    selecthoras.length = 0;           
                    let consultas=datos[0]; console.log(consultas);
                    for (let i = 1; i < datos.length-1; i++) {
                        console.log(datos[i]);
                        const sel = document.getElementById("selecthoras");
                        const opt = document.createElement("option");
                        opt.value = datos[i];
                        opt.text = datos[i];
                        sel.add(opt);
                        //text += cars[i] + "<br>";
                    }
                    //let horaconsulta=datos[1];
                    document.getElementById('cantconsultas').style.visibility = 'visible';
                    //document.getElementById('horaconsulta').style.visibility = 'visible';
                    document.getElementById('cantconsultas').innerHTML = consultas;
                    //document.getElementById('horaconsulta').innerHTML = horaconsulta;
                    document.getElementById('ul-lispacdia').innerHTML =datos2;
                    //'<li class="list-group-item list-group-item-primary">LAURA GOMEZ</li><li class="list-group-item list-group-item-success">MARCOS VALERO</li>' ;
                 },
                  error:function (){}
                });
}

function fconfcita(pidcita) {
    const idcita = pidcita.substring(7);
        
        jQuery.ajax({
                 type: "POST",  
                 url: "sendconfcita_js.php",
                 async: false,
                  data: {idcita: idcita},
                 success:function(data){
                    console.log(data);
                    if (data=='1') {
                        swal("Cnfirmaciòn", "Enviada Correctamente!", "success");
                    }
                 },
                  error:function (){}
                });
}