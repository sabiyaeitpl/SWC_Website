<?php
    $query =  mysqli_query($con,"SELECT * FROM `client` WHERE `status`=1 order by id Desc");  
?>
 <div class="container-fluid bg-light mt-3">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="card p-0 m-0 mb-4 client_div shadow">
                    <div class="card-header bg-white">
                        <h4 class="text-dark mb-0 text-uppercase"><b>Our Clients</b></h4>
                    </div>
                    <div class="bg-white p-3">
                    <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                        <a href="#">
                            <img src="<?php echo CLIENT_IMAGE_SITE_PATH.$row['image'] ?>" alt="" />
                        </a>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
