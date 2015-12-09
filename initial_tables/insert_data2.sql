DELIMITER ;
-- deactivates foreign key verification
SET foreign_key_checks = 0 ;

TRUNCATE TABLE login;
TRUNCATE TABLE campo;
TRUNCATE TABLE pagina;
TRUNCATE TABLE reg_pag;
TRUNCATE TABLE registo;
TRUNCATE TABLE sequencia;
TRUNCATE TABLE tipo_registo;
TRUNCATE TABLE utilizador;
TRUNCATE TABLE valor;

SET foreign_key_checks = 1 ;

INSERT INTO utilizador (userid,email,nome,password, questao1, resposta1, questao2, resposta2, pais, categoria) VALUES 
 (1,"Gustavo.OLHCNU@JCOK.Pi","Gustavo OLHCNU","GIWYFE-ZSOK_YN","ITHHEJ AMWM KN?","YTREGPFFTL HS.","UPTGHL JMQX WL?","PEEWTMASEP VV.","Pitcairn","NG"),
 (5,"Leonardo.WANTMM@CNCD.Gu","Leonardo WANTMM","YUXKZW-FXSV_MI","YJVFYN OCTR EH?","FWKLLMYYQY RJ.","FSVXVN LBQS TL?","BRGGTRXCLM MQ.","Guiana","EQ"),
 (13,"Clara.MUFBLR@VDGG.Ho","Clara MUFBLR","LVYPLE-NAAD_EY","QQWZBW RFZA ND?","WPSNEBUVJH IX.","UORUHH FVVM VA?","GHSOOXRZHI LX.","Honduras","NJ"),
 (21,"Bianca.OCCVHC@BTXJ.Ti","Bianca OCCVHC","SQSTDC-ERTW_BT","BDNFHQ JORA YX?","EHZQTQVRYB UF.","CMPDCU REVQ VK?","KSGMZEJZQB DQ.","Timor Leste","MO"),
 (25,"Clara.DZYPDK@RCIY.Il","Clara DZYPDK","CRYYTL-XHAX_HZ","ZBQOUM YDWK IS?","VUIDAHVQER EB.","XIGDCY MAYT ST?","FXVNQVHLAS IR.","Ilhas Salomão","JS"),
 (33,"Alícia.XJKWFD@FXIQ.Ho","Alícia XJKWFD","FJUFJF-ILRP_TJ","FMPXGK CFJB XD?","XYMJTURNWY SH.","DTSSKS IYDY MC?","NLWHVLSNIO NV.","Hong Kong","YY"),
 (42,"Maria.Eduarda.LTAFCY@TXMS.Áf","Maria Eduarda LTAFCY","PUBOLD-GBFR_GL","RADUUF PAZS NC?","PDMIPQGRJH YQ.","GUXOFR LMXD IM?","VDQXAGHJXL AV.","África do Sul","PK"),
 (43,"Emanuelly.OJUQDB@NGKJ.As","Emanuelly OJUQDB","KHPZML-ZXTP_AI","SOPMIK QBSW JZ?","SZJVJEFMAT VT.","CLVSWZ AQWT HW?","WLCIZTWZDP NN.","Ashmore and Cartier Islands","HZ"),
 (51,"Enzo.Gabriel.WZEEKE@AZQW.No","Enzo Gabriel WZEEKE","NPMNAZ-GAWZ_QN","BUJJWB QUIA ZK?","OACXQRTWQU VA.","ECIYCV AAGA XW?","UGAPNFVQAI XX.","Nova Caledónia","UM");

INSERT INTO login (userid, contador_login, sucesso,moment) VALUES
(1, 1, true, "2004-03-21 00:00:00"),
(1, 2, false, "2014-12-22 00:00:00"),
(1, 8, false, "1987-03-30 00:00:00"),
(1, 13, true, "1993-01-25 00:00:00"),
(1, 22, true, "2014-01-02 00:00:00"),
(1, 32, false, "2002-01-02 00:00:00"),
(1, 38, false, "1995-06-12 00:00:00"),
(1, 40, true, "1995-04-15 00:00:00"),
(1, 48, false, "1989-06-05 00:00:00"),
(1, 52, false, "1998-08-11 00:00:00"),
(5, 56, true, "2003-01-19 00:00:00"),
(5, 78, false, "1978-05-09 00:00:00"),
(5, 83, true, "1988-03-14 00:00:00"),
(5, 93, true, "1987-07-17 00:00:00"),
(5, 95, true, "1991-10-01 00:00:00"),
(13, 102, true, "1989-06-09 00:00:00"),
(13, 104, false, "1987-01-18 00:00:00"),
(21, 112, true, "1979-08-05 00:00:00"),
(21, 122, true, "2003-12-22 00:00:00"),
(21, 126, false, "1991-11-19 00:00:00"),
(21, 130, false, "1979-08-14 00:00:00"),
(25, 132, false, "1989-10-23 00:00:00"),
(25, 135, false, "2006-09-08 00:00:00"),
(25, 137, true, "1985-12-07 00:00:00"),
(25, 138, true, "2010-01-13 00:00:00"),
(25, 148, false, "2002-07-29 00:00:00"),
(25, 149, false, "2004-01-22 00:00:00"),
(25, 154, false, "1980-08-01 00:00:00"),
(25, 160, false, "2006-01-26 00:00:00"),
(25, 166, false, "2000-12-24 00:00:00"),
(33, 180, false, "1984-04-22 00:00:00"),
(33, 190, true, "1995-07-17 00:00:00"),
(33, 193, false, "1984-08-20 00:00:00"),
(33, 196, true, "2004-10-02 00:00:00"),
(33, 202, true, "1999-08-01 00:00:00"),
(42, 207, false, "1984-12-29 00:00:00"),
(42, 208, false, "2004-08-03 00:00:00"),
(43, 218, true, "1992-10-29 00:00:00"),
(43, 222, false, "1977-02-27 00:00:00"),
(43, 230, true, "2014-03-18 00:00:00"),
(51, 239, false, "1995-01-02 00:00:00"),
(51, 241, true, "1990-02-09 00:00:00"),
(51, 248, true, "1979-12-23 00:00:00"),
(51, 251, false, "1980-10-13 00:00:00"),
(51, 255, true, "1977-04-12 00:00:00"),
(51, 258, true, "1992-02-23 00:00:00"),
(51, 261, false, "2002-02-02 00:00:00");

