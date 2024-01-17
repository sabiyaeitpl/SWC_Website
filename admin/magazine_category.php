<?php
   include 'layout/head.php';
   $title = 'Magazine Category'; // page title
   $table = 'magazine_categories'; // table name
   $mange_page = 'manage_magazine_category.php'; //manage page name 

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
                        <div class="text-zero top-right-button-container">
                            <a href="<?php echo $mange_page; ?>"><button type="button" class="btn btn-primary btn-lg top-right-button mr-1">ADD NEW</button></a>
                        </div>

                    </div>

                    <!--<div class="mb-2">-->
                    <!--    <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions"-->
                    <!--        role="button" aria-expanded="true" aria-controls="displayOptions">-->
                    <!--        Display Options-->
                    <!--        <i class="simple-icon-arrow-down align-middle"></i>-->
                    <!--    </a>-->
                    <!--    <div class="collapse d-md-block" id="displayOptions">-->
                    <!--        <div class="d-block d-md-inline-block">-->
                    <!--            <div class="btn-group float-md-left mr-1 mb-1">-->
                    <!--                <button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button"-->
                    <!--                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                    <!--                    Order By-->
                    <!--                </button>-->
                    <!--                <div class="dropdown-menu">-->
                    <!--                    <a class="dropdown-item" href="#">Action</a>-->
                    <!--                    <a class="dropdown-item" href="#">Another action</a>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--            <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">-->
                    <!--                <input placeholder="Search...">-->
                    <!--            </div>-->
                    <!--        </div>-->

                    <!--    </div>-->
                    <!--</div>-->
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
                                <p class="mb-0 text-muted text-small w-15 w-sm-100">Name</p>
                                <p class="mb-0 text-muted text-small w-15 w-sm-100" >Color</p>
                                <p class="mb-0 text-muted text-small w-15 w-sm-100">Created at</p>
                                <p class="mb-0 text-muted text-small w-15 w-sm-100"></p>
                            </div>
                        </div>
                    </div>
                  

                <?php while($row=mysqli_fetch_assoc($res)){ ?>
                    <div class="card d-flex flex-row mb-3">
                        <a class="d-flex" href="<?php echo MAGAZINE_IMAGE_SITE_PATH.$row['image']?>" target="_blank">
                            <img src="<?php echo MAGAZINE_IMAGE_SITE_PATH.$row['image']?>" alt="<?php echo $row['name']?>"
                                class="list-thumbnail responsive border-0 card-img-left img-size-fixed" />
                        </a>
                        <div class="pl-2 d-flex flex-grow-1 min-width-zero">
                            <div
                                class="card-body align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero align-items-lg-center">
                                <p class="mb-0 text-muted text-small w-15 w-sm-100"><?php echo $row['name']?></p>
                                <p class="mb-0 text-muted text-small w-15 w-sm-100" style="background-color:<?php echo $row['color']?>;height:10px;"></p>
                                <p class="mb-0 text-muted text-small w-15 w-sm-100"><?php echo $row['created_at']?></p>
                                <div class="w-15 w-sm-100">
                                    <!--<span class="badge badge-pill badge-primary">Status</span>-->
                                    
                                    <?php
								if($row['status']==1){
									echo "<span class='badge badge-pill badge-success'><a href='?type=status&operation=deactive&id=".$row['id']."' class='badge-text-color'>Active</a></span>&nbsp;";
								}else{
									echo "<span class='badge badge-pill badge-warning'><a href='?type=status&operation=active&id=".$row['id']."' class='badge-text-color'>Deactive</a></span>&nbsp;";
								}
								echo "<span class='badge badge-pill badge-info'><a href='$mange_page?id=".$row['id']."' class='badge-text-color'>Edit</a></span>&nbsp;";
								
								echo "<span class='badge badge-pill badge-danger'><a href='?type=delete&id=".$row['id']."' class='badge-text-color'>Delete</a></span>";
								
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