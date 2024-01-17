<?php

   include 'layout/head.php';
   $table = 'about';
   $section_title = 'Home About Section';
   $title = 'Manage '.$section_title;
   $breadcumb_title = 'Add '.$section_title;
   
    $heading1='';
    $heading2='';
    $heading3='';
    $heading4='';
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
            $heading1=$row['heading1'];
            $heading2=$row['heading2'];
            $heading3=$row['heading3'];
            $heading4=$row['heading4'];
            $image=$row['image'];
        }else{
            //header('location:banner.php');
            
                ?>
            
         <script>
        window.location.href='home_about.php';
        </script>
        <?php
            die();
        }
    }
    if(isset($_POST['submit'])){
        $heading1=get_safe_value($con,$_POST['heading1']);
        $heading2=get_safe_value($con,$_POST['heading2']);
        $heading3=get_safe_value($con,$_POST['heading3']);
        $heading4=get_safe_value($con,$_POST['heading4']);
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
                     if (!move_uploaded_file($_FILES['image']['tmp_name'], CONTENT_IMAGE_SERVER_PATH . $image)) {
                        throw new Exception("Failed to move the uploaded file.");
                    }else{
                        move_uploaded_file($_FILES['image']['tmp_name'],CONTENT_IMAGE_SERVER_PATH.$image);
                    }
                    mysqli_query($con,"update $table set heading1='$heading1',heading2='$heading2',heading3='$heading3',heading4='$heading4',image='$image' where id='$id'");
                }
                else{
                    mysqli_query($con,"update $table set heading1='$heading1',heading2='$heading2',heading3='$heading3',heading4='$heading4' where id='$id'");
                }
    
                 
            }else{
                $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
                if (!move_uploaded_file($_FILES['image']['tmp_name'], CONTENT_IMAGE_SERVER_PATH . $image)) {
                    throw new Exception("Failed to move the uploaded file.");
                }else{
                    move_uploaded_file($_FILES['image']['tmp_name'],CONTENT_IMAGE_SERVER_PATH.$image);
                }
                
                mysqli_query($con,"insert into $table(heading1,heading2,heading3,heading4,image,status) values('$heading1','$heading2','$heading3','$heading4','$image','1')");
            }
        //	header('location:banner.php');
        
            ?>
            
         <script>
        window.location.href='home_about.php';
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
                                    <label class="col-sm-2 col-form-label">Heading-1</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="" name="heading1" value="<?php echo $heading1?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"> Heading-2</label>
                                    <div class="col-sm-10">
                                        <textarea name="heading2" id="" class="form-control"  cols="15" rows="6"><?php echo $heading2?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Contents</label>
                                    <div class="col-sm-10">
                                       <textarea name="heading3" id="" class="form-control"  cols="15" rows="6"><?php echo $heading3?></textarea>
                                    </div>
                                </div>
                               
                                <div class="form-group row ">
                                    <label class="col-sm-2 col-form-label">Type</label>
                                    <div class="col-sm-10">
                                    <textarea name="heading4" id="" class="form-control"  cols="15" rows="6"><?php echo $heading4?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        	<?php

                              if ($image!='') {
                              	echo "<a target='_blank' href='".CONTENT_IMAGE_SITE_PATH.$image."'><img width='100px' height='100px' src='".CONTENT_IMAGE_SITE_PATH.$image."'/></a>";
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
