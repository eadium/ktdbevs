<?PHP 
error_reporting( E_ERROR );
	session_start();

	$rule_s=$_SESSION['rule_s'];	
	$rule_admin=$_SESSION['rule_admin'];	

IF($rule_s[1]==true||$rule_s[2]==true||$rule_s[3]==true||$rule_s[4]==true){
	ECHO("<td><TABLE id='menu' BORDER='0' CELLPADDING='0' CELLSPACING='0' HEIGHT='100%' WIDTH='100%' >
			<TR>
				<TD ALIGN='left' VALIGN='middle'><A id='ztopmenu' HREF='index.php'>Главная</A></TD> </TR>");
		
	IF($rule_s[1]==true){
		ECHO("<TR>	<TD ALIGN='left' VALIGN='middle'><A id='ftopmenu' HREF='docs.php'>Документы</A></TD> </TR>");
	}
	IF($rule_s[2]==true){
		ECHO("<TR>	<TD ALIGN='left' VALIGN='middle'><A id='stopmenu' HREF='PCB.php'>Печатные платы</A></TD> </TR>");
	}
	IF($rule_s[3]==true){
		ECHO("<TR>	<TD ALIGN='left' VALIGN='middle'><A id='ttopmenu' HREF='personal.php'>Персонал</A></TD> </TR>");
	}
	IF($rule_s[4]==true){
		ECHO("<TR>	<TD ALIGN='left' VALIGN='middle'><A id='frtopmenu' HREF='operacii.php'>Операции</A></TD> </TR>");
	}
	IF($rule_admin==true){
		ECHO("<TR>	<TD ALIGN='left' VALIGN='middle'><A id='fftopmenu' HREF='users.php'>Пользователи</A></TD> </TR>");
	} 	
	
			
	ECHO("<TR>	<TD ALIGN='left' VALIGN='middle'><A id='sxtopmenu' HREF='radioelements.php'>Радиокомпоненты</A></TD></TR>
	</TABLE></td>");
}

?>