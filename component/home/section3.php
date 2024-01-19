<?php 
     $query =  mysqli_query($con,"SELECT * FROM `about` WHERE `status`=1 and id=2");
     $row = mysqli_fetch_assoc($query);
     $heading1 = $row['heading1'];
     $heading2 = $row['heading2'];
     $heading3 = $row['heading3'];
     $heading4 = $row['heading4'];
     $image = CONTENT_IMAGE_SITE_PATH . $row['image'];
  ?>
<section class="para1 position-relative" style="background-image: url(<?php echo $image; ?>);" data-aos="fade-up">
        <div class="para1_box1 bg-danger position-absolute text-center p-3">
            <h5 class="text-white mt-4 bold"><?php echo $heading1 ?></h5>
            <p class="text-white mb-0"><?php echo $heading2 ?></p>
            <a href="" class="btn btn-dark py-md-3 px-md-5 mt-2 mt-md-4">Learn More</a>
        </div>
        <div class="para1_box2 position-absolute p-4 text-center hide_box">
            <h3 class="text-white bold"><?php echo $heading3 ?></h3>
            <p class="text-white"><?php echo $heading4 ?></p>
            <div class="row py-2">
                <div class="col-sm-6">
                    <div class="align-items-center mb-2">
                        <img width="50px" alt="" src="img/icon4.png" />
                        <p class="text-truncate m-0 d-block text-white">Tap Hole Drill Machine</p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="align-items-center mb-2">
                        <img width="50px" alt="" src="img/icon5.png" />
                        <p class="text-truncate m-0 d-block text-white">Auto Stock Level Monitoring System</p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="align-items-center mb-2">
                        <img width="50px" alt="" src="img/icon6.png" />
                        <p class="text-truncate m-0 d-block text-white">Hydraulic Mud Gun</p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="align-items-center mb-2">
                        <img width="50px" alt="" src="img/icon7.png" />
                        <p class="text-truncate m-0 d-block text-white">Pig Casting Machine</p>
                    </div>
                </div>
            </div>
            <a href="" class="btn btn-primary py-md-3 px-md-5 mt-2 mt-md-4">View Our Product</a>
        </div>
    </section>