<?php

   include 'layout/head.php';
   $table = 'client';
   $section_title = 'Client';
   $title = 'Manage '.$section_title;
   $breadcumb_title = 'Add '.$section_title;
   
    $heading='';
    $client_type='';
    $image='';
    $msg='';

    try {
    if(isset($_GET['id']) && $_GET['id']!=''){
         $breadcumb_title = 'Edit '.$section_title;
        $id=get_safe_value($con,$_GET['id']);
        $res=mysqli_query($con,"select * from $table where id='$id'");
        $check=mysqli_num_rows($res);
        if($check>0){
            $row=mysqli_fetch_assoc($res);
            $heading=$row['heading'];
            $client_type=$row['client_type'];
            $image=$row['image'];
        }else{
            //header('location:banner.php');
            
                ?>
            
         <script>
        window.location.href='client.php';
        </script>
        <?php
            die();
        }
    }
    if(isset($_POST['submit'])){
        $heading=get_safe_value($con,$_POST['heading']);
        $client_type=get_safe_value($con,$_POST['client_type']);
        $image=get_safe_value($con,$_POST['image']);
        if(isset($_GET['id']) && $_GET['id']==0){
            if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg' && $_FILES['image']['type']!='image/gif'){
                $msg="Please select only png,jpg and jpeg image formate";
            }
        }else{
            if($_FILES['image']['type']!=''){
                    if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg' && $_FILES['image']['type']!='image/gif'){
                    $msg="Please select only png,jpg and jpeg image formate";
                }
            }
        }
    
        
        if($msg==''){
            if(isset($_GET['id']) && $_GET['id']!=''){
            if($_FILES['image']['name']!=''){
                    $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
                     if (!move_uploaded_file($_FILES['image']['tmp_name'], CLIENT_IMAGE_SERVER_PATH . $image)) {
                        throw new Exception("Failed to move the uploaded file.");
                    }else{
                        move_uploaded_file($_FILES['image']['tmp_name'],CLIENT_IMAGE_SERVER_PATH.$image);
                    }
                    mysqli_query($con,"update $table set heading='$heading',client_type='$client_type',image='$image' where id='$id'");
                }
                else{
                    mysqli_query($con,"update $table set heading='$heading',client_type='$client_type' where id='$id'");
                }
    
                 
            }else{
                $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
                if (!move_uploaded_file($_FILES['image']['tmp_name'], CLIENT_IMAGE_SERVER_PATH . $image)) {
                    throw new Exception("Failed to move the uploaded file.");
                }else{
                    move_uploaded_file($_FILES['image']['tmp_name'],CLIENT_IMAGE_SERVER_PATH.$image);
                }
                
                mysqli_query($con,"insert into $table(heading,client_type,image,status) values('$heading','$client_type','$image','1')");
            }
        //	header('location:banner.php');
        
            ?>
            
         <script>
         //alert("successfull");
        window.location.href='client.php';
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
                                    <label class="col-sm-2 col-form-label">Heading</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="" name="heading" value="<?php echo $heading?>" required>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Client Type</label>
                                    <div class="col-sm-10">
                                        <select name="client_type" class="form-control" required>
                                            <option><?php echo $client_type ?></option>
                                            <option value="overseas">Overseas</option>
                                            <option value="domestic">Domestic</option>
                                            
                                        </select>
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        	<?php

                              if ($image!='') {
                              	echo "<a target='_blank' href='".CLIENT_IMAGE_SITE_PATH.$image."'><img width='100px' height='100px' src='".CLIENT_IMAGE_SITE_PATH.$image."'/></a>";
                              }
									 ?>
                                        <input type="file" class="form-control" id="" name="image" accept="image/*" >
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-sm-10">
                                        <button type="submit" name="submit" class="btn btn-primary mb-0">Submit</button>
                                    </div>
                                    <div class="field_error"><?php echo $msg?></div>
                                </div>
                            </form>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </main>


<?php
   include 'layout/footer.php';
?>
