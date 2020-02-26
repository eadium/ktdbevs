<?   
  session_start();
  if (isset($_POST['login'], $_POST['password'])) 
  {
    $login = $_POST['login'];
    $password = $_POST['password'];

    if($login == 'system') $_SESSION = array();

    if ($c=OCILogon($login, $password, CURVABD))
    { 
      $_SESSION['auth'] = 1;
      $_SESSION['login'] = $login;
      $_SESSION['password'] = $password;


      $s = ociParse($c, 'SELECT GRANTED_ROLE FROM USER_ROLE_PRIVS');
      ociExecute($s);
      

      $s = ociParse($c, "SELECT PERS_ID, PERS_SURNAME, PERS_NAME, PERS_POSITION, PERS_RULE FROM scott.PERSONAL WHERE PERS_LOGIN = '" . strtoupper($login)."'");
      ociExecute($s);
      while (OCIFetch($s))
      {

        $_SESSION['PERS_ID'] = mb_convert_encoding(OCIResult($s,1), "utf-8", "windows-1251");
        $_SESSION['PERS_SURNAME'] = mb_convert_encoding(OCIResult($s,2), "utf-8", "windows-1251");
        $_SESSION['PERS_NAME'] = mb_convert_encoding(OCIResult($s,3), "utf-8", "windows-1251");
        $_SESSION['PERS_JOB'] = mb_convert_encoding(OCIResult($s,4), "utf-8", "windows-1251");

      }




      $_SESSION['rule_e'] = $rule_e_array;



    } else
    {
      echo "Error";
      $_SESSION = array();
    } 

  } else 
  {
      echo 'Invalid Request';
      $_SESSION = array();
  }

  header('Location: ../index.php?page=main_page');





?>