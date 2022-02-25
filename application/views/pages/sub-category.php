                <div class="app-content main-content">
                    <div class="side-app">
                        <!--Page header-->
                        <div class="page-header">
                            <div class="page-leftheader">
                                <h4 class="page-title mb-0 text-primary">Sub Category</h4>
                            </div>
                        </div>
                        <!--End Page header-->
                        <!-- Row-1 -->
                        <div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header d-flex justify-content-between">
                                        <h4 class="page-title mb-0 text-primary">Sub Category List</h4>
                                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="openModal()"><i class="fa fa-plus"></i> Add</button>
									</div>
									<div class="card-body">
										<div class="table-responsive">
                                            <table id="subCategoryTable" class="table table-striped table-bordered" style="width:100%">
							                    <thead>
                                                    <tr>
                                                        <th>Sl/No.</th>
                                                        <th>Title</th>
                                                        <th>Image</th>
                                                        <th>Video</th>
                                                        <th>Category</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Row-1 -->
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="subCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="subCategoryLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="subCategoryLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formData" action="<?= base_url('Home/insertUpdateSubCategory');?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
										<label class="form-label">Category</label>
										<select class="form-control" id= "category" name= "category" style="width: 100%;">
											
										</select>
                                        <div class="spinner-border" role="status" id="catSpinner" style="display:none;">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
									</div>
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title">
                                    </div>
                                    <div class="mb-3">
                                        <label for="formImage" class="form-label">Image</label>
                                        <img src="" width="250" alt="banner" id="imgPreview" onerror="src='<?= base_url(); ?>assets/images/common/placeholder.jpg'"/>
                                        <input class="form-control" type="file" id="formImage" name="formImage" accept="image/*" onchange="loadFile(event)">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="cities" class="form-label">Cities</label>
                                        <select multiple="multiple" class="form-control" id="cities" name="cities[]" style="width: 100%;">

                                        </select>
                                        <div class="spinner-border" role="status" id="citySpinner" style="display:none;">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control" id="id" name="id"/>
                                    <input type="hidden" class="form-control" id="preImage" name="preImage"/>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="subCategoryVideoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="subCategoryVideoModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="subCategoryVideoModalLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formDataOne"  method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="formVideo" class="form-label">Sub-Category Video</label>
                                        <video controls width="250" src="" id="videoPreview"></video>
                                        <input class="form-control" type="file" id="formVideo" name="formVideo" accept="video/*" onchange="loadVideo(event)">
                                    </div>
                                    <input type="hidden" class="form-control" id="sid" name="sid"/>
                                    <input type="hidden" class="form-control" id="preVideo" name="preVideo"/>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </form>   
                            </div>
                        </div>
                    </div>
                </div>
                <script src="<?= base_url();?>assets/ajax/sub-category.js"></script>