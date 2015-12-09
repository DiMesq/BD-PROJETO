# What are the users that have the biggest average of notes per page?
SELECT	U.nome, U.email
FROM 	utilizador U
		NATURAL JOIN   (SELECT 		reg_per_page.userid, (SUM(reg_per_page.n_reg) / MAX(page_per_user.n_pag)) as reg_average
						FROM 	   (SELECT 		P.userid, P.pagecounter, COUNT(*) as n_reg
									FROM		pagina P, reg_pag RP, registo R, tipo_registo T
									WHERE 		RP.userid = P.userid
												AND RP.pageid = P.pagecounter
												AND RP.userid = R.userid
												AND RP.regid = R.regcounter
												AND RP.typeid = R.typecounter
												AND RP.userid = T.userid
												AND RP.typeid = T.typecnt
												AND RP.ativa = true
												AND P.ativa = true
												AND R.ativo = true
												AND T.ativo = true
									GROUP BY 	P.userid, P.pagecounter) as reg_per_page
								
									NATURAL JOIN 	
									               (SELECT 		userid, COUNT(*) as n_pag
												 	FROM 		pagina 
												 	WHERE 		ativa = true
												 	GROUP BY	userid) as page_per_user

						GROUP BY 	reg_per_page.userid) as A2

WHERE averages.reg_average = (	SELECT		MAX(A2.reg_average)
								FROM   	   (SELECT 		reg_per_page.userid, (SUM(reg_per_page.n_reg) / MAX(page_per_user.n_pag)) as reg_average
											FROM 	   (SELECT 		P.userid, P.pagecounter, COUNT(*) as n_reg
														FROM		pagina P, reg_pag RP, registo R, tipo_registo T
														WHERE 		RP.userid = P.userid
																	AND RP.pageid = P.pagecounter
																	AND RP.userid = R.userid
																	AND RP.regid = R.regcounter
																	AND RP.typeid = R.typecounter
																	AND RP.userid = T.userid
																	AND RP.typeid = T.typecnt
																	AND RP.ativa = true
																	AND P.ativa = true
																	AND R.ativo = true
																	AND T.ativo = true
														GROUP BY 	P.userid, P.pagecounter) as reg_per_page
													
														NATURAL JOIN   (SELECT 		userid, COUNT(*) as n_pag
																	 	FROM 		pagina 
																	 	WHERE 		ativa = true
																	 	GROUP BY	userid) as page_per_user

											GROUP BY 	reg_per_page.userid) as A2);

						





