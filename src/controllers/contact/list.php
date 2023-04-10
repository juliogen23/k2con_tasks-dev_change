<?php 
$response = $CRUD->Written("SELECT * FROM contact WHERE contact_status = 0 ",null, true);
echo json_encode($response)
?>