const historyPurses = null;
var REGISTER_HISTORY = [];
var ID_PURSE_ACTIVE = -1;
var ID_EDIT_INPUT_PURSE = -1;
var HTML_COPY = null;
var HTML_COPY_TABLE_PURSE = null;
if($("#pages").val() == "show.cartera"){
    Mostrar_Items_Cartera();
}

var StatusMenu = false;
$(".MenuHamburguesa").click(function(){
    if(StatusMenu == false){
        document.getElementById('stickyMenuWidth').style.width = '40vw';
        StatusMenu = true;
    }else{
        $("#stickyMenuWidth").css('width','35vw');
        StatusMenu = false;
    }

});

function Mostrar_Items_Cartera(){
    ID_PURSE_ACTIVE = -1;
    document.getElementById('tableHistory').innerHTML = "";
    document.getElementById('TABLE_ITEMS_CARTERA').innerHTML = "";
    document.getElementById('FormPurseEdit').reset();
    $("#tableHistory tr").remove(); 
    //$("#FormPurseEdit")[0].reset();
    let Lista_items_Cartera = CARTERA.all();

    Lista_items_Cartera.done(function(result){
        console.log(result);
        const JsonData = JSON.parse(result);
        console.log(JsonData[0].id);
        for (let index = 0; index < JsonData.length; index++) {
            let label_TR =  $('<tr class="rowActiveFill"></tr>');
            let TD1, TD2,TD3, TD4, TD5, TD6, TD7;
            TD1 = $('<td class="text-center">'+(index+1)+'</td>');
            TD2 = $('<td class="text-center modifyDate rowActiveFillTD" cuota="'+JsonData[index].cuota+'" id_content="'+JsonData[index].id+'" row="'+(index+1)+'">'+JsonData[index].fecha_pago+'</td>');
            TD3 = $('<td class="text-center">'+JsonData[index].estado+'</td>');
            TD4 = $('<td class="text-center FillCuotaTable number-lg font-weight-bold " dinner="'+JsonData[index].cuota+'">$'+JsonData[index].cuota+'</td>');
            TD5 = $('<td class="text-center FillAbonadoTable d-flex"><div>$</div><div class="ml-auto">'+JsonData[index].abonado+'</div></td>');
            TD6 = $('<td class="text-center"><i message="'+JsonData[index].comentario+'" class="fa-solid fa-comment-dots text-primary showMessage pointer cpointer"></i></td>');
            TD7 = $('<td class="text-center ShowRegisterPurse cpointer" data-toggle="modal" id_purse="'+JsonData[index].id+'" data-target="#ModalHistory"><i class="fa-solid fa-file-waveform ml-2 text-primary"></i></td>');
            ApppendTo([TD1,TD2,TD4,TD5,TD3,TD6,TD7],label_TR);
            label_TR.appendTo("#TABLE_ITEMS_CARTERA");
        }


        HTML_COPY_TABLE_PURSE = $("#TABLE_ITEMS_CARTERA").html();
    });
    REGISTER_HISTORY = [];
    history_Purses();
    TotalPurses();
};

function ConvertirTdEnInput(){
    $(document).on('click','.ConvertirTdEnInput',function(e){
        if(ID_EDIT_INPUT_PURSE != $(this).attr('id_content')){
            var TR = $(this).children();
            ID_EDIT_INPUT_PURSE = $(this).attr('id_content');
            console.log($(this));
            for (let index = 0; index < TR.length; index++) {
                const element = TR[index];
                if(element.getAttribute('convert') == "true"){
                    var text = element.innerText;
                    if(text != ""){
                        var type = element.getAttribute('type');
                        var name = element.getAttribute('name');
                        if(type == "textarea"){
                            element.innerHTML ='<textarea class="form-control" name="'+name+'">'+text+'</textarea>';
                        }else{
                            element.innerHTML ='<input class="form-control" type="'+type+'" name="'+name+'" value="'+text+'">';
                        }
                    }
                }
            }
        }
    })
}
ConvertirTdEnInput();

function history_Purses(){
    let id_cost = $("#id_cost").val();
    let history = CARTERA.history();
    history.done(function(response){
        const array = JSON.parse(response);
        for (let index = 0; index < array.length; index++) {
            var arrayCon = array[index];
            REGISTER_HISTORY.push(arrayCon);
        }
    }); 
}

var ElemenTRactive = null;
$(document).on('click','.ShowRegisterPurse',function(e){
    const id_purse = $(this).attr('id_purse');
    deleteChild('tableHistory');
    console.log(document.getElementById('tableHistory'));
    Search_ID_Purse_Register_History(id_purse); 

});

$(document).on('click','.rowActiveFill',function(){
    if(ElemenTRactive != null){
        ElemenTRactive.removeClass('rowActiveFill2');
    }
    $(this).addClass('rowActiveFill2');
    ElemenTRactive = $(this);
});

