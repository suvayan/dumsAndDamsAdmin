var tableData = $("#bannerTable");
var modal = $('#bannerModal');
var modalOne = $('#bannerDetailsModal');
var formData  = $("#formData");
var formDataOne  = $("#formDataOne");

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
            "url"  : baseURL + "Home/BannerList",
            "type" : "POST"
        },
        "columnDefs" : [{
            "targets" : [-1],
            "orderable": false
        }]
    });

    formData.validate({
        rules: {
            formFile: {required:true}
        },
        messages:{
            formFile: {required: 'Banner is required'}
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


function openModal(){
    let title = 'Add Banner';
    modal.modal('show');
    $('#bannerModalLabel').text(title);
    $("#imgPreview").attr("src",`${baseURL}assets/images/common/placeholder.jpg`);
    formData.validate().resetForm();
    formData[0].reset();
}

function deleteBanner(id,img){
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
            if (result.isConfirmed) {
                $.ajax({
                    url  : baseURL + 'Home/deleteBanner',
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
        }
    });
}

function BannerStatusChange(status, id){
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
              url  : baseURL + 'Home/changeBannerStatus',
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

function getSubCategoryByCid(cid,id=null){
    $('#subcatSpinner').show();
    $('#subcategory').hide();
    $.ajax({
        url : baseURL + "Home/getSubCategoriesByCid",
        type: "POST",
        data:{cid:cid},
        success: function(response){
            $('#subcatSpinner').hide();
            $('#subcategory').show();
            $("#subcategory").empty();
            $.each(response,function(index,response){
                $("#subcategory").append($("<option></option>").attr({"value" :response.id, "selected": (response.id == id) ? true : false}).text(response.title));
            }); 
        }
    })
}

function getSubCategodyByCategory(){
    let cid = $('#category').val();
    getSubCategoryByCid(cid);
}

function bannerDetailsView(id){
    $.ajax({
        url : baseURL + 'Home/getBannerDetailsById',
        type : "POST",
        data : {id : id},
        success: function(response){
            console.log(response);
            modalOne.modal('show');
            $("#category").val(null).trigger("change");
            $('#category').select2({
                dropdownParent: modalOne,
                placeholder: "Select any category",
                allowClear: true,
            });
            $("#subcategory").val(null).trigger("change");
            $('#subcategory').select2({
                dropdownParent: modalOne,
                placeholder: "Select any sub-category",
                allowClear: true,
            });
            if(response.status == 'success'){
                getCategories(response.data[0].cid);
                getSubCategoryByCid(response.data[0].cid, response.data[0].sid);
                $('#imgShow').attr("src", response.data[0].img);
                $('#bid').val(response.data[0].id);
            }
        }
    })
}

function updateBannerOtherDetails(){
    let category = $('#category').val();
    let subcategory = $('#subcategory').val();
    let bid = $('#bid').val();
    let url = baseURL + 'Home/updateBannerOtherDetails';
    $.post(url,{id:bid, cid:category, sid:subcategory},function(response) {
        //console.log(response);
        if(response.status == 'success'){
            modalOne.modal('hide');
            toastr.success(response.message);
            reloadTable();
        }else{
            modalOne.modal('hide');
            toastr.error(response.message);
            reloadTable();
        }
    })
}


