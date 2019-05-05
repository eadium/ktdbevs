<?PHP 
error_reporting( E_ERROR );
session_start();
	INCLUDE "header.php";
	if ($_SESSION['logon']==true){	
	
	$table['name_table']="Пользователи АСУ";
	$table['table_id']="users";
	
	$table['col_1_name']="id";
	$table['col_1_table']="USERS_ID";
	$table['col_1_table_select']="users_id";
	$table['col_1_type']=NULL;
	$table['col_1_checkbox']=false;
	
	$table['col_2_name']="Логин";
	$table['col_2_table']="USERS_LOGIN";
	$table['col_2_table_select']="users_login";
	$table['col_2_type']=NULL;
	$table['col_2_checkbox']=false;
	
	$table['col_3_name']="Пароль";
	$table['col_3_table']="USERS_PASSWORD";
	$table['col_3_table_select']="users_password";
	$table['col_3_type']=NULL;
	$table['col_3_checkbox']=false;
	
	$table['col_4_name']="Права просмотра";
	$table['col_4_table']="USERS_RULE_SEE";
	$table['col_4_table_select']="users_rule_see";
	$table['col_4_type']=NULL;
	$table['col_4_checkbox']=false;
	
	$table['col_5_name']="Права редактирования";
	$table['col_5_table']="USERS_RULE_EDIT";
	$table['col_5_table_select']="users_rule_edit";
	$table['col_5_type']=NULL;
	$table['col_5_checkbox']=false;
	
	$table['col_6_name']="Права администратора";
	$table['col_6_table']="USERS_RULE_ADMIN";
	$table['col_6_table_select']="users_rule_admin";
	$table['col_6_type']=NULL;
	$table['col_6_checkbox']=false;
	
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