<?php
   include 'layout/head.php';
   $rowNumber = 1;
   $title = 'CMS';
   $manage_page = 'manage_cms.php';
   $table = 'cms';
   $join_table = 'menu_items';

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
        $sql="SELECT $join_table.name,$table.* FROM $table,$join_table where $table.menu_id = $join_table.id and $join_table.status=1 order by $table.id desc";
        $res=mysqli_query($con,$sql);
	}
    if($type=='search'){
		$id=get_safe_value($con,$_GET['id']);
		$sql="SELECT $join_table.name,$table.* FROM $table,$join_table where $table.menu_id = $join_table.id and $table.menu_id=$id order by $table.id desc";
        $res=mysqli_query($con,$sql);
	}
}else{
        $sql="SELECT $join_table.name,$table.* FROM $table,$join_table where $table.menu_id = $join_table.id and $join_table.status=1 order by $table.id desc";
        $res=mysqli_query($con,$sql);
    
}


?>

<main>
        <div class="container-fluid">
        <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <h1><?php echo $title; ?></h1>
                        <!-- <div class="text-zero top-right-button-container">
                            <a href="<?php echo $manage_page; ?>"><button type="button" class="btn btn-primary btn-lg top-right-button mr-1">ADD NEW</button></a>
                        </div> -->

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
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
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
                                            <th scope="row"><?php echo $rowNumber; ?></th>  
                                            <td><?php echo $row['title'] ?></td>
                                          
                                            <td>
                                                <?php
                                                    // if($row['status']==1){
                                                    //     echo "<span class='badge badge-pill badge-success'><a href='?type=status&operation=deactive&id=".$row['id']."' class='badge-text-color'>Active</a></span>&nbsp;";
                                                    // }else{
                                                    //     echo "<span class='badge badge-pill badge-warning'><a href='?type=status&operation=active&id=".$row['id']."' class='badge-text-color'>Deactive</a></span>&nbsp;";
                                                    // }
                                                    echo "<span class='badge badge-pill badge-info'><a href='$manage_page?id=".$row['id']."' class='badge-text-color'>Edit</a></span>&nbsp;";
                                                    
                                                    
                                                ?>
                                            </td>
                                     </tr>
                                    <?php  
                                        $rowNumber++; 
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