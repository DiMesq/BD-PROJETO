# 1 - What users failed the login more times than they succeded? (we want all users)
SELECT 	U.userid, U.nome, U.email
FROM	(	# get the number of failed logins for each user
			SELECT 		L.userid, COUNT(*) AS n_fails
			FROM		Login L
			WHERE		L.sucesso = false
			GROUP BY	L.userid
		) as fails 

		NATURAL JOIN (
			# get the total number of logins
			SELECT		L2.userid, COUNT(*) AS n_logins
			FROM 		login L2
			GROUP BY	L2.userid
		) as totals 

		NATURAL JOIN utilizador U

WHERE 	2 * fails.n_fails > totals.n_logins;

# 1 - também para a pergunta 1 - mas não funciona, não sei porquê
SELECT 	U.userid, U.nome, U.email
FROM 	utilizador U
WHERE 	(2 * (SELECT COUNT(*)
			  FROM 	 login L
			  WHERE  L.userid = U.userid 
			 		 AND L.sucesso = false
			)) > (
			 SELECT	COUNT(*)
			 FROM login L2
			 WHERE L2.userid = U.userid
			);
