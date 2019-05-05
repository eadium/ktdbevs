<?PHP 	
error_reporting( E_ERROR );
	session_start();
	$table=$_SESSION['tab'];
	INCLUDE "connect.php";
	
	$insert="INSERT INTO ".$table['table_id']."(";
	$i=1;
	WHILE(!EMPTY($table['col_'.$i.'_table_select'])){
		$insert=$insert.$table['col_'.$i.'_table_select'].", ";
		$i++;
	};
	$insert=substr ($insert, 0, -2);
	$insert=$insert.") VALUES (";
	$i=1;
	WHILE(!EMPTY($table['col_'.$i.'_table_select'])){
		IF (!EMPTY($table['col_'.$i.'_type'])){
			$insert=$insert."to_date('".$_POST['value_col_'.$i] ."', 'DD.MM.YYYY') , ";
		}ELSE{
			$insert=$insert."'".$_POST['value_col_'.$i] ."', ";
		}
		$i++;
	};
	$insert=substr ($insert, 0, -2);	
	$insert=$insert.") ";
	
ECHO ($insert);
		$insert_parse = OCIParse($c, $insert );
								
		OCIExecute($insert_parse, OCI_DEFAULT);
		
		IF (!$insert_parse){
			DIE("<H2 ALIGN='center'>Ошибка!</H2>"); 
			ECHO "Невозможно сформировать запрос: " . var_dump( OCIError() );
			DIE("<H2>Неправильно введены данные!</H2>");
		}
	INCLUDE "disconnect.php";
	HEADER("LOCATION: ". $table['table_id'].".php?action=insert");
?> 
	
	
