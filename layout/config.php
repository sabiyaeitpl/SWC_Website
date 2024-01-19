<?php
 $con = mysqli_connect("localhost","root","","swcw");
 if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/swcw/');
define('SITE_PATH','http://localhost/swcw/');

define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/products/');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/products/');

define('CLIENT_IMAGE_SERVER_PATH',SERVER_PATH.'media/client/');
define('CLIENT_IMAGE_SITE_PATH',SITE_PATH.'media/client/');

define('DESIGN_IMAGE_SERVER_PATH',SERVER_PATH.'media/design/');
define('DESIGN_IMAGE_SITE_PATH',SITE_PATH.'media/design/');

define('DRAWING_IMAGE_SERVER_PATH',SERVER_PATH.'media/drawing/');
define('DRAWING_IMAGE_SITE_PATH',SITE_PATH.'media/drawing/');

define('CAREER_IMAGE_SERVER_PATH',SERVER_PATH.'media/career/');
define('CAREER_IMAGE_SITE_PATH',SITE_PATH.'media/carrer/');

define('PROJECT_IMAGE_SERVER_PATH',SERVER_PATH.'media/project/');
define('PROJECT_IMAGE_SITE_PATH',SITE_PATH.'media/project/');

define('COUNT_IMAGE_SERVER_PATH',SERVER_PATH.'media/count/');
define('COUNT_IMAGE_SITE_PATH',SITE_PATH.'media/count/');

define('TEAM_IMAGE_SERVER_PATH',SERVER_PATH.'media/ourteam/');
define('TEAM_IMAGE_SITE_PATH',SITE_PATH.'media/ourteam/');

define('VIDEO_IMAGE_SERVER_PATH',SERVER_PATH.'media/video/');
define('VIDEO_IMAGE_SITE_PATH',SITE_PATH.'media/video/');

define('CMS_IMAGE_SERVER_PATH',SERVER_PATH.'media/cms/');
define('CMS_IMAGE_SITE_PATH',SITE_PATH.'media/cms/');

define('TESTIMONIALS_IMAGE_SERVER_PATH',SERVER_PATH.'media/testimonials/');
define('TESTIMONIALS_IMAGE_SITE_PATH',SITE_PATH.'media/testimonials/');

define('CONTENT_IMAGE_SERVER_PATH',SERVER_PATH.'media/contents/');
define('CONTENT_IMAGE_SITE_PATH',SITE_PATH.'media/contents/');

define('BANNER_IMAGE_SERVER_PATH',SERVER_PATH.'media/banner/');
define('BANNER_IMAGE_SITE_PATH',SITE_PATH.'media/banner/');





?>