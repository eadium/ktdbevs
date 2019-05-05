<?PHP session_start();
error_reporting( E_ERROR );

	INCLUDE "header.php";
	if ($_SESSION['logon']==true){
	
	$table['name_table']="Документация";
	$table['table_id']="docs";
	
	$table['col_1_name']="id";
	$table['col_1_table']="DOC_ID";
	$table['col_1_table_select']="doc_id";
	$table['col_1_type']=NULL;
	$table['col_1_checkbox']=false;
	
	$table['col_2_name']="Наименование";
	$table['col_2_table']="DOC_NAME";
	$table['col_2_table_select']="doc_name";
	$table['col_2_type']=NULL;
	$table['col_2_checkbox']=false;
	
	$table['col_3_name']="Дата создания";
	$table['col_3_table']="DOC_DATE";
	$table['col_3_table_select']="doc_date";
	$table['col_3_type']="date";
	$table['col_3_checkbox']=false;


        $table['col_4_name']="Тип";
	$table['col_4_table']="DOC_TYPE";
	$table['col_4_table_select']="doc_type";
	$table['col_4_type']=NULL;
	$table['col_4_checkbox']=false;
	
  
        $table['col_5_name']="Операция";
	$table['col_5_table']="DOC_OPE_ID";
	$table['col_5_table_select']="doc_ope_id";
	$table['col_5_type']=NULL;
	$table['col_5_checkbox']=false;

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