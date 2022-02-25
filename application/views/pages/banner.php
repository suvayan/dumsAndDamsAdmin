                <div class="app-content main-content">
                    <div class="side-app">
                        <!--Page header-->
                        <div class="page-header">
                            <div class="page-leftheader">
                                <h4 class="page-title mb-0 text-primary">Banner</h4>
                            </div>
                        </div>
                        <!--End Page header-->
                        <!-- Row-1 -->
                        <div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header d-flex justify-content-between">
                                        <h4 class="page-title mb-0 text-primary">Banner List</h4>
                                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="openModal()"><i class="fa fa-plus"></i> Add</button>
									</div>
									<div class="card-body">
										<div class="table-responsive">
                                            <table id="bannerTable" class="table table-striped table-bordered" style="width:100%">
							                    <thead>
                                                    <tr>
                                                        <th>Sl/No.</th>
                                                        <th>Image</th>
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
                <div class="modal fade" id="bannerModal" tabindex="-1" aria-labelledby="bannerModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="bannerModalLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formData" action="<?= base_url('Home/insertBanner');?>" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Banner</label>
                                        <img src="" width="250" alt="banner" id="imgPreview" onerror="src='<?= base_url(); ?>assets/images/common/placeholder.jpg'"/>
                                        <input class="form-control" type="file" id="formFile" name="formFile" accept="image/*" onchange="loadFile(event)">
                                    </div>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="bannerDetailsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="bannerDetailsModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="bannerDetailsModalLabel">Other Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <from id="formDataOne" method="post">
                                    <div class="mb-3">
                                        <img src="" width="250" alt="banner" id="imgShow"/>
                                    </div>
                                    <div class="form-group">
										<label class="form-label">Category</label>
                                        <div class="spinner-border" role="status" id="catSpinner" style="display:none;">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
										<select class="form-control" id= "category" name= "category" style="width: 100%;" onchange="getSubCategodyByCategory()">
											
										</select>
									</div>
                                    <div class="form-group">
										<label class="form-label">Sub Category</label>
                                        <div class="spinner-border" role="status" id="subcatSpinner" style="display:none;">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
										<select class="form-control" id= "subcategory" name= "subcategory" style="width: 100%;">
											
										</select>
									</div>
                                    <input type="hidden" name="bid" id="bid">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="updateBannerOtherDetails()">Save</button>
                                </from>
                            </div>
                        </div>
                    </div>
                </div>



                

                <script src="<?= base_url();?>assets/ajax/banner.js"></script>