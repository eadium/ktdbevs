SPOOL 05_create_tr.lst

PROMPT �������� ��������� ��� ������ �������������� �������
PROMPT �����: ������� �.�.
PROMPT ���� �������� 24.04.18

PROMPT �������� �������� ��� ������� docs
CREATE OR REPLACE TRIGGER tr_doc_id
BEFORE INSERT ON docs
FOR EACH ROW
BEGIN
SELECT seq_doc_id.nextval
INTO :new.doc_id
FROM dual;
END; 
/

PROMPT  �������� �������� ��� ������� operacii
CREATE OR REPLACE TRIGGER tr_ope_id
BEFORE INSERT ON operacii
FOR EACH ROW
BEGIN
SELECT seq_ope_id.nextval
INTO :new.ope_id
FROM dual;
END; 
/

PROMPT �������� �������� ��� ������� pcb
CREATE OR REPLACE TRIGGER tr_pcb_id
BEFORE INSERT ON pcb
FOR EACH ROW
BEGIN
SELECT seq_pcb_id.nextval
INTO :new.pcb_id
FROM dual;
END; 
/

PROMPT �������� �������� ��� ������� personal
CREATE OR REPLACE TRIGGER tr_per_id
BEFORE INSERT ON personal
FOR EACH ROW
BEGIN
SELECT seq_per_id.nextval
INTO :new.per_id
FROM dual;
END; 
/

PROMPT �������� �������� ��� ������� radioelements
CREATE OR REPLACE TRIGGER tr_rad_id
BEFORE INSERT ON radioelements
FOR EACH ROW
BEGIN
SELECT seq_rad_id.nextval
INTO :new.rad_id
FROM dual;
END; 
/

PROMPT �������� �������� ��� ������� users
CREATE OR REPLACE TRIGGER tr_users_id
BEFORE INSERT ON users
FOR EACH ROW
BEGIN
SELECT seq_users_id.nextval
INTO :new.users_id
FROM dual;
END; 
/

COMMIT;

SPOOL off;
