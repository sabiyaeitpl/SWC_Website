<div class="container-fluid bg-light mt-5  mb-5">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-5">
                    <div class="container-fluid p-0 margin_munus_top">
                        <div id="header-carousel" class="carousel-12 slide carousel-fade product_details_section"
                            data-ride="carousel" data-aos="fade-up">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="w-100" src="<?php echo PRODUCT_IMAGE_SITE_PATH.$products_result['image'] ?>" alt="<?php echo $products_result['name']; ?>">
                                </div>
                   
                               <?php
                                  $image_sql = mysqli_query($con,"SELECT * FROM `product_image` where product_id=$id");
                                  while ($row_images = mysqli_fetch_assoc($image_sql)) {
                               ?>
                                <div class="carousel-item">
                                    <img class="w-100" src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row_images['image'] ?>" alt="<?php echo $products_result['name']; ?>">
                                </div>
                               <?php 
                                  }
                               ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 m-0 my-lg-5 pt-0 pb-5 pb-lg-2  mt-0">
                    <div class="padding_0">
                        <h4 class="m-0 p-0 mb-2 h5 bold text-uppercase">Product Details</h4>
                        <h2 class="text-uppercase"><?php echo $products_result['name']; ?></h2>
                         <?php  echo $products_result['description'] ?>
                        <h6>
                            Looking to source machinery from an Indian Engineering Consulting company and save up to 50%
                            of your investment.Ask for
                            a <a href="#" data-toggle="modal" data-target="#exampleModal2"> <strong> FREE QUOTE </strong> </a> or <a
                                href="contact_us.php" target="_blank"> <strong> CONTACT US.
                                </strong></a>
                        </h6>
                    </div>
                </div>
            </div>

        </div>
    </div>