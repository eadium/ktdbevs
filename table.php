<?PHP
error_reporting( E_ERROR );
 session_start();
	$table=$_SESSION['tab'];
		
	$html='';
	$html_buffer='';

	ECHO("	<BR>
			<H2 ALIGN='CENTER'>
			".$table['name_table']."
			</H2>");
	
	
	INCLUDE "connect.php";
	// Выборка из базы данных
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
	if(isset($_GET['operation_id']) && !empty($_GET['operation_id']))
	{
		$select=$select." 	FROM ".$table['table_id']." WHERE ope_id=".$_GET['operation_id']."   
						ORDER BY " . $table['col_1_table_select'] . " ";
	}
	else
	{
		$select=$select." 	FROM ".$table['table_id']."
						ORDER BY " . $table['col_1_table_select'] . " ";
	}
	
				
	$s = OCIParse($c,$select); 
	OCIExecute($s, OCI_DEFAULT); 
	
	
	//Действие - "Просмотр"
	IF(EMPTY($_GET["action"])) {
			$html_buffer=" 
					<CENTER>
						<TABLE id='maintable' BORDER=0 WIDTH=97%>
								<TR id='headrow' BGCOLOR='FFFFFF'>";
			ECHO($html_buffer);
			$html=$html.$html_buffer;					
			$i=1;
			WHILE(!EMPTY($table['col_'.$i.'_name'])){
				$html_buffer="		<TD>
										<CENTER>
											".$table['col_'.$i.'_name']."
										</CENTER>
									</TD>";
				ECHO($html_buffer);
				$html=$html.$html_buffer;
			$i++;
			};
			ECHO("				</TR>");
			$color=1;
			WHILE (OCIFetch($s)) {
				IF (($color % 2)!='0' ){
					$html_buffer="<TR >";
					ECHO($html_buffer);
					$html=$html.$html_buffer;
				}ELSE{
					$html_buffer="<TR BGCOLOR='yellow'>";
					ECHO($html_buffer);
					$html=$html.$html_buffer;
				}
				$color++;
				$i=1;
				WHILE(!EMPTY($table['col_'.$i.'_name'])){
					if($i==5 && $table['table_id']=='docs' || $i==6 &&  $table['table_id']=='personal')
					{
						$link_to_operation=1;
					}
					else
					{
						$link_to_operation=0;
					}
					$html_buffer="
									<TD>
										<CENTER>";
					if($link_to_operation)
					{
						$html_buffer.='<a href="operacii.php?operation_id=';
					}
					ECHO($html_buffer);
					$html=$html.$html_buffer;
						
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
						$select_ref=$select_ref." 	FROM ".$table['table_id_ref']."	WHERE  ". $table['col_1_table_select_ref'] ." = ". $col_table."  ";
												$sr = OCIParse($c,$select_ref); 
						OCIExecute($sr, OCI_DEFAULT); 
											
						WHILE (OCIFetch($sr)) {
							$col_1_table_ref = OCIResult($sr, $table['col_1_table_ref']);
							$col_2_table_ref = OCIResult($sr, $table['col_2_table_ref']);
												
							$html_buffer=$col_1_table_ref." : ".$col_2_table_ref;
							ECHO($html_buffer);
							$html=$html.$html_buffer;				
						};
													
					}ELSE{
						$html_buffer= $col_table ;
						ECHO($html_buffer);
						$html=$html.$html_buffer;									
					};
					if($link_to_operation)
					{
						$html_buffer='">'.$html_buffer.'</a></CENTER>
						</TD>';
					}
					else
					{
						$html_buffer='</CENTER>
						</TD>';
					}
					
					ECHO($html_buffer);
					$html=$html.$html_buffer;	
					$i++;
				};
				
				$html_buffer="</TR>";
				ECHO($html_buffer);
				$html=$html.$html_buffer;	
			} 
			
			$html_buffer=" 	</TABLE>
					</CENTER>" ;
			ECHO($html_buffer);
			$html=$html.$html_buffer;	
		$_SESSION['html']=$html;
				
	//Действие - "Вставка строки"
	}ELSEIF($_GET["action"]=="insert") {
		ECHO ("
			<FORM ACTION='insert.php' METHOD='POST'>
				<CENTER>
					<TABLE id='maininput' BORDER=0 WIDTH=97%>
						<TR BGCOLOR='FFFFFF'>");
		$i=1;
		WHILE(!EMPTY($table['col_'.$i.'_name'])){
			ECHO("			<TD>
								<CENTER>
									".$table['col_'.$i.'_name']."
								</CENTER>
							</TD>");
			$i++;
		};
		ECHO("			</TR>");
		$color=1;
		WHILE (OCIFetch($s)) { 
			IF (($color % 2)!='0' ){
				ECHO("	<TR >");
			}ELSE{
				ECHO ("	<TR BGCOLOR='yellow'>");
			}
			$color++;
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
	
		ECHO (" 		<TR>");
		$i=1;
		WHILE(!EMPTY($table['col_'.$i.'_name'])){
			ECHO("			<TD>
								<CENTER> ");
									IF($i==1){
										ECHO("");
									}ELSE{
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
											
											ECHO ("	<SELECT NAME='value_col_".$i."'>");
											WHILE (OCIFetch($sr)) {
												$col_1_table_ref=OCIResult($sr, $table['col_1_table_ref']);
												$col_2_table_ref=OCIResult($sr, $table['col_2_table_ref']);
												
												ECHO ("	<OPTION VALUE='".$col_1_table_ref."'>"
															.$col_1_table_ref." : ".$col_2_table_ref
													."	</OPTION>");
											};
											ECHO("			</SELECT>");
											
										}ELSE{
											ECHO(" <INPUT TYPE='text' NAME='value_col_".$i."' >");
										}
									}
			ECHO("				</CENTER>
							</TD>");
			$i++;
		};
		ECHO("			</TR>
					</TABLE>
				</CENTER> 
				<P  ALIGN='center'>
					<INPUT TYPE='submit'  VALUE ='Вставить строку'>
				</P>
			</FORM>");

	//Действие - "Обновление строки"
	}ELSEIF($_GET["action"]=="update") {
		ECHO ("
			<FORM ACTION='update.php' METHOD='POST'>
				<CENTER>
					<TABLE id='mainupdate' BORDER=0 WIDTH=97%>
						<TR BGCOLOR='FFFFFF'>");
		$i=1;
		WHILE(!EMPTY($table['col_'.$i.'_name'])){
			ECHO("			<TD>
								<CENTER>
									".$table['col_'.$i.'_name']."
								</CENTER>
							</TD>");
			$i++;
		};
		ECHO("				<TD>
								<CENTER>
									ACTION
								</CENTER>
							</TD>
						</TR>");
			$color=1;			
		WHILE (OCIFetch($s)) { 
			$i=1;
			WHILE(!EMPTY($table['col_'.$i.'_name'])){
				$value_col[$i]=OCIResult($s, $table['col_'.$i.'_table']);
				$i++;
			};
			
			
			IF (($color % 2)!='0' ){
				ECHO("	<TR >");
			}ELSE{
				ECHO ("	<TR BGCOLOR='yellow'>");
			}
			$color++;
			
			$i=1;
			WHILE(!EMPTY($table['col_'.$i.'_name'])){
				ECHO("		<TD>
								<CENTER>");
											$value_col[$i]=OCIResult($s, $table['col_'.$i.'_table']);
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
												WHERE  ". $table['col_1_table_select_ref'] ." = ". $value_col[$i]."  ";
												
											
												$sr = OCIParse($c,$select_ref); 
												OCIExecute($sr, OCI_DEFAULT); 
											
											
												WHILE (OCIFetch($sr)) {
													$col_1_table_ref = OCIResult($sr, $table['col_1_table_ref']);
													$col_2_table_ref = OCIResult($sr, $table['col_2_table_ref']);
												
													ECHO ( $col_1_table_ref." : ".$col_2_table_ref);
													
												};
													
											}ELSE{
												ECHO( $value_col[$i] ); 
											};
								ECHO("
								</CENTER>
							</TD>");
				$i++;
			};

			ECHO("			<TD>
								<CENTER>
									<INPUT TYPE='radio' NAME='value_col_id' VALUE ='".$value_col[1]."'>
								</CENTER>
							</TD>
						</TR>");
		}
				
		ECHO (" 	</TABLE>
				</CENTER> 
				<P  ALIGN='center'>
					<INPUT TYPE='submit'  VALUE ='Изменить строку'>
				</P>
			</FORM>");
				
	//Действие - "Удалить строку"	
	}ELSEIF($_GET["action"]=="delete") {
		ECHO ("
			<FORM ACTION='delete.php' METHOD='post'>
				<CENTER>
					<TABLE id='maindelete' BORDER=0 WIDTH=97%>
						<TR BGCOLOR='FFFFFF'>");
		$i=1;
		WHILE(!EMPTY($table['col_'.$i.'_name'])){
			ECHO("			<TD>
								<CENTER>
									".$table['col_'.$i.'_name']."
								</CENTER>
							</TD>");
			$i++;
		};
		ECHO("				<TD>
								<CENTER>
									ACTION
								</CENTER>
							</TD>
						</TR>");
		$color=1;			
		WHILE (OCIFetch($s)) { 
			$i=1;
			WHILE(!EMPTY($table['col_'.$i.'_name'])){
				$value_col[$i]=OCIResult($s, $table['col_'.$i.'_table']);
				$i++;
			};

			IF (($color % 2)!=0 ){
				ECHO("	<TR >");
			}ELSE{
				ECHO ("	<TR BGCOLOR='yellow'>");
			}
			$color++;
			$i=1;
			WHILE(!EMPTY($table['col_'.$i.'_name'])){
				ECHO("		<TD>
								<CENTER>");
											$value_col[$i]=OCIResult($s, $table['col_'.$i.'_table']);
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
												WHERE  ". $table['col_1_table_select_ref'] ." = ". $value_col[$i]."  ";
												
												$sr = OCIParse($c,$select_ref); 
												OCIExecute($sr, OCI_DEFAULT); 
											
											
												WHILE (OCIFetch($sr)) {
													$col_1_table_ref = OCIResult($sr, $table['col_1_table_ref']);
													$col_2_table_ref = OCIResult($sr, $table['col_2_table_ref']);
												
													ECHO ( $col_1_table_ref." : ".$col_2_table_ref);
													
												};
													
											}ELSE{
												ECHO( $value_col[$i] ); 
											};
								ECHO("
								</CENTER>
							</TD>");
				$i++;
			};

					ECHO("	<TD>
								<CENTER>
									<INPUT TYPE='radio' NAME='value_col_id' VALUE ='".$value_col[1]."'>
								</CENTER>
							</TD>
						</TR>");
		}
		
		ECHO (" 	</TABLE>
				</CENTER> 
				<P  ALIGN='center'>
					<INPUT TYPE='submit'  VALUE ='Удалить строку'>
				</P>
			</FORM>");
		
	}ELSEIF($_GET["action"]=="generate") {
		ECHO ("
			<FORM ACTION='pdf/create_pdf.php' METHOD='post'>
				<CENTER>
					<TABLE id='gena' BORDER=0 WIDTH=97%>
						<TR BGCOLOR='FFFFFF'>");
		$i=1;
		WHILE(!EMPTY($table['col_'.$i.'_name'])){
			ECHO("			<TD>
								<CENTER>
									".$table['col_'.$i.'_name']."
								</CENTER>
							</TD>");
			$i++;
		};
		ECHO("				<TD>
								<CENTER>
									ACTION
								</CENTER>
							</TD>
						</TR>");
		$color=1;			
		WHILE (OCIFetch($s)) { 
			$i=1;
			WHILE(!EMPTY($table['col_'.$i.'_name'])){
				$value_col[$i]=OCIResult($s, $table['col_'.$i.'_table']);
				$i++;
			};

			IF (($color % 2)!=0 ){
				ECHO("	<TR BGCOLOR='008B8B'>");
			}ELSE{
				ECHO ("	<TR BGCOLOR='yellow'>");
			}
			$color++;
			$i=1;
			WHILE(!EMPTY($table['col_'.$i.'_name'])){
				ECHO("		<TD>
								<CENTER>");
											$value_col[$i]=OCIResult($s, $table['col_'.$i.'_table']);
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
												WHERE  ". $table['col_1_table_select_ref'] ." = ". $value_col[$i]."  ";
												
												$sr = OCIParse($c,$select_ref); 
												OCIExecute($sr, OCI_DEFAULT); 
											
											
												WHILE (OCIFetch($sr)) {
													$col_1_table_ref = OCIResult($sr, $table['col_1_table_ref']);
													$col_2_table_ref = OCIResult($sr, $table['col_2_table_ref']);
												
													ECHO ( $col_1_table_ref." : ".$col_2_table_ref);
													
												};
													
											}ELSE{
												ECHO( $value_col[$i] ); 
											};
								ECHO("
								</CENTER>
							</TD>");
				$i++;
			};

					ECHO("	<TD>
								<CENTER>
									<INPUT TYPE='checkbox' NAME='name[]' VALUE ='".$value_col[1]."'>
								</CENTER>
							</TD>
						</TR>");
		}
		
		ECHO (" 	</TABLE>
				</CENTER> 
				<P  ALIGN='center'>
					<INPUT TYPE='submit'  VALUE ='Создать отчет' method='post'>
				</P>
			</FORM>");
	
	}
	INCLUDE "disconnect.php";

?>