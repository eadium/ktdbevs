SPOOL 04_create_sq.lst

PROMPT �������� ������������������� ��� ������ �������������� �������
PROMPT �����: ������� �.�.
PROMPT ���� �������� 24.04.2018

PROMPT �������� ������������������ ��� ������� docs
DROP SEQUENCE seq_doc_id;
CREATE SEQUENCE seq_doc_id INCREMENT BY 1 START WITH 1;

PROMPT �������� ������������������ ��� ������� operacii
DROP SEQUENCE seq_ope_id;
CREATE SEQUENCE seq_ope_id INCREMENT BY 1 START WITH 1;

PROMPT �������� ������������������ ��� ������� pcb
DROP SEQUENCE seq_pcb_id;
CREATE SEQUENCE seq_pcb_id INCREMENT BY 1 START WITH 1;

PROMPT �������� ������������������ ��� ������� personal
DROP SEQUENCE seq_per_id;
CREATE SEQUENCE seq_per_id INCREMENT BY 1 START WITH 1;

PROMPT �������� ������������������ ��� ������� radioelements
DROP SEQUENCE seq_rad_id;
CREATE SEQUENCE seq_rad_id INCREMENT BY 1 START WITH 1;

PROMPT �������� ������������������ ��� ������� zakaz
DROP SEQUENCE seq_users_id;
CREATE SEQUENCE seq_users_id INCREMENT BY 1 START WITH 1;

COMMIT;

SPOOL off;

