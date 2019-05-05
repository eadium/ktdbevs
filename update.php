<?PHP 
error_reporting( E_ERROR );		
	session_start();
	$table=$_SESSION['tab'];
	INCLUDE "connect.php";
	IF ($_POST['update']){ 
		$update="UPDATE ". $table['table_id']. " SET ";
		$i=1;
	WHILE(!EMPTY($table['col_'.$i.'_table_select'])){
		IF (!EMPTY($table['col_'.$i.'_type'])){
			$update=$update. $table['col_'.$i.'_table_select'] . " = to_date('".$_POST['value_col_new_'.$i]."', 'DD.MM.YYYY') , ";
		}ELSE{	
			$update=$update. $table['col_'.$i.'_table_select'] . " = '" . $_POST['value_col_new_'.$i]."' , ";
		}
		$i++;
	};
	$update=substr ($update, 0, -2);
	$update=$update." WHERE " .$table['col_1_table'] . " = '" . $_POST['value_col_id']."' ";
		
		ECHO $update;
		
		$u = OCIParse($c, $update);
		$z=OCIExecute($u, OCI_DEFAULT);
		IF (!$u){
			DIE("<H2 ALIGN='center'>Ошибка!</H2>"); 
			ECHO "Невозможно сформировать запрос: " . var_dump( OCIError() );
			DIE("<H2>Неправильно введены данные!</H2>");
		}
	INCLUDE "disconnect.php";	
	HEADER("LOCATION:". $table['table_id'].".php?action=update");
	
	}ELSE{
		INCLUDE "header.php"; 
		
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
								AND ".$table['col_1_table']." = '".$_POST['value_col_id']."' ";

		$s = OCIParse($c, $select); 
		OCIExecute($s, OCI_DEFAULT); 
	
		ECHO ("	<FORM ACTION='update.php' METHOD='post'>
					<CENTER>
						<TABLE id='updaterow' BORDER=0 WIDTH=97%>
							<TR>
								<TD WIDTH=3% ><CENTER>NEW/OLD</CENTER></TD>");
		$i=1;
		WHILE(!EMPTY($table['col_'.$i.'_name'])){
			ECHO("				<TD BGCOLOR=' #E52968'>
									<CENTER>
										".$table['col_'.$i.'_name']."
									</CENTER>
								</TD>");
			$i++;
		};
		
		ECHO("				</TR>");
		WHILE (OCIFetch($s)) { 
			$i=1;
			WHILE(!EMPTY($table['col_'.$i.'_name'])){
				$value_col[$i]=OCIResult($s, $table['col_'.$i.'_table']);
				$i++;
			};
			ECHO ("			<TR>
								<TD WIDTH=3% >
									<CENTER>
										OLD
									</CENTER>
								</TD>
								");
			$i=1;
			WHILE(!EMPTY($table['col_'.$i.'_name'])){
				ECHO("			<TD BGCOLOR='F0E68C'>
									<CENTER>
										".$value_col[$i]."
									</CENTER>
								</TD>");
				$i++;
			};
			ECHO("			</TR>");
		}
			
		ECHO ("				<TR>
								<TD WIDTH=3% ><CENTER>EDIT</CENTER></TD>
								");
		$i=1;
		WHILE(!EMPTY($table['col_'.$i.'_name'])){
			ECHO("			<TD>
								");
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
												ORDER BY " . $table['col_1_table_select_ref'] . " ";
											
											$sr = OCIParse($c,$select_ref); 
											OCIExecute($sr, OCI_DEFAULT); 
											
											ECHO ("	<SELECT NAME='value_col_new_".$i."'>");
											WHILE (OCIFetch($sr)) {
												$col_1_table_ref=OCIResult($sr, $table['col_1_table_ref']);
												$col_2_table_ref=OCIResult($sr, $table['col_2_table_ref']);
												
												ECHO ("	<OPTION VALUE='".$col_1_table_ref."'");
													IF ($col_1_table_ref==$value_col[$i]){
													ECHO (" SELECTED ");
													}
													ECHO (">"
															.$col_1_table_ref." : ".$col_2_table_ref
													."	</OPTION>");
											};
											ECHO("			</SELECT>");
											
										}ELSE{
											ECHO("<INPUT TYPE='text' NAME='value_col_new_".$i."' VALUE='".$value_col[$i]."'");
											IF ($i==1) ECHO("readonly");
											ECHO(">");
										}	
							ECHO("	</CENTER>
							</TD>");
			$i++;
		};
		ECHO("			</TR>");
		ECHO ("		</TABLE>
				</CENTER>
				<center>
				<INPUT TYPE='hidden' NAME='value_col_id' VALUE='".$value_col[1]."'>
				<INPUT TYPE='submit' VALUE='Изменить'>
				<INPUT  TYPE='hidden' NAME='update' VALUE=!0>
				</center>
			</FORM>");	
		INCLUDE "disconnect.php";
		INCLUDE "footer.php" ;
		}
?> 
	
	
