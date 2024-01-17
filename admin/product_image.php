<?php
include('database/connection.inc.php');
include('database/function.inc.php');
$table = 'product_image';
$msg='';


if(isset($_POST['imageSubmit']))
{
    $product_id=get_safe_value($con,$_POST['product_id']);
    
    if($msg=='')
    {
            $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
            if (!move_uploaded_file($_FILES['image']['tmp_name'], PRODUCT_IMAGE_SERVER_PATH . $image)) {
                throw new Exception("Failed to move the uploaded file.");
            }else{
                move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
            }
            
            mysqli_query($con,"insert into $table(`product_id`,`image`) values('$product_id','$image')");

        //	header('location:banner.php');
    
        ?>
        
        <script>
    // Go back one step in the browser history
            window.history.back();
        </script>
        <?php
        die();
    }

}


?>