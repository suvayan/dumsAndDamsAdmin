                <div class="app-content main-content">
                    <div class="side-app">
                        <!--Page header-->
                        <div class="page-header">
                            <div class="page-leftheader">
                                <h4 class="page-title mb-0 text-primary">Dashboard</h4>
                            </div>

                        </div>
                        <!--End Page header-->
                        <!-- Row-1 -->
                        <div class="row">
                            
                            <div class="col-xl-2 col-lg-6 col-md-6 col-xm-12">
                                <div class="card overflow-hidden dash1-card border-0 dash1">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-6">
                                                <div class="">
                                                    <span class="fs-14 font-weight-normal">Total User</span>
                                                    <h2 class="mb-2 number-font carn1 font-weight-bold"><?php echo $pageData['Total Uer']; ?></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-6 col-md-6 col-xm-12">
                                <div class="card overflow-hidden dash2-card border-0 dash2">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-6">
                                                <div class="">
                                                    <span class="fs-14 font-weight-normal">Total Partner</span>
                                                    <h2 class="mb-2 number-font carn1 font-weight-bold"><?php echo $pageData['Total Partner']; ?></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-6 col-md-6 col-xm-12">
                                <div class="card overflow-hidden dash3-card border-0 dash3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-6">
                                                <div class="">
                                                    <span class="fs-14 font-weight-normal">Total Order</span>
                                                    <h2 class="mb-2 number-font carn1 font-weight-bold"><?php echo $pageData['Total Order']; ?></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                                <div class="card overflow-hidden dash4-card border-0 dash4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-9 col-sm-9 col-9">
                                                <div class="">
                                                    <span class="fs-14 font-weight-normal">Totla Income</span>
                                                    <h2 class="mb-2 number-font carn1 font-weight-bold">₹<?php echo number_format($pageData['Totla Income'],2); ?></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                                <div class="card overflow-hidden dash4-card border-0 dash4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-9 col-sm-9 col-9">
                                                <div class="">
                                                    <span class="fs-14 font-weight-normal">Total Tax</span>
                                                    <h2 class="mb-2 number-font carn1 font-weight-bold">₹<?php echo number_format($pageData['Total Tax'],2); ?></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                             
                        </div>
                        <!-- End Row-1 -->
                        <!-- Row-3 -->
                        <div class="row row-deck">
                            
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-5">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Top Products
                                        </h3>
                                        <div class="card-options">
                                            <a href="<?= base_url('home/brand');?>" class="btn btn-sm btn-primary">View All</a>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-hover card-table table-vcenter text-nowrap">
                                                <thead class="border-bottom-0 pt-3 pb-3">
                                                    <tr>
                                                        <th class="text-center">s.no</th>
                                                        <th>Product Category</th>
                                                        <th>Product Name</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    if(!empty($pageData['productList'])):
                                                        $i = 1;
                                                        foreach($pageData['productList'] as $pRow):
                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?= $i; ?></td>
                                                        <td><img class="avatat avatar-md brround me-2" src="<?= $pRow->img ;?>" alt="img"></td>
                                                        <td class="fs-13"><?= $pRow->brand ;?></td>
                                                        <td>
                                                            <?= ($pRow->status == '1')? '<span class="badge fs-11 bg-success-transparent text-success ms-2">Published</span>' : '<span class="badge fs-11 bg-danger-transparent text-danger ms-2">Unpublished</span>' ;?>
                                                        </td>
                                                    </tr>
                                                <?php
                                                        $i++;
                                                        endforeach;
                                                    endif;
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Recent Activity
                                        </h3>
                                        <div class="card-options">
                                            <a href="<?= base_url('home/order');?>" class="btn btn-sm btn-primary">View All</a>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <ul class="recent-activity">
                                            <?php
                                                if(!empty($pageData['orderList'])):
                                                    $i = 1;
                                                    foreach($pageData['orderList'] as $odrData):
                                            ?>
                                            <li class="mb-5 mt-5">
                                                <div>
                                                    <span class="activity-timeline bg-primary text-white"><?php echo $i;?></span>
                                                    <div class="activity-timeline-content">
                                                        <span class="font-weight-normal1 fs-13">Order Placed By <?php echo (!empty($odrData->name))? $odrData->name: ((!empty($odrData->email))? $odrData->email : $odrData->mobile);?> </span><span class="text-muted fs-12 float-end"><?php echo date('F d, Y', strtotime($odrData->datetime));?> <?php echo date('H:i A', strtotime($odrData->datetime));?></span>
                                                        <p class="text-muted fs-12 mt-1">Order Ammount: ₹<?php echo $odrData->subtotal;?></p>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php
                                                    $i++;
                                                    endforeach;
                                                endif;
                                            ?>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-3">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Revenue Of This Month</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-6">
                                            <!--<div class="d-flex align-items-center justify-content-between">-->
                                            <!--    <span class="text-muted fs-13 mb-1">Monthly Profit</span>-->
                                            <!--</div>-->
                                            <!--<div class="d-flex justify-content-between mb-1">-->
                                            <!--    <span class="fs-16 font-weight-normal1">$25,854</span>-->
                                            <!--</div>-->
                                            <!--<div class="progress progress-sm">-->
                                            <!--    <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" style="width: 50%"></div>-->
                                            <!--</div>-->
                                        </div>
                                        <div class="mb-6">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="text-muted fs-13 mb-1">Monthly Orders</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-1">
                                                <span class="fs-16 font-weight-normal1">₹<?php echo ($pageData['monthlyRevenue'][0]->monthlyOrder) ? number_format($pageData['monthlyRevenue'][0]->monthlyOrder, 2) : '';?></span>
                                            </div>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" style="width: 80%"></div>
                                            </div>
                                        </div>
                                        <div class="mb-6">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="text-muted fs-13 mb-1">Monthly Revenue</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-1">
                                                <span class="fs-16 font-weight-normal1">₹<?php echo ($pageData['monthlyRevenue'][0]->monthlyRevenue) ? number_format($pageData['monthlyRevenue'][0]->monthlyRevenue, 2) : '';?></span>
                                            </div>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width: 80%"></div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="text-muted fs-13 mb-1">Monthly Expenses</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-1">
                                                <span class="fs-16 font-weight-normal1">₹<?php echo ($pageData['monthlyRevenue'][0]-> monthlyExpence) ? number_format($pageData['monthlyRevenue'][0]-> monthlyExpence, 2) : '';?></span>
                                            </div>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-pink progress-bar-striped progress-bar-animated" style="width: 80%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Row-3 -->
                        <!--Row-->
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Invoice Summary</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="invoiceTable" class="table table-striped table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Sl/No.</th>
                                                        <th>Order ID</th>
                                                        <th>Customer Name</th>
                                                        <th>Partner Name</th>
                                                        <th>Partner Invoice</th>
                                                        <th>Tax Invoice</th>
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
                    </div>
                    <script src="<?= base_url();?>assets/ajax/invoice.js"></script>
                </div>