<?php

   include 'layout/head.php';
   $table = 'admin_users';
   $section_title = 'General Settings';
   $title = 'Manage '.$section_title;
   $breadcumb_title = 'Add '.$section_title;
   $id=$_GET['id'];
   $email='';
   $comp_email='';
   $password='';
   $full_name='';
   $phone='';
   $message='';
   $address='';
   $facebook_link='';
   $google_link='';
   $twitter_link='';
   $instagram_link='';
   $youtube_link='';
   $meta_title='';
   $meta_keywords='';
   $meta_descriptions='';
   $image='';
   $msg = '';
   try {
   if(isset($_GET['id']) && $_GET['id']!=''){
       $breadcumb_title = 'Edit '.$section_title;
       $id=get_safe_value($con,$_GET['id']);
       $res=mysqli_query($con,"select * from $table where id='$id'");
       $check=mysqli_num_rows($res);
       if($check>0){
           $row=mysqli_fetch_assoc($res);
           $email=$row['email'];
           $comp_email=$row['comp_email'];
           $password=$row['password'];
           $full_name=$row['full_name'];
           $phone=$row['phone'];
           $message=$row['message'];
           $address=$row['address'];
           $facebook_link=$row['facebook_link'];
           $google_link=$row['google_link'];
           $twitter_link=$row['twitter_link'];
           $instagram_link=$row['instagram_link'];
           $youtube_link=$row['youtube_link'];
           $meta_title=$row['meta_title'];
           $meta_keywords=$row['meta_keywords'];
           $meta_descriptions=$row['meta_description'];
           $image=$row['image'];
       }else{
           //header('location:banner.php');
           
               ?>
           
        <script>
       window.location.href='general_setting.php?id=<?php echo $id; ?>';
       </script>
       <?php
           die();
       }
   }
   if(isset($_POST['submit'])){
       $password=get_safe_value($con,$_POST['password']);
       $full_name=get_safe_value($con,$_POST['full_name']);
       $comp_email=get_safe_value($con,$_POST['comp_email']);
       $phone=get_safe_value($con,$_POST['phone']);
       $message=get_safe_value($con,$_POST['message']);
       $address=get_safe_value($con,$_POST['address']);
       $facebook_link=get_safe_value($con,$_POST['facebook_link']);
       $google_link=get_safe_value($con,$_POST['google_link']);
       $twitter_link=get_safe_value($con,$_POST['twitter_link']);
       $instagram_link=get_safe_value($con,$_POST['instagram_link']);
       $youtube_link=get_safe_value($con,$_POST['youtube_link']);
       $meta_title=get_safe_value($con,$_POST['meta_title']);
       $meta_keywords=get_safe_value($con,$_POST['meta_keywords']);
       $meta_descriptions=get_safe_value($con,$_POST['meta_descriptions']);

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
                    if (!move_uploaded_file($_FILES['image']['tmp_name'], PROFILE_IMAGE_SERVER_PATH . $image)) {
                        throw new Exception("Failed to move the uploaded file.");
                    }else{
                        move_uploaded_file($_FILES['image']['tmp_name'],PROFILE_IMAGE_SERVER_PATH.$image);
                    }
                   mysqli_query($con,"update $table set password='$password',full_name='$full_name',phone='$phone',message='$message',address='$address',facebook_link='$facebook_link',google_link='$google_link',twitter_link='$twitter_link',instagram_link='$instagram_link',youtube_link='$youtube_link',comp_email='$comp_email',image='$image',meta_title='$meta_title',meta_keywords='$meta_keywords',meta_description='$meta_descriptions' where id='$id'");
               }
               else{
                    mysqli_query($con,"update $table set password='$password',full_name='$full_name',phone='$phone',message='$message',address='$address',facebook_link='$facebook_link',google_link='$google_link',twitter_link='$twitter_link',instagram_link='$instagram_link',youtube_link='$youtube_link',comp_email='$comp_email',meta_title='$meta_title',meta_keywords='$meta_keywords',meta_description='$meta_descriptions' where id='$id'");
               }
   
               
           }else{?>
            <script>
             alert("Something went Wrong");
             history.back();
            </script>
          <?php }
       //	header('location:banner.php');
       
           ?>
           
        <script>
        alert("Profile Updated Successfully!");
        window.location.href='general_setting.php?id=<?php echo $id; ?>';
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
                            <h5 class="mb-4"><?php echo $section_title; ?></h5>

                            <form action="" method="post" enctype="multipart/form-data" class="needs-validation tooltip-label-right">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Email</label>
                                        <input type="email" name="email" class="form-control" value="<?php echo $email ?>" id="inputEmail4" placeholder="Email" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Password(Minimum 8 charcters maximim 32)</label>
                                        <input type="text" name="password" value="<?php echo $password ?>" class="form-control" id="inputPassword4"
                                            placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Company name</label>
                                        <input type="text" name="full_name" value="<?php echo $full_name ?>" class="form-control" id="inputEmail4" >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Company Email</label>
                                        <input type="text" name="comp_email" value="<?php echo $comp_email ?>" class="form-control" id="inputEmail4" >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Mobile</label>
                                        <input type="text" name="phone" value="<?php echo $phone ?>" class="form-control" id="inputEmail4" >
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label for="inputEmail4">Address</label>
                                        <input type="text" name="address" value="<?php echo $address  ?>"  class="form-control" id="inputEmail4" >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Facebook Link</label>
                                        <input type="text" name="facebook_link" value="<?php echo $facebook_link ?>" class="form-control" id="inputEmail4" >
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Instagram Link</label>
                                        <input type="text" name="instagram_link" value="<?php echo $instagram_link ?>" class="form-control" id="inputEmail4" >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Linkedin Link</label>
                                        <input type="text" name="google_link" value="<?php echo $google_link ?>" class="form-control" id="inputEmail4" >
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Youtube Link</label>
                                        <input type="text" name="youtube_link" value="<?php echo $youtube_link ?>"  class="form-control" id="inputEmail4" >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Twitter Link</label>
                                        <input type="text" name="twitter_link" value="<?php echo $twitter_link ?>" class="form-control" id="inputEmail4" >
                                    </div>
                                   
                                </div>
                                <div class="form-group">
                                        <label for="inputEmail4">About Company</label>
                                        <textarea name="message" class="form-control" cols="30" rows="5"><?php echo $message ?></textarea>
                                </div>
                                <div class="form-group">
                                        <label for="inputEmail4">Title</label>
                                        <textarea name="meta_title" class="form-control" cols="30" rows="5"><?php echo $meta_title ?></textarea>
                                </div>
                                <div class="form-group">
                                        <label for="inputEmail4">Meta Keywords</label>
                                        <textarea name="meta_keywords" class="form-control" cols="30" rows="5"><?php echo $meta_keywords ?></textarea>
                                </div>
                                <div class="form-group">
                                        <label for="inputEmail4">Meta Description</label>
                                        <textarea name="meta_descriptions" class="form-control" cols="30" rows="5"><?php echo $meta_descriptions ?></textarea>
                                </div>
                                <div class="form-group">
                                        <label for="inputEmail4">Profile Image</label>
                                        <input type="file" name="image" class="form-control" id="inputEmail4" accept="image/*">
                                        <?php

                                                if ($image!='') {
                                                    echo "<a target='_blank' href='".PROFILE_IMAGE_SITE_PATH.$image."'><img width='100px' height='100px' src='".PROFILE_IMAGE_SITE_PATH.$image."'/></a>";
                                                }
                                        ?>
                                    </div>



                                <button type="submit" name="submit" class="btn btn-primary d-block mt-3">Update</button>
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