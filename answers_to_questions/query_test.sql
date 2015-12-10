/*INSERT INTO tipo_registo (userid, typecnt, nome, idseq, ativo) VALUES
(1, 3, "ola", 29, true);

INSERT INTO registo (userid, typecounter, regcounter, nome, idseq, ativo) VALUES
(1, 1, 1, "U1T1R1", 28, true);

INSERT INTO pagina (userid, pagecounter, nome, idseq, ativa) VALUES
(1, 1, "U1P1", 1, true);

INSERT INTO reg_pag (idregpag, userid, typeid, pageid, regid, idseq, ativa) VALUES 
(1, 1, 1, 1, 1, 18, true);

INSERT INTO campo (userid, typecnt, campocnt, nome, idseq, ativo) VALUES
(1, 1, 1,"U1C1", 30, true);

INSERT INTO valor (userid, typeid, campoid, regid, valor, idseq, ativo) VALUES
(1, 1, 1, 1, "meu valor", 31, true);*/

SELECT U.userid, U.nome
FROM utilizador U
WHERE U.userid NOT IN (SELECT l.userid
					   FROM 	login l);

