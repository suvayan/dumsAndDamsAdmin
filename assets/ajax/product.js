var tableData = $("#productTable");
var modal = $('#productModal');
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
            "url"  : baseURL + "Home/productList",
            "type" : "POST"
        },
        "columnDefs" : [{
            "targets" : [-1],
            "orderable": false
        }]
    });
    

    formData.validate({
        rules: {
            product: {required:true},
            brand: {required:true},
            formImage: {required: ($('#preImage').val())?false:true},
        },
        // highlight:function(element){
        //     $(element).css('border', '2px solid red');
        // },
        // unhighlight:function(element){
        //     $(element).css('border', '');
        // },
        messages:{
            product: {required: 'product name is required'},
            brand: {required: 'brand name is required'},
            formImage:{required: 'image is required'}
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

function getBrands(id=null){
    $('#brandSpinner').show();
    $('#brand').hide();
    $.ajax({
        url : baseURL + "Home/getBrands",
        type: "POST",
        success: function(response){
            $('#brandSpinner').hide();
            $('#brand').show();
            $('#brand').empty();
            $.each(response,function(index,response){
                $("#brand").append($("<option></option>").attr({"value" :response.id, "selected": (response.id == id) ? true : false}).text(response.brand));
            }); 
        }
    })
}


function openModal(id=null){
    if(id){
        $.ajax({
            url : baseURL + 'Home/getProductDetailsById',
            type : 'POST',
            data : {id : id},
            success : function(response){
                let title = 'Update Product';
                modal.modal('show');
                formData.validate().resetForm();
                formData[0].reset();
                $('#productModalLabel').text(title);
                $('#id').val(response[0].id);
                $('#product').val(response[0].name);
                $('#preImage').val(response[0].img);
                $("#imgPreview").attr("src", response[0].img);
                $("#brand").val(null).trigger("change");
                $('#brand').select2({
                    dropdownParent: modal,
                    placeholder: "Select any brand",
                    allowClear: true,
                });
                getBrands(response[0].bid);
            }
        })
    }else{
        let title = 'Add New Product';
        modal.modal('show');
        formData.validate().resetForm();
        formData[0].reset();
        $('#id').val('');
        $('#productModalLabel').text(title);
        $("#imgPreview").attr("src",`${baseURL}assets/images/common/placeholder.jpg`);
        $("#brand").val(null).trigger("change");
        $('#brand').select2({
            dropdownParent: modal,
            placeholder: "Select any brand",
            allowClear: true,
        });
        getBrands();
    }
}


function changeProductStatus(id, status) {
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
              url  : baseURL + 'Home/changeProductStatus',
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

function deleteProduct(id, img=null){
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
              url  : baseURL + 'Home/deleteProduct',
              type : 'POST',
              data : { 
                  id : id,
                  img : img,
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