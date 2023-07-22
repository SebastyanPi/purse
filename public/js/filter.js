
(function($) {
    var table = $('#example3').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        "responsive": "true",
        "dom": 'lBfrtip',
        "buttons": [{
                extend: 'excel',
                text: '<i class="mdi mdi-file-excel">Excel</i>',
                titleAttr: 'Exportar a Excel',
                className: 'ml-3 btn btn-success btn-xs',
                excelStyles: {
                    template: 'blue_medium'
                }
            },
            {
                extend: 'pdf',
                text: '<i class="mdi mdi-file-pdf">PDF</i>',
                titleAttr: 'Exportar a Pdf',
                className: 'ml-3 btn btn-danger btn-xs'

            },
            {
                extend: 'print',
                text: '<i class="mdi mdi-cloud-print">Imprimir</i>',
                titleAttr: 'Exportar a Pdf',
                className: 'ml-3 btn btn-info btn-xs'
            }
        ]
    });
    $('tbody').on('click', 'tr', function() {
        var data = table.row(this).data();
    });

    let fLote = document.getElementById("fLote");
    if (comprobar(fLote)) {
        fLote.onchange = (event) => {
            let data = event.target.value;
            filter(event.target.getAttribute("data-index"), data);
        }
    }
    let fCargo = document.getElementById("fCargo");
    if (comprobar(fCargo)) {
        fCargo.onchange = (event) => {
            let data = event.target.value;
            filter(event.target.getAttribute("data-index"), data);
        }
    }

    function filter(column, data) {
        if (data == -1) {
            table.column(column).search("").draw();
        } else {
            table.column(column).search(data).draw();
        }
    }

    function comprobar(tag) {
        if (tag != undefined) {
            return true;
        }
        return false;
    }

})(jQuery);
