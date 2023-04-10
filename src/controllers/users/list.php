<?php 
$response = $CRUD->Written("SELECT * FROM staff WHERE staff_status IN(1,2)",null, true);
echo json_encode($response)
?>