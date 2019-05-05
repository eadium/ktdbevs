<?PHP 
error_reporting( E_ERROR );
session_start();
	INCLUDE "header.php";
	if ($_SESSION['logon']==true){
	
	
	$table['name_table']="Операции";
	$table['table_id']="operacii";
	
	$table['col_1_name']="id";
	$table['col_1_table']="OPE_ID";
	$table['col_1_table_select']="ope_id";
	$table['col_1_type']=NULL;
	$table['col_1_checkbox']=false;
	
	$table['col_2_name']="Стоимость, руб";
	$table['col_2_table']="OPE_COST";
	$table['col_2_table_select']="ope_cost";
	$table['col_2_type']=NULL;
	$table['col_2_checkbox']=false;
	
	$table['col_3_name']="Длительность, с";
	$table['col_3_table']="OPE_DUR";
	$table['col_3_table_select']="ope_dur";
	$table['col_3_type']=NULL;
	$table['col_3_checkbox']=false;
	
	$table['col_4_name']="Тип операции";
	$table['col_4_table']="OPE_TYPE";
	$table['col_4_table_select']="ope_type";
	$table['col_4_type']=NULL;
	$table['col_4_checkbox']=false;
	

	$table['col_5_name']="Ответственный";
	$table['col_5_table']="OPE_USERS_ID";
	$table['col_5_table_select']="ope_users_id";
	$table['col_5_type']=NULL;
	$table['col_5_checkbox']=false;
	
		$table['table_id_ref']="users";
	
	$table['col_2_table_ref']="USERS_LOGIN";
	$table['col_2_table_select_ref']="users_login";
	$table['col_2_type_ref']=NULL;
	$table['col_2_checkbox_ref']=false;

	$_SESSION['tab']=$table;
	INCLUDE "table.php";
	
	ECHO("	<P>
				<center><A HREF='operacii.php?action=generate' style='font-size:16px;'>Создать отчет в PDF</A></center>
			</P>");

	echo("<br>");
	INCLUDE "submenu.php";
	}
	else {
		echo("<center><strong>Ошибка авторизации! Введите логин и пароль!</strong></center>");
		echo ("<center><FORM ACTION='index.php' METHOD='POST'>
						<INPUT TYPE='hidden' NAME='exit' VALUE=true >
						<INPUT TYPE='submit' VALUE='На главную' >
						</FORM></center>");
		}
	INCLUDE "footer.php"; 
?>