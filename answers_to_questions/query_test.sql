SELECT U.userid, U.email, U.password, P.nome
FROM utilizador U, pagina P
WHERE U.userid = P.userid
	  AND U.userid = (SELECT MIN(U2.userid)
						FROM utilizador U2, pagina P2
                        WHERE U2.userid= P2.userid 
                             AND P2.ativa = true);