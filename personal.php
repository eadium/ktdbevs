<?PHP 
error_reporting( E_ERROR );
session_start();
	INCLUDE "header.php";
	if ($_SESSION['logon']==true){	
	
	$table['name_table']="Персонал";
	$table['table_id']="personal";
	
	$table['col_1_name']="id";
	$table['col_1_table']="PER_ID";
	$table['col_1_table_select']="per_id";
	$table['col_1_type']=NULL;
	$table['col_1_checkbox']=false;
	
	$table['col_2_name']="Имя";
	$table['col_2_table']="PER_NAME";
	$table['col_2_table_select']="per_name";
	$table['col_2_type']=NULL;
	$table['col_2_checkbox']=false;
	
	$table['col_3_name']="Фамилия";
	$table['col_3_table']="PER_SURN";
	$table['col_3_table_select']="per_surn";
	$table['col_3_type']=NULL;
	$table['col_3_checkbox']=false;

	$table['col_4_name']="Должность";
	$table['col_4_table']="PER_ROLE";
	$table['col_4_table_select']="per_role";
	$table['col_4_type']=NULL;
	$table['col_4_checkbox']=false;

	$table['col_5_name']="Телефон";
	$table['col_5_table']="PER_TEL";
	$table['col_5_table_select']="per_tel";
	$table['col_5_type']=NULL;
	$table['col_5_checkbox']=false;


	$table['col_6_name']="Номер операции";
	$table['col_6_table']="PER_OPE_ID";
	$table['col_6_table_select']="per_ope_id";
	$table['col_6_type']=NULL;
	$table['col_6_checkbox']=false;	
	
        $table['table_id_ref']="operacii";
	
	$table['col_1_table_ref']="OPE_ID";
	$table['col_1_table_select_ref']="ope_id";
	$table['col_1_type_ref']=NULL;
	$table['col_1_checkbox_ref']=false; 
	
	$_SESSION['tab']=$table;
	INCLUDE "table.php";
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