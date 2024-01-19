<?php
    $query =  mysqli_query($con,"SELECT * FROM `stage` order by id ASC");  
?>
     <section class="work_process pt-5 pb-5" data-aos="fade-up">
        <div class="work_img1">
            <img class="img-fluid" src="img/workimg1.png" alt="" />
        </div>
        <div class="work_img2">
            <img class="img-fluid" src="img/workimg2.png" alt="" />
        </div>
        <div class="container">
            <div class="row">
                <h2 class="text-center mb-5">Work Process</h2>
                <div class="div">
                    <span>↓</span>
                    <span style="--delay: 0.1s">↓</span>
                    <span style="--delay: 0.3s">↓</span>
                    <span style="--delay: 0.4s">↓</span>
                    <span style="--delay: 0.5s">↓</span>
                </div>
            </div>
            <div class="row">
            <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                <div class="col-md-3 col-sm-12 work_boxmain">
                    <div class="bg-white work_process_box text-center p-4 pt-5 pb-5 rounded-pill shadow ">
                        <a href="#">
                            <img class="icon_work vert-move" src="img/<?php echo $row['image'] ?>" alt="" />
                            <h2 class="mt-3"><?php echo $row['heading'] ?></h2>
                            <p class="p-4">
                             <?php echo $row['content'] ?>
                            </p>
                        </a>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    </section>