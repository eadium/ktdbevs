SPOOL Start.lst

	PROMPT ������ ���������� ������ ��������� �������
	PROMPT �����: ������� �.�.
	PROMPT ���� �������� 24.04.18
	PROMPT ���� ���������� ��������� 24.04.18
	
	@@01_create_table.sql;
	@@02_create_pk.sql;
	@@03_create_fk.sql;
	@@04_create_sq.sql;
	@@05_create_tr.sql;
	@@06_create_td.sql;
		
	COMMIT;
	
SPOOL off;
