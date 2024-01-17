<?php

   include 'layout/head.php';
   $table = 'cms';
   $section_title = 'CMS';
   $title = 'Manage '.$section_title;
   $breadcumb_title = 'Add '.$section_title;
   
    $title='';
    $menu_id='';
    $description='';
    $url='';
    $image='';
    $video='';
    $msg='';
    $status='';

    try {
    if(isset($_GET['id']) && $_GET['id']!=''){
         $breadcumb_title = 'Edit '.$section_title;
        $id=get_safe_value($con,$_GET['id']);
        $res=mysqli_query($con,"select * from $table where id='$id'");
        $check=mysqli_num_rows($res);
        if($check>0){
            $row=mysqli_fetch_assoc($res);
            $title=$row['title'];
            $menu_id=$row['menu_id'];
            $description=$row['description'];
            $url = $row['url'];
            $image=$row['image'];
            $video=$row['video'];
            $status=$row['status'];
        }else{
            //header('location:banner.php');
            
                ?>
            
         <script>
        window.location.href='cms.php';
        </script>
        <?php
            die();
        }
    }
    if(isset($_POST['submit'])){
        $title=get_safe_value($con,$_POST['title']);
        $url=get_safe_value($con,$_POST['url']);
        $menu_id=get_safe_value($con,$_POST['menu_id']);
        $description=get_safe_value($con,$_POST['description']);
        //$image=get_safe_value($con,$_POST['image']);
        $video=get_safe_value($con,$_POST['video']);
        $status=get_safe_value($con,$_POST['status']);

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
                    //  if (!move_uploaded_file($_FILES['image']['tmp_name'], CMS_IMAGE_SERVER_PATH . $image)) {
                    //     throw new Exception("Failed to move the uploaded file.");
                    // }else{
                    //     move_uploaded_file($_FILES['image']['tmp_name'],CMS_IMAGE_SERVER_PATH.$image);
                    // }
                    mysqli_query($con,"update $table set title='$title',menu_id='$menu_id',description='$description',video='$video',image='$image' where id='$id'");
                }
                else{
                   
                    mysqli_query($con,"update $table set title='$title',menu_id='$menu_id',description='$description',video='$video' where id='$id'");
                }
    
                 
            }else{
                 $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
                // if (!move_uploaded_file($_FILES['image']['tmp_name'], BLOG_IMAGE_SERVER_PATH . $image)) {
                //     throw new Exception("Failed to move the uploaded file.");
                // }else{
                //     move_uploaded_file($_FILES['image']['tmp_name'],BLOG_IMAGE_SERVER_PATH.$image);
                // }
                
                mysqli_query($con,"insert into $table(title,menu_id,url,description,image,video,status) values('$title','$menu_id','$url','$description','$image','$video','$status')");
                $lastInsertedId = mysqli_insert_id($con);
                $base_url = SITE_PATH . 'cms.php?type=' . base64_encode($lastInsertedId);
                mysqli_query($con,"UPDATE `menu_items` SET `url` = '$base_url' WHERE `menu_items`.`id` ='$menu_id' ");
                mysqli_query($con,"UPDATE $table SET `url` = '$base_url' WHERE `id` ='$lastInsertedId'");
            }
        //	header('location:banner.php');
        
            ?>
            
         <script>
        window.location.href='cms.php';
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
                                <input type="hidden" name="menu_id" value="<?php echo $menu_id; ?>">
                                <input type="hidden" name="video" value="<?php echo $video; ?>">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="50" id="editor" name="description" required><?php echo $description ?></textarea>
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
