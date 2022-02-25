            <div class="app-content main-content">
                    <div class="side-app">
                        <!--Page header-->
                        <div class="page-header">
                            <div class="page-leftheader">
                                <h4 class="page-title mb-0 text-primary">Payout</h4>
                            </div>
                        </div>
                        <!--End Page header-->
                        <!-- Row-1 -->
                        <div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header d-flex justify-content-between">
                                        <h4 class="page-title mb-0 text-primary">Payout List</h4>
									</div>
									<div class="card-body">
										<div class="table-responsive">
                                            <table id="payoutTable" class="table table-striped table-bordered" style="width:100%">
							                    <thead>
                                                    <tr>
                                                        <th>Sl/No.</th>
                                                        <th>Image</th>
                                                        <th>Name</th>
                                                        <th>Ammount</th>
                                                        <th>Transaction ID</th>
                                                        <th>Bank Name</th>
                                                        <th>IFSC</th>
                                                        <th>Account</th>
                                                        <th>UPI</th>
                                                        <th>Date</th>
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
                <div class="modal fade" id="payoutModal" tabindex="-1" aria-labelledby="payoutModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="payoutModalLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="modalBody">
                                <form id="formData" action="<?= base_url('Home/updatePayout');?>" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="transId" class="form-label">Transaction ID</label>
                                        <input type="text" class="form-control" id="transId" name="transId"/>
                                    </div>
                                    <input type="hidden" class="form-control" id="id" name="id"/>
                                    <input type="hidden" class="form-control" id="pid" name="pid"/>
                                    <input type="hidden" class="form-control" id="amt" name="amt"/>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="<?= base_url();?>assets/ajax/payout.js"></script>