<?php 
     $query =  mysqli_query($con,"SELECT * FROM `design`");
     $row = mysqli_fetch_assoc($query);
     $title = $row['title'];
     $content = $row['content'];
     $instruction = $row['instruction'];
     $image = DESIGN_IMAGE_SITE_PATH . $row['image'];
  ?>
<div class="container-fluid bg-light mt-5">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-5">
                    <div class="position-relative me-4">
                        <img class="img-fluid" src="<?php echo $image; ?>" alt="" />
                    </div>
                   
                    <?php 
                    
                        include('component/design/drawing.php');
                    ?>

                </div>
                <div class="col-lg-7 m-0 my-lg-5 pt-0 pb-5 pb-lg-2  mt-0" style="margin-top: 0!important;">
                    <div class="padding_0">
                        <h4 class="m-0 p-0 mb-2 h5 bold"><?php echo $title ?></h4>
                         <p>
                            <?php echo $content; ?>
                         </p>
                        <p>If you require a custom solution please contact us with a description of your project and we
                            will be happy to work
                            through the details and provide a <a href="javascript:void(0)" data-toggle="modal"
                                data-target="#exampleModal2"> FREE QUOTE</a> and estimate. </p>

                        <p>
                            <strong class="d-block">Instructions :</strong>
                            <?php echo $instruction; ?>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
