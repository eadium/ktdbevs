<?PHP 
error_reporting( E_ERROR );
	$c=OCILogon("sergeyhalzev", "pass", "curvabd"); 
	
	if ( ! $c ) { 
		die("<H2 ALIGN='center'>Ошибка подключения к базе данных!</H2>"); 
		echo "Невозможно подключится к базе: " . var_dump( OCIError() ); 
		}
?>