<?php
   include 'layout/head.php';
   $title = 'Order';
   $manage_page = 'manage_products.php';
   $table = '`order`';
   $join_table = 'order_details';

   if(isset($_GET['status']) && $_GET['status']!='' && isset($_GET['id']) && $_GET['id']!=''){
	$status=get_safe_value($con,$_GET['status']);
	$id=get_safe_value($con,$_GET['id']);
	
		
		$update_status_sql="update $table set status='$status' where id='$id'";
		mysqli_query($con,$update_status_sql);

    ?>
    <script>
        alert("Update successfully")
        window.location = 'order.php'
    </script>    
	<?php 
    
    }else{
        
        
        $sql="SELECT $join_table.name as customer_name,$join_table.email,$join_table.phone,$join_table.state,$join_table.city,$join_table.zip,$join_table.address,$join_table.total_amount,$table.* FROM $table,$join_table WHERE $table.order_number=$join_table.order_number order by id desc";
    
        $res=mysqli_query($con,$sql);
    }
    

?>
<script>
function status_update(id) {
  var update_val = document.getElementById("status_id").value;
  
  window.location = 'order.php?status='+update_val+'&id='+id;
 
}
</script>
<main>
        <div class="container-fluid">
        <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <h1><?php echo $title; ?></h1>
                       

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
                                        <th scope="col">Order No</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Product Details</th>
                                        <!-- <th scope="col">Category</th> -->
                                        <th scope="col">Customer Details</th>
                                        <th scope="col">Customer Address</th>
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
                                     <td><?php echo $row['order_number'] ?></td>
                                            <td>
                                                <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>" alt=""
                                class="list-thumbnail responsive border-0 card-img-left img-size-fixed" />
                            </td>
                                            
                                            <td>
                                                <p>Name: <strong><?php echo $row['product_name']; ?></strong></p>
                                                <p>Quentity: <strong><?php echo $row['quentity']; ?></strong></p>
                                                <p>Price: <strong><?php echo $row['price']; ?></strong></p>
                                                <p>Sale Price: <strong><?php echo $row['sell_price']; ?></strong></p>

                                            </td>
                                            <td>
                                                <p>Name: <strong><?php echo $row['customer_name']; ?></strong></p>
                                                <p>Email: <strong><?php echo $row['email']; ?></strong></p>
                                                <p>Phone: <strong><?php echo $row['phone']; ?></strong></p>
                                            </td>
                                            <td>
                                                <p>State: <strong><?php echo $row['state']; ?></strong></p>
                                                <p>City: <strong><?php echo $row['city']; ?></strong></p>
                                                <p>Zip: <strong><?php echo $row['zip']; ?></strong></p>
                                                <p>Address: <strong><?php echo $row['address']; ?></strong></p>
                                            </td>
                                           
                                            <td><?php echo $row['created_at']; ?></td>
                                            <td><?php if($row['status']==1){
                                                        echo "<span class='badge badge-pill badge-success'>Processing</span>&nbsp;";
                                                    }elseif ($row['status']==2) {
                                                        echo "<span class='badge badge-pill badge-success'>Confirm</span>&nbsp;";
                                                    }
                                                    elseif ($row['status']==3) {
                                                        echo "<span class='badge badge-pill badge-success'>Shift</span>&nbsp;";
                                                    }
                                                    elseif ($row['status']==4) {
                                                        echo "<span class='badge badge-pill badge-success'>Delivered</span>&nbsp;";
                                                    }
                                                    else{
                                                        echo "<span class='badge badge-pill badge-warning'>Cancel</span>&nbsp;";
                                                    }?></td>
                                            <td width="180">
                                                <?php
                                                   
                                                //    echo "<button  class='btn btn-primary' data-toggle='modal' data-target='#exampleModal'>
                                                //    Update Status
                                                //  </button>";
                                                 echo '<div class="form-group row">
                                                 
                                                 <div class="col-sm-10">
                                                 <select class="form-control" name="status" 
                                                 onchange="status_update('.$row['id'].')" id="status_id">
                                                     <option>Select Status</option>
                                                     <option value="1">Processing</option>
                                                     <option value="2">Confirm</option>
                                                     <option value="3">Shift</option>
                                                     <option value="4">Delivered</option>
                                                     <option value="5">Cancel</option>
                                                         
                                                    </select>
                                                    </div>
                                                </div>';
                                                   
                                                    
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Order Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                    <select class="form-control" name="status" required>
										<option>Select Status</option>
										<option value="processing">Processing</option>
										<option value="processing">Processing</option>
											
									</select>
                                    </div>
                                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Update</button>
      </div>
    </div>
  </div>
</div>  