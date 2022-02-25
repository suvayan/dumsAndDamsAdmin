var tableData = $("#subCategoryTable");
var modal = $('#subCategoryModal');
var formData  = $("#formData");
var modalOne = $('#subCategoryVideoModal');
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
            "url"  : baseURL + "Home/sub_categoryList",
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
            category: {required:true},
            "cities[]": {required:true}
        },
        // highlight:function(element){
        //     $(element).css('border', '2px solid red');
        // },
        // unhighlight:function(element){
        //     $(element).css('border', '');
        // },
        messages:{
            title: {required: 'title is required'},
            category:{required: 'category is required'},
            "cities[]": {required: 'city is required'}
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
            url : baseURL + 'Home/insertUpdateSubCategoryVideo',
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

function getCategories(id=null){
    $('#catSpinner').show();
    $('#category').hide();
    $.ajax({
        url : baseURL + "Home/getCategories",
        type: "POST",
        success: function(response){
            $('#catSpinner').hide();
            $('#category').show();
            $('#category').empty();
            $.each(response,function(index,response){
                $("#category").append($("<option></option>").attr({"value" :response.id, "selected": (response.id == id) ? true : false}).text(response.cat_name));
            }); 
        }
    })
}

function getCities(id=null){
    $('#citySpinner').show();
    $('#cities').hide();
    let city_id = (id)? JSON.parse(id) : null;
    $.ajax({
        url : baseURL + "Home/getCities",
        type: "POST",
        success: function(response){
            $('#citySpinner').hide();
            $('#cities').show();
            $('#cities').empty();
            $.each(response,function(index,response){
                $("#cities").append($("<option></option>").attr({"value" :response.id, "selected": (city_id && city_id.includes(response.id )) ? true : false}).text(response.cname));
            }); 
        }
    })
}


function openModal(id=null){
    if(id){
        $.ajax({
            url : baseURL + 'Home/getSubCategoryDetailsById',
            type : 'POST',
            data : {id : id},
            success : function(response){
                let title = 'Update Sub-Category';
                modal.modal('show');
                formData[0].reset();
                formData.validate().resetForm();
                $('#subCategoryLabel').text(title);
                $("#category").val(null).trigger("change");
                $('#category').select2({
                    dropdownParent: modal,
                    placeholder: "Select any category",
                    allowClear: true,
                });
                $("#cities").val(null).trigger("change");
                $('#cities').select2({
                    dropdownParent: modal,
                    placeholder: "Select any city",
                    allowClear: true,
                });
                $('#id').val(response[0].id);
                getCategories(response[0].cid)
                getCities(response[0].city_id);
                $('#title').val(response[0].title);
                $('#preImage').val(response[0].img);
                $("#imgPreview").attr("src",response[0].img);
            }
        })
    }else{
        let title = 'Add New Sub-Category';
        modal.modal('show');
        $('#subCategoryLabel').text(title);
        formData.validate().resetForm();
        formData[0].reset();
        $('#id').val('');
        $("#imgPreview").attr("src",`${baseURL}assets/images/common/placeholder.jpg`);
        $("#category").val(null).trigger("change");
        $('#category').select2({
            dropdownParent: modal,
            placeholder: "Select any category",
            allowClear: true,
        });
        $("#cities").val(null).trigger("change");
        $('#cities').select2({
            dropdownParent: modal,
            placeholder: "Select any city",
            allowClear: true,
        });
        getCategories();
        getCities();
    }
}


function changeSubCategoryStatus(id, status) {
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
              url  : baseURL + 'Home/changeSubCategoryStatus',
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

function deleteSubCategory(id, img=null, video=null){
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
              url  : baseURL + 'Home/deleteSubCategory',
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
        url : baseURL + 'Home/getSubCategoryDetailsById',
        type : 'POST',
        data : {id : id},
        success : function(response){
            //console.log(response[0]);
            let title = response[0].title;
            modalOne.modal('show');
            formDataOne[0].reset();
            $('#sid').val(response[0].id);
            $('#subCategoryVideoModalLabel').text(title);
            $("#videoPreview").attr("src", response[0].video);
            $('#preVideo').val(response[0].video);
        }
    })
}