<?php
   include 'layout/head.php';
   $title = 'Magazine';
   $manage_page = 'manage_magazine.php';
   $table = 'magazine';
   $join_table = 'magazine_categories';

   if(isset($_GET['type']) && $_GET['type']!='')
   {
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
    if($type=='search'){
		$id=get_safe_value($con,$_GET['id']);
		$sql="SELECT $join_table.name,$table.* FROM $table,$join_table where $table.category_id = $join_table.id and $table.category_id=$id order by $table.id asc";
        $res=mysqli_query($con,$sql);
	}
}else{
    if ($role_id==1) { 
        $sql="SELECT $join_table.name,$table.* FROM $table,$join_table where $table.category_id = $join_table.id and $join_table.status=1 order by $table.id DESC";
        $res=mysqli_query($con,$sql);
    }
    else{

        $tempUserName=$_SESSION['ADMIN_USERNAME'];
        $tempQuery =  mysqli_query($con,"select * from admin_users WHERE email= '$tempUserName'");                                       

        $result1=mysqli_fetch_assoc($tempQuery);
        $tempUserId = $result1['id'];

        $sql="SELECT $join_table.name,$table.* FROM $table,$join_table where $table.category_id = $join_table.id and $join_table.status=1 and $table.author_id=$tempUserId order by $table.id DESC";
        $res=mysqli_query($con,$sql);


    }
    
}
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
                       <div class="collapse d-md-block" id="displayOptions">
                           <div class="d-block d-md-inline-block">
                               <div class="btn-group float-md-left mr-1 mb-1">
                                   <button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       Categories
                                   </button>
                                   <div class="dropdown-menu">
                                   <a class="dropdown-item" href="blog_list.php">All</a>
                                   <?php
										$result=mysqli_query($con,"select id,name from magazine_categories where status=1 order by name asc");
										while($rows=mysqli_fetch_assoc($result)){
												echo "<a class='dropdown-item' href='?type=search&id=".$rows['id']."'>".$rows['name']."</a>";
										}
										?>
                                   </div>
                               </div>
                           </div>

                       </div>
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
                                        <th scope="col">Category</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">Caraeted At</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = mysqli_num_rows($res);
                                    if($count > 0){
                                        while($row = mysqli_fetch_assoc($res)){ ?>
                                     <tr>
                                            <th scope="row">2</th>
                                            <td><?php echo $row['title'] ?></td>
                                            <td><?php echo $row['name'] ?></td>
                                            <td>
                                                <?php
                                                
                                                $sql1=mysqli_query($con,"SELECT full_name FROM admin_users WHERE id=".$row['author_id']);
                                                $result1=mysqli_fetch_assoc($sql1);
                                                echo $result1['full_name'];
                                                ?>                                                
                                               
                                            </td>
                                            <td><?php echo $row['created_at'] ?></td>
                                            <td><?php 
                                            if($row['status']==1){
                                                echo "Approved";
                                            }
                                            elseif($row['status']==2){
                                                echo "Pending";
                                            }
                                            else{
                                                echo "Rejected";
                                            }              
                                            
                                            ?></td>
                                            <td>
                                                <?php
                                                    // if($row['status']==1){
                                                    //     echo "<span class='badge badge-pill badge-success'><a href='?type=status&operation=deactive&id=".$row['id']."' class='badge-text-color'>Active</a></span>&nbsp;";
                                                    // }else{
                                                    //     echo "<span class='badge badge-pill badge-warning'><a href='?type=status&operation=active&id=".$row['id']."' class='badge-text-color'>Deactive</a></span>&nbsp;";
                                                    // }
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