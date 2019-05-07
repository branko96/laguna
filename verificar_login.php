<?php 
@session_start();
if(!isset($_SESSION['objetoCliente'])){
	?>
	<script type="text/javascript">
	//$(document).ready(function(){
		alert("No estas logueado!");
	  	setTimeout(function(){ 
	  	window.location="login.php";
	  	 }, 1000);
	 	
	//});
	</script>
<?php 
exit(0);

}
?>