<?php
	session_start();
	session_destroy();
	$_SESSION['userid'] = "";
?>
<script type="text/javascript">
	<!--
	window.top.location.href = "../index.php";
	-->
</script>
<?php
?>

