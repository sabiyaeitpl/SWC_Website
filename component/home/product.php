<?php
 $product_nav = mysqli_query($con,"SELECT * FROM `products` where status=1");
?>
<div class="container-fluid bg-light aos-init aos-animate" data-aos="fade-up">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col text-center mb-4">
                    <h6 class="text-primary font-weight-normal text-uppercase mb-3 bold">More</h6>
                    <h1 class="mb-4 bold">Product</h1>
                </div>
            </div>
            <div class="row pb-3">
            <?php
               while ($row_product = mysqli_fetch_assoc($product_nav)) { 
                $encodedId = base64_encode($row_product['id']);
            ?>
                <div class="col-md-3">
                    <a href="product_details.php?id=<?php echo $encodedId; ?>">
                    <div class="card border-0 mb-2 shadow-sm">
                        <img class="card-img-top" src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row_product['image'] ?>" alt="<?php echo $row_product['name'] ?>">
                        <div class="card-body bg-white p-4">
                            <div class="d-flex align-items-center mb-3">
                                <h5 class="m-0 text-truncate"><?php echo $row_product['name'] ?></h5>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            <?php
               }
            ?>
            </div>
            <a href="products.php" class="btn btn-danger py-md-3 px-md-5">View Our Product</a>
        </div>
    </div>