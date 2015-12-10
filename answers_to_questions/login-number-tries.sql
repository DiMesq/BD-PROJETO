

--
-- Table structure for table `d_utilizador`
--

DROP TABLE IF EXISTS `d_utilizador`;
CREATE TABLE `d_utilizador` (
  `utilizador_id` INT(11) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `pais` VARCHAR(45) NOT NULL,
  `categoria` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`utilizador_id`)
  FOREIGN KEY (userid) REFERENCES utilizador (userid) 
);

--
-- Dumping data for table `d_utilizador`
--

LOCK TABLES `d_utilizador` WRITE;
INSERT INTO `d_utilizador` VALUES #TODO
UNLOCK TABLES;


--
-- Table structure for table `d_tempo`
--

DROP TABLE IF EXISTS `d_tempo`;
CREATE TABLE `d_tempo` (
  `date_id` int(11) NOT NULL,
  `date_year` int(11) NOT NULL,
  `month_number` int(11) NOT NULL,
  `month_day_number` int(11) DEFAULT '0',
  PRIMARY KEY (`date_id`)
) 


--
-- Dumping data for table `d_tempo`
--

LOCK TABLES `d_tempo` WRITE;
INSERT INTO `d_tempo` VALUES ##TODO
UNLOCK TABLES;

--
-- Table structure for table `login_readings`
--

DROP TABLE IF EXISTS `login_readings`;
CREATE TABLE `login_readings` (
  `date_id` int(11) NOT NULL,
  `utilizador_id` int(11) NOT NULL,
  `reading` int(11) NOT NULL,
  PRIMARY KEY (`utilizador_id`),
  FOREIGN KEY (`utilizador_id`) REFERENCES `d_utilizador`,
  FOREIGN KEY (`date_id`) REFERENCES `d_tempo`
) 

--
-- Dumping data for table `login_readings`
--

LOCK TABLES `login_readings` WRITE;
INSERT INTO `login_readings` VALUES #TODO
UNLOCK TABLES;

--
-- Table structure for table `time_dimension`
--