$(document).on('keyup','body',function(e){
    if(e.keyCode == 27){

        $("#TABLE_ITEMS_CARTERA").html(HTML_COPY_TABLE_PURSE);
    }
    if(e.keyCode == 17){
        BloqueoVentana();
    }
});

function deleteChild(id){
    element = document.getElementById(id);
    while (element.firstChild){
        console.log(element.firstChild);
        element.removeChild(element.firstChild);
    };
}

function removeElementByClass(element){
    $(element).each(function(item){
        item.remove();
    });
}

function transformDate(date){
    var fecha = date.split('-');
    $mes = MESES[(parseInt(fecha[1])-1)];
    return fecha[2]+"-"+$mes+"-"+fecha[0];
}
function BackDate(date){
    var fecha = date.split('-');
    for (let index = 0; index < MESES.length; index++) {
        if(MESES[index] == fecha[1]){
            $mes = index+1;
        }
    }
    return fecha[0]+"-"+$mes+"-"+fecha[2];
}

function Search_ID_Purse_Register_History(id){
    $("#tableHistory tr").remove(); 
    deleteChild('tableHistory');
    var encontroAlgo = false;
        HTML_COPY = $("#tableHistory").html();
        ID_PURSE_ACTIVE = id;
        for (let i = 0; i < REGISTER_HISTORY.length; i++) {
            var element = REGISTER_HISTORY[i];
            for (let j = 0; j < element.length; j++) {
                var item = element[j];
                console.log(item.id_purse);
                if(item.id_purse == id){   
                    encontroAlgo = true;
                    let label_TR =  $('<tr id_content="'+item.id+'" class="ConvertirTdEnInput"></tr>');
                    let TD1, TD2,TD3, TD4, TD6, TD7;
                    let array = (item.created_at).split(' ');
                    TD1 = $('<td class="text-center" convert="false">'+(j+1)+'</td>');
                    TD2 = $('<td class="text-center" type="date" name="fecha_pago" convert="false">'+transformDate(item.fecha_pago)+'</td>');
                    TD4 = $('<td class="text-center number-lg font-weight-bold" type="text name="cuota" convert="false">$'+dar_formato(item.cuota)+'</td>');
                    TD6 = $('<td class="text-center" type="textarea name="comentario" convert="false">'+item.comentario+'</td>');
                    TD3 = $('<td class="text-center" type="date" name="fecha_pago" convert="false">'+transformDate(array[0])+'</td>');
                    TD7 = $('<td  convert="false" class="text-center text-danger deleteHistoryChange cpointer" id_content="'+item.id+'"><i class="fa-solid fa-trash-can"></i></td>');
                    ApppendTo([TD1,TD2,TD4,TD6,TD3,TD7],label_TR);
                    label_TR.appendTo("#tableHistory");
    
                } 
            }
        }
        if(!encontroAlgo){
            let label_TR =  $('<tr></tr>');
            let TD1, TD2,TD3, TD4, TD6;
            TD1 = $('<td class="text-center"></td>');
            TD2 = $('<td class="text-center"></td>');
            TD3 = $('<td class="text-center"></td>');
            TD4 = $('<td class="text-center"></td>');
            TD6 = $('<td class="text-center">No hay cambios.</td>');
            ApppendTo([TD1,TD2,TD3,TD4,TD6],label_TR);
            label_TR.appendTo("#tableHistory");
        }   
    
    
}


$(document).on('click','.deleteHistoryChange',function(e){

    var id = $(this).attr('id_content');
    console.log(id);
    $('#IdContentOperation').val(id);
    $("#ElimationPorID").val(id);
    $("#CloseModalHistory").click();
    $("#ButtonadminModal1").click();
});

$(document).on('click','.saveHistoryChange',function(e){
    console.log('hola');
});


var ExisteUnInput = false, RowActive = 0;
$(document).on('click','.modifyDate',function(e){
    var rowColumn = $(this).attr('row'),
    IDs = $(this).attr('id_content'),
    Cuota = $(this).attr('cuota');
    let val = ($(this).text()).split('-'),
    mes = BucarIndice(val[1]),
    fechaCompleta = val[2]+"-"+mes+"-"+val[0];
    ExisteUnInput = true;
    $("#ContentPurseID").val(IDs);
    $("#ContentPurseCUOTA").val(Cuota);
    $("#ContentPurseDATE").val(fechaCompleta);
    $("#buttonShowEditFecha").click();
    
});

