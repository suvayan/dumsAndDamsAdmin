var tableData = $("#orderTable");
var modal = $('#invoiceModal');
var modalOne = $('#subOrderModal');


function reloadTable(){
    tableData.DataTable().ajax.reload(null, false);
}


$(document).ready(function(){
    tableData.DataTable({
        "processing" : true,
        "serverSide" : true,
        "order" : [],
        "ajax" : {
            "url"  : baseURL + "Home/getOrderList",
            "type" : "POST"
        },
        "columnDefs" : [{
            "targets" : [-1],
            "orderable": false
        }]
    });
});

function invoiceModal(id, uid){
    $.ajax({
        url : baseURL + 'Home/getInvoice',
        type : 'POST',
        data : {id:id, uid:uid},
        success:function(responce){
            console.log(responce);
            $('#invoiceBody').html('');
            let title = 'Invoice List';
            modal.modal('show');
            $('#invoiceModalLabel').text(title);
            if(responce){
                $.each(responce,function(index,data){
                    $('#invoiceBody'). append(`
                        <tr>
                            <td>${data.name}</td>
                            <td>${(data.recipt_invoice)?`<a href="${data.recipt_invoice}" download>Download Invoice</a>`:`No invoice is generated`}</td>
                            <td>${(data.tax_invoice)?`<a href="${data.tax_invoice}" download>Download Invoice</a>`:`No invoice is generated`}</td>
                        </tr>
                    `);
                }); 
            
            }
        }
    })
}

function subOrderModal(id, uid){
    $.ajax({
        url : baseURL + 'Home/getSubOrder',
        type : 'POST',
        data : {id:id, uid:uid},
        success:function(responce){
            console.log(responce);
            $('#subOrderBody').html('');
            let title = 'Sub-Order List';
            modalOne.modal('show');
            $('#subOrderModalLabel').text(title);
            if(responce){
                $.each(responce,function(index,data){
                    $('#subOrderBody').append(`
                        <tr>
                            <td>${data.service}</td>
                            <td>${(data.name)?data.name:''}</td>
                            <td>${data.count}</td>
                            <td>${data.p_amt}</td>
                            <td>${data.c_amt}</td>
                        </tr>
                    `);
                }); 
            
            }
        }
    })
}