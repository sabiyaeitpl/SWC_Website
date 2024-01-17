<?php
   include 'layout/head.php';
   $table = 'services_child';
   $section_title = 'Services';
   $title = 'Manage '.$section_title;
   $breadcumb_title = 'Add '.$section_title;
   
    $title='';
    $short_desc = '';
    $long_desc = '';
    $image = '';
    $url_link = '';
    $price = '';
    $sales_price = '';
    $author_name = '';
    $instructor_desc = '';
    $master_id = $_GET['master_id'];
    $msg='';
   
    try {
    if(isset($_GET['id']) && $_GET['id']!=''){
         $breadcumb_title = 'Edit '.$section_title;
        $id=get_safe_value($con,$_GET['id']);
        $res=mysqli_query($con,"select * from $table where id='$id'");
        $check=mysqli_num_rows($res);
        if($check>0){
            $row=mysqli_fetch_assoc($res);
            $title=$row['title'];
            $short_desc=$row['short_desc'];
            $long_desc=$row['long_desc'];
            $image=$row['image'];
            $price=$row['price'];
            $sales_price=$row['sales_price'];
            $author_name=$row['author_name'];
            $url_link=$row['url_link'];
            $instructor_desc=$row['instructor_desc'];
            
        }else{
            //header('location:banner.php');
            
                ?>
            
         <script>
        window.location.href='child_services.php';
        </script>
        <?php
            die();
        }
    }
    if(isset($_POST['submit'])){
        $title=get_safe_value($con,$_POST['title']);
        $short_desc=get_safe_value($con,$_POST['short_desc']);
        $long_desc=get_safe_value($con,$_POST['long_desc']);
        $price=get_safe_value($con,$_POST['price']);
        $sales_price=get_safe_value($con,$_POST['sales_price']);
        $author_name=get_safe_value($con,$_POST['author_name']);
        $url_link=get_safe_value($con,$_POST['url_link']);
        $instructor_desc=get_safe_value($con,$_POST['instructor_desc']);
        
        if($_FILES['image']['name']!=''){
            $fileName = $_FILES['image']['name'];
            $ext =pathinfo($fileName, PATHINFO_EXTENSION);
            $allowed = array('jpg', 'png', 'jpeg','gif');

            if(isset($_GET['id']) && $_GET['id']==0){           
                if (!in_array($ext, $allowed)) {
                    $msg="Please select only jpg, png , jpeg , gif formate";
                }           
            }else{
                if (!in_array($ext, $allowed)) {
                    $msg="Please select only jpg, png , jpeg , gif file formate";
                }    
            
            }
        }
    
        
        if($msg==''){
            if(isset($_GET['id']) && $_GET['id']!=''){
            if($_FILES['image']['name']!=''){
                    $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
                     if (!move_uploaded_file($_FILES['image']['tmp_name'], CHILD_SERVICE_IMAGE_SERVER_PATH . $image)) {
                        throw new Exception("Failed to move the uploaded file.");
                    }else{
                        move_uploaded_file($_FILES['image']['tmp_name'],CHILD_SERVICE_IMAGE_SERVER_PATH.$image);
                    }
                    mysqli_query($con,"update $table set title='$title',short_desc='$short_desc',long_desc='$long_desc',price='$price',sales_price='$sales_price',author_name='$author_name',url_link='$url_link',instructor_desc='$instructor_desc',image='$image' where id='$id'");
                }
                else{
                    mysqli_query($con,"update $table set title='$title',short_desc='$short_desc',long_desc='$long_desc',price='$price',sales_price='$sales_price',author_name='$author_name',url_link='$url_link',instructor_desc='$instructor_desc' where id='$id'");
                }
    
                 
            }else{
                if($_FILES['image']['name']!=''){
                    $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
                    if (!move_uploaded_file($_FILES['image']['tmp_name'], CHILD_SERVICE_IMAGE_SERVER_PATH . $image)) {
                        throw new Exception("Failed to move the uploaded file.");
                    }else{
                        move_uploaded_file($_FILES['image']['tmp_name'],CHILD_SERVICE_IMAGE_SERVER_PATH.$image);
                    }
                }
                
                mysqli_query($con,"insert into $table(title,short_desc,master_id,long_desc,price,sales_price,author_name,url_link,instructor_desc,image) values('$title','$short_desc','$master_id','$long_desc','$price','$sales_price','$author_name','$url_link','$instructor_desc','$image')");
            }
        //	header('location:banner.php');
        
            ?>
            
         <script>
        window.location.href='child_services.php?master_id=<?php echo $master_id ?>';
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
                                    <label class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="" name="title" value="<?php echo $title?>" required>
                                    </div>
                                </div>
                               <input type="hidden" name="master_id" value="<?php echo $_GET['master_id'] ?>">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Short Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="10" id="editor" name="short_desc" required><?php echo $short_desc ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Long Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="10" id="editor1" name="long_desc" required><?php echo $long_desc ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Instructor Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="10" id="editor2" name="instructor_desc" required><?php echo $instructor_desc ?></textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Price</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="" name="price" value="<?php echo $price?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Sales Price</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="" name="sales_price" value="<?php echo $sales_price?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Author</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="" name="author_name" value="<?php echo $author_name?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Video Link</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="" name="url_link" value="<?php echo $url_link?>" required>
                                    </div>
                                </div>
                               
                               
                                
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">File</label>
                                    <div class="col-sm-10">
                                        	<?php

                                    if ($image!='') {
                                        echo "<a target='_blank' href='".CHILD_SERVICE_IMAGE_SITE_PATH.$image."'><img width='100px' height='100px' src='".CHILD_SERVICE_IMAGE_SITE_PATH.$image."'/></a>";
                                    }
									 ?>
                                        <input type="file" class="form-control" id="" name="image" accept=".jpg, .jpeg,.png,.gif" >
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
