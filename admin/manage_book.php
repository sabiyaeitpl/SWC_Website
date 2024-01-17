<?php
   include 'layout/head.php';
   $table = 'books';
   $section_title = 'Book';
   $title = 'Manage '.$section_title;
   $breadcumb_title = 'Add '.$section_title;
   
    $title='';
    $journal_name = '';
    $author_id  = '';
    $doi_or_hsn = '';
    $year = '';
    $keywords = '';
    $organization_name = '';
    $country = '';
    $short_description = '';
    $long_description = '';
    $url_link='';
    $image='';
    $msg='';
    $categories_id='';
    $status='';
    $recomended_status = '';
   
    try {
    if(isset($_GET['id']) && $_GET['id']!=''){
         $breadcumb_title = 'Edit '.$section_title;
        $id=get_safe_value($con,$_GET['id']);
        $res=mysqli_query($con,"select * from $table where id='$id'");
        $check=mysqli_num_rows($res);
        if($check>0){
            $row=mysqli_fetch_assoc($res);
            $title=$row['title'];
            $journal_name=$row['journal_name'];
            $author_id=$row['author_id'];
            $doi_or_hsn=$row['doi_or_hsn'];
            $year=$row['year'];
            $keywords=$row['keywords'];
            $organization_name=$row['organization_name'];
            $country=$row['country'];
            $short_description=$row['short_description'];
            $long_description=$row['long_description'];
            $image=$row['image'];
            $url_link=$row['url_link'];
            $categories_id=$row['category_id'];
            $status=$row['status'];
            $recomended_status=$row['recomended_status'];
        }else{
            //header('location:banner.php');
            
                ?>
            
         <script>
        window.location.href='book_list.php.php';
        </script>
        <?php
            die();
        }
    }
    if(isset($_POST['submit'])){
        $title=get_safe_value($con,$_POST['title']);
        $journal_name=get_safe_value($con,$_POST['journal_name']);
        $author_id=get_safe_value($con,$_POST['author_id']);
        $doi_or_hsn=get_safe_value($con,$_POST['doi_or_hsn']);
        $year=get_safe_value($con,$_POST['year']);
        $keywords=get_safe_value($con,$_POST['keywords']);
        $organization_name=get_safe_value($con,$_POST['organization_name']);
        $country=get_safe_value($con,$_POST['country']);
        $categories_id=get_safe_value($con,$_POST['category_id']);
        $short_description=get_safe_value($con,$_POST['short_description']);
        $long_description=get_safe_value($con,$_POST['long_description']);
        //$image=get_safe_value($con,$_POST['image']);
        $url_link=get_safe_value($con,$_POST['url_link']);
        $status=get_safe_value($con,$_POST['status']);
        $recomended_status=get_safe_value($con,$_POST['recomended_status']);
        
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
                     if (!move_uploaded_file($_FILES['image']['tmp_name'], BOOK_IMAGE_SERVER_PATH . $image)) {
                        throw new Exception("Failed to move the uploaded file.");
                    }else{
                        move_uploaded_file($_FILES['image']['tmp_name'],BOOK_IMAGE_SERVER_PATH.$image);
                    }
                    mysqli_query($con,"update $table set title='$title',category_id='$categories_id',journal_name='$journal_name',author_id='$author_id',
                    doi_or_hsn='$doi_or_hsn',year='$year',organization_name='$organization_name',country='$country',url_link='$url_link',short_description='$short_description',long_description='$long_description' , image='$image', status=$status , recomended_status ='$recomended_status' where id='$id'");
                }
                else{
                    mysqli_query($con,"update $table set title='$title',category_id='$categories_id',journal_name='$journal_name',author_id='$author_id',
                    doi_or_hsn='$doi_or_hsn',year='$year',organization_name='$organization_name',country='$country',url_link='$url_link',short_description='$short_description',long_description='$long_description',status=$status , recomended_status ='$recomended_status' where id='$id'");
                }
    
                 
            }else{
                $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
                if (!move_uploaded_file($_FILES['image']['tmp_name'], BOOK_IMAGE_SERVER_PATH . $image)) {
                    throw new Exception("Failed to move the uploaded file.");
                }else{
                    move_uploaded_file($_FILES['image']['tmp_name'],BOOK_IMAGE_SERVER_PATH.$image);
                }
                
                mysqli_query($con,"insert into $table(title,category_id,journal_name,author_id,doi_or_hsn,year,keywords,organization_name,country,url_link,short_description,long_description,image,status,recomended_status) values('$title','$categories_id','$journal_name','$author_id','$doi_or_hsn','$year','$keywords','$organization_name','$country','$url_link','$short_description','$long_description','$image','$status','$recomended_status')");
            }
        //	header('location:banner.php');
        
            ?>
            
         <script>
        window.location.href='book_list.php';
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
                                    <label class="col-sm-2 col-form-label">Book title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="" name="title" value="<?php echo $title?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-10">
                                    <select class="form-control" name="category_id" required>
										<option>Select Category</option>
										<?php
										$res=mysqli_query($con,"select id,name from books_categories where status=1 order by name asc");
										while($row=mysqli_fetch_assoc($res)){
											if($row['id']==$categories_id){
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
                                    <label class="col-sm-2 col-form-label">Journal Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="" name="journal_name" value="<?php echo $journal_name?>" required>
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Authors Name</label>
                                    <div class="col-sm-10">
                                        <!-- <input type="text" class="form-control" id="" name="author_id" value="<?php echo $author_id?>"> -->
                                        <?php
                                        $tempUserName=$_SESSION['ADMIN_USERNAME'];
                                        $tempQuery =  mysqli_query($con,"select * from admin_users WHERE email= '$tempUserName'");                                       
                        
                                        $result1=mysqli_fetch_assoc($tempQuery);
                                        if($result1['type']==2){
                                            $tempUserId = $result1['id'];
                                        }
                                        else{
                                            $tempUserId = '';
                                        }
                                        ?>
                                        <select class="form-control" name="author_id"  required <?php echo ($tempUserId!="")?'readonly':''; ?>>
										<option>Select Authors</option>
										<?php
										$res=mysqli_query($con,"select id,full_name from admin_users");
										while($row=mysqli_fetch_assoc($res)){
											if($row['id']==$author_id){
												echo "<option selected value=".$row['id'].">".$row['full_name']."</option>";
											}
                                            elseif($tempUserId!=""){
                                                if($row['id']==$tempUserId){
                                                    echo "<option selected value=".$row['id'].">".$row['full_name']."</option>";
                                                }
                                            }
                                            
                                            else{
												echo "<option value=".$row['id'].">".$row['full_name']."</option>";
											}
											
										}
										?>
									</select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">DOI/HSN</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="" name="doi_or_hsn" value="<?php echo $doi_or_hsn?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Year</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="" name="year" value="<?php echo $year?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Keywords/Meta Tag</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="" name="keywords" value="<?php echo $keywords?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Organization Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="" name="organization_name" value="<?php echo $organization_name?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Country</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="" name="country" value="<?php echo $country?>">
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label class="col-sm-2 col-form-label">Url Link</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="" name="url_link" value="<?php echo $url_link?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Short Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="10" id="editor" name="short_description" required><?php echo $short_description ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Long Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="20" id="editor1" name="long_description" required><?php echo $long_description ?></textarea>
                                    </div>
                                </div>
                               
                                
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">File</label>
                                    <div class="col-sm-10">
                                        	<?php

                              if ($image!='') {
                              	echo "<a target='_blank' href='".BOOK_IMAGE_SITE_PATH.$image."'><img width='100px' height='100px' src='img/doc.jpg'/></a>";
                              }
									 ?>
                                        <input type="file" class="form-control" id="" name="image" accept=".doc, .docx,.txt,.pdf" >
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
                                 <?php if ($role_id==1) { ?>

                                    <fieldset class="form-group">
                                    <div class="row">
                                        <label class="col-form-label col-sm-2 pt-0">Recomended Video</label>
                                        <div class="col-sm-10">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="recomended_status"
                                                    id="gridRadios1" value="1" <?php echo ($recomended_status!="")?(($recomended_status==1)?'checked':''):'' ?>>
                                                <label class="form-check-label" for="gridRadios1">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="recomended_status"
                                                    id="gridRadios2" value="0" <?php echo ($recomended_status!="")?(($recomended_status==0)?'checked':''):'' ?>>
                                                <label class="form-check-label" for="gridRadios2">
                                                    No
                                                </label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </fieldset>
                                <?php 
                                 }
                                 else{
                                    ?>
                                    <input type="hidden" name="recomended_status" value=<?php echo isset($_GET['id'])?$recomended_status:'0' ?> readonly>
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
