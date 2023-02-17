-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: ciutat_agora
-- ------------------------------------------------------
-- Server version	5.6.51

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `autors`
--

DROP TABLE IF EXISTS `autors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `autors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) DEFAULT NULL,
  `imatge` varchar(200) DEFAULT NULL,
  `resum` varchar(2000) DEFAULT NULL,
  `text` text,
  `web` varchar(2000) DEFAULT NULL,
  `facebook` varchar(2000) DEFAULT NULL,
  `twitter` varchar(2000) DEFAULT NULL,
  `instagram` varchar(2000) DEFAULT NULL,
  `youtube` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=179 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autors`
--

LOCK TABLES `autors` WRITE;
/*!40000 ALTER TABLE `autors` DISABLE KEYS */;
INSERT INTO `autors` (`id`, `nom`, `imatge`, `resum`, `text`, `web`, `facebook`, `twitter`, `instagram`, `youtube`) VALUES
                                                                                                                        (176,	'Alejandro Palomas',	'/docs/ciutat_agora/autors/foto_promo.jpg',	'',	'<p>Alejandro Palomas (Barcelona, 1967). Llicenciat en Filologia Anglesa i m&agrave;ster en Po&egrave;tica pel New College de Calif&ograve;rnia a San Francisco. Ha compaginat &nbsp;el periodisme amb la traducci&oacute; d&rsquo;autors importants i amb la poesia (<em>Quiero</em> i <em>Una flor</em>). Entre altres, ha publicat les novel&middot;les <em>El temps que ens uneix</em> i, recentment, <em>Un pa&iacute;s amb el teu nom</em>. El 2016 va rebre el Premi Joaquim Ruyra per <em>Un fill,</em> la seq&uuml;ela del qual, <em>Un secret</em>, es va publicar el 2019. L&rsquo;exitosa trilogia d&rsquo;<em>Una mare</em>, <em>Un gos</em> i <em>Un amor</em> (Premi Nadal 2018) retrata una fam&iacute;lia que ha enamorat milers de lectors. L&rsquo;obra ha estat portada al cinema i al teatre i s&rsquo;ha tradu&iuml;t a m&eacute;s de vint lleng&uuml;es.&nbsp;</p>',	'',	'',	'',	'',	''),
                                                                                                                        (177,	'José A. Mesa',	'/docs/ciutat_agora/autors/jose_a._mesaav.jpg',	'Secretari Internacional d\'Educació de la Companyia de Jesús ',	'<p>Secretari Internacional d\'Educaci&oacute; de la Companyia de Jes&uacute;s (secund&agrave;ria i&nbsp;presecund&agrave;ria), con sede en Roma, y responsable de la animaci&oacute;n y coordinaci&oacute;n de la red global de escuelas jesuitas. Adem&aacute;s, es profesor invitado en la Universidad de Loyola (Chicago), en las &aacute;reas de Filosof&iacute;a de la Educaci&oacute;n y Pedagog&iacute;a Ignaciana.</p>',	'',	'',	'',	'',	''),
                                                                                                                        (178,	'Pepe Menéndez',	'/docs/ciutat_agora/autors/pepe_menendezok.jpg',	'',	'<p><strong>Exdirectiu Jesu&iuml;tes&nbsp;Educaci&oacute; i assessor internacional d\'educaci&oacute;</strong></p>',	'http://pepemenendez.cat ',	'',	'',	'',	'');
/*!40000 ALTER TABLE `autors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projectes`
--

DROP TABLE IF EXISTS `projectes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projectes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(2000) DEFAULT NULL,
  `resum` varchar(2000) DEFAULT NULL,
  `text` text,
  `web` varchar(45) DEFAULT NULL,
  `imatge` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projectes`
--

LOCK TABLES `projectes` WRITE;
/*!40000 ALTER TABLE `projectes` DISABLE KEYS */;
INSERT INTO `projectes` VALUES (3,'Cosmògraf','','<p>&Eacute;s un espai de reflexi&oacute; i pensament a l\'entorn de temes clau per a fomentar el pensament cr&iacute;tic en la ciutadania. El cicle t&eacute; pres&egrave;ncia de ponents internacionals i busca la implicaci&oacute; de diferents institucions en l\'&agrave;mbit del coneixement (universitats, centres de pensament contemporani, centres culturals i ciutats).&nbsp;</p>\n<p>El cicle Cosm&ograve;graf va acompanyat d\'accions formatives adre&ccedil;ades a l\'alumnat de la ciutat, es vincula amb les accions de sensibilitzaci&oacute; ciutadana de l\'<a href=\"http://www.manresa.cat/web/menu/9541-agenda-2030-i-objectius-de-desenvolupament-sostenible-(ods)-a-manresa\">Agenda 2030</a>&nbsp;i forma part del projecte global&nbsp;Ciutat &Agrave;gora. Una finestra al m&oacute;n per a uns programes anuals en l\'&agrave;mbit de la divulgaci&oacute; del coneixement i el pensament..</p>\n<p>&nbsp;</p>','http://www.manresacultura.cat/cosmograf','/docs/ciutat_agora/projectes/cosmograf_1.jpg'),(5,'Tocats de Lletra','','<p>El Tocats de Lletra &eacute;s un festival po&egrave;tic i literari organitzat conjuntament per l&rsquo;Ajuntament de Manresa, el Gremi de Llibreters de Catalunya, &Ograve;mnium Cultural Bages-Moian&eacute;s i un munt d&rsquo;entitats de la ciutat vinculades a l&rsquo;&agrave;mbit cultural i literari. Es celebra cada mes d&rsquo;octubre a Manresa, on durant deu dies es programen una quarantena d&rsquo;actes po&egrave;tics i literaris en diferents espais de la ciutat.</p>','https://tocatsdelletra.cat/','/docs/ciutat_agora/projectes/tocats_de_lletra.jpg'),(6,'Pessics de Vida','','<p>Cicle mensual en el que s&rsquo;entrevista a un personatge rellevant per la seva traject&ograve;ria vital i professional. Est&agrave; organitzat pel Centre Cultural el Casino i la <a href=\"https://www.periodistes.cat/home/catalunya-central\">Demarcaci&oacute; de la Catalunya Central del Col&middot;legi de Periodistes de Catalunya.</a></p>','','/docs/ciutat_agora/projectes/pessics_de_vida.jpg'),(7,'Pessics de Saviesa','','<p>Cicle anual de quatre confer&egrave;ncies en el que es desenvolupa i es dialoga sobre un tema concret. Est&agrave; organitzat pel Centre Cultural el Casino i el <a href=\"https://blocs.xtec.cat/filocatcentral/\">Grup de Professors de Filosofia de la Catalunya Central.</a></p>','','/docs/ciutat_agora/projectes/pessics_de_saviesa.jpg'),(11,'Ignàgora','','<p>El projecte Ign&agrave;gora &eacute;s un espai de reflexi&oacute; i aprofundiment en la figura de Sant Ignasi i de la influ&egrave;ncia dels valors ignasians en la societat actual, i de com aquests poden contribuir en el lideratge i el governament dels diversos &agrave;mbits de les ciutats, les empreses i l&rsquo;educaci&oacute; del futur.&nbsp;</p>\n<p>Aquest cicle de xerrades i pon&egrave;ncies est&agrave; promogut per Manresa 2022, l&rsquo;Ajuntament de Manresa i la Fundaci&oacute; La Cova.</p>','','/docs/ciutat_agora/projectes/ignagora.jpg'),(14,'Altres','','<p>Aquest espai ofereix les propostes singulars que no responen a un projecte concret dins de la programaci&oacute; estable de continguts de la ciutat</p>','','/docs/ciutat_agora/projectes/altres.jpg'),(15,'Diàlegs educatius','','<p>Els &ldquo;di&agrave;legs educatius&rdquo; s&rsquo;emmarquen en el programa &Agrave;gora Educaci&oacute; 2022 que ha tirat endavant UManresa d&rsquo;acord amb l&rsquo;Ajuntament dins del projecte vinculat als 500 anys de l&rsquo;estada d&rsquo;Ignasi de Loiola a la ciutat. Els di&agrave;legs han estat un espai de reflexi&oacute; a l&rsquo;entorn de l&rsquo;educaci&oacute; amb la participaci&oacute; de m&eacute;s de 20 ponents molt plurals, persones tant de l&rsquo;&agrave;mbit escolar com de diversos altres &agrave;mbits socials.</p>','','/docs/ciutat_agora/projectes/dialegs_educatiusok.jpg');
/*!40000 ALTER TABLE `projectes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temes`
--

DROP TABLE IF EXISTS `temes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tema` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temes`
--

