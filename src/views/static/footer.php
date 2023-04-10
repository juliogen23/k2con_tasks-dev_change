<?php
if (!isset($_SESSION['notification'])) {
  $_SESSION['notification']=null;
}
if ($_SESSION["notification"]!=null){
foreach($_SESSION["notification"] as $noti){
?>
<div class="fixed-bottom container" style="max-width:50%;min-width:50%;">
  <div class="alert alert-<?php echo $noti["type"]; ?> alert-dismissible fade show" role="alert">
    <ul class="mb-0">
      <li><?php echo $noti["mesaje"]; ?></li>
    </ul>
    <button type="button" class="btn-close close-notification" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
</div>
<?php }
} 
$_SESSION["notification"] = '';
?>
  </body>
  <script src="<?php echo RAIZ; ?>assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo RAIZ; ?>assets/jQuery/jquery-3.6.1.min.js"></script>
	<link href="<?php echo RAIZ; ?>assets/vanilla-dataTables/vanilla-dataTables.css" rel="stylesheet">
  <script src="<?php echo RAIZ; ?>assets/vanilla-dataTables/vanilla-dataTables.js"></script>
  <link href="<?php echo RAIZ; ?>assets/multi-select-tag/css/multi-select-tag.css" rel="stylesheet">
  <script src="<?php echo RAIZ; ?>assets/multi-select-tag/js/multi-select-tag.js"></script>
  <script>
    document.querySelectorAll(".close-notification").forEach(element => {
      setTimeout(() => {
        element.click();
      }, 3000);
    })
  </script>
</html>