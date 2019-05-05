<?PHP 
error_reporting( E_ERROR );
	session_start();
	$table=$_SESSION['tab'];
	INCLUDE "connect.php";
	IF($_POST["delete"]) {

$delete="DELETE FROM ".$table['table_id'] ." 
								WHERE 
									".$table['col_1_table_select']." = '".$_POST['value_col_id'] ."' " ;
									
		$d = OCIParse($c,$delete );
		OCIExecute($d, OCI_DEFAULT);
		IF (!$d){
			DIE("<H2 ALIGN='center'>Ошибка!</H2>"); 
			ECHO "Невозможно сформировать запрос: " . var_dump( OCIError() );
			DIE("<H2>Неправильно введены данные!</H2>");
		}
	INCLUDE "disconnect.php";
	HEADER("LOCATION:". $table['table_id'].".php?action=delete");
	
	}ELSE{
		INCLUDE "header.php";
		ECHO ("<br>");
		ECHO ("<center><H2>Вы действительно хотите удалить строку?</H2>");
		
	$select="SELECT ";
	$i=1;
	WHILE(!EMPTY($table['col_'.$i.'_table_select'])){
		IF (!EMPTY($table['col_'.$i.'_type'])){
			$select=$select."TO_CHAR (".$table['col_'.$i.'_table_select'].", 'DD.MM.YYYY' ) AS ".$table['col_'.$i.'_table_select']. ", ";
		}ELSE{	
			$select=$select.$table['col_'.$i.'_table_select'].", ";
		}
		$i++;
	};
	$select=substr ($select, 0, -2);
	$select=$select." FROM ".$table['table_id']."
							WHERE 1=1 
								AND ".$table['col_1_table']." = '".$_POST['value_col_id']."'
								ORDER BY " . $table['col_1_table_select'] . " ";
		
		
						
		$s = OCIParse($c, $select); 
		OCIExecute($s, OCI_DEFAULT); 
		ECHO ("	<CENTER>
					<TABLE id='deleterow' BORDER=0 WIDTH=97%>
						<TR>");
		$i=1;
		WHILE(!EMPTY($table['col_'.$i.'_name'])){
			ECHO("			<TD >
								<CENTER>
									".$table['col_'.$i.'_name']."
								</CENTER>
							</TD>");
			$i++;
		};
		ECHO("			</TR>");

		WHILE (OCIFetch($s)) { 
			$i=1;
			WHILE(!EMPTY($table['col_'.$i.'_name'])){
				$value_col[$i]=OCIResult($s, $table['col_'.$i.'_table']);
				$i++;
			};
			ECHO ("		<TR>");
			$i=1;
			WHILE(!EMPTY($table['col_'.$i.'_name'])){
				ECHO("		<TD>
								<CENTER>");
											$col_table=OCIResult($s, $table['col_'.$i.'_table']);
											IF($table['col_'.$i.'_checkbox']==true){
												$select_ref="SELECT ";
												$j=1;
												WHILE(!EMPTY($table['col_'.$j.'_table_select_ref'])){
													IF (!EMPTY($table['col_'.$j.'_type_ref'])){
														$select_ref=$select_ref."TO_CHAR (".$table['col_'.$j.'_table_select_ref'].", 'DD.MM.YYYY' ) AS ".$table['col_'.$j.'_table_select']. ", ";
													}ELSE{	
														$select_ref=$select_ref.$table['col_'.$j.'_table_select_ref'].", ";
													}
													$j++;
												};
												$select_ref=substr ($select_ref, 0, -2);
												$select_ref=$select_ref." 	FROM ".$table['table_id_ref']."
												WHERE  ". $table['col_1_table_select_ref'] ." = ". $col_table."  ";
												
											
												$sr = OCIParse($c,$select_ref); 
												OCIExecute($sr, OCI_DEFAULT); 
											
											
												WHILE (OCIFetch($sr)) {
													$col_1_table_ref = OCIResult($sr, $table['col_1_table_ref']);
													$col_2_table_ref = OCIResult($sr, $table['col_2_table_ref']);
												
													ECHO ( $col_1_table_ref." : ".$col_2_table_ref);
													
												};
													
											}ELSE{
												ECHO( $col_table ); 
											};
								ECHO("
								</CENTER>
							</TD>");
				$i++;
			};
			ECHO("		</TR>");
		}
			ECHO (" </TABLE>
				</CENTER>");
			ECHO("<center><TABLE id='yesnotable'>
					<TR>
						<TD>
						<center>
							<FORM ACTION='delete.php' METHOD='post'>
								<INPUT TYPE='hidden' NAME='delete' VALUE ='True'>
								<INPUT TYPE='hidden' NAME='value_col_id' VALUE ='".$value_col[1]."'>
								<INPUT TYPE='submit'  VALUE ='Да'>"."
							</FORM>
							</center>
						</TD>"."
						<TD>
						<CENTER>
							<FORM ACTION='".$table['table_id'].".php?action=update' METHOD='post'>"."
								<INPUT TYPE='submit'  VALUE ='Нет'>	"."
							</FORM>
							</CENTER>
						</TD>
					</TR>
					
				</TABLE></center>");
		INCLUDE "footer.php";
		INCLUDE "disconnect.php";	
	}	

?> 
	
	
