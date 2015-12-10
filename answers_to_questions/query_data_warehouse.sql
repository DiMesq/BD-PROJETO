SELECT 	(SUM(reading) / MAX(utiliz_pt_count)) as average, date_year, month_number, categoria
FROM 	d_tempo
		NATURAL JOIN login_readings
		NATURAL JOIN d_utilizador,
	   (SELECT 	COUNT(*) as utiliz_pt_count
	   	FROM 	d_utilizador
	   	WHERE 	pais = "União Europeia") as utiliz_pt
WHERE 	pais = "União Europeia"
GROUP BY date_year, month_number, categoria WITH ROLLUP;