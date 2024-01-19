  <?php 
     $query =  mysqli_query($con,"SELECT * FROM `about` WHERE `status`=1 and id=1");
     $row = mysqli_fetch_assoc($query);
     $heading1 = $row['heading1'];
     $heading2 = $row['heading2'];
     $heading3 = $row['heading3'];
     $heading4 = $row['heading4'];
     $image = CONTENT_IMAGE_SITE_PATH . $row['image'];
  ?>
  
  <div class="container-fluid bg-light about_section">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-5">
                    <div class="round_section">
                        <div class="main">
                            <div class="circle"></div>
                            <div class="circle"></div>
                            <div class="position-absolute round_img">
                                <img class="img-fluid" src="<?php echo $image ?>" alt="" />
                            </div>
                        </div>
                        <div class="main2">
                            <div class="circle2"></div>
                        </div>
                        <div class="main3">
                            <div class="circle3"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 m-0 pt-5 pb-5">
                    <div class="padding_0">
                        <h2><?php echo $heading1 ?></h2>
                        <div class="div heading_animation">
                            <span>↓</span>
                            <span style="--delay: 0.1s">↓</span>
                            <span style="--delay: 0.3s">↓</span>
                            <span style="--delay: 0.4s">↓</span>
                            <span style="--delay: 0.5s">↓</span>
                        </div>

                        <p class="mb-4 section-title"><?php echo $heading2 ?>
                            <br />
                            <br />
                            <?php echo $heading3 ?>
                        </p>
                        <p>
                           <?php echo $heading4 ?>
                        </p>

                        <button type="button" class="cmn_bnt">Learn more</button>

                    </div>
                </div>
            </div>
        </div>
    </div>