INSERT INTO sequencia (userid, contador_sequencia,moment) VALUES
(1, 1,"1977-07-01 00:00:00"),
(1, 2,"1977-07-04 00:00:00"),
(1, 3,"1977-07-14 00:00:00"),
(1, 4,"1977-07-23 00:00:00"),
(5, 5,"1977-07-26 00:00:00"),
(5, 6,"1977-08-01 00:00:00"),
(5, 7,"1977-08-10 00:00:00"),
(5, 8,"1977-08-16 00:00:00"),
(1, 9,"1977-08-21 00:00:00"),
(1, 10,"1977-08-27 00:00:00"),
(1, 11,"1977-09-01 00:00:00"),
(1, 12,"1977-09-05 00:00:00"),
(1, 13,"1977-09-15 00:00:00"),
(5, 14,"1977-09-21 00:00:00"),
(5, 15,"1977-09-23 00:00:00"),
(5, 16,"1977-09-24 00:00:00"),
(5, 17,"1977-10-02 00:00:00"),
(5, 18,"1977-10-02 00:00:00"),
(5, 19,"1978-11-03 00:00:00"),
(1, 20,"1979-09-05 00:00:00"),
(1, 21,"1979-09-15 00:00:00"),
(1, 22,"1979-09-21 00:00:00"),
(13, 23,"1979-09-23 00:00:00"),
(13, 24,"1979-09-24 00:00:00"),
(13, 25,"1979-10-02 00:00:00"),
(13, 26,"1979-10-02 00:00:00"),
(13, 27,"1979-11-03 00:00:00"),
(1, 28,"1979-11-04 00:00:00"),
(13, 29,"1979-11-05 00:00:00"),
(1, 30,"1979-12-04 00:00:00"),
(1, 31,"1979-12-06 00:00:00"),
(1, 32,"1979-12-07 00:00:00");

INSERT INTO tipo_registo (userid, typecnt, nome, idseq, ativo) VALUES
(1, 1, "U1T1", NULL, true),
(1, 2, "U1T2", NULL, true),
(5, 1, "U2T1", NULL, true),
(13, 1, "U3T1", NULL, true),
(13, 2, "U3T2", 29, true);

INSERT INTO registo (userid, typecounter, regcounter, nome, idseq, ativo) VALUES
(1, 1, 1, "U1T1R1", 28, true),			
(1, 1, 2, "U1T1R2", NULL, true),			
(1, 2, 1, "U1T2R1", NULL, true),			
(5, 1, 1, "U2T1R1", NULL, true),			
(5, 1, 2, "U2T1R2", NULL, true),
(13, 1, 1, "U3T1R1", NULL, true),
(13, 1, 2, "U3T1R2", NULL, false),
(13, 2, 1, "U3T2R1", NULL, true);		

INSERT INTO pagina (userid, pagecounter, nome, idseq, ativa) VALUES
(1, 1, "U1P1", 1, true),
(1, 2, "U1P2", 2, true),
(1, 3, "U1P3", 3, true),
(1, 4, "U1P4", 4, false),
(5, 1, "U2P1", 5, true),
(5, 2, "U2P2", 6, true),
(5, 3, "U2P3", 7, true),
(5, 4, "U2P4", 8, true),
(13, 1, "U3P1", 9, true),
(13, 2, "U3P2", 10, true),
(13, 3, "U3P3", 11, false);


INSERT INTO reg_pag (idregpag, userid, typeid, pageid, regid, idseq, ativa) VALUES 
(1, 1, 1, 1, 1, 9, true),
(2, 1, 1, 2, 1, 10, true),					
(3, 1, 1, 3, 1, 11, false),
(4, 1, 2, 4, 1, 12, true),
(5, 1, 1, 4, 1, 13, true),					
(6, 5, 1, 1, 2, 14, true),
(7, 5, 1, 2, 2, 15, true),
(8, 5, 1, 3, 1, 16, true),
(9, 5, 1, 4, 2, 17, true),
(10, 5, 1, 4, 1, 18, true),
(11, 5, 1, 3, 2, 19, true),				
(12, 1, 2, 1, 1, 20, true),
(13, 1, 2, 2, 1, 21, true),
(14, 1, 2, 3, 1, 22, true),
(15, 13, 1, 1, 1, 23, false),
(16, 13, 1, 2, 1, 24, true),
(17, 13, 2, 1, 1, 25, true),		
(18, 13, 2, 2, 1, 26, true),
(19, 13, 2, 3, 1, 27, true),
(20, 1, 1, 1, 2, 32, true);	

INSERT INTO campo (userid, typecnt, campocnt, nome, idseq, ativo) VALUES
(1, 1, 1,"U1C1", 30, true);

INSERT INTO valor (userid, typeid, campoid, regid, valor, idseq, ativo) VALUES
(1, 1, 1, 1, "meu valor", 31, true);			









