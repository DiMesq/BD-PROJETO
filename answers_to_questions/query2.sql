# What are the notes (registo table) that appear in all pages (page table) of a certain user?
SELECT 	R.userid, R.typecounter, R.nome
FROM 	registo R
WHERE 	NOT EXISTS(	SELECT 	P.pagecounter
					FROM	pagina P
					WHERE 	P.userid = R.userid
							AND NOT EXISTS(		SELECT 	RP.pageid
												FROM 	reg_pag RP
												WHERE 	RP.userid = R.userid 
														AND RP.typeid = R.typecounter
														AND RP.regid = R.regcounter
														AND RP.pageid = P.pagecounter)
);



