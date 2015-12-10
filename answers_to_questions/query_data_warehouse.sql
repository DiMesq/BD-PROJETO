# Get the average of login attempts for all Portuguese users, in each category, with rollup for year and month

SELECT 	(SUM(reading) / MAX(utiliz_pt_count)) as average, date_year, month_number, categoria
FROM 	d_tempo
		NATURAL JOIN login_readings
		NATURAL JOIN d_utilizador,
	   (SELECT 	COUNT(*) as utiliz_pt_count
	   	FROM 	d_utilizador
	   	WHERE 	pais = "Hong Kong") as utiliz_pt
WHERE 	pais = "Hong Kong"
GROUP BY date_year, month_number, categoria WITH ROLLUP;

