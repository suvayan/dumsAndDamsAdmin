
                <div class="app-content main-content">
                    <div class="side-app">
                        <!--Page header-->
                        <div class="page-header">
                            <div class="page-leftheader">
                                <h4 class="page-title mb-0 text-primary">City</h4>
                            </div>
                        </div>
                        <!--End Page header-->
                        <!-- Row-1 -->
                        <div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header d-flex justify-content-between">
                                        <h4 class="page-title mb-0 text-primary">City List</h4>
                                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="openModal()"><i class="fa fa-plus"></i> Add</button>
									</div>
									<div class="card-body">
										<div class="table-responsive">
                                            <table id="cityTable" class="table table-striped table-bordered" style="width:100%">
							                    <thead>
                                                    <tr>
                                                        <th>Sl/No.</th>
                                                        <th>Image</th>
                                                        <th>City</th>
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
                <div class="modal fade" id="cityModal" tabindex="-1" aria-labelledby="cityModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="cityModalLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="modalBody">
                                <form id="formData" action="<?= base_url('Home/insertUpdateCity');?>" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="city" class="form-label">City Name</label>
                                        <input type="text" class="form-control" id="city" name="city"/>
                                    </div>
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">City Image</label>
                                        <img src="" width="250" alt="city" id="imgPreview" onerror="src='<?= base_url(); ?>assets/images/common/placeholder.jpg'"/>
                                        <input class="form-control" type="file" id="formFile" name="formFile" accept="image/*" onchange="loadFile(event)">
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
                <script src="<?= base_url();?>assets/ajax/city.js"></script>
                
