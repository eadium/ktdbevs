SPOOL 01_create_table.lst

PROMPT Скрипт создания таблиц
PROMPT Автор: Хальзев С.Е.
PROMPT Дата создания 24.04.2018

PROMPT Создание таблицы docs
DROP TABLE docs;
CREATE TABLE docs    (
          doc_id	  INTEGER  NOT NULL 
        , doc_date	  DATE  NULL 
        , doc_name	  VARCHAR2(20)  NULL 
        , doc_type	  VARCHAR2(20)  NULL 
        , doc_ope_id	  INTEGER  NOT NULL)
TABLESPACE users;

PROMPT Создание таблицы operacii
DROP TABLE operacii;
CREATE TABLE operacii    (
          ope_id	  INTEGER  NOT NULL 
         ,ope_cost	  INTEGER  NULL 
         ,ope_dur	  INTEGER  NULL 
         ,ope_type	  VARCHAR2(20)  NULL
         ,ope_users_id	  INTEGER  NOT NULL)
TABLESPACE users;

PROMPT Создание таблицы pcb
DROP TABLE pcb;
CREATE TABLE pcb    (
          pcb_id	  INTEGER  NOT NULL 
         ,pcb_name	  VARCHAR2(20)  NULL 
         ,pcb_mat	  VARCHAR2(20)  NULL 
         ,pcb_class	  INTEGER  NULL 
         ,pcb_vend	  VARCHAR2(20)  NULL)
TABLESPACE users;

PROMPT Создание таблицы personal
DROP TABLE personal;
CREATE TABLE personal    (
          per_id	  INTEGER  NOT NULL 
         ,per_name	  VARCHAR2(20)  NULL 
         ,per_surn	  VARCHAR2(20)  NULL 
         ,per_role	  VARCHAR2(20)  NULL
         ,per_tel	  INTEGER  NULL 
         ,per_ope_id	  INTEGER  NOT NULL)
TABLESPACE users;

PROMPT Создание таблицы radioelements    
DROP TABLE radioelements    ;
CREATE TABLE radioelements    (
          rad_id	  INTEGER  NOT NULL
         ,rad_vend	  VARCHAR2(20)  NULL
         ,rad_nom	  VARCHAR2(20)  NULL
         ,rad_type	  VARCHAR2(20)  NULL
         ,rad_ope_id	  INTEGER  NOT NULL
         ,rad_pcb_id	  INTEGER  NOT NULL)
TABLESPACE users;

PROMPT Создание таблицы users
DROP TABLE users;
CREATE TABLE users   (
          users_id	  INTEGER  NOT NULL
         ,users_login	  VARCHAR2(20)  NULL 
         ,users_password  VARCHAR2(20)  NULL 
         ,users_rule_see  VARCHAR2(20)  NULL 
         ,users_rule_edit VARCHAR2(20)  NULL 
         ,users_rule_admin VARCHAR2(20)  NULL)
TABLESPACE users;

COMMIT;

SPOOL off;
