var tableData = $("#userTable");
var walletModal = $("#transactionModal");
var formData  = $("#formData");

function reloadTable(){
    tableData.DataTable().ajax.reload(null, false);
}


$(document).ready(function(){
    tableData.DataTable({
        "processing" : true,
        "serverSide" : true,
        "order" : [],
        "ajax" : {
            "url"  : baseURL + "Home/userList",
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

function changeUserStatus(id, status) {
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
              url  : baseURL + 'Home/changeUserStatus',
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