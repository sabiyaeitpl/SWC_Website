<?php

   include 'layout/head.php';
   $table = 'menu_items';
   $section_title = 'Menu';
   $title = 'Manage '.$section_title;
   $breadcumb_title = 'Add '.$section_title;
   
    $name='';
    $parent_id='';
    $url='';
    $msg='';

    try {
    if(isset($_GET['id']) && $_GET['id']!=''){
         $breadcumb_title = 'Edit '.$section_title;
        $id=get_safe_value($con,$_GET['id']);
        $res=mysqli_query($con,"select * from $table where id='$id'");
        $check=mysqli_num_rows($res);
        if($check>0){
            $row=mysqli_fetch_assoc($res);
            $name=$row['name'];
            $parent_id=$row['parent_id'];
            $url=$row['url'];

        }else{
            //header('location:banner.php');
            
                ?>
            
         <script>
        window.location.href='menus.php';
        </script>
        <?php
            die();
        }
    }
    if(isset($_POST['submit']))
    {
        $name=get_safe_value($con,$_POST['name']);
        $url=get_safe_value($con,$_POST['url']);
        $parent_id=get_safe_value($con,$_POST['parent_id']);
        $res=mysqli_query($con,"select * from $table where name='$name'");
        $check=mysqli_num_rows($res);
       
            if($msg==''){
                if(isset($_GET['id']) && $_GET['id']!=''){
                        mysqli_query($con,"update $table set name='$name',parent_id='$parent_id' where id='$id'");
                }else{ 
                    mysqli_query($con,"insert into $table(name,parent_id,url,status) values('$name','$parent_id','$url','1')");
                }
            //	header('location:banner.php');
            
                ?>
                
             <script>
            window.location.href='menus.php';
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
                                    <label class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="" name="name" value="<?php echo $name?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Parent Menu</label>
                                    <div class="col-sm-8">
                                        <select name="parent_id" class="form-control" id="" required>

                                            <option value="0">Primary Menu</option>
                                                    <?php
                                                    $menuItems = getMenuItemsForDropdown();
                                                    foreach ($menuItems as $menuItem) {
                                                        $selected = ($menuItem['id'] == $parent_id) ? 'selected' : '';
                                                        echo '<option value="' . $menuItem['id'] . '" ' . $selected . '>' . $menuItem['name'] . '</option>';
                                                    }                                                    
                                                    ?>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" class="form-control" id="" name="url" value="" >
                                <!-- <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">URL</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="" name="url" value="<?php echo $url?>" >
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
function getMenuItemsForDropdown() {
    global $con;

    $sql = "SELECT id,parent_id, name FROM menu_items";
    $result = mysqli_query($con, $sql);
    $menu_items = [];

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $menu_items[] = $row;
        }
    }

    return $menu_items;
}
   include 'layout/footer.php';
?>