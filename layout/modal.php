<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $fullName = mysqli_real_escape_string($con, $_POST['name']);
    $phoneNumber = mysqli_real_escape_string($con, $_POST['phone']);
    $emailId = mysqli_real_escape_string($con, $_POST['email']);
    $jobType = mysqli_real_escape_string($con, $_POST['jobType']);
    $message = mysqli_real_escape_string($con, $_POST['message']);

    // Insert the data into the database

      if($_FILES['image']['name']!=''){
        $allowedTypes = ['application/pdf'];
        if (!in_array($_FILES["image"]["type"], $allowedTypes)) {
            $msg = "Please select only PDF format.";
        }
        else{
          $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
            //   move_uploaded_file($_FILES['image']['tmp_name'],CAREER_IMAGE_SERVER_PATH.$image);
              mysqli_query($con,"INSERT INTO career (full_name, phone_number, email_id, job_type, message,image) 
              VALUES ('$fullName', '$phoneNumber', '$emailId', '$jobType', '$message','$image')");
              echo '<script>';
              echo 'alert("Application successfully submitted");';
              echo 'window.location.href = "index.php";';
              echo '</script>';
        } 
      }else{
            mysqli_query($con,"INSERT INTO career (full_name, phone_number, email_id, job_type, message,image) 
            VALUES ('$fullName', '$phoneNumber', '$emailId', '$jobType', '$message',NULL)");
            echo '<script>';
            echo 'alert("Application successfully submitted");';
            echo 'window.location.href = "index.php";';
            echo '</script>';
   
      }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['enquiry'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $message = mysqli_real_escape_string($con, $_POST['message']);

    $insertQuery = "INSERT INTO enquiry (full_name, phone_number, email_id, message) 
    VALUES ('$name', '$phone', '$email', '$message')";
    if (mysqli_query($con, $insertQuery)) {
        echo '<script>';
        echo 'alert("Enquiry successfully submitted");';
        echo 'window.history.back();';
        echo '</script>';
    } else {
        echo '<script>';
        echo 'alert("Something went wrong!");';
        echo 'window.history.back();';
        echo '</script>';
    }

}
?>

<body>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="background-image: url(img/carousel-12.jpg);">
                <div class="modal-header bg-dark  text-center">
                    <h5 class="modal-title d-block text-white" id="exampleModalLabel" style="width: 100%;">Career</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                </div>
                <div class="modal-body pb-0">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Id</label>
                        <input type="email" name="email" class="form-control" placeholder="Email Id" >
                    </div>
                    <div class="mb-3">
                        <label for="jobType" class="form-label">Job Type</label>
                        <select name="jobType" class="form-control" required>
                            <option>Job Type 1</option>
                            <option>Job Type 2</option>
                            <option>Job Type 3</option>
                            <option>Job Type 4</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cv" class="form-label d-block">Upload CV (PDF)</label>
                        <input type="file" name="image" accept=".pdf" >
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea name="message" class="form-control" placeholder="Leave a Message here" ></textarea>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-lg btn-dark btn-block" type="submit" name="submit">Submit</button>
                    </div>
                </form>
                </div>
                <div class="modal-footer pt-0">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                   
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 2-->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="background-image: url(img/carousel-12.jpg);">
                <div class="modal-header bg-dark  text-center">
                    <h5 class="modal-title d-block text-white" id="exampleModalLabel" style="width: 100%;">Enquiry</h5>
                </div>
                <div class="modal-body pb-0">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Id</label>
                            <input type="email" name="email" class="form-control" placeholder="Email Id" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea name="message" class="form-control" placeholder="Leave a Message here"></textarea>
                        </div>

                        <div class="mb-3">
                            <button class="btn btn-lg btn-dark btn-block" type="submit" name="enquiry">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer pt-0">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>