$("#FormPurseEdit").submit(function(e){
    var EstaEnError1 = false;
    var fecha_pago = $("#ContentPurseDATE").val();
    var valor = $("#ContentPurseCUOTA").val();
    var comentarioP = $("#comentarioP").val();
    var fechaActual = (fecha_pago).split('-');
    e.preventDefault();
    if(fecha_pago == ""){
        BloqueoVentana();
        EstaEnError1 = true;
        $('.error_fecha').removeClass('d-none');
        $('.error_fecha').html('<small>Complete este campo.</small>');
    }
    if(fechaActual[2] > 28){
        BloqueoVentana();
        EstaEnError1 = true;
        $('.error_fecha').removeClass('d-none');
        $('.error_fecha').html('<small>La fecha NO puede ser mayor que 28.</small>');
    }
    if(valor == ""){
        BloqueoVentana();
        EstaEnError1 = true;
        $('.error_valor').removeClass('d-none');
        $('.error_valor').html('<small>Complete este campo.</small>');
    }
    if(comentarioP == ""){
        BloqueoVentana();
        EstaEnError1 = true;
        $('.error_comentario').removeClass('d-none');
        $('.error_comentario').html('<small>Complete este campo.</small>');
    }
    if(EstaEnError1){
        function QuitarAlertas(){
            $(".ActiveError").html("<small></small>");
        }
        setTimeout(QuitarAlertas,2000);
    }else{
        DesbloquearVentana();
        let formSend = CARTERA.edit();
        formSend.done(function(response){
            console.log(response);
            if(response == "OK"){
                $("#CloseModalPurse").click();
                Mostrar_Items_Cartera();
                setTimeout(function(){
                    BloqueoVentana();
                },1000);
                $("#FormPurseEdit")[0].reset();
            }
        })
    } 
});


$(document).on('mouseover','.showMessage',function(e){
    let message = $(this).attr('message');
    var element = $(this).offset();
    $('.ventanaFlotanteOver').css('display','block');
    $('.ventanaFlotanteOver').css('left',element.left);
    $('.ventanaFlotanteOver').css('top',element.top);
    $('.ventanaFlotanteOver').html('<small>'+message+'</small>');
});

$(document).on('mouseout','.showMessage',function(e){
    $('.ventanaFlotanteOver').css('display','none');
});

var CountTable = 0;
var valNo = 0;
$('.clickconcepto').click(function(e){
    let id = $(this).attr('id_attr');
    let nombre = $(this).attr('nombre');
    let estado = $(this).attr('estado');
    let orderTable = $(this).attr('orderTable');
    let consecutivo = $(this).attr('consecutivo');

    $('#concepto_id').val(id);
    $('#concepto_nombre').val(nombre);
    $('#concepto_estado').val();
    if(estado == "0"){
        $("#concepto_estado2").prop( "checked", true );
        $("#concepto_estado1").prop( "checked", false );
    }else{
        $("#concepto_estado1").prop( "checked", true );
        $("#concepto_estado2").prop( "checked", false );
    }

    if(consecutivo == 1){
        $("#consecutivoSi").prop("checked", true);
        $("#consecutivoNo").prop("checked", false);
    }else{
        $("#consecutivoNo").prop("checked", true);
        $("#consecutivoSi").prop("checked", false);
    }

    if(orderTable == "1"){
        $(".OrderBy1la").remove();
        $(".OrderBy2la").remove();
        var $myNewElement = $('<label class="radio-inline mr-3 OrderBy1la"><input id="OrderBy1" checked type="radio" value="1" name="orderTable">Primero</label>');
        $myNewElement.appendTo('#OrderBy');
        $(".OrderBy2la").remove();
        CountTable++;
    }
    if(orderTable == "0"){
        $(".OrderBy1la").remove();
        $(".OrderBy2la").remove();
        var $myNewElement = $('<label class="radio-inline mr-3 OrderBy2la"><input id="OrderBy2" checked type="radio" value="0" name="orderTable">No importa</label>');
        $myNewElement.appendTo('#OrderBy');
    }
});

$('.clearButton').click(function(e){
    $(".OrderBy1la").remove();
    $(".OrderBy2la").remove();
    var $myNewElement = $('<label class="radio-inline mr-3 OrderBy2la"><input id="OrderBy2" checked type="radio" value="0" name="orderTable">No importa</label>');
        $myNewElement.appendTo('#OrderBy');
        CountTable = 0;
});


$('.clickelaborado').click(function(e){
    let id = $(this).attr('id_attr');
    let nombre = $(this).attr('nombre');
    let estado = $(this).attr('estado');

    $('#elaborado_id').val(id);
    $('#elaborado_nombre').val(nombre);
    $('#elaborado_estado').val();
    if(estado == "0"){
        $("#elaborado_estado1").prop( "checked", false );
        $("#elaborado_estado2").prop( "checked", true );
    }else{
        $("#elaborado_estado1").prop( "checked", true );
        $("#elaborado_estado2").prop( "checked", false );
    }
});

$('.clickdebe').click(function(e){
    let id = $(this).attr('id_attr');
    let nombre = $(this).attr('nombre');
    let cuenta = $(this).attr('cuenta');

    $('#debe_id').val(id);
    $('#debe_nombre').val(nombre);
    $('#debe_cuenta').val(cuenta);
});


