var modal = $('#cityModal');
var tableData = $("#cityTable");
var formData  = $("#formData");

function reloadTable(){
    tableData.DataTable().ajax.reload(null, false);
}

function loadFile(event){
    let output = document.getElementById('imgPreview');
    output.src = URL.createObjectURL(event.target.files[0]);
}



$(document).ready(function(){
    tableData.DataTable({
        "processing" : true,
        "serverSide" : true,
        "order" : [],
        "ajax" : {
            "url"  : baseURL + "Home/cityList",
            "type" : "POST"
        },
        "columnDefs" : [{
            "targets" : [-1],
            "orderable": false
        }]
    });

    formData.validate({
        rules: {
            city: {required:true}
        },
        // highlight:function(element){
        //     $(element).css('border', '2px solid red');
        // },
        // unhighlight:function(element){
        //     $(element).css('border', '');
        // },
        messages:{
            city: {required: 'city name is required'}
        },
        submitHandler: function(form, e) {
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
                    if(response.status == 'success'){
                        modal.modal('hide');
                        toastr.success(response.message);
                        reloadTable();
                    }else{
                        modal.modal('hide');
                        toastr.error(response.message);
                        reloadTable();
                    }
                }            
            });
        }
    });
});


function openModal(id=null){
    if(id){
        $.ajax({
            url : baseURL + 'Home/getCityDetailsById',
            type : 'POST',
            data : {id : id},
            success : function(response){
                console.log(response[0]);
                let title = 'Update City';
                modal.modal('show');
                formData.validate().resetForm();
                formData[0].reset();
                $('#cityModalLabel').text(title);
                $('#id').val(response[0].id);
                $('#city').val(response[0].cname);
                $('#preImage').val(response[0].img);
                $("#imgPreview").attr("src", response[0].img);
            }
        })
    }else{
        let title = 'Add New City';
        modal.modal('show');
        $('#cityModalLabel').text(title);
        formData.validate().resetForm();
        formData[0].reset();
        $('#id').val('');
        $("#imgPreview").attr("src",`${baseURL}assets/images/common/placeholder.jpg`);
    }
}

function cityStatusChange(status, id){
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
            url  : baseURL + 'Home/changeCityStatus',
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
    })
}

function deleteCity(id,img=null){
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to delete this item",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        allowOutsideClick: false
    }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
              url  : baseURL + 'Home/deleteCity',
              type : 'POST',
              data : { 
                  id : id,
                  img : img
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