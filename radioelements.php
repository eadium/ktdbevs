<?PHP 
error_reporting( E_ERROR );
session_start();
	INCLUDE "header.php";
	if ($_SESSION['logon']==true){
		
	$table['name_table']="Радиокомпоненты";
	$table['table_id']="radioelements";
	
	$table['col_1_name']="id";
	$table['col_1_table']="RAD_ID";
	$table['col_1_table_select']="rad_id";
	$table['col_1_type']=NULL;
	$table['col_1_checkbox']=false;
	
	$table['col_2_name']="Поставщик";
	$table['col_2_table']="RAD_VEND";
	$table['col_2_table_select']="rad_vend";
	$table['col_2_type']=NULL;
	$table['col_2_checkbox']=false;
	
	$table['col_3_name']="Номинал (Ом, нФ, нГн)";
	$table['col_3_table']="RAD_NOM";
	$table['col_3_table_select']="rad_nom";
	$table['col_3_type']=NULL;
	$table['col_3_checkbox']=false;

	$table['col_4_name']="Тип";
	$table['col_4_table']="RAD_TYPE";
	$table['col_4_table_select']="rad_type";
	$table['col_4_type']=NULL;
	$table['col_4_checkbox']=false;

	$table['col_5_name']="Номер операции";
	$table['col_5_table']="RAD_OPE_ID";
	$table['col_5_table_select']="RAD_OPE_ID";
	$table['col_5_type']=NULL;
	$table['col_5_checkbox']=false;

        $table['table_id_ref']="operacii";
	
	$table['col_1_table_ref']="OPE_ID";
	$table['col_1_table_select_ref']="ope_id";
	$table['col_1_type_ref']=NULL;
	$table['col_1_checkbox_ref']=false; 
	
	$table['col_6_name']="Номер платы";
	$table['col_6_table']="RAD_PCB_ID";
	$table['col_6_table_select']="RAD_PCB_ID";
	$table['col_6_type']=NULL;
	$table['col_6_checkbox']=false;	
	
        $table['table_id_ref']="pcb";
	
	$table['col_1_table_ref']="PCB_ID";
	$table['col_1_table_select_ref']="pcb_id";
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