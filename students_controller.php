<?php

header("Content-Type: application/json; charset=UTF-8");

include('students_service.php');

$service = new StudentService;

$result = $service->getReport($_GET['id']);
	
   echo ($result);
