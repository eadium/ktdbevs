<?PHP 
error_reporting( E_ERROR );
	$c=OCILogon("sergeyhalzev", "pass", "curvabd"); 
	
	if ( ! $c ) { 
		die("<H2 ALIGN='center'>������ ����������� � ���� ������!</H2>"); 
		echo "���������� ����������� � ����: " . var_dump( OCIError() ); 
		}
?>