SPOOL 07_create_proc.lst
PROMPT Создание процедуры нахождения длительности и стоимости операций
PROMPT Автор Хальзев С.Е.
PROMPT Дата создания 24.04.2018

CREATE OR REPLACE
PROCEDURE OPE_COST_TIME_SUM
(
	 OPE_TIME OUT REAL
	,OPE_COST OUT REAL
)
IS
BEGIN
	OPE_TIME := (SELECT SUM (ope_dur) FROM operacii);
	OPE_COST := (SELECT SUM (ope_cost) FROM operacii);
END;