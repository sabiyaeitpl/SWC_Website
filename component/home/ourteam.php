<?php
    $query =  mysqli_query($con,"SELECT * FROM `ourteam` WHERE `status`=1 order by id ASC");  
?>
 

    <div class="container-fluid bg-light">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-md-12 col-sm-12 p-0 py-sm-5">
                    <div class="text-center">
                        <h6 class="text-primary font-weight-normal text-uppercase bold">Our Team</h6>
                        <h1 class="mb-4">Meet Our Pertner</h1>
                        <div class="div">
                            <span>↓</span>
                            <span style="--delay: 0.1s">↓</span>
                            <span style="--delay: 0.3s">↓</span>
                            <span style="--delay: 0.4s">↓</span>
                            <span style="--delay: 0.5s">↓</span>
                        </div>
                    </div>
                    <div class="owl-carousel team-carousel position-relative p-0 py-sm-5">
                    <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                        <div class="team d-flex flex-column text-center mx-3">
                            <div class="position-relative">
                                <img class="img-fluid w-100" src="<?php echo TEAM_IMAGE_SITE_PATH . $row['image']; ?>" alt="">
                            </div>
                            <div class="d-flex flex-column text-center py-3">
                                <h5 class="text-dark"><?php echo $row['name'] ?></h5>
                                <p class="m-0 text-dark"><?php echo $row['designation'] ?></p>
                            </div>
                        </div>
                     <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>