$('.clickhaber').click(function(e){
    let id = $(this).attr('id_attr');
    let nombre = $(this).attr('nombre');
    let cuenta = $(this).attr('cuenta');

    $('#haber_id').val(id);
    $('#haber_nombre').val(nombre);
    $('#haber_cuenta').val(cuenta);
});

$('.clickOtros').click(function(e){
    let id = $(this).attr('id_attr');
    let nombre = $(this).attr('nombre');
    let estado = $(this).attr('estado');

    $('#Oconcepto_id').val(id);
    $('#Oconcepto_nombre').val(nombre);

    if(estado == "0"){
        $("#Oconcepto_estado1").prop( "checked", false );
        $("#Oconcepto_estado2").prop( "checked", true );
    }else{
        $("#Oconcepto_estado1").prop( "checked", true );
        $("#Oconcepto_estado2").prop( "checked", false );
    }
});

var i = 0;
let isAbonoInicial = false;
$("#conceptoAttr").change(function(){
    var value = $(this);

    var con = $("#conceptoAttr option[value='"+value.val()+"']").attr('consecutive');
    console.log(con);
    if(con == "0" || con == 0){
        if(i == 0){
            valNo = $("#noReciboAttr").val();
            i++;
            console.log(valNo);
        }
        $("#noReciboAttr").val('');
        $("#noReciboAttr").removeAttr('readonly');
        isAbonoInicial = true;
    }else{
        if(i > 0){
            $("#noReciboAttr").val(valNo);
            $("#noReciboAttr").prop('readonly','true');
            i = 0;
        }
        isAbonoInicial = false;
    }
});


var Search = $('.noRecibo__Class');
var ConsecutivosOcupados = $('#ConsecutivosOcupados').val();
var HayErrorConsecutivo = false;
Search.keyup(function(){
    var value = Search.val();
    var arrryConse = ConsecutivosOcupados.split("-");
    var Encontrado = false;
    HayErrorConsecutivo = false;
    console.log(arrryConse);
    for (let index = 0; index < arrryConse.length; index++) {
        const element = (arrryConse[index]).replace(/\' '/g,'');
        if(isNaN(parseInt(element)) == false){
            console.log(element);
            if(parseInt(element) == parseInt(value)){
                Encontrado = true;
            }
        }
    }
    $(".error_recibo").removeClass('d-none');
    if(Encontrado){
        HayErrorConsecutivo = true;
        $('.error_recibo').html('<small class="text-danger">El numero de recibo ya está asignado.</small>');
        QuitarAlertas();
    }else{
        HayErrorConsecutivo = false;
        $('.error_recibo').html('<small class="text-success">Disponible.</small>');
        QuitarAlertas();
    }
 
});

//************************************************** */

function BloqueoVentana(){
    $('.content-preloader2').addClass(' show2loader');
}
var Pestaña,
nameForm = '#formEntry',
contentErrorRecibo = ".error_recibo",
contentErrorFecha = ".error_fecha",
contentErrorValor = ".error_valor",
contentErrorDescripcion = ".error_des",
contentErrorElaborado = ".error_elaborado",
EstaEnError = false,
formEntry = document.getElementById(nameForm);


$(".Pestaña").click(function(e){
    Pestaña = $(this).attr('Pestaña');
    switch (Pestaña) {
        case 'abono':
            nameForm = '#formEntry';
            break;
        case 'otrosIngresos':
            nameForm = '#formEntry1';
            console.log(nameForm);
            break;
    }
});

function EnviarDatos(event){
    let name = "#"+ (event.target.id);
    FormRequestIngresos(event,name);
}

