DROP TRIGGER IF EXISTS check_sequencia_campo;
DROP TRIGGER IF EXISTS check_sequencia_registo;
DROP TRIGGER IF EXISTS check_sequencia_valor;
DROP TRIGGER IF EXISTS check_sequencia_tipo_registo;
DROP TRIGGER IF EXISTS check_sequencia_pagina;
DELETE FROM reg_pag WHERE userid > 1;
DELETE FROM pagina WHERE userid > 1;
DELETE FROM valor 	WHERE userid > 1;
DELETE FROM campo WHERE userid < 1;
DELETE FROM registo WHERE userid > 1;
DELETE FROM tipo_registo WHERE userid > 1;
DELETE FROM sequencia WHERE userid > 1;
DELETE FROM login WHERE userid > 1;
DELETE FROM utilizador WHERE userid > 1;