<?php 
$response = $CRUD->Written("SELECT * FROM providers WHERE providers_status = 0 ",null, true);
echo json_encode($response)
?>