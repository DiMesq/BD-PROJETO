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


