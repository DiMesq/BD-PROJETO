# Assuming the following queries are executed very often, create indexes that speed them up.
#
# a) Get the average of the number of notes per page of a certain user 

#CREATE INDEX page_idx ON reg_pag(userid, pageid);

SELECT 		U.userid, U.nome, U.email, AVG(reg_count.n_reg) as average_reg
FROM 		utilizador U  
			NATURAL JOIN   (SELECT 		RP.userid, RP.pageid, COUNT(*) as n_reg
							FROM 		reg_pag RP
							GROUP BY	RP.userid, RP.pageid
			) as reg_count
GROUP BY	U.userid;

# b) Get the name of the notes associated to a certain page of a user