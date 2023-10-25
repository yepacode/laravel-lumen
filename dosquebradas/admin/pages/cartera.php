<? session_start();
if($_SESSION["ses_id"]==""){
?>
<script>
window.location='index.php';
</script>
<?
}
?>
<div id="cp_cargando"></div>
<iframe src="pages/archivos/frame_cartera.php" width="580" height="400" scrolling="no" frameborder="0"></iframe>