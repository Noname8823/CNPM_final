<?php 
session_start();

if(!isset($_SESSION['admin']['adminnakalogin']) == true) header("location:index.php");


 ?>
<?php include("../../conn.php"); ?>
<!-- MAO NI ANG HEADER -->
<?php include("controller/header.php"); ?>      

<!-- UI THEME DIRI -->
<?php include("controller/ui-theme.php"); ?>

<div class="app-main">
<!-- sidebar diri  -->
<?php include("controller/sidebar.php"); ?>



<!-- Condition If unza nga page gi click -->
<?php 
   @$page = $_GET['page'];


   if($page != '')
   {
     if($page == "add-course")
     {
     include("view/pages/add-course.php");
     }
     else if($page == "manage-course")
     {
     	include("view/pages/manage-course.php");
     }
     else if($page == "manage-exam")
     {
      include("view/pages/manage-exam.php");
     }
     else if($page == "manage-examinee")
     {
      include("view/pages/manage-examinee.php");
     }
     else if($page == "ranking-exam")
     {
      include("view/pages/ranking-exam.php");
     }
     else if($page == "feedbacks")
     {
      include("view/pages/feedbacks.php");
     }
     else if($page == "examinee-result")
     {
      include("view/pages/examinee-result.php");
     }

       
   }
   // Else ang home nga page mo display
   else
   {
     include("view/pages/home.php"); 
   }


 ?> 


<!-- MAO NI IYA FOOTER -->
<?php include("controller/footer.php"); ?>

<?php include("controller/modals.php"); ?>
