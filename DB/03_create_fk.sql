SPOOL 03_create_fk.lst

PROMPT Создание внешних ключей таблиц информационной системы
PROMPT Автор: Хальзев С.Е.
PROMPT Дата создания 24.04.2018

PROMPT Удаление внешних ключей
ALTER TABLE docs
DROP CONSTRAINT c_doc_ope_id;

ALTER TABLE operacii
DROP CONSTRAINT c_ope_users_id;

ALTER TABLE personal
DROP CONSTRAINT c_per_ope_id;

ALTER TABLE radioelements
DROP CONSTRAINT c_rad_ope_id;

ALTER TABLE radioelements
DROP CONSTRAINT c_rad_pcb_id;

COMMIT;
	

PROMPT Добавление внешнего ключа в таблицу docs
ALTER TABLE docs
	ADD CONSTRAINT  c_doc_ope_id FOREIGN KEY (doc_ope_id) 	REFERENCES operacii(ope_id);

PROMPT Добавление внешнего ключа в таблицу operacii
ALTER TABLE operacii
	ADD CONSTRAINT  c_ope_users_id FOREIGN KEY (ope_users_id) REFERENCES users(users_id);

PROMPT Добавление внешнего ключа в таблицу personal
ALTER TABLE personal
	ADD CONSTRAINT  c_per_ope_id FOREIGN KEY (per_ope_id) 	REFERENCES operacii(ope_id);

PROMPT Добавление внешнего ключа в таблицу radioelements
ALTER TABLE radioelements
	ADD CONSTRAINT  c_rad_ope_id FOREIGN KEY (rad_ope_id) 	REFERENCES operacii(ope_id);

PROMPT Добавление внешнего ключа в таблицу radioelements
ALTER TABLE radioelements
	ADD CONSTRAINT  c_rad_pcb_id FOREIGN KEY (rad_pcb_id) 	REFERENCES pcb(pcb_id);

COMMIT;

SPOOL off;
