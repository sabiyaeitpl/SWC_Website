    <?php
    
    $query =  mysqli_query($con,"SELECT * FROM `banner` WHERE `status`=1 order by order_by ASC");
    
    ?>

    <div class="container-fluid p-0 margin_munus_top">
        <div id="header-carousel" class="carousel slide carousel-fade banner_main" data-ride="carousel"
            data-aos="fade-up">
            <div class="carousel-inner">
            <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                <div class="carousel-item active">
                    <div class="position-absolute">
                        <img class="img-fluid vert-move" class="vert-move" src="img/banner_bg.jpg" alt="" />
                    </div>
                    <div class="container">
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-sm-6 banner_text">
                                <h2><?php echo $row['heading1'] ?></h2>
                                <div class="div heading_animation">
                                    <span>↓</span>
                                    <span style="--delay: 0.1s">↓</span>
                                    <span style="--delay: 0.3s">↓</span>
                                    <span style="--delay: 0.4s">↓</span>
                                    <span style="--delay: 0.5s">↓</span>
                                </div>
                                <h4>Consultants-</h4>
                                <h6>Making Your Business Our Business</h6>
                                <p><?php echo $row['heading2'] ?></p>
                                <a href="<?php echo $row['btn_link'] ?>" class="cmn_bnt" ><?php echo $row['btn_name'] ?></a>
                            </div>
                            <div class="col-sm-6">
                                <img class="img-fluid" src="<?php echo BANNER_IMAGE_SITE_PATH . $row['image']; ?>" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>