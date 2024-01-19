<?php
    $query =  mysqli_query($con,"SELECT * FROM `drawing` WHERE `status`=1 order by id Desc");  
?>


<div class="row">
    <ul class="text-center mt-4">
    <?php while ($row = mysqli_fetch_assoc($query)) { ?>
        <a class="btn btn-outline-danger text-dark text-decoration-none p-2 mb-1"href="<?php echo DRAWING_IMAGE_SITE_PATH.$row['image'] ?>" target="_blank"><?php echo $row['heading'] ?></a>
    <?php } ?>
    </ul>
</div>