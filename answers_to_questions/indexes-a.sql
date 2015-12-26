# Assuming the following query is executed very often, create an index to optimize it.
#
# a) Get the average of the number of notes per page of a certain user 
	# A operação mais demorada deste query centra-se em agrupar as entradas
	# da tabela reg_pag por userid e pageid. Dessa forma, uma forma de otimizar
	# esta query, em teoria, seria criar um índice na tabela reg_pag com esses dois 
	# atributos. A sintaxe da criação desse índice é: "CREATE INDEX page_idx ON reg_pag(userid, pageid);"
	# Mais, seria benéfico usar um índice hash-based, visto que a operação
	# GROUP BY realiza muitas seleções por igualdade.
	# Ainda de referir é que pelo facto da tabela página não estar agrupada por userid
	# e por pageid faz mais sentido usar-se um índice denso, até porque este torna a operação
	# SELECT mais rápida em comparação com um índice esparso.
	# No entanto, na prática estamos a usar o storage engine InnoDB para o MySQL. Por um lado, o MySQL
	# não suporta índices hash-based. Por outro lado, o InnoDB requer um índice para chaves estrangeiras 
	# e cria-o automaticamente se este não for especificado.
	# Por esse motivo, o índice que propomos criar já é criado
	# automaticamente pelo InnoDB pelo facto de os atributos (userid, pageid) na tabela reg_pag 
	# terem uma restrição de Foreign Key para a tabela pagina.
	# Assim, para a nossa demonstração, ao criar o índice não é espectável que se verifiquem melhorias 
	# no desempenho ao executar a query proposta.
	# Concluir apenas dizendo que a restrição Primary Key numa tabela também garante a existência 
	# de um índice sobre essa mesma chave e que no MySQL todos os subconjuntos ordenados de um índice 
	# também são automaticamente otimizados por esse índice. Logo, a criação de um índice sobre o userid
	# na tabela respetiva a cada um dos dois agrupamentos que são feitos sobre este atributo também não 
	# traria nenhum melhoramento em termos de tempo na otimização desta query.
	# 
	# Segue-se a experiência de criar o índice mencionado e verificar 
	# as diferenças de desempenho obtidas. Relembramos que pelas razões referidas, entre outras, não é 
	# expectável obter-se um melhoramento considerável.

SET profiling = 1;

SELECT 		U.userid, U.nome, U.email, SUM(reg_count.n_reg)/MAX(n_pag_user.n_pag) as average_reg
FROM 		utilizador U  
			NATURAL JOIN   (SELECT 		RP.userid, RP.pageid, COUNT(*) as n_reg
							FROM 		reg_pag RP
							GROUP BY	RP.userid, RP.pageid
			) as reg_count
			NATURAL JOIN (	SELECT		P.userid, COUNT(*) as n_pag
							FROM		pagina P
							GROUP BY 	P.userid
			) as n_pag_user

GROUP BY	U.userid;

CREATE INDEX page_idx ON reg_pag(userid, pageid);

SELECT 		U.userid, U.nome, U.email, SUM(reg_count.n_reg)/MAX(n_pag_user.n_pag) as average_reg
FROM 		utilizador U  
			NATURAL JOIN   (SELECT 		RP.userid, RP.pageid, COUNT(*) as n_reg
							FROM 		reg_pag RP
							GROUP BY	RP.userid, RP.pageid
			) as reg_count
			NATURAL JOIN (	SELECT		P.userid, COUNT(*) as n_pag
							FROM		pagina P
							GROUP BY 	P.userid
			) as n_pag_user

GROUP BY	U.userid;

SHOW profiles;


