<?php
  $query =  mysqli_query($con,"SELECT * FROM `ourproject` WHERE `status`=1 order by id DESC");
?>
<div class="container-fluid">
        <div class="container py-5" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col text-center mb-4">
                    <h1 class="mb-4">Our Services</h1>
                    <div class="div">
                        <span>↓</span>
                        <span style="--delay: 0.1s">↓</span>
                        <span style="--delay: 0.3s">↓</span>
                        <span style="--delay: 0.4s">↓</span>
                        <span style="--delay: 0.5s">↓</span>
                    </div>

                    <p>SKILLED WORKERS CLOUD is a UK HR-tech company will help to manage your workers skillfully and
                        effectively. We specialise
                        in HR-TECH systems for business in the UK.</p>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <div class="row">
                    <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                        <div class="col-sm-4 mb-4">
                            <div class="our_services_box rotation_div">
                                <div class="global_img"><img class="img-fluid" src="img/global.png" /></div>
                                <img class="img-fluid vert-move" src="<?php echo PROJECT_IMAGE_SITE_PATH . $row['image']; ?>" />
                                <h2><?php echo $row['heading']; ?></h2>
                                <p>
                                <?php echo $row['content']; ?>
                                </p>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>