LOCK TABLES `temes` WRITE;
/*!40000 ALTER TABLE `temes` DISABLE KEYS */;
INSERT INTO `temes` VALUES (1,'Creació'),(2,'Ciència'),(3,'Pensament'),(4,'Espiritualitat'),(5,'Literatura'),(6,'Memòria'),(7,'Entrevista'),(8,'Salut'),(9,'Sostenibilitat'),(10,'Tecnologia'),(11,'Art'),(12,'Educació');
/*!40000 ALTER TABLE `temes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) DEFAULT NULL,
  `url_video` varchar(200) DEFAULT NULL,
  `imatge_h` varchar(200) DEFAULT NULL,
  `imatge_v` varchar(200) DEFAULT NULL,
  `resum` varchar(2000) DEFAULT NULL,
  `text` text,
  `destacat` tinyint(4) DEFAULT NULL,
  `ordre` int(11) DEFAULT NULL,
  `url_subtitols` varchar(2000) DEFAULT NULL,
  `url_podcast` varchar(2000) DEFAULT NULL,
  `url_versio_original` varchar(2000) DEFAULT NULL,
  `id_projecte` int(11) DEFAULT NULL,
  `durada` varchar(200) DEFAULT NULL,
  `data_video` date DEFAULT NULL,
  `url_versio_eng` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_videos_1_idx` (`id_projecte`),
  CONSTRAINT `fk_videos_1` FOREIGN KEY (`id_projecte`) REFERENCES `projectes` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos`
--

LOCK TABLES `videos` WRITE;
/*!40000 ALTER TABLE `videos` DISABLE KEYS */;
INSERT INTO `videos` (`id`, `nom`, `url_video`, `imatge_h`, `imatge_v`, `resum`, `text`, `destacat`, `ordre`, `url_subtitols`, `url_podcast`, `url_versio_original`, `id_projecte`, `durada`, `data_video`, `url_versio_eng`) VALUES
(118,	'Microscopies Manresa 2022',	' https://www.youtube.com/watch?v=4lrjNbqzgUw',	'/docs/ciutat_agora/videos/microscopies.jpg',	'/docs/ciutat_agora/videos/micros_1.jpg',	' Itinerari d’art de l’Anella Verda de Manresa',	'<p>Un itinerari pels entorns de la Torre Lluvi&agrave;, amb intervencions art&iacute;stiques permanents i ef&iacute;meres recollint experi&egrave;ncies de Land Art.</p>',	0,	3,	'',	'',	'',	14,	'05:26:00',	'2022-08-26',	NULL),
(119,	'Pessics de vida amb Alejandro Palomas',	'https://www.youtube.com/watch?v=fo7A73SJ89M',	'/docs/ciutat_agora/videos/palomasok.jpg',	'/docs/ciutat_agora/videos/palomasv.jpg',	'Entrevista en profunditat sobre la vida personal i professional de Alejandro Palomas',	'<p>Alejandro Palomas (Barcelona, 1967). Llicenciat en Filologia Anglesa i m&agrave;ster en Po&egrave;tica pel New College de Calif&ograve;rnia a San Francisco. Ha compaginat &nbsp;el periodisme amb la traducci&oacute; d&rsquo;autors importants i amb la poesia (<em>Quiero</em> i <em>Una flor</em>). Entre altres, ha publicat les novel&middot;les <em>El temps que ens uneix</em> i, recentment, <em>Un pa&iacute;s amb el teu nom</em>. El 2016 va rebre el Premi Joaquim Ruyra per <em>Un fill,</em> la seq&uuml;ela del qual, <em>Un secret</em>, es va publicar el 2019. L&rsquo;exitosa trilogia d&rsquo;<em>Una mare</em>, <em>Un gos</em> i <em>Un amor</em> (Premi Nadal 2018) retrata una fam&iacute;lia que ha enamorat milers de lectors. L&rsquo;obra ha estat portada al cinema i al teatre i s&rsquo;ha tradu&iuml;t a m&eacute;s de vint lleng&uuml;es.&nbsp;</p>',	0,	2,	'',	'',	'',	6,	'1:21:01',	'2023-01-25',	''),
(120,	'Vigència de la pedagogia Ignasiana',	'https://www.youtube.com/watch?v=s40ugG0oXCw&t=23s',	'/docs/ciutat_agora/videos/vigenciaok.jpg',	'/docs/ciutat_agora/videos/vigencia_de_la_pedagogia_ignasianavp.jpg',	'La pedagogia dels jesuïtes ha estat un referent des del seu naixement fa 500 anys, a la vegada que ha influït profundament en la creació de sistemes educatius arreu del món.',	'<p>La pedagogia dels jesu&iuml;tes ha estat un referent des del seu naixement fa 500 anys, a la vegada que ha influ&iuml;t profundament en la creaci&oacute; de sistemes educatius arreu del m&oacute;n. El paradigma pedag&ograve;gic ignasi&agrave; arrela en la proposta educativa dels exercicis espirituals de Sant Ignasi, escrits a Manresa, i viu processos d&rsquo;actualitzaci&oacute; al costat dels canvis pedag&ograve;gics i pol&iacute;tics d&rsquo;arreu. El di&agrave;leg se centrar&agrave; en la vig&egrave;ncia d\'aquesta pedagogia, des de l&rsquo;experi&egrave;ncia pr&agrave;ctica de Jos&eacute; Alberto Mesa, jesu&iuml;ta i secretari d\'educaci&oacute; de la&nbsp;&nbsp;xarxa global d&rsquo;escoles jesu&iuml;tes i professor convidat a la Loyola University de Chicago a les &agrave;rees de Filosofia de l\'Educaci&oacute; i Pedagogia Ignasiana, i en Pepe Men&eacute;ndez, amb una llarga experi&egrave;ncia com a professor de secund&agrave;ria, director d\'escola i directiu a la xarxa Jesu&iuml;tes Educaci&oacute;, i actualment assessor internacional d\'educaci&oacute;.</p>\n<p>&nbsp;</p>',	0,	1,	'',	'',	'',	15,	'1:19:09',	'2023-01-19',	'');
/*!40000 ALTER TABLE `videos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videos_autors`
--

DROP TABLE IF EXISTS `videos_autors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `videos_autors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_video` int(11) DEFAULT NULL,
  `id_autor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_videos_autors_1_idx` (`id_video`),
  KEY `fk_videos_autors_2_idx` (`id_autor`),
  CONSTRAINT `fk_videos_autors_1` FOREIGN KEY (`id_video`) REFERENCES `videos` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_videos_autors_2` FOREIGN KEY (`id_autor`) REFERENCES `autors` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=205 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos_autors`
--

LOCK TABLES `videos_autors` WRITE;
/*!40000 ALTER TABLE `videos_autors` DISABLE KEYS */;
INSERT INTO `videos_autors` (`id`, `id_video`, `id_autor`) VALUES
(198,	119,	176),
(199,	120,	178),
(200,	120,	177);
/*!40000 ALTER TABLE `videos_autors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videos_documents`
--

DROP TABLE IF EXISTS `videos_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `videos_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_video` int(11) DEFAULT NULL,
  `nom_document` text,
  `url_document` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos_documents`
--

LOCK TABLES `videos_documents` WRITE;
/*!40000 ALTER TABLE `videos_documents` DISABLE KEYS */;
INSERT INTO `videos_documents` VALUES (1,60,'Propostes de treball País Petit 2022','/docs/ciutat_agora/documents/mca_propostes_treball_pais_petit.pdf'),(2,86,'Propostes de treball Llengua, societat i escola','/docs/ciutat_agora/documents/mca_propostes_treball_llengua_societat_escola.pdf'),(3,67,'Propostes de treball La religió i l\'espiritualitat com a motor de transformació CAT','/docs/ciutat_agora/documents/mca_pla_treball_religio_espiritualitat_cat.pdf'),(4,67,'Didactic proposals Roundtable discussion entitled Religion and spirituality as drivers of transformation','/docs/ciutat_agora/documents/mca_pla_treball_religio_espiritualitat_eng.pdf'),(5,69,'Propostes de treball Urbanisme feminista. Posar les vides en el centre CAT','/docs/ciutat_agora/documents/mca_pla_treball_urbanisme_feminista_cat.pdf'),(6,69,'Didactic proposals The dialogue entitled Feminist urban planning, putting lives at the centre','/docs/ciutat_agora/documents/mca_pla_treball_urbanisme_feminista_eng.pdf'),(7,95,'Propostes de treball Eines digitals: ús i addicció','/docs/ciutat_agora/documents/mca_propostes_treball_us_i_addiccions.pdf');
/*!40000 ALTER TABLE `videos_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videos_temes`
--

DROP TABLE IF EXISTS `videos_temes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `videos_temes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tema` int(11) DEFAULT NULL,
  `id_video` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_videos_temes_1_idx` (`id_tema`),
  KEY `fk_videos_temes_1_idx1` (`id_video`),
  CONSTRAINT `fk_videos_temes_1` FOREIGN KEY (`id_video`) REFERENCES `videos` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_videos_temes_2` FOREIGN KEY (`id_tema`) REFERENCES `temes` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos_temes`
--

LOCK TABLES `videos_temes` WRITE;
/*!40000 ALTER TABLE `videos_temes` DISABLE KEYS */;
INSERT INTO `videos_temes` (`id`, `id_tema`, `id_video`) VALUES
(199,	11,	118),
(200,	7,	119),
(201,	5,	119),
(202,	12,	120);/*!40000 ALTER TABLE `videos_temes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'ciutat_agora'
--

--
-- Dumping routines for database 'ciutat_agora'
--
/*!50003 DROP PROCEDURE IF EXISTS `ordenarVideos_p` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ciutat_agora`@`%` PROCEDURE `ordenarVideos_p`(var_tipus VARCHAR(1),var_ordre INT, var_id INT)
BEGIN
    DECLARE var_ordreOrig INTEGER;
    DECLARE var_idPareOrig INTEGER;
    DECLARE var_ordreExist INTEGER;
    
    -- segur que existeix, el busqeum nosaltres
	IF (var_tipus = 'D') THEN
		-- Tipus esborrar(DELETE)
		SELECT ordre INTO var_ordreOrig FROM videos WHERE id = var_id;
		UPDATE videos SET ordre = ordre - 1 WHERE ordre > var_ordreOrig;
	END IF;
    
	-- Mirem si la posicio exiteix
    SELECT count(1) INTO var_ordreExist FROM videos WHERE ordre = var_ordre;
    IF var_ordreExist > 0 THEN
		IF (var_tipus = 'U') THEN
			-- Tipus actualitzar(UPDATE)
			
			-- Busquem posicio inicial
			SELECT ordre INTO var_ordreOrig FROM videos WHERE id = var_id;
			
			IF (var_ordre > var_ordreOrig) THEN
				-- si hem mogut l'item per sota de la posicio incial pujem els items entre la posició original i la desti
				UPDATE videos SET ordre = ordre - 1 WHERE ordre > var_ordreOrig AND ordre <= var_ordre;
			ELSE
				-- si hem mogut l'item per sobre de la posicio incial baixem els items entre la posició original i la desti
				UPDATE videos SET ordre = ordre + 1 WHERE ordre < var_ordreOrig AND ordre >= var_ordre;
			END IF;
		END IF;

		IF (var_tipus = 'A') THEN
			-- tipus afegir(ADD)
			UPDATE videos SET ordre = ordre + 1 WHERE ordre >= var_ordre;
		END IF;
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-02-16 13:48:39
