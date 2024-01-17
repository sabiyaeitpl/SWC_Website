<?php
   include 'layout/head.php';
   $title = 'Menus';
   $manage_page = 'manage_menu.php';
   $table = 'menu_items';

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
function getMenuItems() {
    global $con;
    global $table;

    $sql = "SELECT * FROM $table";
    $result = mysqli_query($con, $sql);
    $menu_items = [];

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $menu_items[] = $row;
        }
    }

    return $menu_items;
}

$menu_items = getMenuItems();

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
                                        <th scope="col">id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Parent Id</th>
                                        <th scope="col">Url</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($menu_items as $item): ?>
                                    <tr>
                                        <td><?php echo $item['id']; ?></td>
                                        <td><?php echo $item['name']; ?></td>
                                        <td><?php echo $item['parent_id']; ?></td>
                                        <td><?php echo $item['url']; ?></td>
                                        <td>
                                        <?php
                                        echo "<span class='badge badge-pill badge-info'><a href='$manage_page?id=".$item['id']."' class='badge-text-color'>Edit</a></span>&nbsp;";
                                        echo "<span class='badge badge-pill badge-danger'><a href='?type=delete&id=".$item['id']."' class='badge-text-color'>Delete</a></span>";
                                        ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                               
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