<?php 
     $query =  mysqli_query($con,"SELECT * FROM `count`");
     $row = mysqli_fetch_assoc($query);
     $heading1 = $row['heading1'];
     $heading2 = $row['heading2'];
     $heading3 = $row['heading3'];
     $heading4 = $row['heading4'];
     $heading5 = $row['heading5'];
     $heading6 = $row['heading6'];
     $image = COUNT_IMAGE_SITE_PATH . $row['image'];
  ?>
 
 
 <!-- About Start -->
 <div class="container-fluid bg-light mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 m-0 my-lg-5">
                    <div class="row mt-5">
                        <div class="col-sm-6">
                            <div class="stat">
                                <span class="stat-count bold"><?php echo $heading2 ?></span><b class="text-danger h1 bold">+</b>
                                <h4 class="stat-detail">Projects</h4>
                                <p><?php echo $heading1 ?></p>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="stat">
                                <span class="stat-count bold"><?php echo $heading4 ?></span><b class="text-danger h1 bold">+</b>
                                <h4 class="stat-detail">Clients</h4>
                                <p><?php echo $heading3 ?></p>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6">
                                    <div class="stat">
                                        <span class="stat-count bold"><?php echo $heading6 ?></span><b class="text-danger h1 bold">%</b>
                                        <h4 class="stat-detail">Satisfaction</h4>
                                        <p><?php echo $heading5 ?></p>
                                    </div>
                                </div>
                                <div class="col-sm-3"></div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-5" data-aos="fade-up">
                    <div class="position-relative me-4">
                        <img class="img-fluid" src="<?php echo $image ?>" alt="" />
                        <div class="img_box_1 img_box_left position-absolute bg-danger text-center more_about pt-4">
                            <h2 class="h1 text-white mt-5 bold">More</h2>
                            <h4 class="text-white h2">About Us</h4>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- About End -->