function FormRequestIngresos(e,nameForm){
    EstaEnError = false;
    e.preventDefault();
    //const no_recibo = formEntry.noReciboAttr;

    const element_Recibo = $(nameForm).find(".noRecibo__Class")[0];
    const elemento_fecha = $(nameForm).find(".fechaRecibo__Class")[0];
    const elemento_valor = $(nameForm).find(".valor__Class")[0];
    const elemento_descrip = $(nameForm).find(".descripcion__Class")[0];
    const elemento_elaborado = $(nameForm).find(".elaborado__Class")[1];
    const elemento_nombreForm = $(nameForm).find(".nombreForm__Class")[0];
    const no_recibo = (element_Recibo).value;
    const fecha = (elemento_fecha).value;
    const valor = (elemento_valor).value;
    const descrip = (elemento_descrip).value;
    const elaborado = (elemento_elaborado).value;
    const nombreForm = (elemento_nombreForm).value;


    if(no_recibo == "" || no_recibo == 0){
        console.log("Error en recibo");
        BloqueoVentana();
        $(contentErrorRecibo).removeClass('d-none');
        $(contentErrorRecibo).html('<small>Complete este campo.</small>');
        e.preventDefault();
        EstaEnError = true;
    }else{
        $(contentErrorRecibo).addClass('d-none');
    }
    if(descrip == ""){
        console.log("Error en decrip");
        BloqueoVentana();
        $(contentErrorDescripcion).removeClass('d-none');
        $(contentErrorDescripcion).html('<small>Complete este campo.</small>');
        e.preventDefault();
        EstaEnError = true;
    }else{
        $(contentErrorDescripcion).addClass('d-none');
    }
    if(fecha == ""){
        console.log("Error en fecha");
        BloqueoVentana();
        $(contentErrorFecha).removeClass('d-none');
        $(contentErrorFecha).html('<small>Complete este campo.</small>');
        e.preventDefault();
        EstaEnError = true;
    }else{
        $(contentErrorFecha).addClass('d-none');
    }
    if(valor == ""){
        console.log("Error en valor");
        BloqueoVentana();
        $(contentErrorValor).removeClass('d-none');
        $(contentErrorValor).html('<small>Complete este campo.</small>');
        e.preventDefault();
        EstaEnError = true;
    }else{
        $(contentErrorValor).addClass('d-none');
    }
    console.log(elaborado);
    if(elaborado == "0"){
 
        BloqueoVentana();
        $(contentErrorElaborado).removeClass('d-none');
        $(contentErrorElaborado).html('<small>Complete este campo.</small>');
        e.preventDefault();
        EstaEnError = true;
    }else{
        $(contentErrorElaborado).addClass('d-none');
    }
    
    if(HayErrorConsecutivo){
        console.log("Error en error consecutivo");
        BloqueoVentana();
        e.preventDefault();
        EstaEnError = true;
        $(contentErrorRecibo).removeClass('d-none');
        $(contentErrorRecibo).html('<small class="text-danger">El numero de recibo ya está asignado.</small>');
    }else{
        $(contentErrorRecibo).addClass('d-none');
    }

    if(isAbonoInicial){

        if(no_recibo == "" || no_recibo == 0){
            console.log("Error en no recibo");
            BloqueoVentana();
            $(contentErrorRecibo).removeClass('d-none');
            $(contentErrorRecibo).html('<small>Complete este campo.</small>');
            e.preventDefault();
            EstaEnError = true;
        }else{
            const num = parseInt($("#StartConsecutivo").val());
            if(parseInt(no_recibo) >= num){
                console.log("Error en no recibo");
                BloqueoVentana();
                e.preventDefault();
                EstaEnError = true;
                $(contentErrorRecibo).removeClass('d-none');
                $(contentErrorRecibo).html('<small>El numero no puede ser mayor que '+num+'</small>');
            }else{
                $(contentErrorRecibo).addClass('d-none');    
            }
        }
        
    }

    if(EstaEnError){
        function QuitarAlertas(){
            $(".ActiveError").html("<small></small>");
        }
        setTimeout(QuitarAlertas,2000);
    }

    if(!EstaEnError){
        if(nombreForm == "Other"){
            document.getElementById('Table_Otros_Items').innerHTML = "";
            document.getElementById('Table_Otros_Items_foot').innerHTML = "";
            const obj = OtherENTRIES.create();
            obj.done(function(e){
                window.location.reload();
                if(e== "OK"){
                    const newn = parseInt(element_Recibo.value)+1;
                    element_Recibo.value = newn;
                    $(".noRecibo__Class1").val(newn);
                    elemento_valor.value = "";
                    elemento_descrip.value = "";
                    elemento_elaborado.value = "0";
                    elemento_elaborado.innerText = "Busca tu nombre";
                    $("#CloseOtherModal2").click();
                    Mostrar_SheetOtrosAbonos();
                    BloqueoVentana();

                
                }
            }); 
        }
        console.log(nombreForm);
        if(nombreForm == "Entry"){
            document.getElementById('table_items_abono').innerHTML = "";
            document.getElementById('table_items_abono_tfoot').innerHTML = "";
            const obj = ENTRY.create();
            obj.done(function(e){
                if(e== "OK"){
                    window.location.reload();
                    const newn = parseInt(element_Recibo.value)+1;
                    element_Recibo.value = newn;
                    $(".noRecibo__Class2").val(newn);
                    elemento_valor.value = "";
                    elemento_descrip.value = "";
                    elemento_elaborado.value = "0";
                    elemento_elaborado.innerText = "Busca tu nombre";
                    $("#CloseFormEntry1").click();
                    Mostrar_SheetAbonos();
                    BloqueoVentana();
                    TotalPurses();
                }
            }); 
        }
    }
}


//************************************************** */

