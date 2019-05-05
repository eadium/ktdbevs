SPOOL 02_create_pk.lst

PROMPT �������� ��������� ������ ������ �������������� �������
PROMPT �����: ������� �.�.
PROMPT ���� �������� 24.04.2018

PROMPT �������� ��������� ������
ALTER TABLE docs 
DROP CONSTRAINT pr_docs;

ALTER TABLE operacii
DROP CONSTRAINT pr_operacii;

ALTER TABLE pcb
DROP CONSTRAINT	pr_pcb;

ALTER TABLE personal
DROP CONSTRAINT	pr_personal;

ALTER TABLE radioelements
DROP CONSTRAINT	pr_radioelements;

ALTER TABLE users
DROP CONSTRAINT	pr_users;

PROMPT �������� ��������

DROP INDEX i_doc_id;

DROP INDEX i_equ_id;

DROP INDEX i_ope_id;

DROP INDEX i_pcb_id;

DROP INDEX i_per_id;

DROP INDEX i_rad_id;

DROP INDEX i_users_zak_id;

COMMIT;


COMMIT;

PROMPT ���������� ���������� ����� � ������� docs
CREATE UNIQUE INDEX i_doc_id ON docs (doc_id);
ALTER TABLE docs ADD CONSTRAINT  pr_docs PRIMARY KEY (doc_id);

PROMPT ���������� ���������� ����� � ������� operacii
CREATE UNIQUE INDEX i_ope_id ON operacii (ope_id);
ALTER TABLE operacii ADD CONSTRAINT  pr_operacii PRIMARY KEY (ope_id);

PROMPT ���������� ���������� ����� � ������� pcb
CREATE UNIQUE INDEX i_pcb_id ON pcb (pcb_id);
ALTER TABLE pcb ADD CONSTRAINT  pr_pcb PRIMARY KEY (pcb_id);

PROMPT ���������� ���������� ����� � ������� personal
CREATE UNIQUE INDEX i_per_id ON personal (per_id);
ALTER TABLE personal ADD CONSTRAINT  pr_personal PRIMARY KEY (per_id);

PROMPT ���������� ���������� ����� � ������� radioelements
CREATE UNIQUE INDEX i_rad_id ON radioelements (rad_id);
ALTER TABLE radioelements ADD CONSTRAINT  pr_radioelements PRIMARY KEY (rad_id);


PROMPT ���������� ���������� ����� � ������� zakaz
CREATE UNIQUE INDEX i_users_id ON users (users_id);
ALTER TABLE users ADD CONSTRAINT  pr_users PRIMARY KEY (users_id);

COMMIT;

SPOOL off;
