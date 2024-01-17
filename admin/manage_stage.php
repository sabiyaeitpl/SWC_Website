<?php

   include 'layout/head.php';
   $table = 'stage';
   $section_title = 'Project Stage';
   $title = 'Manage '.$section_title;
   $breadcumb_title = 'Add '.$section_title;
   
    $heading='';
    $content='';
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
            $content=$row['content'];
        }else{
            //header('location:banner.php');
            
                ?>
            
         <script>
        window.location.href='stage.php';
        </script>
        <?php
            die();
        }
    }
    if(isset($_POST['submit'])){
        $heading=get_safe_value($con,$_POST['heading']);
        $content=get_safe_value($con,$_POST['content']);
      
    
        
        if($msg==''){
            if(isset($_GET['id']) && $_GET['id']!=''){
                date_default_timezone_set('Asia/Kolkata');
                $date = date('Y-m-d H:i:s');
                mysqli_query($con,"update $table set heading='$heading',content='$content',updated_at='$date' where id='$id'"); 
            }else{
                mysqli_query($con,"insert into $table(heading,content,status) values('$heading','$content','1')");
            }
        //	header('location:banner.php');
        
            ?>
            
         <script>
         //alert("successfull");
        window.location.href='stage.php';
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
                                    <label class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                   
                                         <textarea name="content" id="" cols="15" rows="6" class="form-control" required><?php echo $content?></textarea>
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
