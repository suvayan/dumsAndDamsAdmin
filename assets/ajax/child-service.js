var tableData = $("#childServiceTable");
var modal     = $('#childServiceModal');
var formData  = $("#formData");

function reloadTable(){
    tableData.DataTable().ajax.reload(null, false);
}

function loadFile(event){
    let output = document.getElementById('imgPreview');
    output.src = URL.createObjectURL(event.target.files[0]);
}

function loadVideo(event){
    let output = document.getElementById('videoPreview');
    output.src = URL.createObjectURL(event.target.files[0]);
}

$(document).ready(function(){
    tableData.DataTable({
        "processing" : true,
        "serverSide" : true,
        "order" : [],
        "ajax" : {
            "url"  : baseURL + "Home/childServiceList",
            "type" : "POST"
        },
        "columnDefs" : [{
            "targets" : [-1],
            "orderable": false
        }]
    });

    formData.validate({
        rules: {
            title: {required:true},
            child: {required:true},
            description: {required:true},
            price: {required:true}
        },
        messages:{
            title: {required: 'title is required'},
            child:{required: 'child is required'},
            description: {required: 'description is required'},
            price: {required: 'price is required'}
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
                    console.log(response);
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


function getChilds(id=null){
    $.ajax({
        url : baseURL + "Home/getChilds",
        type: "POST",
        success: function(response){
            $('#child').empty();
            $.each(response,function(index,response){
                $("#child").append($("<option></option>").attr({"value" :response.id, "selected": (response.id == id) ? true : false}).text(response.title));
            }); 
        }
    })
}


function openModal(id=null){
    if(id){
        $.ajax({
            url : baseURL + 'Home/getChildServiceDetailsById',
            type : 'POST',
            data : {id : id},
            success : function(response){
                let title = 'Update Sub-Category';
                modal.modal('show');
                formData[0].reset();
                formData.validate().resetForm();
                $('#childServiceLabel').text(title);
                getChilds(response[0].child_id);
                $("#child").val(null).trigger("change");
                $('#child').select2({
                    dropdownParent: modal,
                    placeholder: "Select any child",
                    allowClear: true,
                });
                $('#id').val(response[0].id);
                $('#title').val(response[0].title);
                $('#price').val(response[0].price);
                $('#description').val(response[0].description);
                $('#preImage').val(response[0].img);
                $("#imgPreview").attr("src",response[0].img);
            }
        })
    }else{
        let title = 'Add New Child Service';
        modal.modal('show');
        $('#childServiceLabel').text(title);
        formData.validate().resetForm();
        formData[0].reset();
        $('#id').val('');
        getChilds();
        $("#imgPreview").attr("src",`${baseURL}assets/images/common/placeholder.jpg`);
        $("#child").val(null).trigger("change");
        $('#child').select2({
            dropdownParent: modal,
            placeholder: "Select any child",
            allowClear: true,
        });
        
    }
}


function changeChildServiceStatus(id, status) {
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
              url  : baseURL + 'Home/changeChildServiceStatus',
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

function deleteChildService(id, img=null, video=null){
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
              url  : baseURL + 'Home/deleteChildService',
              type : 'POST',
              data : { 
                  id : id,
                  img : img,
                  video : video
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