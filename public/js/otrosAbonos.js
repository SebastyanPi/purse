function Mostrar_SheetOtrosAbonos(){
    let id_cost = $("#id_cost").val();
    $("#IdContentOperation").val(id_cost);
    const obj = OtherENTRIES.all();
    obj.done(function(response){
        console.log(response);
        const data = JSON.parse(response);
        var SUMA = 0;
        for (let index = 0; index < data.length; index++) {
            var TR = $("<tr></tr>");
            var TD1,TD2,TD3,TD4,TD5,TD6,TD7,TD8;
            const a = [data[index].no_recibo,data[index].fecha_recibo, data[index].concepto,data[index].descripcion,data[index].valor,data[index].elaborado_por,data[index].debe, data[index].haber];
            SUMA = SUMA + parseInt(a[4]);
            TD1 = $("<td ventana='/login/privileges/"+a[0]+"/otros.admin' class='clickNoRecibo font-weight-bold rowActiveFillTD' >"+ a[0] +"</td>");
            TD2 = $("<td class='text-center'>"+transformDate(a[1]) +"</td>");
            TD3 = $("<td class='text-center'>"+ a[2] +"</td>");
            TD5 = $("<td class='font-weight-bold text-right number-lg d-flex'><div class=''>$</div><div class='ml-auto'>"+ dar_formato(a[4]) +"</div></td>");
            TD6 = $("<td class='text-center'>"+ a[5]+"</td>");
            TD7 = $("<td class='text-center'><a class='btn btn-success shadow btn-xs sharp cpointer showMessage text-white' message='"+a[3]+"'><i class='fa-solid fa-comment-dots'></i></a><a class='btn btn-danger shadow btn-xs sharp mx-1 text-white cpointer buttonAttr' data-toggle='modal' data-target='#exampleModal2' noRecibo='"+a[0]+"' fechaRecibo='"+a[1]+"' concepto='"+a[2]+"' descripcion='"+a[3]+"' valor='"+a[4]+"' elaboradoPor='"+a[5]+"' debe='"+a[6]+"' haber='"+a[7]+"' ><i class='fa-solid fa-eye'></i></a><a class='btn btn-primary shadow btn-xs cpointer sharp mx-1 text-white'><i class='fa-solid fa-print'></i></a></td>");
            ApppendTo([TD1,TD2,TD3,TD6,TD5,TD7],TR);
            TR.appendTo("#Table_Otros_Items");
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
        TR_tfoot.appendTo("#Table_Otros_Items_foot");

    });
}

Mostrar_SheetOtrosAbonos();

$(".formatReceiptFormOtrosAbono").submit((e)=>{
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
        const send = OtherENTRIES.createForm(".formatReceiptFormOtrosAbono");
        DesbloquearVentana();
        send.done((response) => {
            if(response == 'OK'){
                location.href ='/otros/abonos/';
            }
        });
    }
});

$(document).on('keyup', '.searchOtrosAbonoReceipts',(e) => {
    if(e.keyCode == 16){
        const values = $('.searchOtrosAbonoReceipts').val();
        if(values != ""){
            location.href ='/otros/abonos/'+values;
        }
    }
});