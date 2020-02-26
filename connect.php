<?PHP 
error_reporting( E_ERROR );
	$c=OCILogon("scott", "tiger", "orcl"); 
	
	if ( ! $c ) { 
		die("<H2 ALIGN='center'>Ошибка подключения к базе данных!</H2>"); 
		echo "ORCL CONN ERROR: " . var_dump( OCIError() ); 
		}
?>