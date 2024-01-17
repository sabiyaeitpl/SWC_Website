<?php
   include 'layout/head.php';

   $sql="SELECT * FROM career";
   $res=mysqli_query($con,$sql);
   $carrerCount = mysqli_num_rows($res);

   $sql="SELECT * FROM enquiry";
   $res=mysqli_query($con,$sql);
   $enquiryCount = mysqli_num_rows($res);

   $sql="SELECT * FROM emailtable";
   $res=mysqli_query($con,$sql);
   $joinusCount = mysqli_num_rows($res);

   ?>
   
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<main>
   <div class="container-fluid">

      <div class="row">
         <div class="col-lg-4">
            <div class="card mb-4 progress-banner">
               <div class="card-body justify-content-between d-flex flex-row align-items-center">
                  <div>
                     <i class="iconsminds-clock mr-2 text-white align-text-bottom d-inline-block"></i>
                     <div>
                        <p class="lead text-white">Career Application (<?php echo $carrerCount ?>)</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-4">
            <div class="card mb-4 progress-banner">
               <div class="card-body justify-content-between d-flex flex-row align-items-center">
                  <div>
                     <i class="iconsminds-male mr-2 text-white align-text-bottom d-inline-block"></i>
                     <div>
                        <p class="lead text-white">Join Us (<?php echo $enquiryCount ?>)</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-4">
            <div class="card mb-4 progress-banner">
               <a href="#" class="card-body justify-content-between d-flex flex-row align-items-center">
                  <div>
                     <i class="iconsminds-bell mr-2 text-white align-text-bottom d-inline-block"></i>
                     <div>
                        <p class="lead text-white">Enquiry (<?php echo $joinusCount ?>)</p>
                     </div>
                  </div>
               </a>
            </div>
         </div>
      </div>
      
      <div class="col-sm-12">
          <div class="d-flex justify-content-between">
            <div><h2><b>File Upload</b></h2></div>
            <div><button type="button" class="btn btn-primary">Add File</button></div>
          </div>
          <div class="card p-3 mt-3">
              <ul class="p-0 m-0 file_upload_section">
                  <li>
                      <div class="position-absolute delete_btn"><button type="button" class="btn_main">
                             <span class="material-symbols-outlined text-danger">
                               delete
                             </span>
                            </button>
                      </div>
                      <img src="img/icon/file_icon.png" alt="" />
                      <p>File Name File Name</p>
                  </li> 
                  <li>
                      <div class="position-absolute delete_btn"><button type="button" class="btn_main">
                             <span class="material-symbols-outlined text-danger">
                               delete
                             </span>
                            </button>
                      </div>
                      <img src="img/icon/excel.png" alt="" />
                      <p>File Name</p>
                  </li> 
                  <li>
                      <div class="position-absolute delete_btn"><button type="button" class="btn_main">
                             <span class="material-symbols-outlined text-danger">
                               delete
                             </span>
                            </button>
                      </div>
                      <img src="img/icon/word.png" alt="" />
                      <p>File Name</p>
                  </li> 
                  <li>
                      <div class="position-absolute delete_btn"><button type="button" class="btn_main">
                             <span class="material-symbols-outlined text-danger">
                               delete
                             </span>
                            </button>
                      </div>
                      <img src="img/icon/pdf.png" alt="" />
                      <p>File Name</p>
                  </li> 
                  <li>
                      <div class="position-absolute delete_btn"><button type="button" class="btn_main">
                             <span class="material-symbols-outlined text-danger">
                               delete
                             </span>
                            </button>
                      </div>
                      <img src="img/icon/zip.png" alt="" />
                      <p>File Name</p>
                  </li> 
              </ul>
          </div>
      </div>
  
 </div>
</main>
<style>
    .file_upload_section li{
            display: inline-block;
        max-width:75px;
        list-style:none;
            text-align: center;
            position: relative;
            margin:10px 10px;
            vertical-align: top;
    }
     .file_upload_section li p{
             line-height: 14px;
    margin-top: 5px;
    height:33px;
     }
     .file_upload_section li img{
         max-height:50px;
     }
     .delete_btn{
        right: -12px;
     }
     .delete_btn button{
         border:0;
     }
     .btn_main{
             padding: 0;
    margin: 0;
    background: #ccc;
    width: 25px;
    height: 25px;
    padding-top: 4px;
    border-radius: 50px;
     }
     .btn_main .material-symbols-outlined{
             font-size: 18px;
     }
</style>
<?php
   include 'layout/footer.php';
   ?>