var ContenTvalorSemestre = $("#valor_semestre");
var ContenTnumeroSemestre = $("#numero_semestre");
var ContenTvalorTotalSemestre = $("#valor_total_semestre");
var ContenTdescuento = $("#descuento");
var ContenTvalorNeto = $("#valor_neto");
var ContenTsaldoFinanciar = $("#valor_semestre");
var ContenTnumeroCuota = $("#valor_semestre");
var ContenTvalorCuota = $("#valor_cuota");
var ContenTfechaPago = $("#fecha_pago");
var HanHechoCambio = false;



$("#FormValueProgram").submit(function(e){
    var fechaActual = (ContenTfechaPago.val()).split('-');
    EstaEnError = false;
    if(ContenTvalorSemestre.val() == ""){
        EstaEnError = true;
        BloqueoVentana();
        e.preventDefault();
        $(".error_vs").removeClass('d-none');
        $(".error_vs").html('<small>Complete este campo.</small>');
    }
    if(ContenTnumeroSemestre.val() == ""){
        EstaEnError = true;
        BloqueoVentana();
        e.preventDefault();
        $(".error_ns").removeClass('d-none');
        $(".error_ns").html('<small>Complete este campo.</small>');    
    }   
    if(ContenTvalorTotalSemestre.val() == ""){
        EstaEnError = true;
        BloqueoVentana();
        e.preventDefault();
        $(".error_vtp").removeClass('d-none');
        $(".error_vtp").html('<small>Complete este campo.</small>');
    }
    if(ContenTdescuento.val() == ""){
        EstaEnError = true;
        BloqueoVentana();
        e.preventDefault();
        $(".error_d").removeClass('d-none');
        $(".error_d").html('<small>Complete este campo.</small>');
    }
    if(ContenTvalorNeto.val() == ""){
        EstaEnError = true;
        BloqueoVentana();
        e.preventDefault();
        $(".error_tn").removeClass('d-none');
        $(".error_tn").html('<small>Complete este campo.</small>');
    }
    if(ContenTsaldoFinanciar.val() == ""){
        EstaEnError = true;
        BloqueoVentana();
        e.preventDefault();
        $(".error_sf").removeClass('d-none');
        $(".error_sf").html('<small>Complete este campo.</small>');
    }
    if(ContenTnumeroCuota.val() == ""){
        EstaEnError = true;
        BloqueoVentana();
        e.preventDefault();
        $(".error_nc").removeClass('d-none');
        $(".error_nc").html('<small>Complete este campo.</small>');
    }
    if(ContenTvalorCuota.val() == ""){
        EstaEnError = true;
        BloqueoVentana();
        e.preventDefault();
        $(".error_vc").removeClass('d-none');
        $(".error_vc").html('<small>Complete este campo.</small>');
    }
    if(ContenTfechaPago.val() == ""){
        EstaEnError = true;
        BloqueoVentana();
        e.preventDefault();
        $(".error_fp").removeClass('d-none');
        $(".error_fp").html('<small>Complete este campo.</small>');
    }
    if(fechaActual[2] > 28){
        EstaEnError = true;
        BloqueoVentana();
        e.preventDefault();
        $(".error_fp").removeClass('d-none');
        $(".error_fp").html('<small>No se pueden utilizar los dias 29, 30 y 31.</small>');
    }
    if(!HanHechoCambio){
        BloqueoVentana();
        e.preventDefault();
        EstaEnError = true;  
        $(".error_noti").removeClass('d-none');
        $(".error_noti").html('<small><i class="fa-solid mr-2 fa-triangle-exclamation"></i>No has hecho cambios</small>');
    }
    if(EstaEnError){
        function QuitarAlertas(){
            $(".ActiveError").html("<small></small>");
        }
        setTimeout(QuitarAlertas,2000);
    }
    
});

$("#FormValueProgram").change(function(e){
    HanHechoCambio = true;
});



$('#AddConceptos').click(function(e){
    $('#resetConceptos').click();
});

$('#AddElaborado').click(function(e){
    $('#resetElaborado').click();
});

$('#AddDebe').click(function(e){
    $('#resetDebe').click();
});

$('#AddHaber').click(function(e){
    $('#resetHaber').click();
});

$('#AddOConceptos').click(function(e){
    $('#resetOConceptos').click();
});


$("#ModalPasswordAdmin").submit(function(e){
    e.preventDefault();
    if($("#passwordADMIN").val() != ""){
        DesbloquearVentana();
        var obj = CARTERA.delete();
        obj.done(function(response){
            console.log(response);
            if(response != "false"){
                Mostrar_Items_Cartera();
                $("#contentResponse").html("<div class='alert alert-success solid alert-dismissible fade show'><i class='fa-solid fa-thumbs-up mr-2'></i>Eliminado Corectamente!</div>");
            }else{
                $("#contentResponse").html("<div class='alert alert-danger solid alert-dismissible fade show'><i class='fa-solid fa-triangle-exclamation mr-2'></i>La credencial de administrador no es correcta.</div>");
            }
            $("#passwordADMIN").val("");
            $('#CloseadminModal1').click();
            BloqueoVentana();
            $('#ButtonadminModal2').click();

        });
    }else{
        $(".error_password").removeClass('d-none');
        $(".error_password").html('<small>Complete el campo por favor.</small>');
        function QuitarAlertas(){
            $(".ActiveError").html("<small></small>");
        }
        setTimeout(QuitarAlertas,2000);
    }
});


