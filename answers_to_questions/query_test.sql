SELECT 	P.userid, P.pagecounter, P.nome
FROM 	pagina P
WHERE 	NOT EXISTS (

			SELECT	T.typecnt
			FROM	tipo_registo T
			WHERE 	T.userid = P.userid
					AND NOT EXISTS ( 

						SELECT 	RP2.typeid
						FROM 	reg_pag RP2
						WHERE	RP2.userid = T.userid
								AND RP2.pageid = P.pagecounter
								AND RP2.typeid = T.typecnt
					)
);

