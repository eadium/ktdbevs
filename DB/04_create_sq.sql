SPOOL 04_create_sq.lst

PROMPT Создание последовательностей для таблиц информационной системы
PROMPT Автор: Хальзев С.Е.
PROMPT Дата создания 24.04.2018

PROMPT Создание последовательности для таблицы docs
DROP SEQUENCE seq_doc_id;
CREATE SEQUENCE seq_doc_id INCREMENT BY 1 START WITH 1;

PROMPT Создание последовательности для таблицы operacii
DROP SEQUENCE seq_ope_id;
CREATE SEQUENCE seq_ope_id INCREMENT BY 1 START WITH 1;

PROMPT Создание последовательности для таблицы pcb
DROP SEQUENCE seq_pcb_id;
CREATE SEQUENCE seq_pcb_id INCREMENT BY 1 START WITH 1;

PROMPT Создание последовательности для таблицы personal
DROP SEQUENCE seq_per_id;
CREATE SEQUENCE seq_per_id INCREMENT BY 1 START WITH 1;

PROMPT Создание последовательности для таблицы radioelements
DROP SEQUENCE seq_rad_id;
CREATE SEQUENCE seq_rad_id INCREMENT BY 1 START WITH 1;

PROMPT Создание последовательности для таблицы zakaz
DROP SEQUENCE seq_users_id;
CREATE SEQUENCE seq_users_id INCREMENT BY 1 START WITH 1;

COMMIT;

SPOOL off;

