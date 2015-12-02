# What are the users that have the biggest average of notes per page?
SELECT	U.nome, U.email
FROM 	utilizador U
		NATURAL JOIN   (SELECT 		counts.userid, AVG(counts.n_reg) as reg_average
						FROM 	   (SELECT 		RP.userid, RP.pageid, COUNT(*) as n_reg
									FROM		reg_pag RP
									GROUP BY 	RP.userid, RP.pageid) as counts
						GROUP BY 	counts.userid) as averages
WHERE averages.reg_average = (	SELECT	MAX(A2.reg_average)
								FROM   (SELECT 		counts.userid, AVG(counts.n_reg) as reg_average
										FROM 	   (SELECT 		RP.userid, RP.pageid, COUNT(*) as n_reg
													FROM		reg_pag RP
													GROUP BY 	RP.userid, RP.pageid) as counts
										GROUP BY 	counts.userid) as A2);





