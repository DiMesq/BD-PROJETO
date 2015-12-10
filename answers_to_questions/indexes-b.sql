# Assuming the following query is executed very often, create an index to optimize it.
#
# b) Get the name of the notes associated to a certain page of a user

	# Primeiro dizer que esta questão nos pareceu um pouco ambígua, daí termos feito a
	# seguinto suposição: a query que se visa otimizar é para um utilizador específico
	# que se especifíca através do seu userid e a página para a qual queremos determinar
	# o nome dos registos também é uma página específica deste user que é determinada
	# pelo seu pageid. Optámos por tomar esta suposião em vez de outra qualquer, pois 
	# pareceu-nos a que tinha um maior sentido prático. Numa aplicação bloco de notas
	# terá que se ir buscar com muita frequência o nome dos registos de uma página de um
	# determinado utilizador para depois lhe ser possível exibi-los. Aliás essa query -
	# que está concretamente implementada abaixo - é executada na aplicação 
	# por nós desenvolvida. 
	#
	# Posto isto, em teoria, criar um índice sobre as colunas userid e pageid em conjunto -
	# CREATE INDEX page_idx ON reg_pag (userid, pageid) - traria melhoria na velocidade 
	# de execução desta query, visto que estamos a selecionar as linhas da tabela reg_pag 
	# por estes dois atributos. Para além disso, usar um índice hash-based também contribuiria 
	# para otimizar a query, pois a especificação das linhas na WHERE clause é feita por igualdade.
	# Mais ainda, o índice deveria ser denso, desde já porque as entradas da tabela reg_pag não 
	# estão agrupadas por (userid, pageid) o que torna a implementação de um índice esparso mais complicada
	# e, por outro lado, porque um índice deste tipo (denso) é mais eficiente para queries de lookup
	# em comparação com um índice do tipo esparso, que funciona melhor para updates por exemplo.
	# No entanto, na prática para nós, que usamos o MySQL e o InnoDB como storage engine, as otimizações que
	# falei podem não melhorar o desempenho da query. Num caso porque já estão implementadas, noutro porque 
	# não são suportadas, como referido na alínea anterior. Concretamente: o MySQL não suporta índices
	# hash-based logo essa otimização não pode ser testada experimentalmente; o InnoDB requer um índice
	# para o conjunto de atributos presente numa restrição de foreign key e cria-o automaticamente 
	# se este não tiver sido especificado. Como (userid, pageid) tem uma restrição de foreign key na tabela
	# reg_pag referenciando a tabela pagina, o índice (userid, pageid) que mencionamos já está 
	# implementado à partida, otimizando a query sem ser necessário criá-lo de forma explícita.
	#
	# Para demonstrar o resultado da otimização referida escolhemos ao acaso, de entre 
	# as páginas com registos, uma página de um determinado utilizador, para ser usada na especificação.
	# Pelas razões mencionadas, entre outras, é expectável que não se obtenham melhoramentos consideráveis.

SET profiling = 1;

SELECT 	R.nome
FROM 	registo R INNER JOIN reg_pag RP
			ON (R.userid = RP.userid 
				AND R.typecounter = RP.typeid 
				AND R.regcounter = RP.regid)
WHERE 	RP.userid = 2462 AND RP.pageid = 91867;

CREATE INDEX page_idx ON reg_pag (userid, pageid); 

SELECT 	R.nome
FROM 	registo R INNER JOIN reg_pag RP
			ON (R.userid = RP.userid 
				AND R.typecounter = RP.typeid 
				AND R.regcounter = RP.regid)
WHERE 	RP.userid = 2462 AND RP.pageid = 91867;

show profiles;
