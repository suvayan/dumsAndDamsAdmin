var tableData = $("#bestOfferServicesTable");
var modal = $('#bestOfferServicesModal');
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
            "url"  : baseURL + "Home/bestOfferServiceList",
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
            description: {required:true},
            bestOffer : {required:true},
            category : {required:true},
            subcategory : {required:true},
        },
        messages:{
            title: {required: 'title is required'},
            description: {required: 'description is required'},
            bestOffer: {required: 'Best Offer is required'},
            category: {required: 'category is required'},
            subcategory: {required: 'subcategory is required'},
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

    $('#category').on('change', function (){
        let cid = $('#category').val();
        getSubCategoryByCid(cid);
    })
});


function getBestOffers(id=null){
    $.ajax({
        url : baseURL + "Home/getBestOffers",
        type: "POST",
        success: function(response){
            $('#bestOffer').empty();
            $.each(response,function(index,response){
                $("#bestOffer").append($("<option></option>").attr({"value" :response.id, "selected": (response.id == id) ? true : false}).text(response.title));
            }); 
        }
    })
}


function getCategories(id=null){
    $.ajax({
        url : baseURL + "Home/getCategories",
        type: "POST",
        success: function(response){
            $('#category').empty();
            $.each(response,function(index,response){
                $("#category").append($("<option></option>").attr({"value" :response.id, "selected": (response.id == id) ? true : false}).text(response.cat_name));
            }); 
        }
    })
}

function getSubCategoryByCid(cid,id=null){
    $.ajax({
        url : baseURL + "Home/getSubCategoriesByCid",
        type: "POST",
        data:{cid:cid},
        success: function(response){
            $("#subcategory").empty();
            $.each(response,function(index,response){
                $("#subcategory").append($("<option></option>").attr({"value" :response.id, "selected": (response.id == id) ? true : false}).text(response.title));
            }); 
        }
    })
}



function openModal(id=null){
    if(id){
        $.ajax({
            url : baseURL + 'Home/getBestOfferServicesDetailsById',
            type : 'POST',
            data : {id : id},
            success : function(response){
                formData.validate().resetForm();
                formData[0].reset();
                let title = 'Update Service';
                modal.modal('show');
                $('#bestOfferServicesModalLabel').text(title);
                formData.validate().resetForm();
                formData[0].reset();
                $('#id').val(response[0].id);
                $('#title').val(response[0].title);
                $('#description').val(response[0].description);
                $('#preImage').val(response[0].img);
                $("#imgPreview").attr("src",response[0].img);
                getCategories(response[0].cid);
                $("#category").val(null).trigger("change");
                $('#category').select2({
                    dropdownParent: modal,
                    placeholder: "Select any category",
                    allowClear: true,
                });
                $("#subcategory").val(null).trigger("change");
                $('#subcategory').select2({
                    dropdownParent: modal,
                    placeholder: "Select any sub-category",
                    allowClear: true,
                });
                getSubCategoryByCid(response[0].cid, response[0].sid);
                getBestOffers(response[0].hid);
                $("#bestOffer").val(null).trigger("change");
                $('#bestOffer').select2({
                    dropdownParent: modal,
                    placeholder: "Select any Best Offer",
                    allowClear: true,
                });
            }
        })
    }else{
        let title = 'Add New Service';
        modal.modal('show');
        $('#bestOfferServicesModalLabel').text(title);
        formData.validate().resetForm();
        formData[0].reset();
        $('#id').val('');
        $("#imgPreview").attr("src",`${baseURL}assets/images/common/placeholder.jpg`);
        $("#bestOffer").val(null).trigger("change");
        $('#bestOffer').select2({
            dropdownParent: modal,
            placeholder: "Select any Best Offer",
            allowClear: true,
        });
        $("#category").val(null).trigger("change");
        $('#category').select2({
            dropdownParent: modal,
            placeholder: "Select any category",
            allowClear: true,
        });
        $("#subcategory").val(null).trigger("change");
        $('#subcategory').select2({
            dropdownParent: modal,
            placeholder: "Select any sub-category",
            allowClear: true,
        });
        getCategories();
        getBestOffers();
    }
}



function changeBestOfferServicesStatus(id, status) {
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
              url  : baseURL + 'Home/changeBestOfferServicesStatus',
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

function deleteBestOfferServices(id, hid, img=null, video=null){
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
              url  : baseURL + 'Home/deleteBestOfferServices',
              type : 'POST',
              data : { 
                  id : id,
                  hid : hid,
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