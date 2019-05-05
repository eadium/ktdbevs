<?PHP 
error_reporting( E_ERROR );
	session_start();

$rule_e = $_SESSION['rule_e'];	

IF($rule_e[1]==true||$rule_e[2]==true||$rule_e[3]==true){
	ECHO("	<TABLE id='submenu' BORDER='0' BGCOLOR = #003153 CELLPADDING='0' CELLSPACING='0' HEIGHT=25px WIDTH='100%'>
				<TR>");
		IF($rule_e[1]==true){
			ECHO("	<TD ALIGN='center' VALIGN='middle' >
						<FORM ACTION='".$_SERVER["PHP_SELF"]."' METHOD='get'>
							<INPUT TYPE=hidden NAME=action VALUE=insert>
							<INPUT TYPE=submit VALUE='Вставить'>
						</FORM>
					</TD>");
		}
		IF($rule_e[2]==true){
			ECHO("	<TD ALIGN='center' VALIGN='middle' >
						<FORM ACTION='".$_SERVER["PHP_SELF"]."' METHOD='get'>
							<INPUT TYPE=hidden NAME=action VALUE=update>
							<INPUT TYPE=submit VALUE='Изменить'>
						</FORM>
					</TD>");
		}
		IF($rule_e[3]==true){
			ECHO("	<TD ALIGN='center' VALIGN='middle' >
						<FORM ACTION='".$_SERVER["PHP_SELF"]."' METHOD='get'>
							<INPUT TYPE=hidden NAME=action VALUE=delete>
							<INPUT TYPE=submit VALUE='Удалить'>
						</FORM>
					</TD>");
		}
	ECHO("		</TR>
			</TABLE>");
}

?>