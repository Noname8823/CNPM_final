<?php 
session_start();
if(isset($_SESSION['admin']['adminnakalogin']) == true) header("location:home.php");

 ?>

<?php 

include("view/login-ui/index.php");


 ?>


<script type="text/javascript" src="view/js/jquery.js"></script>
<script type="text/javascript" src="view/js/ajax.js"></script>
<script type="text/javascript" src="view/js/sweetalert.js"></script>