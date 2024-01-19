<?php 
     $query =  mysqli_query($con,"SELECT * FROM `about` WHERE `status`=1 and id=3");
     $row = mysqli_fetch_assoc($query);
     $heading1 = $row['heading1'];
     $heading2 = $row['heading2'];
     $heading3 = $row['heading3'];
     $heading4 = $row['heading4'];
     $image = CONTENT_IMAGE_SITE_PATH . $row['image'];
  ?>
  
  <!-- video -->
  <section class="para1 position-relative mb-5" style="background-image: url(<?php echo $image ?>);">
        <div class="p-5" data-aos="fade-up">
            <p class="text-white"><?php echo $heading1 ?></p>
            <h5 class="text-white mb-4 bold"><?php echo $heading2 ?></h5>
            <div class="d-flex justify-content-start">
                <div class="profile_img p-2">
                    <img src="img/profile2.jpg" alt="" />
                </div>
                <div class="text-white mt-4 ms-3">
                    <p><span class="d-block">(002) 01061245741</span>
                        Sales Representative</p>
                </div>
            </div>
            <a href="" class="btn btn-danger py-md-3 px-md-5 mt-2 mt-md-4">View Our Product</a>
        </div>
        <div class="para1_box1 para_3 bg-danger position-absolute text-center p-4" data-aos="fade-up">
            <img class="icon2" src="img/icon1.png" alt="" />
            <h3 class="text-white">Product Quality</h3>
            <h1 class="text-white bold"><?php echo $heading3 ?></h1>
            <p class="text-white mb-0"><?php echo $heading4 ?></p>
        </div>
    </section>
    <!-- video end -->