SELECT U2.userid
FROM utilizador U2
WHERE U2.userid NOT IN(
SELECT U.userid
FROM utilizador U, pagina P
WHERE U.userid = P.userid);

SELECT 	MAX(P.pagecounter)
FROM 	pagina P
WHERE 	P.userid = 78