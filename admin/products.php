<?php
   include 'layout/head.php';
   $title = 'Products';
   $manage_page = 'manage_products.php';
   $table = 'products';

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
$sql="SELECT $table.* FROM $table order by id desc";
$res=mysqli_query($con,$sql);

?>

<main>
        <div class="container-fluid">
        <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <h1><?php echo $title; ?></h1>
                        <div class="text-zero top-right-button-container">
                            <a href="<?php echo $manage_page; ?>"><button type="button" class="btn btn-primary btn-lg top-right-button mr-1">ADD NEW</button></a>
                        </div>

                    </div>

                    <div class="mb-2">
                       <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions"
                           role="button" aria-expanded="true" aria-controls="displayOptions">
                           Display Options
                           <i class="simple-icon-arrow-down align-middle"></i>
                       </a>
                       
                    </div>
                    <div class="separator mb-5"></div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $title; ?> List</h5>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Created_at</th>
                                        <th scope="col">status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = mysqli_num_rows($res);
                                    if($count > 0){
                                        while($row = mysqli_fetch_assoc($res)){ 
                                            ?>
                                     <tr>
                                            <td>
                                                <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>" alt=""
                                class="list-thumbnail responsive border-0 card-img-left img-size-fixed" />
                            </td>
                                            
                                            <td><?php echo $row['name'] ?></td>
                                           
                                            <td><?php echo $row['created_at'] ?></td>
                                            <td><?php if($row['status']==1){
                                                        echo "<span class='badge badge-pill badge-success'>Active</span>&nbsp;";
                                                    }else{
                                                        echo "<span class='badge badge-pill badge-warning'>Inactive</span>&nbsp;";
                                                    }?></td>
                                            <td>
                                                <?php
                                                    if($row['status']==1){
                                                        echo "<span class='badge badge-pill badge-success'><a href='?type=status&operation=deactive&id=".$row['id']."' class='badge-text-color'>Active</a></span>&nbsp;";
                                                    }else{
                                                        echo "<span class='badge badge-pill badge-warning'><a href='?type=status&operation=active&id=".$row['id']."' class='badge-text-color'>Deactive</a></span>&nbsp;";
                                                    }
                                                    echo "<span class='badge badge-pill badge-info'><a href='$manage_page?id=".$row['id']."' class='badge-text-color'>Edit</a></span>&nbsp;";
                                                    
                                                    echo "<span class='badge badge-pill badge-danger'><a href='?type=delete&id=".$row['id']."' class='badge-text-color'>Delete</a></span>";
                                                    
                                                ?>
                                            </td>
                                     </tr>
                                    <?php  
                                        }
                                }else{
                                    echo '<tr>';
                                    echo '<td style="color:red">Data Not Found</td>';
                                    echo '</tr>';
                                } ?>
                               
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php
   include 'layout/footer.php';
?>