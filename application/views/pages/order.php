                <div class="app-content main-content">
                    <div class="side-app">
                        <!--Page header-->
                        <div class="page-header">
                            <div class="page-leftheader">
                                <h4 class="page-title mb-0 text-primary">Order</h4>
                            </div>
                        </div>
                        <!--End Page header-->
                        <!-- Row-1 -->
                        <div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header d-flex justify-content-between">
                                        <h4 class="page-title mb-0 text-primary">Order List</h4>
									</div>
									<div class="card-body">
										<div class="table-responsive">
                                            <table id="orderTable" class="table table-striped table-bordered" style="width:100%">
							                    <thead>
                                                    <tr>
                                                        <th>Sl/No.</th>
                                                        <th>User</th>
                                                        <th>Category</th>
                                                        <th>Payment Method</th>
                                                        <th>Order Date</th>
                                                        <th>Order Time</th>
                                                        <th>Address</th>
                                                        <th>Status</th>
                                                        <th>Total</th>
                                                        <th>Phone Number</th>
                                                        <th>Booking Date</th>
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
                <div class="modal fade" id="subOrderModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="subOrderModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="subOrderModalLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered border-primary">
                                    <thead>
                                        <tr>
                                            <td>Services</td>
                                            <td>Partner</td>
                                            <td>Count</td>
                                            <td>Partner Share</td>
                                            <td>Company Share</td>
                                        </tr>
                                    </thead>
                                    <tbody id="subOrderBody">
                                    </tbody>
                                </table>  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="invoiceModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="invoiceModalLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered border-primary">
                                    <thead>
                                        <tr>
                                            <td>Partner</td>
                                            <td>Partner Invoice</td>
                                            <td>Tax Invoice</td>
                                        </tr>
                                    </thead>
                                    <tbody id="invoiceBody">
                                    </tbody>
                                </table>  
                            </div>
                        </div>
                    </div>
                </div>
                <script src="<?= base_url();?>assets/ajax/order.js"></script>