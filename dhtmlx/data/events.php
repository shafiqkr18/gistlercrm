<?php
	require_once('../samples/common/connector/scheduler_connector.php');
	include ('../samples/common/config.php');
	
	$res=mysql_connect("localhost","root","");
	mysql_select_db("gistler_crm");
 
$conn = new SchedulerConnector($res);
 
$conn->render_table("events","event_id","start_date,end_date,event_name");
	//$scheduler->render_table("events","event_id","start_date,end_date,event_name,details");
?>