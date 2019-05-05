<?PHP
error_reporting( E_ERROR );
session_start();
	$num_table=4;
IF ($_SESSION['logon']==false){
	IF($_POST['aut']==false){
	$i=1;
		WHILE ($i!=($num_table+1)){
			$rule_s[$i]=false;
			$i++;
			}

		$rule_e[1]=false;
		$rule_e[2]=false;
		$rule_e[3]=false;
		$rule_admin=false;

		ECHO ("<FORM ACTION='logon.php' METHOD='POST'>
					<TABLE id='logon' BORDER=0 ALIGN='center' WIDTH='300px'>
						<TR><TD><CENTER><strong>Логин</strong></CENTER></TD></TR>
						<TR><TD><CENTER><INPUT TYPE='text' NAME='user_name' ></CENTER></TD></TR>
						<TR><TD><CENTER><strong>Пароль</strong></CENTER></TD></TR>
						<TR><TD><CENTER><INPUT TYPE='password' NAME='user_pass' ></CENTER></TD></TR>
					</TABLE>
						<INPUT TYPE='hidden' NAME='aut' VALUE=true >
						<INPUT TYPE='submit' VALUE='Войти' >
				</FORM>");
	}ELSE{

		$user_nam_form=$_POST['user_name'];
		$user_pass_form=$_POST['user_pass'];
		//$user_pass_form=md5($user_pass_form);
		ECHO("user_name=".$user_nam_form."<br>user_pass=".$user_pass_form."<br>");

		INCLUDE "connect.php";

		$select_u="	SELECT users_id, users_login, users_password, users_rule_see , users_rule_edit , users_rule_admin "."
								FROM users
								WHERE 1=1 "."
									AND users_login = '".$user_nam_form."'
									AND users_password = '".$user_pass_form."' ";

		ECHO $select_u;
		$su = OCIParse($c , $select_u);
		OCIExecute($su , OCI_DEFAULT);

		ECHO $su;

		WHILE (OCIFetch($su)) {
			$id=OCIResult($su, "USERS_ID");
			$users_login = OCIResult($su , "USERS_LOGIN");
			$users_password = OCIResult($su , "USERS_PASSWORD");
			$users_rule_see = OCIResult($su , "USERS_RULE_SEE");
			$users_rule_edit = OCIResult($su , "USERS_RULE_EDIT");
			$users_rule_admin = OCIResult($su , "USERS_RULE_ADMIN");
			}
	//	ECHO("<br> id= ".$id);
	//	ECHO("<br> users_login= ".$users_login);
	//	ECHO("<br> users_password= ".$users_password);
	//	ECHO("<br> users_rule_see= ".$users_rule_see);
	//	ECHO("<br> users_rule_edit= ".$users_rule_edit);
	//	ECHO("<br> users_rule_admin= ".$users_rule_admin);
	//	ECHO ($users_rule_see[0]);
			IF($user_nam_form==$users_login&&$user_pass_form==$users_password){
				$i=1;
				WHILE ($i!=($num_table+1)){
					IF ($users_rule_see[0]=='1'){
						$rule_s[$i]=true;
					}ELSE{
						$rule_s[$i]=false;
					}
					$i++;
				}



				IF ($users_rule_edit[0]=='1'){
					$rule_e[1]=true;
				}ELSE{
					$rule_e[1]=false;
				}
				IF ($users_rule_edit[1]=='1'){
					$rule_e[2]=true;
				}ELSE{
					$rule_e[2]=false;
				}
				IF ($users_rule_edit[2]=='1'){
					$rule_e[3]=true;
				}ELSE{
					$rule_e[3]=false;
				}
				IF ($users_rule_admin=='1'){
					$rule_admin=true;
				}ELSE{
					$rule_admin=false;
				}


			$_SESSION['logon']=true;
		}ELSE{
		$_SESSION['logon']=false;
		}
		$_SESSION['rule_s']=$rule_s;
		$_SESSION['rule_e']=$rule_e;
		$_SESSION['rule_admin']=$rule_admin;
		$_SESSION['user']=$users_login;
		INCLUDE "disconnect.php";
		HEADER("LOCATION:index.php");
	}
	//ECHO($rule_s[3]." 1= ".$rule_e[3]);
	$_SESSION['rule_s']=$rule_s;
	$_SESSION['rule_e']=$rule_e;
	$_SESSION['rule_admin']=$rule_admin;
	$_SESSION['user']=$users_login;

}ELSE{
	IF($_POST['exit']==false){



		$c=OCILogon("sergeyhalzev", "pass", "curvabd");
	if (!$c){
		echo "Невозможно подключиться к базе:" . var_dump(OCIError());
		die();
	}
$s=OCIParse($c, "SELECT SUM (ope_cost) FROM operacii");
OCIExecute($s, OCI_DEFAULT);
while (OCIFetch($s)){
echo ("");

}

$s=OCIParse($c, "SELECT SUM (ope_dur) FROM operacii");
OCIExecute($s, OCI_DEFAULT);
while (OCIFetch($s)){
echo ("

						");

}
/*
$s=OCIParse($c, "SELECT SUM (ope_dur) FROM operacii");
OCIExecute($s, OCI_DEFAULT);
while (OCIFetch($s)){
echo ("
						<tr>
							<td>Суммарная длительность операций =</td>
							<td><a href='http://localhost/asu/operacii.php'>".OCIResult($s, 1)."</a></td>
						</tr>

						");

}
 Дополнительный пересчет */

echo ("");

	}ELSE{

		unset($_SESSION['user']);
		unset($_SESSION['rule_e']);
		unset($_SESSION['rule_s']);
		unset($_SESSION['rule_admin']);
		unset($_SESSION['logon']);
		unset($_SESSION['html_pdf']);
		unset($_SESSION['tab']);
		session_destroy();
		HEADER("LOCATION:index.php");
	}
}

?>