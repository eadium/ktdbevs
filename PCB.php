<?PHP 
error_reporting( E_ERROR );
session_start();
	INCLUDE "header.php";
	if ($_SESSION['logon']==true){
	

	$table['name_table']="Печатные платы";
	$table['table_id']="PCB";
	
	$table['col_1_name']="id";
	$table['col_1_table']="PCB_ID";
	$table['col_1_table_select']="pcb_id";
	$table['col_1_type']=NULL;
	$table['col_1_checkbox']=false;
	
	$table['col_2_name']="Название";
	$table['col_2_table']="PCB_NAME";
	$table['col_2_table_select']="pcb_name";
	$table['col_2_type']=NULL;
	$table['col_2_checkbox']=false;
	
	$table['col_3_name']="Материал";
	$table['col_3_table']="PCB_MAT";
	$table['col_3_table_select']="pcb_mat";
	$table['col_3_type']=NULL;
	$table['col_3_checkbox']=false;
	
	$table['col_4_name']="Класс точности";
	$table['col_4_table']="PCB_CLASS";
	$table['col_4_table_select']="pcb_class";
	$table['col_4_type']=NULL;
	$table['col_4_checkbox']=false;
	
	$table['col_5_name']="Поставщик";
	$table['col_5_table']="PCB_VEND";
	$table['col_5_table_select']="pcb_vend";
	$table['col_5_type']=NULL;
	$table['col_5_checkbox']=false;


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