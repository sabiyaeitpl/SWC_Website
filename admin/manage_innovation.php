<?php

   include 'layout/head.php';
   $table = 'innovation';
   $section_title = 'Innovation';
   $title = 'Manage '.$section_title;
   $breadcumb_title = 'Add '.$section_title;
   
    $title='';
    $description='';
    $image='';
    $video='';
    $document='';
    $msg='';
    $status='';

    try 
    {
        if(isset($_GET['id']) && $_GET['id']!='')
        {
            $breadcumb_title = 'Edit '.$section_title;
            $id=get_safe_value($con,$_GET['id']);
            $res=mysqli_query($con,"select * from $table where id='$id'");
            $check=mysqli_num_rows($res);
            if($check>0)
            {
                $row=mysqli_fetch_assoc($res);
                $title=$row['title'];
                $description=$row['description'];
                $image=$row['image'];
                $video=$row['video'];
                $document=$row['document'];
                $status=$row['status'];
            }
            else
            {
                //header('location:banner.php');
                
                    ?>
                
                <script>
                window.location.href='blog_list.php';
                </script>
                <?php
                die();
            }
        }
        if(isset($_POST['submit']))
        {
            $title=get_safe_value($con,$_POST['title']);
            $description=get_safe_value($con,$_POST['description']);
            //$image=get_safe_value($con,$_POST['image']);
            $video=get_safe_value($con,$_POST['video']);
            $status=get_safe_value($con,$_POST['status']);

            if(isset($_GET['id']) && $_GET['id']==0)
            {
                if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg' && $_FILES['image']['type']!='image/gif'){
                    $msg="Please select only png,jpg and jpeg image formate";
                }
            }
            else
            {
                if($_FILES['image']['type']!=''){
                        if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg' && $_FILES['image']['type']!='image/gif'){
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
                        if (!move_uploaded_file($_FILES['image']['tmp_name'], INNOVATION_IMAGE_SERVER_PATH . $image)) {
                            throw new Exception("Failed to move the uploaded file.");
                        }else{
                            move_uploaded_file($_FILES['image']['tmp_name'],INNOVATION_IMAGE_SERVER_PATH.$image);
                        }
                        mysqli_query($con,"update $table set title='$title', description='$description',video='$video',image='$image', status=$status where id='$id'");
                    }
                    else
                    {
                        mysqli_query($con,"update $table set title='$title',description='$description',video='$video', status=$status where id='$id'");
                    }

                    if($_FILES['document']['name']!='')
                    {
                        $document=rand(111111111,999999999).'_'.$_FILES['document']['name'];
                        if (!move_uploaded_file($_FILES['document']['tmp_name'], INNOVATION_IMAGE_SERVER_PATH . $document)) 
                        {
                            throw new Exception("Failed to move the uploaded file.");
                        }
                        else
                        {
                            move_uploaded_file($_FILES['document']['tmp_name'],INNOVATION_IMAGE_SERVER_PATH.$document);
                        }
                        mysqli_query($con,"update $table set document='$document' where id='$id'");
                    }
        
                    
                }
                else
                {
                    $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
                    if (!move_uploaded_file($_FILES['image']['tmp_name'], INNOVATION_IMAGE_SERVER_PATH . $image)) 
                    {
                        throw new Exception("Failed to move the uploaded file.");
                    }
                    else
                    {
                        move_uploaded_file($_FILES['image']['tmp_name'],INNOVATION_IMAGE_SERVER_PATH.$image);
                    }

                    $document=rand(111111111,999999999).'_'.$_FILES['document']['name'];
                    if (!move_uploaded_file($_FILES['document']['tmp_name'], INNOVATION_IMAGE_SERVER_PATH . $image)) 
                    {
                        throw new Exception("Failed to move the uploaded file.");
                    }
                    else
                    {
                        move_uploaded_file($_FILES['document']['tmp_name'],INNOVATION_IMAGE_SERVER_PATH.$image);
                    }
                    
                    mysqli_query($con,"insert into $table(title,description,image,document,video,status) values('$title','$description','$image','$document','$video','$status')");
                }
                //	header('location:banner.php');
            
                ?>
                
                <script>
                window.location.href='innovation_list.php';
                </script>
                <?php
                die();
            }

        }
    } 
    catch (Exception $e) 
    {
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
                                
                                
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="50" id="editor" name="description" required><?php echo $description ?></textarea>
                                    </div>
                                </div>
                               
                                <div class="form-group row ">
                                    <label class="col-sm-2 col-form-label">Video</label>
                                    <div class="col-sm-10">
                                    <textarea class="form-control" rows="5"  name="video" required><?php echo $video ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        	<?php

                                            if ($image!='') {
                                                echo "<a target='_blank' href='".INNOVATION_IMAGE_SITE_PATH.$image."'><img width='100px' height='100px' src='".INNOVATION_IMAGE_SITE_PATH.$image."'/></a>";
                                            }
									    ?>
                                        <input type="file" class="form-control" id="" name="image" accept="image/*" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Attachment</label>
                                    <div class="col-sm-10">
                                        	<?php

                                            if ($document!='') {
                                                echo "<a target='_blank' href='".INNOVATION_IMAGE_SITE_PATH.$document."'><img width='100px' height='100px' src='".INNOVATION_IMAGE_SITE_PATH.$document."'/></a>";
                                            }
									    ?>
                                        <input type="file" class="form-control" id="" name="document" >
                                    </div>
                                </div>
                                <?php if ($role_id==1) { ?>
                                <fieldset class="form-group">
                                    <div class="row">
                                        <label class="col-form-label col-sm-2 pt-0">Status</label>
                                        <div class="col-sm-10">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="gridRadios1" value="1" <?php echo ($status!="")?(($status==1)?'checked':''):'' ?> >
                                                <label class="form-check-label" for="gridRadios1">
                                                   Approved
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="gridRadios2" value="2" <?php echo ($status!="")?(($status==2)?'checked':''):'' ?>>
                                                <label class="form-check-label" for="gridRadios2">
                                                    Pending
                                                </label>
                                            </div>
                                            <div class="form-check ">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="gridRadios3" value="0" <?php echo ($status!="")?(($status==0)?'checked':''):'' ?> >
                                                <label class="form-check-label" for="gridRadios3">
                                                    Rejected
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <?php
                                    }
                                    else{
                                        ?>
                                        <input type="hidden" name="status" value=<?php echo isset($_GET['id'])?$status:'2' ?> readonly>
                                        <?php
                                    }
                                ?>
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
