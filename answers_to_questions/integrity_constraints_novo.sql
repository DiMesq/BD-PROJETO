# Define the following integrity constraint using the mechanisms most apt to 
# that effect and that are available in MySQL:
#
# 	- Every value of contador_sequencia that exists in the sequencia relation 
# 	exists once and only once in the universe of the following relations: 
# 	tipo_registo; pagina; campo; registo and valor.

DELIMITER //

###
 # Tests if the input parameter is present in any of the following tables: 
 # 		tipo_registo; pagina; campo; registo; valor and reg_pag
 # Returns 0 if its not
 ##
DROP FUNCTION IF EXISTS idseq_unique //
CREATE FUNCTION idseq_unique (new_idseq INT)
	RETURNS INT
BEGIN
  	DECLARE flag INT;
	DECLARE cnt INT;

	SET flag = 1;

	# test if its repeated in the tipo_registo table
	SELECT COUNT(*) INTO cnt FROM tipo_registo T WHERE @new_idseq = T.idseq;
	IF (flag AND cnt > 0) THEN SET flag = 0;
	END IF;

	# if its not repeated in a previous table, test for the registo table
	IF (flag) THEN 
		SELECT COUNT(*) INTO cnt FROM registo R WHERE @new_idseq = R.idseq;
		IF (cnt > 0) THEN SET flag = 0;
		END IF;
	END IF;
	
	# if its not repeated in a previous table, test for the pagina table
	IF (flag) THEN 
		SELECT COUNT(*) INTO cnt FROM pagina P WHERE @new_idseq = P.idseq;
		IF (cnt > 0) THEN SET flag = 0;
		END IF;
	END IF;

	# if its not repeated in a previous table, test for the campo table
	IF (flag) THEN 
		SELECT COUNT(*) INTO cnt FROM campo C WHERE @new_idseq = C.idseq;
		IF (cnt > 0) THEN SET flag = 0;
		END IF;
	END IF;

	# if its not repeated in a previous table, test for the valor table
	IF (flag) THEN 
		SELECT COUNT(*) INTO cnt FROM valor V WHERE @new_idseq = V.idseq;
		IF (cnt > 0) THEN SET flag = 0;
		END IF;
	END IF;

	# if its not repeated in a previous table, test for the reg_pag table
	IF (flag) THEN 
		SELECT COUNT(*) INTO cnt FROM reg_pag RP WHERE RP.idseq;
		IF (cnt > 0) THEN SET flag = 0;
		END IF;
	END IF;

	RETURN flag;

END; //

# check for an already existing value of idseq before inserting in tipo_registo
DROP TRIGGER IF EXISTS check_sequencia_tipo_registo //
CREATE TRIGGER check_sequencia_tipo_registo 
BEFORE INSERT ON tipo_registo 

FOR EACH ROW
	
BEGIN
	DECLARE	msg VARCHAR(255);
	

	IF (NOT idseq_unique(new.idseq)) THEN 
		SET msg = concat('MyTriggerError: trying to insert an already existing value of idseq in tipo_registo: ', cast(new.idseq as char));
		SIGNAL SQLSTATE '45000' SET message_text = msg;
	END IF;

END; //

# check for duplicates when inserting in pagina
DROP TRIGGER IF EXISTS check_sequencia_pagina //
CREATE TRIGGER check_sequencia_pagina 
BEFORE INSERT ON pagina 

FOR EACH ROW

BEGIN
	DECLARE	msg VARCHAR(255);
	

	IF (NOT idseq_unique(new.idseq)) THEN 
		SET msg = concat('MyTriggerError: trying to insert an already existing value of idseq in pagina: ', cast(new.idseq as char));
		SIGNAL SQLSTATE '45000' SET message_text = msg;
	END IF;

END; //

# check for duplicates when inserting in campo
DROP TRIGGER IF EXISTS check_sequencia_campo //
CREATE TRIGGER check_sequencia_campo
BEFORE INSERT ON campo 

FOR EACH ROW

BEGIN
	DECLARE	msg VARCHAR(255);

	IF (NOT idseq_unique(new.idseq)) THEN 
		SET msg = concat('MyTriggerError: trying to insert an already existing value of idseq in campo: ', cast(new.idseq as char));
		SIGNAL SQLSTATE '45000' SET message_text = msg;
	END IF;

END; //

# check for duplicates when inserting on registo
DROP TRIGGER IF EXISTS check_sequencia_registo //
CREATE TRIGGER check_sequencia_registo
BEFORE INSERT ON registo

FOR EACH ROW

BEGIN
	DECLARE	msg VARCHAR(255);
	

	IF (NOT idseq_unique(new.idseq)) THEN 
		SET msg = concat('MyTriggerError: trying to insert an already existing value of idseq in registo: ', cast(new.idseq as char));
		SIGNAL SQLSTATE '45000' SET message_text = msg;
	END IF;

END; //

# check for duplicates when inserting on valor
DROP TRIGGER IF EXISTS check_sequencia_valor //
CREATE TRIGGER check_sequencia_valor
BEFORE INSERT ON valor

FOR EACH ROW

BEGIN
	DECLARE	msg VARCHAR(255);
	

	IF (NOT idseq_unique(new.idseq)) THEN 
		SET msg = concat('MyTriggerError: trying to insert an already existing value of idseq in valor: ', cast(new.idseq as char));
		SIGNAL SQLSTATE '45000' SET message_text = msg;
	END IF;

END; //

# check for duplicates when inserting on valor
DROP TRIGGER IF EXISTS check_sequencia_reg_pag //
CREATE TRIGGER check_sequencia_reg_pag
BEFORE INSERT ON reg_pag

FOR EACH ROW

BEGIN
	DECLARE	msg VARCHAR(255);
	

	IF (NOT idseq_unique(new.idseq)) THEN 
		SET msg = concat('MyTriggerError: trying to insert an already existing value of idseq in reg_pag: ', cast(new.idseq as char));
		SIGNAL SQLSTATE '45000' SET message_text = msg;
	END IF;

END; //

DELIMITER ;




