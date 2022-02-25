var tableData = $("#invoiceTable");


function reloadTable(){
    tableData.DataTable().ajax.reload(null, false);
}


$(document).ready(function(){
    tableData.DataTable({
        "processing" : true,
        "serverSide" : true,
        "order" : [],
        "ajax" : {
            "url"  : baseURL + "Home/getInvoiceList",
            "type" : "POST"
        },
        "columnDefs" : [{
            "targets" : [-1],
            "orderable": false
        }]
    });
});