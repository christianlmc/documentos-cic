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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datas_especiais`
--

LOCK TABLES `datas_especiais` WRITE;
/*!40000 ALTER TABLE `datas_especiais` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionarios`
--

LOCK TABLES `funcionarios` WRITE;
/*!40000 ALTER TABLE `funcionarios` DISABLE KEYS */;
INSERT INTO `funcionarios` VALUES (1,'Luís Claudio Machado Junior','123456','123456',NULL,NULL,NULL,NULL,1,1,3,5),(2,'Christian Luis Marcondes Costa',NULL,NULL,'2017-04-03','2017-10-03','08:00:00','14:00:00',0,1,2,1),(3,'José Valdy Campelo Júnior',NULL,NULL,'2017-07-05','2018-07-05','08:00:00','14:00:00',0,3,2,1),(4,'Camila Imbuzeiro Camargo',NULL,NULL,'2017-05-09','2019-05-09','08:00:00','14:00:00',0,2,2,9),(5,'Marcos Fagundes Caetano','109140945242','42452452',NULL,NULL,NULL,NULL,1,1,3,NULL),(7,'Aline dos Santos Pereira',NULL,NULL,'2017-03-19','2017-09-19','12:00:00','18:00:00',0,1,2,1),(9,'Leandro Tavares Correia','109140945243','42452453',NULL,NULL,NULL,NULL,1,2,3,NULL);
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
  `descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lotacao`
--

LOCK TABLES `lotacao` WRITE;
/*!40000 ALTER TABLE `lotacao` DISABLE KEYS */;
INSERT INTO `lotacao` VALUES (1,'CIC'),(2,'EST'),(3,'PPCA');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ocorrencias`
--

LOCK TABLES `ocorrencias` WRITE;
/*!40000 ALTER TABLE `ocorrencias` DISABLE KEYS */;
INSERT INTO `ocorrencias` VALUES (1,'1111-08-15','1111-08-15',13,1);
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
INSERT INTO `tipo_ocorrencia` VALUES (1,'Recesso',2),(2,'Atestado médico',2),(3,'Atestado escolar',2),(4,'Outras faltas justificadas',2),(5,'Horário reduzido para avaliação escolar',2),(6,'Dispensa de ponto pelo supervisor',2),(7,'Falta compensada em outro dia',2),(8,'Feriado/ponto facultativo',2),(9,'Falta não-justificada',2),(10,'Rescisão (Desligamento)',2),(11,'Outros',2),(12,'Licença c/ Ônus',3),(13,'Licença médica',3),(14,'Licença s/ Ônus',3),(15,'Licença Especial',3),(16,'Licença Gestante',3),(17,'Licença Capacitação',3),(18,'Férias',3),(19,'Faltas',3),(20,'Folga Plantão',3),(21,'Greve',3),(22,'Paralização',3),(23,'Dedetização',3),(26,'Feriado',9999),(27,'Ponto facultativo',9999);
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
INSERT INTO `users` VALUES (1,'apoio','apoiocic@gmail.com','$2y$10$6NkprhXNECaiROVg6xk.J.3lc6llbnssDpBJPfpDHao9ak.Zsj0Ku','pnBYD5QfKXfJYrJvnUqL77fjhvQJhdgkdWTlzeKOMfY7qAkDURv1mKaKMgH9','2017-06-07 15:12:47','2017-06-07 15:12:47'),(2,'Caio Oliveira','caiomcoliveira@gmail.com','$2y$10$Xnrasz8ZnwTRAzQRV4Y.OO8E425TmGBRJwRT20f.MHVJ0pBJ6Ko.C',NULL,'2017-07-20 18:28:26','2017-07-20 18:28:26');
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

-- Dump completed on 2017-08-21 11:11:00
