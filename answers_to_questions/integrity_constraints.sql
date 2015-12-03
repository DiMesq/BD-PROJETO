# Define the following integrity constraint using the mechanisms most apt to 
# that effect and that are available in MySQL:
#
# 	- Every value of contador_sequencia that exists in the sequencia relation 
# 	exists once and only once in the universe of the following relations: 
# 	tipo_registo; pagina; campo; registo and valor.

DELIMITER //

DROP TRIGGER IF EXISTS check_sequencia_tipo_registo //
CREATE TRIGGER check_sequencia_tipo_registo 
BEFORE INSERT ON tipo_registo 

FOR EACH ROW
	
BEGIN
	DECLARE	msg VARCHAR(255);

	IF EXISTS  (SELECT	*
				FROM 	tipo_registo T, pagina P, campo C, registo R, valor V
				WHERE	T.idseq = new.idseq	
						OR P.idseq = new.idseq 
						OR C.idseq = new.idseq 
						OR R.idseq = new.idseq 
						OR V.idseq = new.idseq)
	THEN
		SET msg = concat('MyTriggerError: trying to insert an already existing value of idseq in tipo_registo: ', cast(new.idseq as char));
		SIGNAL SQLSTATE '45000' SET message_text = msg;
	END IF;
END; //


DROP TRIGGER IF EXISTS check_sequencia_pagina //
CREATE TRIGGER check_sequencia_pagina 
BEFORE INSERT ON pagina 

FOR EACH ROW

BEGIN
	DECLARE	msg VARCHAR(255);

	IF EXISTS  (SELECT	*
				FROM 	tipo_registo T, pagina P, campo C, registo R, valor V
				WHERE	T.idseq = new.idseq 
						OR P.idseq = new.idseq
						OR C.idseq = new.idseq 
						OR R.idseq = new.idseq 
						OR V.idseq = new.idseq)
	THEN
		SET msg = concat('MyTriggerError: trying to insert an already existing value of idseq in pagina: ', cast(new.idseq as char));
		SIGNAL SQLSTATE '45000' SET message_text = msg;
	END IF;
END; //

DELIMITER ;

