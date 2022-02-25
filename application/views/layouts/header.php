                <div class="app-header header main-header1">
                    <div class="container-fluid">
                        <div class="d-flex">
                            <a class="header-brand" href="index.html">
                            <img src="<?= base_url();?>assets/images/common/logo.png" class="header-brand-img desktop-lgo" alt="Azea logo">
                            </a>
                            <div class="app-sidebar__toggle d-flex" data-bs-toggle="sidebar">
                                <a class="open-toggle" href="javascript:void(0);">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="feather feather-align-left header-icon" width="24" height="24" viewBox="0 0 24 24">
                                        <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"/>
                                    </svg>
                                </a>
                            </div>
                            
                            <!-- SEARCH -->
                            <div class="d-flex order-lg-2 ms-auto main-header-end">
                                <button  class="navbar-toggler navresponsive-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="true" aria-label="Toggle navigation">
                                <i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
                                </button>
                                <div class="navbar navbar-expand-lg navbar-collapse responsive-navbar p-0">
                                    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                                        <div class="d-flex order-lg-2">
                                            <div class="dropdown profile-dropdown d-flex">
                                                <a href="javascript:void(0);" class="nav-link pe-0 leading-none" data-bs-toggle="dropdown">
                                                <span class="header-avatar1">
                                                <img src="<?= base_url();?>assets/images/common/profile.png" alt="img" class="avatar avatar-md brround">
                                                </span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow animated">
                                                    <!-- <div class="text-center">
                                                        <div class="text-center user pb-0 font-weight-bold">Patrenna</div>
                                                        <span class="text-center user-semi-title">Web Designer</span>
                                                        <div class="dropdown-divider"></div>
                                                    </div> -->
                                                    <a class="dropdown-item d-flex" href="#">
                                                        <svg class="header-icon me-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                                            <path d="M0 0h24v24H0V0z" fill="none"/>
                                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM7.07 18.28c.43-.9 3.05-1.78 4.93-1.78s4.51.88 4.93 1.78C15.57 19.36 13.86 20 12 20s-3.57-.64-4.93-1.72zm11.29-1.45c-1.43-1.74-4.9-2.33-6.36-2.33s-4.93.59-6.36 2.33C4.62 15.49 4 13.82 4 12c0-4.41 3.59-8 8-8s8 3.59 8 8c0 1.82-.62 3.49-1.64 4.83zM12 6c-1.94 0-3.5 1.56-3.5 3.5S10.06 13 12 13s3.5-1.56 3.5-3.5S13.94 6 12 6zm0 5c-.83 0-1.5-.67-1.5-1.5S11.17 8 12 8s1.5.67 1.5 1.5S12.83 11 12 11z"/>
                                                        </svg>
                                                        <div class="fs-13">Profile</div>
                                                    </a>
                                                    <a class="dropdown-item d-flex" href="<?= base_url('Home/logout');?>">
                                                        <svg class="header-icon me-2" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24">
                                                            <g>
                                                                <rect fill="none" height="24" width="24"/>
                                                            </g>
                                                            <g>
                                                                <path d="M11,7L9.6,8.4l2.6,2.6H2v2h10.2l-2.6,2.6L11,17l5-5L11,7z M20,19h-8v2h8c1.1,0,2-0.9,2-2V5c0-1.1-0.9-2-2-2h-8v2h8V19z"/>
                                                            </g>
                                                        </svg>
                                                        <div class="fs-13">Sign Out</div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>