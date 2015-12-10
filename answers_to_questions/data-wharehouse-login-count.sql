
--
-- Table structure for table `d_utilizador`
--

CREATE TABLE IF NOT EXISTS `d_utilizador` (
  `utilizador_id` INT(11) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `pais` VARCHAR(45) NOT NULL,
  `categoria` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`utilizador_id`)
);


--
-- Table structure for table `d_tempo`
--

CREATE TABLE IF NOT EXISTS `d_tempo` (
  `date_id` int(11) NOT NULL,
  `date_year` int(11) NOT NULL,
  `month_number` int(11) NOT NULL,
  `month_day_number` int(11) DEFAULT '0',
  PRIMARY KEY (`date_id`)
);

--
-- Table structure for table `login_readings`
--

CREATE TABLE IF NOT EXISTS `login_readings` (
  `date_id` int(11) NOT NULL,
  `utilizador_id` int(11) NOT NULL,
  `reading` int(11) NOT NULL,
  PRIMARY KEY (`date_id`, `utilizador_id`),
  FOREIGN KEY (`utilizador_id`) REFERENCES `d_utilizador` (`utilizador_id`),
  FOREIGN KEY (`date_id`) REFERENCES `d_tempo` (`date_id`)
);

--
-- Dumping data for table `d_utilizador`
--

LOCK TABLES `d_utilizador` WRITE, `utilizador` READ;
INSERT INTO `d_utilizador` (utilizador_id, email, nome, pais, categoria)  
SELECT  userid, email, nome, pais, categoria
FROM    utilizador;
UNLOCK TABLES;


--
-- Dumping data for table `d_tempo`
--

LOCK TABLES `d_tempo` WRITE, `login` READ;
INSERT INTO `d_tempo` (date_id, date_year, month_number, month_day_number)
SELECT  CONVERT (STR_TO_DATE(thedate, '%Y-%m-%d'), UNSIGNED INTEGER), 
        CONVERT (SUBSTRING_INDEX(thedate, '-', 1), UNSIGNED INTEGER), 
        CONVERT (SUBSTRING_INDEX(SUBSTRING_INDEX(thedate, '-', 2), '-', -1), UNSIGNED INTEGER),
        CONVERT (SUBSTRING_INDEX(SUBSTRING_INDEX(thedate, ' ', 1), '-', -1), UNSIGNED INTEGER)
FROM   (SELECT  DISTINCT (SUBSTRING_INDEX(moment, ' ', 1)) as thedate
        FROM    login) as L;
UNLOCK TABLES;


--
-- Dumping data for table `login_readings`
--

LOCK TABLES `login_readings` WRITE, `login` READ;
INSERT INTO `login_readings` (date_id, utilizador_id, reading)
SELECT  CONVERT (STR_TO_DATE(thedate, '%Y-%m-%d'), UNSIGNED INTEGER),
        userid, 
        COUNT(*)
FROM   (SELECT   userid, SUBSTRING_INDEX(moment, ' ', 1) as thedate
        FROM     login) as L
GROUP BY userid, thedate;
UNLOCK TABLES;



