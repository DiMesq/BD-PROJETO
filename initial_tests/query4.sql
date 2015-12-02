# query: What are the users that, in all and each one of their pages, have all of the types of notes that they have created?
# answer: get me the user which doenst have a page that is not included in the 
# pages that have all the types of notes that there users have created
FROM 	utilizador U
WHERE 	NOT EXISTS (

			SELECT 	P2.pagecounter
			FROM	pagina P2
			WHERE	P2.userid = U.userid
					AND P2.pagecounter NOT IN (

						SELECT 	P.pagecounter
						FROM 	pagina P
						WHERE 	P.userid = P2.userid
								AND NOT EXISTS (

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
								)
					)
);



