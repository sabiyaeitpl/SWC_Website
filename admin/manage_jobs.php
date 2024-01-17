<?php

   include 'layout/head.php';
   $table = 'job';
   $section_title = 'Job';
   $title = 'Manage '.$section_title;
   $breadcumb_title = 'Add '.$section_title;
   
    $title='';
    $menu_id='';
    $description='';
    $job_status='';
    $job_type='';
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
            $menu_id=$row['menu_id'];
            $description=$row['description'];
            $job_status = $row['job_status'];
            $job_type = $row['type'];

        }else{
            //header('location:banner.php');
            
                ?>
            
         <script>
        window.location.href='jobs.php';
        </script>
        <?php
            die();
        }
    }
    if(isset($_POST['submit']))
    {
        $title=get_safe_value($con,$_POST['title']);
        $menu_id=get_safe_value($con,$_POST['menu_id']);
        $description=get_safe_value($con,$_POST['description']);
        $job_type=get_safe_value($con,$_POST['job_type']);
        $job_status=get_safe_value($con,$_POST['job_status']);
       
            if($msg==''){
                if(isset($_GET['id']) && $_GET['id']!=''){
                        mysqli_query($con,"update $table set title='$title',menu_id='$menu_id',description='$description',type='$job_type',job_status='$job_status' where id='$id'");
                }else{ 
                    mysqli_query($con,"insert into $table(title,menu_id,description,type,job_status,status) values('$title','$menu_id','$description','$job_type','$job_status','1')");
                }
            //	header('location:banner.php');
            
                ?>
                
             <script>
            window.location.href='jobs.php';
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
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="" name="title" value="<?php echo $title?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Country</label>
                                    <div class="col-sm-8">
                                        <select name="menu_id" class="form-control" id="" required>
                                        <option>Select Country</option>
										<?php
										$res=mysqli_query($con,"select id,name from menu_items where status=1 order by name asc");
										while($row=mysqli_fetch_assoc($res)){
											if($row['id']==$menu_id){
												echo "<option selected value=".$row['id'].">".$row['name']."</option>";
											}else{
												echo "<option value=".$row['id'].">".$row['name']."</option>";
											}
											
										}
										?>
                                          
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Job Type</label>
                                    <div class="col-sm-8">
                                        <select name="job_type" id="" class="form-control">
                                            <option value="">Selct Type</option>
                                            <?php
										$res=mysqli_query($con,"select id,name from job_type where status=1 order by name asc");
										while($row=mysqli_fetch_assoc($res)){
											if($row['name']==$job_type){
												echo "<option selected>".$row['name']."</option>";
											}else{
												echo "<option>".$row['name']."</option>";
											}
											
										}
										?>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="50" id="editor" name="description" required><?php echo $description ?></textarea>
                                    </div>
                                </div>
                                <fieldset class="form-group">
                                    <div class="row">
                                        <label class="col-form-label col-sm-2 pt-0">Status</label>
                                        <div class="col-sm-10">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="job_status"
                                                    id="gridRadios1" value="1" <?php echo ($job_status!="")?(($job_status==1)?'checked':''):'' ?> >
                                                <label class="form-check-label" for="gridRadios1">
                                                   Open
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="job_status"
                                                    id="gridRadios2" value="2" <?php echo ($job_status!="")?(($job_status==2)?'checked':''):'' ?>>
                                                <label class="form-check-label" for="gridRadios2">
                                                    Pending
                                                </label>
                                            </div>
                                            <div class="form-check ">
                                                <input class="form-check-input" type="radio" name="job_status"
                                                    id="gridRadios3" value="0" <?php echo ($job_status!="")?(($job_status==0)?'checked':''):'' ?> >
                                                <label class="form-check-label" for="gridRadios3">
                                                    Closed
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
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