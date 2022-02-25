var tableData = $("#sanitizationTable");
var modal = $('#sanitizationModal');
var formData  = $("#formData");
var modalOne = $('#sanitizationVideoModal');
var formDataOne  = $("#formDataOne");

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
            "url"  : baseURL + "Home/sanitizationList",
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
        },
        messages:{
            title: {required: 'title is required'},
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

    formDataOne.on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url : baseURL + 'Home/insertUpdateSanitizationVideo',
            type : 'POST',
            data : formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            success: function(response) {
                if(response.status == 'success'){
                    modalOne.modal('hide');
                    toastr.success(response.message);
                    reloadTable();
                }else if(response.status == 'warning'){
                    modalOne.modal('hide');
                    toastr.warning(response.message);
                    reloadTable();
                }else{
                    modalOne.modal('hide');
                    toastr.error(response.message);
                    reloadTable();
                }
            } 
        })
    })
});


function openModal(id=null){
    if(id){
        $.ajax({
            url : baseURL + 'Home/getSanitizationDetailsById',
            type : 'POST',
            data : {id : id},
            success : function(response){
                console.log(response[0]);
                let title = 'Update Category';
                modal.modal('show');
                $('#sanitizationLabel').text(title);
                formData.validate().resetForm();
                formData[0].reset();
                $('#id').val(response[0].id);
                $('#title').val(response[0].title);
                $('#preImage').val(response[0].img);
                $("#imgPreview").attr("src",response[0].img);
            }
        })
    }else{
        let title = 'Add New Sanitization';
        modal.modal('show');
        $('#sanitizationLabel').text(title);
        formData.validate().resetForm();
        formData[0].reset();
        $('#id').val('');
        $("#imgPreview").attr("src",`${baseURL}assets/images/common/placeholder.jpg`);
    }
}

function changeSanitizationStatus(id, status) {
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
              url  : baseURL + 'Home/changeSanitizationStatus',
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

function deleteSanitization(id, img=null, video=null){
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
              url  : baseURL + 'Home/deleteSanitization',
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

function addVideoModal(id){
    $("#videoPreview").attr("src", '');
    $.ajax({
        url : baseURL + 'Home/getSanitizationDetailsById',
        type : 'POST',
        data : {id : id},
        success : function(response){
            //console.log(response[0]);
            let title = response[0].title;
            $('#sanitizationVideoModalLabel').text(title);
            modalOne.modal('show');
            formDataOne[0].reset();
            $('#sid').val(response[0].id);
            $("#videoPreview").attr("src", response[0].video);
            $('#preVideo').val(response[0].video);
        }
    })
}