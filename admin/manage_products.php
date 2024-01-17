<?php
   include 'layout/head.php';
   $table = 'products';
   $section_title = 'Product';
   $title = 'Manage '.$section_title;
   $breadcumb_title = 'Add '.$section_title;
 

    $name   = '';
    $description = '';
    $image='';
    $status='';
    $msg='';
    $product_id='';
   
    try {
    if(isset($_GET['id']) && $_GET['id']!='')
    {
        $product_id=$_GET['id'];
        $breadcumb_title = 'Edit '.$section_title;
        $id=get_safe_value($con,$_GET['id']);
        $res=mysqli_query($con,"select * from $table where id='$id'");
        $check=mysqli_num_rows($res);
        if($check>0){
            $row=mysqli_fetch_assoc($res);
            $name=$row['name'];
            $description=$row['description'];
            $image=$row['image'];
            $status=$row['status'];
        }else{
            //header('location:banner.php');
            
                ?>
            
         <script>
        window.location.href='products.php';
        </script>
        <?php
            die();
        }
    }
    if(isset($_POST['submit']))
    {
        
        $name=get_safe_value($con,$_POST['name']);
        $description=get_safe_value($con,$_POST['description']);
        
        if(isset($_GET['id']) && $_GET['id']==0)
        {
            if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
                $msg="Please select only png,jpg and jpeg image formate";
            }
        }
        else
        {
            if($_FILES['image']['type']!=''){
                    if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
                    $msg="Please select only png,jpg and jpeg image formate";
                }
            }
        }
    
        
        if($msg=='')
        {
            if(isset($_GET['id']) && $_GET['id']!='')
            {
                if($_FILES['image']['name']!='')
                {
                    $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
                     if (!move_uploaded_file($_FILES['image']['tmp_name'], PRODUCT_IMAGE_SERVER_PATH . $image)) {
                        throw new Exception("Failed to move the uploaded file.");
                    }else{
                        move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
                    }
                    mysqli_query($con,"update $table set name='$name',description='$description',image='$image' where id='$id'");
                }
                else
                {
                    mysqli_query($con,"update $table set name='$name',description='$description' where id='$id'");
                }    
            }
            else
            {
                $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
                if (!move_uploaded_file($_FILES['image']['tmp_name'], PRODUCT_IMAGE_SERVER_PATH . $image)) {
                    throw new Exception("Failed to move the uploaded file.");
                }else{
                    move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
                }
                
                mysqli_query($con,"insert into $table(`name`,`image`,`description`) values('$name','$image','$description')");

            }
            //	header('location:banner.php');
        
            ?>
            
            <script>
            window.location.href='products.php';
            </script>
            <?php
            die();
        }

    }
} catch (Exception $e) {
    // Error handling and reporting
    echo "An error occurred: " . $e->getMessage();
    // You can log the error or perform any necessary actions here
}

?>

<main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <h1><?php  echo $title; ?></h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:history.back()"><?php echo $section_title; ?></a>
                            </li>
                            <li class="breadcrumb-item" class="active">
                                <a href="#"><?php echo $breadcumb_title; ?></a>
                            </li>
                            
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>


                </div>
            </div>

            <div class="row">
                <div class="col-12">
                <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="mb-4"><?php  echo $breadcumb_title; ?></h5>
                            <form action="" method="post" enctype="multipart/form-data" class="needs-validation tooltip-label-right" >
                              
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">product title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="" name="name" value="<?php echo $name?>" required>
                                    </div>
                                </div>
                             
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="20" id="editor1" name="description" required><?php echo $description ?></textarea>
                                    </div>
                                </div>
                               
                                
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                    <?php

                                        if ($image!='') {
                                            echo "<a target='_blank' href='".PRODUCT_IMAGE_SITE_PATH.$image."'><img width='100px' height='100px' src='".PRODUCT_IMAGE_SITE_PATH.$image."'/></a>";
                                        }
									 ?>
                                        <input type="file" class="form-control" id="" name="image"  >
                                    </div>
                                </div>

                              
                                
                               
                                

                                <div class="form-group row mb-0">
                                    <div class="col-sm-10">
                                        <button type="submit" name="submit" class="btn btn-primary mb-0">Submit</button>
                                    </div>
                                    <div class="field_error"><?php echo $msg?></div>
                                </div>
                              
                            </form>

                            <?php
                                  if($product_id !=''){
                                ?>
                               
                                <?php 
                                    
                                    
                                    $sql_query_image = mysqli_query($con,"SELECT * FROM `product_image` where product_id=$product_id");
                                    while ($row_image=mysqli_fetch_assoc($sql_query_image)) {
                                        if ($row_image['image']!='') {
                                            echo "<a target='_blank' href='".PRODUCT_IMAGE_SITE_PATH.$row_image['image']."' target='_blank'><img width='100px' height='100px' src='".PRODUCT_IMAGE_SITE_PATH.$row_image['image']."' class='m-2'/></a>";
                                        }
                                        
                                    }
                                
                                ?>
                                 <div class="form-group row m-2">
                                    <button type="button" class="btn btn-info mb-0" data-toggle="modal" data-target="#myModal">Add Image</button>
                                </div>

                                <?php
                                  }
                                ?>
                            
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </main>

    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Product Image</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="product_image.php" method="post" enctype="multipart/form-data">
                     <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                        <div class="form-group">
                            <label for="fileInput">Choose File:</label>
                            <input type="file" name="image" class="form-control-file" id="fileInput" name="file">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="imageSubmit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>






<?php
   include 'layout/footer.php';
?>
