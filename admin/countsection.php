<?php
   include 'layout/head.php';
   $title = 'Home Count Section';
   $manage_page = 'manage_countsection.php';
   $table = 'count';
   if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	if($type=='status'){
		$operation=get_safe_value($con,$_GET['operation']);
		$id=get_safe_value($con,$_GET['id']);
		if($operation=='active'){
			$status='1';
		}else{
			$status='0';
		}
		$update_status_sql="update $table set status='$status' where id='$id'";
		mysqli_query($con,$update_status_sql);
	}
	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from $table where id='$id'";
		mysqli_query($con,$delete_sql);
	}
}

$sql="SELECT * FROM $table order by id asc";
$res=mysqli_query($con,$sql);
?>


<main>
        <div class="container-fluid disable-text-selection">
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <h1><?php echo $title; ?></h1>

                    </div>
                    <div class="separator mb-5"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 list" data-check-all="checkAll">
                    
                     <div class="card d-flex flex-row mb-3 element-to-hide">
                        <a class="d-flex" href="#">
                            <img src="img/products/fat-rascal-thumb.jpg" alt="Fat Rascal"
                                class="list-thumbnail responsive border-0 card-img-left img-size-fixed" />
                        </a>
                        <div class="pl-2 d-flex flex-grow-1 min-width-zero">
                            <div
                                class="card-body align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero align-items-lg-center">
                                <p class="mb-0 text-muted text-small w-15 w-sm-100">Project<br>Description<br>Count</p>
                                <p class="mb-0 text-muted text-small w-15 w-sm-100">Client<br>Description<br>Count</p>
                                <p class="mb-0 text-muted text-small w-15 w-sm-100">Client<br>Description<br>Count</p>
                                <p class="mb-0 text-muted text-small w-15 w-sm-100"></p>
                            </div>
                        </div>
                    </div>
                  

                <?php while($row=mysqli_fetch_assoc($res)){ ?>
                    <div class="card d-flex flex-row mb-3">
                        <a class="d-flex" href="<?php echo COUNT_IMAGE_SITE_PATH.$row['image']?>" target="_blank">
                            <img src="<?php echo COUNT_IMAGE_SITE_PATH.$row['image']?>" alt="<?php echo $row['heading']?>"
                                class="list-thumbnail responsive border-0 card-img-left img-size-fixed" />
                        </a>
                        <div class="pl-2 d-flex flex-grow-1 min-width-zero">
                            <div
                                class="card-body align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero align-items-lg-center">
                                <p class="mb-0 text-muted text-small w-15 w-sm-100"><?php echo $row['heading1'] ."<br>". $row['heading2']?></p>
                                <p class="mb-0 text-muted text-small w-15 w-sm-100"><?php echo $row['heading3'] ."<br>". $row['heading4']?></p>
                                <p class="mb-0 text-muted text-small w-15 w-sm-100"><?php echo $row['heading5'] ."<br>". $row['heading6']?></p>
                                <div class="w-15 w-sm-100">
                                    <!--<span class="badge badge-pill badge-primary">Status</span>-->
                                    
                                    <?php
								// if($row['status']==1){
								// 	echo "<span class='badge badge-pill badge-success'><a href='?type=status&operation=deactive&id=".$row['id']."' class='badge-text-color'>Active</a></span>&nbsp;";
								// }else{
								// 	echo "<span class='badge badge-pill badge-warning'><a href='?type=status&operation=active&id=".$row['id']."' class='badge-text-color'>Deactive</a></span>&nbsp;";
								// }
								echo "<span class='badge badge-pill badge-info'><a href='$manage_page?id=".$row['id']."' class='badge-text-color'>Edit</a></span>&nbsp;";
								
								// echo "<span class='badge badge-pill badge-danger'><a href='?type=delete&id=".$row['id']."' class='badge-text-color'>Delete</a></span>";
								
								?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                <?php } ?>




                   

                </div>
            </div>
        </div>
    </main>



<?php
   include 'layout/footer.php';
?>