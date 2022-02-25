var tableData = $("#partnerTable");
var walletModal = $("#transactionModal");
var formData  = $("#formData");
var serviceModal = $("#serviceModal");

function reloadTable(){
    tableData.DataTable().ajax.reload(null, false);
}


$(document).ready(function(){
    tableData.DataTable({
        "processing" : true,
        "serverSide" : true,
        "order" : [],
        "ajax" : {
            "url"  : baseURL + "Home/partnerList",
            "type" : "POST"
        },
        "columnDefs" : [{
            "targets" : [-1],
            "orderable": false
        }]
    });

    formData.validate({
        rules: {
            ammount: {required:true},
            status: {required:true}
        },
        messages:{
            ammount: {required: 'ammount is required'},
            status: {required: 'status is required'}
        },
        submitHandler: function(form, e) {
            e.preventDefault();
            $.ajax({
                url: form.action,
                type: form.method,
                data: new FormData(form),
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                enctype: 'multipart/form-data',
                success: function(response) {
                    console.log(response);
                    if(response.status == 'success'){
                        walletModal.modal('hide');
                        toastr.success(response.message);
                        reloadTable();
                    }else{
                        walletModal.modal('hide');
                        toastr.error(response.message);
                        reloadTable();
                    }
                }            
            });
        }
    });
});

function changePartnerStatus(id, status) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to change status",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        allowOutsideClick: false
    }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
              url  : baseURL + 'Home/changePartnerStatus',
              type : 'POST',
              data : { 
                  id : id,
                  status : status
              },
              success: function(response) {
                  if(response.status == 'success'){
                      // modal.modal('hide');
                      toastr.success(response.message);
                      reloadTable();
                  }else{
                      // modal.modal('hide');
                      toastr.error(response.message);
                      reloadTable();
                  }
              } 
          })
        }
    });
}

function getStatus(){
    let status = [
        {value:'', name:'select any status'},
        {value:'credit', name:'Credit'},
        {value:'debit', name:'Debit'},
    ];
    $('#status').empty();
    $.each(status,function(index,response){
        $("#status").append($("<option></option>").attr({"value" :response.value}).text(response.name));
    });
}

function changeWallet(id, wallet, name){
    walletModal.modal('show');
    $('#transactionLabel').text(name);
    formData.validate().resetForm();
    formData[0].reset();
    $('#id').val(id);
    $('#balance').val(wallet);
    $('#ammount').val('');
    $('#message').val('');
    $('#status').select2({
        dropdownParent: walletModal,
        placeholder: "select any status",
        allowClear: true,
    });
    getStatus();
}

function viewServices(id, name){
    $.ajax({
        url : baseURL + 'Home/getPartnerServices',
        type : 'POST',
        data : {id:id},
        success:function(responce){
            console.log(responce);
            $('#serviceBody').html('');
            let title = `Service List of ${name}`;
            serviceModal.modal('show');
            $('#serviceModalLabel').text(title);
            if(responce){
                $.each(responce,function(index,data){
                    $('#serviceBody').append(`
                        <tr>
                            <td>${data.title}</td>
                            <td>${data.mqty}</td>
                            <td>${data.price}</td>
                        </tr>
                    `);
                }); 
            
            }
        }
    })
}