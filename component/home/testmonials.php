<?php
    
    $query =  mysqli_query($con,"SELECT * FROM `testimonials` WHERE `status`=1 order by id ASC");
    
 ?>


<section class="mt-5">
        <div class="container pt-5 pb-5">
            <div class="row">
                <div class="col-sm-4">
                    <img class="img-fluid vert-move" src="img/testimonial_img.png" />
                </div>
                <div class="col-sm-8">
                    <div id="carouselTestimonial" class="carousel carousel-testimonial slide carousel-fade pb-5"
                        data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselTestimonial" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselTestimonial" data-slide-to="1"></li>
                            <li data-target="#carouselTestimonial" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item text-left active testimonial_style">
                                <div class="p-1 rounded-circle m-auto">
                                    <h2>Testimonial</h2>
                                    <h1>What Our Clients Say</h1>
                                    <div class="d-flex flex-row mb-3">
                                        <div class="p-2">
                                            <div class="testi_profile_img">
                                                <img class="img-fluid" src="img/team-2.jpg" />
                                            </div>
                                        </div>
                                        <div class="p-2 mt-3">
                                            <h5>Client Name</h5>
                                            <p>Post: Web Designer</p>
                                        </div>
                                    </div>
                                </div>

                                <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu
                                    sem
                                    tempor,
                                    consectetur adipiscing elit varius quam at, luctus dui. Mauris magna metus
                                    consectetur
                                    adipiscing
                                    elit.</p>
                            </div>
                            <div class="carousel-item text-left testimonial_style">
                                <div class="p-1 rounded-circle m-auto">
                                    <h2>Testimonial 1</h2>
                                    <h1>What Our Clients Say</h1>
                                    <div class="d-flex flex-row mb-3">
                                        <div class="p-2">
                                            <div class="testi_profile_img">
                                                <img class="img-fluid" src="img/team-2.jpg" />
                                            </div>
                                        </div>
                                        <div class="p-2 mt-3">
                                            <h5>Client Name</h5>
                                            <p>Post: Web Designer</p>
                                        </div>
                                    </div>
                                </div>

                                <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu
                                    sem
                                    tempor,
                                    consectetur adipiscing elit varius quam at, luctus dui. Mauris magna metus
                                    consectetur
                                    adipiscing
                                    elit.</p>
                            </div>
                            <div class="carousel-item text-left testimonial_style">
                                <div class="p-1 rounded-circle m-auto">
                                    <h2>Testimonial 2</h2>
                                    <h1>What Our Clients Say</h1>
                                    <div class="d-flex flex-row mb-3">
                                        <div class="p-2">
                                            <div class="testi_profile_img">
                                                <img class="img-fluid" src="img/team-3.jpg" />
                                            </div>
                                        </div>
                                        <div class="p-2 mt-3">
                                            <h5>Client Name</h5>
                                            <p>Post: Web Designer</p>
                                        </div>
                                    </div>
                                </div>

                                <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu
                                    sem
                                    tempor,
                                    consectetur adipiscing elit varius quam at, luctus dui. Mauris magna metus
                                    consectetur
                                    adipiscing
                                    elit.</p>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselTestimonial" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselTestimonial" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>