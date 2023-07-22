function Mostrar_SheetAbonos(){
    let id_cost = $("#id_cost").val();
    $("#IdContentOperation").val(id_cost);
    const obj = ENTRY.all();
    obj.done(function(response){
        const data = JSON.parse(response);
        var SUMA = 0;
        for (let index = 0; index < data.length; index++) {
            var TR = $("<tr></tr>");
            var TD1,TD2,TD3,TD4,TD5,TD6,TD7,TD8;
            const a = [data[index].no_recibo,data[index].fecha_recibo, data[index].concepto,data[index].descripcion,data[index].valor,data[index].elaborado_por,data[index].debe, data[index].haber];
            SUMA = SUMA + parseInt(a[4]);
            TD1 = $("<td ventana='/login/privileges/"+a[0]+"/show.admin' class='clickNoRecibo font-weight-bold rowActiveFillTD' >"+ a[0] +"</td>");
            TD2 = $("<td class='text-center'>"+transformDate(a[1]) +"</td>");
            TD3 = $("<td class='text-center'>"+ a[2] +"</td>");
            TD5 = $("<td class='font-weight-bold text-right number-lg d-flex'><div class=''>$</div><div class='ml-auto'>"+ dar_formato(a[4]) +"</div></td>");
            TD6 = $("<td class='text-center'>"+ a[5]+"</td>");
            TD7 = $("<td class='text-center'><a class='btn btn-success shadow btn-xs sharp cpointer showMessage text-white' message='"+a[3]+"'><i class='fa-solid fa-comment-dots'></i></a><a class='btn btn-danger shadow btn-xs sharp mx-1 text-white cpointer buttonAttr' data-toggle='modal' data-target='#exampleModal2' noRecibo='"+a[0]+"' fechaRecibo='"+a[1]+"' concepto='"+a[2]+"' descripcion='"+a[3]+"' valor='"+a[4]+"' elaboradoPor='"+a[5]+"' debe='"+a[6]+"' haber='"+a[7]+"' ><i class='fa-solid fa-eye'></i></a><a  class='btn btn-primary shadow btn-xs cpointer sharp mx-1 text-white imprimirya ' data-toggle='modal' data-target='#Tickets'><i class='fa-solid fa-print'></i></a></td>");
            ApppendTo([TD1,TD2,TD3,TD6,TD5,TD7],TR);
            TR.appendTo("#table_items_abono");
        }
        var TR_tfoot = $("<tr class='bg-gray-1'></tr>");
        var TD1,TD2,TD3,TD4,TD5,TD6,TD7,TD8;
        TD1 = $("<td></td>");
        TD2 = $("<td></td>");
        TD3 = $("<td></td>");
        TD4 = $("<td class='text-center'>Total Abono</td>");
        TD5 = $("<td class='d-flex font-weight-bold'><div>$</div><div class='ml-auto'>"+dar_formato(SUMA)+"</div></td>");
        TD6 = $("<td></td>");
        ApppendTo([TD1,TD2,TD3,TD4,TD5,TD6],TR_tfoot);
        TR_tfoot.appendTo("#table_items_abono_tfoot");

        const Neto = ($('#NetoP').val()).replace(/\./g,'');
        const Pendiente = parseInt(Neto) - parseInt(SUMA);
        var TR_tfoot = $("<tr class='bg-gray-2'></tr>");
        var TD1,TD2,TD3,TD4,TD5,TD6,TD7,TD8;
        TD1 = $("<td></td>");
        TD2 = $("<td></td>");
        TD3 = $("<td></td>");
        TD4 = $("<td></td>");
        TD5 = $("<td class='text-center' >Saldo</td>");
        TD6 = $("<td  class='d-flex font-weight-bold'><div>$</div><div class='ml-auto'>"+dar_formato(Pendiente)+"</div></td>");
        ApppendTo([TD1,TD2,TD3,TD4,TD5,TD6],TR_tfoot);
        TR_tfoot.appendTo("#table_items_abono_tfoot");

    });
}

Mostrar_SheetAbonos();

function ChangeForm_SheetAbonos(){
    $(".noRecibo__Class_1").val(parseInt($(".noRecibo__Class_1").val())+1);
    $(".valor__Class_1").val("");
}


$("#estudianteInput").keyup(function(e){
    const name = e.target.value;
    console.log("Estas buscando " + name);
    const consulta = ESTUDIANTE.search(name);
    consulta.done((response) =>{
        $(".listItems").removeClass('d-none');
        var items = '';
        response = JSON.parse(response);
        for (let index = 0; index < response.length; index++) {
            const element = response[index];
            items += '<li idElement="'+element.id_cost+'" valueElement="'+element.nombre+'" class="elementSelectStudent">'+element.nombre+'</li>'; 
        }
        $(".listItems").html(items);
    });
});

$(document).on('click', '.elementSelectStudent', function(e){
    const element = e.target;
    const id = element.getAttribute('idElement');
    const name = element.getAttribute('valueElement');
    $(".listItems").addClass('d-none');
    $("#estudianteInput").val(name);
    $("#estudianteID").val(id);
});

$(".formatReceiptFormAbono").submit((e)=>{
    e.preventDefault();
    var i = 0;
    const estudiante = $("#estudianteID").val();
    if(estudiante == ""){
        $(".errorThirdReceipt").removeClass('d-none');
        setTimeout(()=>{
            $(".errorThirdReceipt").addClass('d-none');
        }, 1000);
        i++;

    }
    if(!$('input[name="forma"]').is(':checked')){
        $(".errorFormaReceipt").removeClass('d-none');
        setTimeout(()=>{
            $(".errorFormaReceipt").addClass('d-none');
        }, 1000);
        i++;
    }
    const values = $("#valor").val();
    if(values == ""){
        $(".errorValueReceipt").removeClass('d-none');
        setTimeout(()=>{
            $(".errorValueReceipt").addClass('d-none');
        }, 1000);
        i++;
    }
    if(i == 0){
        const send = ENTRY.createForm(".formatReceiptFormAbono");
        DesbloquearVentana();
        send.done((response) => {
            if(response == 'OK'){
                location.href ='/abonos/';
            }
        });
    }
});

$(document).on('keyup', '.searchAbonoReceipts',(e) => {
    if(e.keyCode == 16){
        const values = $('.searchAbonoReceipts').val();
        if(values != ""){
            location.href ='/abonos/'+values;
        }
    }
});