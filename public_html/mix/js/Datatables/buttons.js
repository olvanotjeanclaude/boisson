import exportColumns from "./export-column.js";

export default function buttons(columns){
    return [{
        extend: 'collection',
        text: 'Exporter',
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: exportColumns(columns)
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: exportColumns(columns)
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: exportColumns(columns)
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: exportColumns(columns)
                }
            },
            // { extend: "colvis", text: 'Görünür sütunları seçin' },
            // 'copy',
            // 'excel',
            // 'csv',
            // 'pdf',
            // 'print'
        ]
    }]
}