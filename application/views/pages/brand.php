                <div class="app-content main-content">
                    <div class="side-app">
                        <!--Page header-->
                        <div class="page-header">
                            <div class="page-leftheader">
                                <h4 class="page-title mb-0 text-primary">Brand</h4>
                            </div>
                        </div>
                        <!--End Page header-->
                        <!-- Row-1 -->
                        <div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header d-flex justify-content-between">
                                        <h4 class="page-title mb-0 text-primary">Brand List</h4>
                                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="openModal()"><i class="fa fa-plus"></i> Add</button>
									</div>
									<div class="card-body">
										<div class="table-responsive">
                                            <table id="brandTable" class="table table-striped table-bordered" style="width:100%">
							                    <thead>
                                                    <tr>
                                                        <th>Sl/No.</th>
                                                        <th>Image</th>
                                                        <th>Brand</th>
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
                <div class="modal fade" id="brandModal" tabindex="-1" aria-labelledby="brandModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="brandModalLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="modalBody">
                                <form id="formData" action="<?= base_url('Home/insertUpdateBrand');?>" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="brand" class="form-label">Brand</label>
                                        <input type="text" class="form-control" id="brand" name="brand"/>
                                    </div>
                                    <div class="mb-3">
                                        <label for="formImage" class="form-label">Brand Image</label>
                                        <img src="" width="250" alt="" id="imgPreview" onerror="src='<?= base_url(); ?>assets/images/common/placeholder.jpg'"/>
                                        <input class="form-control" type="file" id="formImage" name="formImage" accept="image/*" onchange="loadFile(event)">
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
                <script src="<?= base_url();?>assets/ajax/brand.js"></script>