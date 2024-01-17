<?php
   include 'layout/head.php';
   $title = 'Free Trainning';
   $table = 'free_trainning_comments';
   $rowNumber = 1;


        $sql="SELECT $table.* FROM $table order by $table.id desc";
        $res=mysqli_query($con,$sql);

    
?>

<main>
        <div class="container-fluid">
        <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <h1><?php echo $title; ?></h1>
                        

                    </div>

                    <div class="separator mb-5"></div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $title; ?> List</h5>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Message</th>
                                        <th scope="col">Caraeted At</th>
                                        
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = mysqli_num_rows($res);
                                    if($count > 0){
                                        while($row = mysqli_fetch_assoc($res)){
                                            ?>
                                     <tr>
                                            <th scope="row"><?php echo $rowNumber; ?></th>
                                            <td><?php echo $row['commenter_name'] ?></td>
                                            <td><?php echo $row['commenter_phone'] ?></td>
                                            <td><?php echo $row['commenter_email'] ?></td>
                                            <td><?php echo $row['comment_content'] ?></td>
                                            <td><?php echo $row['created_at'] ?></td>
                                           
                                            
                                     </tr>
                                    <?php  
                                        $rowNumber++; 
                                        }
                                }else{
                                    echo '<tr>';
                                    echo '<td style="color:red">Data Not Found</td>';
                                    echo '</tr>';
                                } ?>
                               
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php
   include 'layout/footer.php';
?>