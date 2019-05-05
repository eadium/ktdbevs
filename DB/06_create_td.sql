SPOOL 06_create_td.lst

	PROMPT Скрипт заполнения таблиц тестовыми данными
	PROMPT Автор: Хальзев С.Е.
	PROMPT Дата создания 24.04.18

	PROMPT Заполнение таблицы users
	INSERT INTO users (users_login, users_password, users_rule_see, users_rule_edit, users_rule_admin)
		VALUES ('admin', 'admin', '111', '111', '1'
			);
	INSERT INTO users (users_login, users_password, users_rule_see, users_rule_edit, users_rule_admin)
		VALUES ('technolog', 'technolog', '111', '111', '0'
			);
	INSERT INTO users (users_login, users_password, users_rule_see, users_rule_edit, users_rule_admin)
		VALUES ('worker', 'worker', '111', '000', '0'
			);


	PROMPT Заполнение таблицы pcb
	INSERT INTO pcb (pcb_name, pcb_mat, pcb_class, pcb_vend)
		VALUES ('25', 'SF', '5', 'Altonik'
			);
 
	PROMPT Заполнение таблицы operacii
	INSERT INTO operacii (ope_type, ope_cost, ope_dur
					, ope_users_id)
		VALUES (	'Lithography', '5000', '2000'
				, (SELECT users_id
					FROM users
					WHERE users_login = 'technolog')
				);
	INSERT INTO operacii (ope_type, ope_cost, ope_dur
					, ope_users_id)
		VALUES (	'Measure CD', '10000', '3000'
				, (SELECT users_id
					FROM users
					WHERE users_login = 'technolog')
				);
	INSERT INTO operacii (ope_type, ope_cost, ope_dur
					, ope_users_id)
		VALUES (	'Sborka', '7400', '300'
				, (SELECT users_id
					FROM users
					WHERE users_login = 'worker')
				);
	INSERT INTO operacii (ope_type, ope_cost, ope_dur
					, ope_users_id)
		VALUES (	'Out Control', '8900', '3000'
				, (SELECT users_id
					FROM users
					WHERE users_login = 'worker')
				);

	PROMPT Заполнение таблицы personal
	INSERT INTO personal (per_surn, per_name, per_tel
				, per_role, per_ope_id
				)
		VALUES ('Pushkin', 'Aleksandr', '84954659232'
				, 'admin'
				, (SELECT ope_id
					FROM operacii
					WHERE ope_type = 'Lithography')
				);
	INSERT INTO personal (per_surn, per_name, per_tel
				, per_role, per_ope_id 
				)
		VALUES ('Tolstoy', 'Lev', '84984659239'
				, 'dir'
				, (SELECT ope_id
					FROM operacii
					WHERE ope_type = 'Measure CD')
				);
	INSERT INTO personal (per_surn, per_name, per_tel
				, per_role, per_ope_id
				)
		VALUES ('Hayam', 'Omar', '84997654365'
				, 'worker'
				, (SELECT ope_id
					FROM operacii
					WHERE ope_type = 'Sborka')
				);

	PROMPT Заполнение таблицы docs
	INSERT INTO docs (	doc_name
				, doc_date
				, doc_type
				, doc_ope_id
					)
		VALUES (	'IU4.001.002.003'
				, to_date('29/03/2012', 'DD.MM.YY')
				, 'Operation Card'
				, (SELECT ope_id
					FROM operacii
					WHERE ope_type = 'Sborka')
				);
	INSERT INTO docs (	doc_name
				, doc_date
				, doc_type
				, doc_ope_id
					)
		VALUES (	'IU4.001.002.015'
				, to_date('01/05/2013', 'DD.MM.YY')
				, 'Measure Program'
				, (SELECT ope_id
					FROM operacii
					WHERE ope_type = 'Measure CD')
				);
	INSERT INTO docs (	doc_name
				, doc_date
				, doc_type
				, doc_ope_id
					)
		VALUES (	'IU4.001.003.005'
				, to_date('15/04/2012', 'DD.MM.YY')
				, 'SB'
				, (SELECT ope_id
					FROM operacii
					WHERE ope_type = 'Measure CD')
				);
	INSERT INTO docs (	doc_name
				, doc_date
				, doc_type
				, doc_ope_id
					)
		VALUES (	'IU4.001.001.001'
				, to_date('01/02/2011', 'DD.MM.YY')
				, 'TZ'
				, (SELECT ope_id
					FROM operacii
					WHERE ope_type = 'Lithography')
				);


	PROMPT Заполнение таблицы radioelements
	INSERT INTO radioelements (rad_vend, rad_nom, rad_type, rad_ope_id, rad_pcb_id)
		VALUES ('CHIP-DIP', '6', 'C'
			, (SELECT ope_id FROM operacii
				WHERE ope_type = 'Measure CD')
			, (SELECT pcb_id FROM pcb
				WHERE pcb_vend = 'Altonik')
			);
	INSERT INTO radioelements (rad_vend, rad_nom, rad_type, rad_ope_id, rad_pcb_id)
		VALUES ('CHIP-DIP', '9', 'R'
			, (SELECT ope_id FROM operacii
				WHERE ope_type = 'Measure CD')
			, (SELECT pcb_id FROM pcb
				WHERE pcb_vend = 'Altonik')
			);

			
	COMMIT;

SPOOL off;