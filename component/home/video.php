<?php 
     $query =  mysqli_query($con,"SELECT * FROM `video` WHERE `status`=1");
     $row = mysqli_fetch_assoc($query);
     $heading = $row['heading'];
     $content = $row['content'];
     $video = $row['video'];
     $image = VIDEO_IMAGE_SITE_PATH . $row['image'];
  ?>



<section class="para1 position-relative mb-5" style="background-image: url(<?php echo $image ?>);" data-aos="fade-up">
        <div class="you_tube_icon">
            <a href="<?php echo $video ?>" target="_blank"><img class="button" src="img/you_tube.png" alt="" /></a>
        </div>
        <div class="para1_box1 bg-danger position-absolute text-center p-3">
            <h5 class="text-white mt-4 bold"><?php echo $heading ?></h5>
            <p class="text-white mb-0"><?php echo $content ?></p>
        </div>
    </section>