<?php
error_reporting( E_ERROR );
	// Выполняем commit; 
	OCICommit($c); 
	// Отключаемся от БД
	OCILogoff($c); 
?> 