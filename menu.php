<?PHP
error_reporting( E_ERROR );
	session_start();

	$rule_s=$_SESSION['rule_s'];
	$rule_admin=$_SESSION['rule_admin'];

IF($rule_s[1]==true||$rule_s[2]==true||$rule_s[3]==true||$rule_s[4]==true){
	ECHO("<TABLE id='menu' BORDER='0' CELLPADDING='0' CELLSPACING='0' HEIGHT='100%' WIDTH='100%' >
			<tr>
				<TD ALIGN='left' VALIGN='middle'><A id='ztopmenu' HREF='index.php'>Главная</A> </TD>");

	IF($rule_s[1]==true){
		ECHO("	<TD ALIGN='left' VALIGN='middle'><A id='ftopmenu' HREF='docs.php'>Документы</A> </TD>");
	}
	IF($rule_s[2]==true){
		ECHO("	<TD ALIGN='left' VALIGN='middle'><A id='stopmenu' HREF='PCB.php'>Печатные платы</A> </TD>");
	}
	IF($rule_s[3]==true){
		ECHO("	<TD ALIGN='left' VALIGN='middle'><A id='ttopmenu' HREF='personal.php'>Персонал</A> </TD>");
	}
	IF($rule_s[4]==true){
		ECHO("	<TD ALIGN='left' VALIGN='middle'><A id='frtopmenu' HREF='operacii.php'>Операции</A> </TD>");
	}
	IF($rule_admin==true){
		ECHO("	<TD ALIGN='left' VALIGN='middle'><A id='fftopmenu' HREF='users.php'>Пользователи</A> </TD>");
	}


	ECHO("	<TD ALIGN='left' VALIGN='middle'><A id='sxtopmenu' HREF='radioelements.php'>Радиокомпоненты</A></TD></TR>
	</TABLE></td><tr>	");
}

?>