-- MySQL dump 10.13  Distrib 5.5.57, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: documentos
-- ------------------------------------------------------
-- Server version	5.5.57-0+deb8u1

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
-- Table structure for table `cargos`
--

DROP TABLE IF EXISTS `cargos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `carga_horaria` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10000 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargos`
--

LOCK TABLES `cargos` WRITE;
/*!40000 ALTER TABLE `cargos` DISABLE KEYS */;
INSERT INTO `cargos` VALUES (1,'Professor',60),(2,'Estagiário',30),(3,'Servidor',40),(9999,'Genérico',0);
/*!40000 ALTER TABLE `cargos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `datas_especiais`
--

DROP TABLE IF EXISTS `datas_especiais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `datas_especiais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `fk_funcionario` int(11) NOT NULL,
  `fk_tipo_ocorrencia` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_datas_especiais_funcionarios1_idx` (`fk_funcionario`),
  KEY `fk_datas_especiais_tipo_ocorrencia1_idx` (`fk_tipo_ocorrencia`),
  CONSTRAINT `fk_datas_especiais_funcionarios1` FOREIGN KEY (`fk_funcionario`) REFERENCES `funcionarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_datas_especiais_tipo_ocorrencia1` FOREIGN KEY (`fk_tipo_ocorrencia`) REFERENCES `tipo_ocorrencia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datas_especiais`
--

LOCK TABLES `datas_especiais` WRITE;
/*!40000 ALTER TABLE `datas_especiais` DISABLE KEYS */;
INSERT INTO `datas_especiais` VALUES (13,'2017-09-07',1,26),(14,'2017-09-07',2,26),(15,'2017-09-07',3,26),(16,'2017-09-07',4,26),(17,'2017-09-07',5,26),(18,'2017-09-07',7,26),(19,'2017-09-07',9,26),(20,'2017-08-01',10,11),(21,'2017-08-02',10,11),(22,'2017-08-03',10,11),(23,'2017-08-04',10,11),(24,'2017-08-05',10,11),(25,'2017-08-06',10,11),(26,'2017-08-07',10,11),(27,'2017-08-08',10,11),(28,'2017-08-09',10,11),(29,'2017-08-10',10,11),(30,'2017-08-11',10,11),(31,'2017-08-12',10,11),(32,'2017-08-13',10,11),(33,'2017-08-14',10,11),(34,'2017-08-15',10,11),(35,'2017-08-16',10,11),(36,'2017-08-17',10,11),(37,'2017-08-18',10,11),(38,'2017-08-19',10,11),(39,'2017-08-20',10,11),(40,'2017-08-21',10,11),(41,'2017-09-07',1,26),(42,'2017-09-07',2,26),(43,'2017-09-07',3,26),(44,'2017-09-07',4,26),(45,'2017-09-07',5,26),(46,'2017-09-07',7,26),(47,'2017-09-07',9,26),(48,'2017-09-07',10,26);
/*!40000 ALTER TABLE `datas_especiais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `funcionarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `matricula_fub` varchar(45) DEFAULT NULL,
  `matricula_siape` varchar(45) DEFAULT NULL,
  `periodo_inicio` date DEFAULT NULL,
  `periodo_fim` date DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fim` time DEFAULT NULL,
  `cargo_especifico` varchar(255) DEFAULT NULL,
  `is_supervisor` tinyint(1) NOT NULL,
  `fk_lotacao` int(11) NOT NULL,
  `fk_cargo` int(11) NOT NULL,
  `fk_supervisor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_funcionarios_lotacao1_idx` (`fk_lotacao`),
  KEY `fk_funcionarios_cargo1_idx` (`fk_cargo`),
  KEY `fk_funcionarios_funcionarios1_idx` (`fk_supervisor`),
  CONSTRAINT `fk_cargo` FOREIGN KEY (`fk_cargo`) REFERENCES `cargos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_funcionarios` FOREIGN KEY (`fk_supervisor`) REFERENCES `funcionarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lotacao` FOREIGN KEY (`fk_lotacao`) REFERENCES `lotacao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionarios`
--

LOCK TABLES `funcionarios` WRITE;
/*!40000 ALTER TABLE `funcionarios` DISABLE KEYS */;
INSERT INTO `funcionarios` VALUES (1,'Luís Claudio Machado Junior','123456','123456',NULL,NULL,NULL,NULL,'Técnico de Tecnologia da Informação',1,1,3,5),(2,'Christian Luis Marcondes Costa',NULL,NULL,'2017-04-03','2017-10-03','08:00:00','14:00:00',NULL,0,1,2,1),(3,'José Valdy Campelo Júnior',NULL,NULL,'2017-07-05','2018-07-05','08:00:00','14:00:00',NULL,0,3,2,1),(4,'Camila Imbuzeiro Camargo',NULL,NULL,'2017-05-09','2019-05-09','08:00:00','14:00:00',NULL,0,2,2,9),(5,'Marcos Fagundes Caetano','109140945242','42452452',NULL,NULL,NULL,NULL,NULL,1,1,3,NULL),(7,'Aline dos Santos Pereira',NULL,NULL,'2017-03-19','2017-09-19','12:00:00','18:00:00',NULL,0,1,2,1),(9,'Leandro Tavares Correia','109140945243','42452453',NULL,NULL,NULL,NULL,NULL,1,2,3,NULL),(10,'Mariana Rodrigues Makiuchi',NULL,NULL,'2017-08-22','2019-08-22','12:00:00','18:00:00',NULL,0,1,2,1);
/*!40000 ALTER TABLE `funcionarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lotacao`
--

DROP TABLE IF EXISTS `lotacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lotacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sigla` varchar(10) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `codigo` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lotacao`
--

LOCK TABLES `lotacao` WRITE;
/*!40000 ALTER TABLE `lotacao` DISABLE KEYS */;
INSERT INTO `lotacao` VALUES (1,'CIC','Departamento de Ciência da Computação',116),(2,'EST','Departamento de Estatística',NULL),(3,'PPCA','Programa de Pós-Graduação em Computação Avançada',NULL);
/*!40000 ALTER TABLE `lotacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ocorrencias`
--

DROP TABLE IF EXISTS `ocorrencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ocorrencias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `fk_tipo_ocorrencia` int(11) NOT NULL,
  `fk_funcionario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ocorrencia_tipo_ocorrencia_idx` (`fk_tipo_ocorrencia`),
  KEY `fk_ocorrencias_funcionarios1_idx` (`fk_funcionario`),
  CONSTRAINT `fk_ocorrencias_funcionarios1` FOREIGN KEY (`fk_funcionario`) REFERENCES `funcionarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ocorrencia_tipo_ocorrencia` FOREIGN KEY (`fk_tipo_ocorrencia`) REFERENCES `tipo_ocorrencia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ocorrencias`
--

LOCK TABLES `ocorrencias` WRITE;
/*!40000 ALTER TABLE `ocorrencias` DISABLE KEYS */;
INSERT INTO `ocorrencias` VALUES (1,'2017-08-01','2017-08-21',11,10);
/*!40000 ALTER TABLE `ocorrencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_ocorrencia`
--

DROP TABLE IF EXISTS `tipo_ocorrencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_ocorrencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sigla` varchar(10) DEFAULT NULL,
  `descricao` varchar(255) NOT NULL,
  `cargo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tipo_ocorrencia_cargo1_idx` (`cargo_id`),
  CONSTRAINT `fk_tipo_ocorrencia_cargo1` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_ocorrencia`
--

LOCK TABLES `tipo_ocorrencia` WRITE;
/*!40000 ALTER TABLE `tipo_ocorrencia` DISABLE KEYS */;
INSERT INTO `tipo_ocorrencia` VALUES (1,NULL,'Recesso (Lei Nº 11.788, art. 13)',2),(2,NULL,'Atestado médico (*)',2),(3,NULL,'Atestado escolar (*)',2),(4,NULL,'Outras faltas justificadas (*)',2),(5,NULL,'Horário reduzido para avaliação escolar (*)',2),(6,NULL,'Dispensa de ponto pelo supervisor',2),(7,NULL,'Falta compensada em outro dia',2),(8,NULL,'Feriado/ponto facultativo',2),(9,NULL,'Falta não-justificada',2),(10,NULL,'Rescisão (Desligamento)',2),(11,NULL,'Outros (**)',2),(12,'LCO','Licença c/ Ônus',3),(13,'LM','Licença médica',3),(14,'LSO','Licença s/ Ônus',3),(15,'LE','Licença Especial',3),(16,'LG','Licença Gestante',3),(17,'LC','Licença Capacitação',3),(18,'FE','Férias',3),(19,'FA','Faltas',3),(20,'FP','Folga Plantão',3),(21,'Gr','Greve',3),(22,'Pr','Paralização',3),(23,'Dt','Dedetização',3),(26,NULL,'Feriado',9999),(27,NULL,'Ponto facultativo',9999);
/*!40000 ALTER TABLE `tipo_ocorrencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'apoio','apoiocic@gmail.com','$2y$10$6NkprhXNECaiROVg6xk.J.3lc6llbnssDpBJPfpDHao9ak.Zsj0Ku','3Fln038aMGiAAQlIMVVzLsKf59NR1lxl5uEvovZ09bkljiTfaIHvojfU3ch6','2017-06-07 15:12:47','2017-06-07 15:12:47'),(2,'Caio Oliveira','caiomcoliveira@gmail.com','$2y$10$Xnrasz8ZnwTRAzQRV4Y.OO8E425TmGBRJwRT20f.MHVJ0pBJ6Ko.C',NULL,'2017-07-20 18:28:26','2017-07-20 18:28:26');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-06 13:06:24