function TotalPurses(){
    var Abonado = 0, SaldoPendiente = 0,SaldoPendiente1 = 0, SaldoAFavor = 0, CuotasTotal = 0;
    let id_cost = $("#id_cost").val();
    $("#IdContentOperation").val(id_cost);
    document.getElementById('TABLE_ITEMS_CARTERA_TFOOT').innerHTML = "";
    var obj = CARTERA.suma();
    obj.done(function(response){
        response = JSON.parse(response);
        var total = parseInt(response[0].total);
        if(isNaN(total)){
            total = 0;
        }
        console.log("Has abonado totalmente : "+total );
        $(".FillAbonadoTable").each(function( key, value ){
            var tr = $(value).parent();
            var tr_hijos = tr.children();
            var cuota = 0;
            var estado = "Pendiente";
            var IsVencida = false;
            var valueShow = 0;
 //Saldo a Mostrar

            for (let index = 0; index < tr_hijos.length; index++) {
                const element = tr_hijos[index];

                console.log(element);

                if(index == 1){
                    var fecha = BackDate(tr_hijos[index].innerText);
                    console.log(fecha);
                    const ArrayFecha = fecha.split('-');
                    const fechaHoy = new Date();
                    console.log(fechaHoy);
                    const fechaPago = new Date(ArrayFecha[2],parseInt(ArrayFecha[1]) - 1 ,ArrayFecha[0]);
                    console.log(fechaPago);
                    if(fechaHoy > fechaPago){
                        console.log("Fecha de Pago vencida.");
                        IsVencida = true;
                    }else if(fechaHoy == fechaPago){
                        console.log("Hoy es el dia");
                    }else{
                        console.log("Todavia no se ha vencido.");
                    }

                    /*var dia = fechaHoy.getDate();
                    var mes = parseInt(fechaHoy.getMonth())+1;
                    console.log("El mes es " + mes);
                    var año = fechaHoy.getFullYear();
                    if(parseInt(ArrayFecha[2]) == año){
                        console.log("Si es el mismo año.");
                        if(parseInt(ArrayFecha[1]) >=  mes){
                            console.log("El mes es mayor o el mismo.");
                            if(parseInt(ArrayFecha[0]) <= dia){
                                console.log("Cuota Vencida");
                                IsVencida = true;
                                console.log("Si esta vencida");
                            }
                        }
                    }*/
                }
                if(index == 2){
                   cuota = parseInt(((tr_hijos[index].getAttribute('dinner')).replace(/\./g,''))); 
                }
                if(index == 3){
                    /*if(total > 0){
                        console.log(cuota);
                        if(total >= cuota){
                            estado = "Al dia";
                            total = parseInt(total)-parseInt(cuota);
                            console.log(total);
                            tr_hijos[index].innerHTML = "<div>$</div><div class='ml-auto'>"+dar_formato(cuota)+"</div>";
                            Abonado = Abonado + parseInt(cuota);
                            tr_hijos[index].classList.add('bg-success');

                        }else{

                            let restante = total;
                            tr_hijos[index].innerHTML = "<div>$</div><div class='ml-auto'>"+dar_formato(total)+"</div>";
                            if(IsVencida){
                                SaldoPendiente = SaldoPendiente + (parseInt(cuota)-parseInt(total));
                            }
                            Abonado = parseInt(Abonado) + parseInt(total);
                            if(IsVencida){
                                estado = "En Mora";
                                tr_hijos[index].classList.add('bg-danger2');
                                SaldoPendiente1 += parseInt(cuota) - restante;

                            }else{
                                estado = "Pendiente";
                                tr_hijos[index].classList.add('bg-amarillo');
                                SaldoPendiente += parseInt(cuota) - restante;
                                
                            }
                            
                            total = parseInt(total)-parseInt(cuota);

                            if(!IsVencida && Abonado > 0){
                                SaldoAFavor += restante;
                            }

                        }

                        
                        tr_hijos[index].classList.add('text-white');
                        tr_hijos[index].classList.add('font-weight-bold');
                    }else{
                        if(IsVencida){
                            estado = "En Mora";
                            SaldoPendiente = parseInt(SaldoPendiente) + parseInt(cuota);
                            tr_hijos[index].classList.add('bg-danger2');
                            tr_hijos[index].classList.add('text-white');
                            tr_hijos[index].classList.add('font-weight-bold');
                        }else{
                            estado = "Proxima";
                        }
                    }*/

  
                    var Classe = "bg";
                    CuotasTotal += cuota;

                    if(total >= cuota){
                        estado = "Al dia";
                        total = parseInt(total)-parseInt(cuota);
                        valueShow = cuota;
                        Classe = "bg-success";
                    }
                    else if(IsVencida){
                        estado = "En Mora";
                        Classe = "bg-danger2";
                        if(total > 0){
                            let val = parseInt(cuota) - parseInt(total);
                            SaldoPendiente += val;  //Se suma a lo pendiente
                            valueShow = total; //Lo que se desea mostrar 
                            total = 0; //Lo igualamos porque es mayor a 0
         
                        }else{
                            SaldoPendiente += cuota;
                        }   

                    }else{
                        estado = "Proxima";
                        Classe = "bg";
                        if(total > 0){
                            Classe = "bg-amarillo";
                            valueShow = total;
                            total = 0;
                        }else{
                            valueShow = 0;
                        }
                    }

                    if(valueShow > 0 && IsVencida == false){
                        SaldoAFavor += valueShow;
                    }


                    Abonado += valueShow;
                    tr_hijos[index].innerHTML = "<div>$</div><div class='ml-auto'>"+dar_formato(valueShow)+"</div>";
                    tr_hijos[index].classList.add(Classe);
                    tr_hijos[index].classList.add('text-white');
                    tr_hijos[index].classList.add('font-weight-bold');

                }



                if(index == 4){
                    tr_hijos[index].innerText = estado;
                }
            }
            


        });

        var TR = $("<tr class='bg-azul'></tr>");
            var TD1,TD2,TD3,TD4,TD5,TD6,TD7,TD8;
            TD1 = $("<td></td>");
            TD2 = $("<td class='text-center'>Total Programa</td>");
            TD3 = $("<td class='text-center font-weight-bold'>$"+dar_formato(CuotasTotal)+"</td>");
            TD4 = $("<td></td>");
            TD5 = $("<td></td>");
            TD6 = $("<td></td>");
            TD7 = $("<td></td>");
            ApppendTo([TD1,TD2,TD3,TD4,TD5,TD6,TD7],TR);
            TR.appendTo("#TABLE_ITEMS_CARTERA_TFOOT");

            var TR = $("<tr class='bg-gray-2'></tr>");
            var TD1,TD2,TD3,TD4,TD5,TD6,TD7,TD8;
            TD1 = $("<td></td>");
            TD2 = $("<td></td>");
            TD3 = $("<td class='text-center font-weight-bold'>Total Abonado</td>");
            TD4 = $("<td class='d-flex font-weight-bold'><div>$</div><div class='ml-auto'>"+dar_formato(Abonado)+"</div></td>");
            TD5 = $("<td></td>");
            TD6 = $("<td></td>");
            TD7 = $("<td></td>");
            ApppendTo([TD1,TD2,TD3,TD4,TD5,TD6,TD7],TR);
            TR.appendTo("#TABLE_ITEMS_CARTERA_TFOOT");

            var TR = $("<tr class='bg-rojosuave'></tr>");
            var TD1,TD2,TD3,TD4,TD5,TD6,TD7,TD8;
            TD1 = $("<td></td>");
            TD2 = $("<td></td>");
            TD3 = $("<td class='text-center'>Saldo Pendiente</td>");
            TD4 = $("<td class='d-flex font-weight-bold'><div>$</div><div class='ml-auto'>"+dar_formato(SaldoPendiente)+"</div></td>");
            TD5 = $("<td></td>");
            TD6 = $("<td></td>");
            TD7 = $("<td></td>");
            ApppendTo([TD1,TD2,TD3,TD4,TD5,TD6,TD7],TR);
            TR.appendTo("#TABLE_ITEMS_CARTERA_TFOOT");

            var TR = $("<tr class='bg-verdesuave'></tr>");
            var TD1,TD2,TD3,TD4,TD5,TD6,TD7,TD8;
            TD1 = $("<td></td>");
            TD2 = $("<td></td>");
            TD3 = $("<td class='text-center'>Saldo a Favor</td>");
            TD4 = $("<td class='d-flex font-weight-bold'><div>$</div><div class='ml-auto'>"+dar_formato(SaldoAFavor)+"</div></td>");
            TD5 = $("<td></td>");
            TD6 = $("<td></td>");
            TD7 = $("<td></td>");
  
            ApppendTo([TD1,TD2,TD3,TD4,TD5,TD6,TD7],TR);
            TR.appendTo("#TABLE_ITEMS_CARTERA_TFOOT");
        HTML_COPY_TABLE_PURSE = $("#TABLE_ITEMS_CARTERA").html();
        $("#SaldoFavorText").html(dar_formato(SaldoAFavor));
        $("#SaldoPendienteText").html(dar_formato(SaldoPendiente));
    }); 

    
}
