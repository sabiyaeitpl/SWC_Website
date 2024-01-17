<?php
   include 'layout/head.php';
   $table = 'services_master';
   $section_title = 'Magazine';
   $title = 'Manage '.$section_title;
   $breadcumb_title = 'Add '.$section_title;
   
    $title='';
    $details = '';
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
            $details=$row['details'];
        }else{
            //header('location:banner.php');
            
                ?>
            
         <script>
        window.location.href='service_list.php';
        </script>
        <?php
            die();
        }
    }
    if(isset($_POST['submit'])){
        $title=get_safe_value($con,$_POST['title']);
        $details=get_safe_value($con,$_POST['details']);
        
        if($_FILES['image']['name']!=''){
            $fileName = $_FILES['image']['name'];
            $ext =pathinfo($fileName, PATHINFO_EXTENSION);
            $allowed = array('pdf', 'doc', 'docx');

            if(isset($_GET['id']) && $_GET['id']==0){           
                if (!in_array($ext, $allowed)) {
                    $msg="Please select only doc, pdf file formate";
                }           
            }else{
                if (!in_array($ext, $allowed)) {
                    $msg="Please select only doc, pdf file formate";
                }    
            
            }
        }
    
        
        if($msg==''){
            if(isset($_GET['id']) && $_GET['id']!=''){
            if($_FILES['image']['name']!=''){
                    $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
                     if (!move_uploaded_file($_FILES['image']['tmp_name'], MAGAZINE_IMAGE_SERVER_PATH . $image)) {
                        throw new Exception("Failed to move the uploaded file.");
                    }else{
                        move_uploaded_file($_FILES['image']['tmp_name'],MAGAZINE_IMAGE_SERVER_PATH.$image);
                    }
                    mysqli_query($con,"update $table set title='$title',details='$details', image='$image' where id='$id'");
                }
                else{
                    mysqli_query($con,"update $table set title='$title',details='$details' where id='$id'");
                }
    
                 
            }else{
                if($_FILES['image']['name']!=''){
                    $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
                    if (!move_uploaded_file($_FILES['image']['tmp_name'], MAGAZINE_IMAGE_SERVER_PATH . $image)) {
                        throw new Exception("Failed to move the uploaded file.");
                    }else{
                        move_uploaded_file($_FILES['image']['tmp_name'],MAGAZINE_IMAGE_SERVER_PATH.$image);
                    }
                }
                
                mysqli_query($con,"insert into $table(title,details) values('$title','$details')");
            }
        //	header('location:banner.php');
        
            ?>
            
         <script>
        window.location.href='service_list.php';
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
                                    <label class="col-sm-2 col-form-label">Magazine title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="" name="title" value="<?php echo $title?>" required>
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="10" id="editor" name="details" required><?php echo $details ?></textarea>
                                    </div>
                                </div>
                               
                               
                                
                                <!-- <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">File</label>
                                    <div class="col-sm-10">
                                        	<?php

                                    if ($image!='') {
                                        echo "<a target='_blank' href='".MAGAZINE_IMAGE_SITE_PATH.$image."'><img width='100px' height='100px' src='img/doc.jpg'/></a>";
                                    }
									 ?>
                                        <input type="file" class="form-control" id="" name="image" accept=".doc, .docx,.txt,.pdf" >
                                    </div>
                                </div> -->
                               
                               

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
