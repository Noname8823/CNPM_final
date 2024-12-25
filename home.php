<?php 
session_start();

if(!isset($_SESSION['examineeSession']['examineenakalogin']) == true) header("location:index.php");


 ?>
<?php include("conn.php"); ?>
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
     if($page == "exam")
     {
       include("view/pages/exam.php");
     }
     else if($page == "result")
     {
       include("view/pages/result.php");
     }
     else if($page == "myscores")
     {
       include("view/pages/myscores.php");
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


