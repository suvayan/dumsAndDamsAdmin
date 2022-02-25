                <aside class="app-sidebar">
                    <div class="app-sidebar__logo">
                        <a class="header-brand" href="<?= base_url('Home/index');?>">
                        <img src="<?= base_url();?>assets/images/common/logo.png" class="header-brand-img desktop-lgo" alt="Azea logo">
                        </a>
                    </div>
                    <ul class="side-menu app-sidebar3">
                        <li class="side-item side-item-category">Main</li>
                        <li class="slide">
                            <a class="side-menu__item"  href="<?= base_url('Home/index');?>">
                                <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"/>
                                </svg>
                                <span class="side-menu__label">Dashboard</span>
                            </a>
                        </li>

                        <li class="side-item side-item-category">Banner Section</li>
                        <li class="slide">
                            <a class="side-menu__item"  href="<?= base_url('Home/banner');?>">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1 6h-4V5h4v4zm-9 4H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6H5v-4h4v4zm8-6c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"></path>
                                </svg>
                                <span class="side-menu__label">Banner</span>
                            </a>
                        </li>

                        <li class="side-item side-item-category">City Section</li>
                        <li class="slide">
                            <a class="side-menu__item"  href="<?= base_url('Home/city');?>">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1 6h-4V5h4v4zm-9 4H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6H5v-4h4v4zm8-6c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"></path>
                                </svg>
                                <span class="side-menu__label">City</span>
                            </a>
                        </li>

                        <li class="side-item side-item-category">General Category Section</li>
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
								<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1 6h-4V5h4v4zm-9 4H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6H5v-4h4v4zm8-6c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"></path>
                                </svg>
                                <span class="side-menu__label">Category Section</span><i class="angle fe fe-chevron-right"></i>
                            </a>
                            <ul class="slide-menu">
                                <li><a href="<?= base_url('Home/category');?>" class="slide-item"> Category</a></li>
                                <li><a href="<?= base_url('Home/sub_category');?>" class="slide-item"> Sub Category</a></li>
                                <li><a href="<?= base_url('Home/child');?>" class="slide-item"> Child</a></li>
                                <li><a href="<?= base_url('Home/childService');?>" class="slide-item"> Child Service</a></li>
                                <li><a href="<?= base_url('Home/addon');?>" class="slide-item"> Add On</a></li>
                            </ul>
                        </li>

                        <li class="side-item side-item-category">Offer Section</li>
                        <li class="slide">
                            <a class="side-menu__item"  data-bs-toggle="slide" href="javascript:void(0);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1 6h-4V5h4v4zm-9 4H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6H5v-4h4v4zm8-6c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"></path>
                                </svg>
                                <span class="side-menu__label">Offer Section</span><i class="angle fe fe-chevron-right"></i>
                            </a>
                            <ul class="slide-menu">
                                <li><a href="<?= base_url('Home/offer');?>" class="slide-item"> Offers</a></li>
                                <li><a href="<?= base_url('Home/bestOffer');?>" class="slide-item"> Best Offers</a></li>
                                <li><a href="<?= base_url('Home/bestOfferServices');?>" class="slide-item"> Best Offers Services</a></li>
                            </ul>
                        </li>

                        <li class="side-item side-item-category">Beauty Product Section</li>
                        <li class="slide">
                            <a class="side-menu__item"  data-bs-toggle="slide" href="javascript:void(0);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1 6h-4V5h4v4zm-9 4H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6H5v-4h4v4zm8-6c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"></path>
                                </svg>
                                <span class="side-menu__label">Beauty Product Section</span><i class="angle fe fe-chevron-right"></i>
                            </a>
                            <ul class="slide-menu">
                                <li><a href="<?= base_url('Home/brand');?>" class="slide-item"> Brand</a></li>
                                <li><a href="<?= base_url('Home/product');?>" class="slide-item"> Product</a></li>
                            </ul>
                        </li>

                        <li class="side-item side-item-category">Sanitization Section</li>
                        <li class="slide">
                            <a class="side-menu__item"  href="<?= base_url('Home/sanitization');?>">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1 6h-4V5h4v4zm-9 4H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6H5v-4h4v4zm8-6c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"></path>
                                </svg>
                                <span class="side-menu__label">Sanitization</span>
                            </a>
                        </li>

                        <li class="side-item side-item-category">Testimonial Section</li>
                        <li class="slide">
                            <a class="side-menu__item"  href="<?= base_url('Home/testimonial');?>">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1 6h-4V5h4v4zm-9 4H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6H5v-4h4v4zm8-6c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"></path>
                                </svg>
                                <span class="side-menu__label">Testimonial</span>
                            </a>
                        </li>
                        <li class="side-item side-item-category">Payout Section</li>
                        <li class="slide">
                            <a class="side-menu__item"  href="<?= base_url('Home/payout');?>">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1 6h-4V5h4v4zm-9 4H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6H5v-4h4v4zm8-6c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"></path>
                                </svg>
                                <span class="side-menu__label">Payout</span>
                            </a>
                        </li>
                        
                        <li class="side-item side-item-category">Order Section</li>
                        <li class="slide">
                            <a class="side-menu__item"  href="<?= base_url('Home/order');?>">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1 6h-4V5h4v4zm-9 4H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6H5v-4h4v4zm8-6c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"></path>
                                </svg>
                                <span class="side-menu__label">Order</span>
                            </a>
                        </li>
                        <li class="side-item side-item-category">User & Partner Section</li>
                        <li class="slide">
                            <a class="side-menu__item"  data-bs-toggle="slide" href="javascript:void(0);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1 6h-4V5h4v4zm-9 4H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6H5v-4h4v4zm8-6c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"></path>
                                </svg>
                                <span class="side-menu__label">User & Partner Section</span><i class="angle fe fe-chevron-right"></i>
                            </a>
                            <ul class="slide-menu">
                                <li><a href="<?= base_url('Home/user');?>" class="slide-item"> User</a></li>
                                <li><a href="<?= base_url('Home/partner');?>" class="slide-item"> Partner</a></li>
                            </ul>
                        </li>


                        <!-- <li class="side-item side-item-category">Components</li>
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
								<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1 6h-4V5h4v4zm-9 4H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6H5v-4h4v4zm8-6c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"></path>
                                </svg>
                                <span class="side-menu__label">Utilities</span><i class="angle fe fe-chevron-right"></i>
                            </a>
                            <ul class="slide-menu">
                                <li><a href="element-border.html" class="slide-item"> Border</a></li>
                                <li><a href="element-colors.html" class="slide-item"> Colors</a></li>
                                <li><a href="element-display.html" class="slide-item"> Display</a></li>
                                <li><a href="element-flex.html" class="slide-item"> Flex Items</a></li>
                                <li><a href="element-height.html" class="slide-item"> Height</a></li>
                                <li><a href="element-margin.html" class="slide-item"> Margin</a></li>
                                <li><a href="element-padding.html" class="slide-item"> Padding</a></li>
                                <li><a href="element-typography.html" class="slide-item"> Typhography</a></li>
                                <li><a href="element-width.html" class="slide-item"> Width</a></li>
                            </ul>
                        </li> -->
                    </ul>
                </aside>