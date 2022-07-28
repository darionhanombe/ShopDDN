-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: localhost    Database: ShopDDN
-- ------------------------------------------------------
-- Server version	8.0.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `administrador`
--

DROP TABLE IF EXISTS `administrador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administrador` (
  `Admin_ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `User` varchar(20) NOT NULL,
  `Senha` varchar(80) NOT NULL,
  `Tipo` int DEFAULT '0',
  `Foto_Perfil` varchar(30) DEFAULT NULL,
  UNIQUE KEY `Admin_ID` (`Admin_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrador`
--

LOCK TABLES `administrador` WRITE;
/*!40000 ALTER TABLE `administrador` DISABLE KEYS */;
INSERT INTO `administrador` VALUES (1,'Dario','$2y$10$PcD85n1jXKK3ouO6IDSY2uN691v01WMZw7fmqIm3F0m5w8n2JUi9m',1,'62a8e96244823Dario.png'),(7,'DDN','$2y$10$nvbtyIfkjJekeKT1/by/Y.19C2tC1..S6Rf8H2LbcJ.yt7LH4FyJu',0,'62c30ad9a3b5fBbranca.png');
/*!40000 ALTER TABLE `administrador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bebidas`
--

DROP TABLE IF EXISTS `bebidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bebidas` (
  `Bebidas_ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Codigo` bigint NOT NULL,
  `Produto` varchar(30) NOT NULL,
  `Descricao` varchar(25) NOT NULL,
  `Preco` decimal(10,0) NOT NULL,
  `Imagem` varchar(30) DEFAULT NULL,
  `Validade` date NOT NULL,
  `Admin_FK` bigint unsigned NOT NULL,
  UNIQUE KEY `Bebida_ID` (`Bebidas_ID`),
  UNIQUE KEY `Bebidas_ID` (`Bebidas_ID`),
  KEY `Admin_FK` (`Admin_FK`),
  CONSTRAINT `bebidas_ibfk_1` FOREIGN KEY (`Admin_FK`) REFERENCES `administrador` (`Admin_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bebidas`
--

LOCK TABLES `bebidas` WRITE;
/*!40000 ALTER TABLE `bebidas` DISABLE KEYS */;
INSERT INTO `bebidas` VALUES (2,6222022052423701,'Jack Daniels Old','Whiskey, 1L',2500,'62b3342784c11JDaniels.webp','2022-09-30',1),(3,6222022052550973,'Vinho','Northon, 1L',980,'62b3347e42569Northon.webp','2022-09-22',1),(4,7242022104543920,'Mac-Mahon','Embalagem',680,'62ddcb97b77132m.webp','2022-09-30',1),(5,7242022104943955,'Heineken','Embalagem',380,'62ddcc8707362heineken.webp','2022-09-23',1),(6,7242022105248251,'Orla Maritima','Vinho Tinto',370,'62ddcd406699dvinho.webp','2022-12-17',1),(7,7242022105559506,'Txilar','Emabalagem a lata',240,'62ddcdff9bf17txilar.webp','2022-09-30',1);
/*!40000 ALTER TABLE `bebidas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carnes`
--

DROP TABLE IF EXISTS `carnes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carnes` (
  `Carnes_ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Codigo` bigint NOT NULL,
  `Produto` varchar(30) NOT NULL,
  `Descricao` varchar(25) NOT NULL,
  `Preco` decimal(10,0) NOT NULL,
  `Imagem` varchar(30) DEFAULT NULL,
  `Validade` date NOT NULL,
  `Admin_FK` bigint unsigned NOT NULL,
  UNIQUE KEY `Carne_ID` (`Carnes_ID`),
  UNIQUE KEY `Carnes_ID` (`Carnes_ID`),
  KEY `Admin_FK` (`Admin_FK`),
  CONSTRAINT `carnes_ibfk_1` FOREIGN KEY (`Admin_FK`) REFERENCES `administrador` (`Admin_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carnes`
--

LOCK TABLES `carnes` WRITE;
/*!40000 ALTER TABLE `carnes` DISABLE KEYS */;
INSERT INTO `carnes` VALUES (2,7012022015358134,'Carne de Porco','Fresca, 1KG',250,'62befc76f2b83carn1.webp','2022-09-30',1),(3,7012022015633407,'Carne de vaca','Fresca, 1KG',280,'62befd1150946carn5.webp','2022-09-29',1);
/*!40000 ALTER TABLE `carnes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carrinho`
--

DROP TABLE IF EXISTS `carrinho`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carrinho` (
  `Carrinho_ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Produtos` varchar(40) NOT NULL,
  `Descricao` varchar(30) NOT NULL,
  `Preco` decimal(10,0) NOT NULL,
  `Quantidade` int NOT NULL,
  `Contacto` int NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Pagamento` varchar(16) NOT NULL,
  `Subtotal` int NOT NULL,
  `Total` int NOT NULL,
  `NRConta` bigint DEFAULT NULL,
  `Email` varchar(60) DEFAULT NULL,
  `Endereco` varchar(40) NOT NULL,
  `Data` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Chave` int NOT NULL,
  `Status` int NOT NULL DEFAULT '0',
  `Cliente_FK` bigint unsigned DEFAULT NULL,
  UNIQUE KEY `Carrino_ID` (`Carrinho_ID`),
  UNIQUE KEY `Carrinho_ID` (`Carrinho_ID`),
  KEY `Cliente_FK` (`Cliente_FK`),
  CONSTRAINT `carrinho_ibfk_1` FOREIGN KEY (`Cliente_FK`) REFERENCES `cliente` (`Cliente_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrinho`
--

LOCK TABLES `carrinho` WRITE;
/*!40000 ALTER TABLE `carrinho` DISABLE KEYS */;
INSERT INTO `carrinho` VALUES (1,'Saco de Cebola','Roxa',400,1,846387041,'Dario ','M-Pesa',400,1620,NULL,'dnhanombe@gmail.com','Mozal','2022-07-24 17:21:30',52111330,0,NULL),(2,'Saco de Arroz','Feliz Familia, 25KG',1150,1,846387041,'Dario ','M-Pesa',1150,1620,NULL,'dnhanombe@gmail.com','Mozal','2022-07-24 17:21:30',52111330,0,NULL),(3,'Acucar','Brow Sugar, 1KG',70,1,846387041,'Dario ','M-Pesa',70,1620,NULL,'dnhanombe@gmail.com','Mozal','2022-07-24 17:21:30',52111330,0,NULL),(4,'Saco de Cebola','Roxa',400,1,846387041,'Dario ','M-Pesa',400,1620,NULL,'dnhanombe@gmail.com','Mozal','2022-07-24 17:22:44',52271044,0,NULL),(5,'Saco de Arroz','Feliz Familia, 25KG',1150,1,846387041,'Dario ','M-Pesa',1150,1620,NULL,'dnhanombe@gmail.com','Mozal','2022-07-24 17:22:44',52271044,0,NULL),(6,'Acucar','Brow Sugar, 1KG',70,1,846387041,'Dario ','M-Pesa',70,1620,NULL,'dnhanombe@gmail.com','Mozal','2022-07-24 17:22:44',52271044,0,NULL),(7,'Saco de Arroz','Feliz Familia, 25KG',1150,1,846387041,'DDN','M-Pesa',1150,1150,NULL,'jnhan@gmail.com','Mozal','2022-07-24 17:49:38',54968538,0,NULL),(8,'Saco de Batata','Roxa',480,5,846387041,'DDNhanombe','M-Pesa',2400,11200,NULL,'jnhanombe@gmail.com','Tsalala','2022-07-24 17:53:37',55397837,0,NULL),(9,'Saco de Cebola','Roxa',400,22,846387041,'DDNhanombe','M-Pesa',8800,11200,NULL,'jnhanombe@gmail.com','Tsalala','2022-07-24 17:53:38',55397837,0,NULL),(10,'Saco de Cebola','Roxa',400,1,846387041,'Dr DDN','M-Pesa',400,400,NULL,'jnha@gmail.com','Mozal','2022-07-24 17:54:13',55482513,0,NULL),(11,'Saco de Batata','Roxa',480,1,846387041,'Dario','M-Pesa',480,480,NULL,'jnhanombe@gmail.com','Maputo','2022-07-24 18:02:15',60226015,0,NULL),(12,'Farinha de Milho','White Star, 1KG',50,1,846387041,'Dario Domingos','M-Pesa',50,50,NULL,'jnhanombe@gmail.com','Tsalala','2022-07-24 18:52:55',65213155,0,NULL),(13,'Saco de Arroz','Feliz Familia, 25KG',1150,1,846387041,'DDN','M-Pesa',1150,1150,NULL,'jnhanombe@gmail.com','Tchumene','2022-07-24 19:00:25',70023925,0,NULL),(14,'Ovos','Meia Duzia',70,3,846387041,'Dario Nhanombe','M-Pesa',210,210,NULL,'jnhanombe@gmail.com','Tsalala','2022-07-24 19:11:41',71115241,0,NULL),(15,'Saco de Batata','Roxa',480,1,872876066,'Dario Domingos Nhanombe','E-Mola',480,690,NULL,'jnhanombe59@gmail.com','Tchumene','2022-07-24 19:27:56',72777756,0,NULL),(16,'Ovos','Meia Duzia',70,3,872876066,'Dario Domingos Nhanombe','E-Mola',210,690,NULL,'jnhanombe59@gmail.com','Tchumene','2022-07-24 19:27:56',72777756,0,NULL);
/*!40000 ALTER TABLE `carrinho` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `Cliente_ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Sexo` varchar(16) NOT NULL,
  `Password` varchar(80) NOT NULL,
  UNIQUE KEY `Cliente_ID` (`Cliente_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (4,'Dario Domingos Nhanombe','jnhanombe@gmai.com','Masculino','$2y$10$.V0LMiPXIf5KYR4gWYUUL.oE6GFVxrPpidbbTeyDz96VqsIsWvw4W'),(5,'Dario Nhanombe','dnhanombe@gmail.com','Masculino','$2y$10$qNzZJMJcgaA7RHZiRY0oE.EEWiLgOlIWHCrPiVXX589q3XlZK.7F.'),(6,'Dario DDN','jnhanombe59@gmail.com','Masculino','$2y$10$8pYCP8tiQyeTE9GsmxhcqeyMINaXsVGsNT/aS7risD4hqIsCNWD.u');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compra`
--

DROP TABLE IF EXISTS `compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `compra` (
  `Compra_ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Quantidade` int NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Contacto` int NOT NULL,
  `Pagamento` varchar(16) NOT NULL,
  `NRConta` bigint DEFAULT NULL,
  `Email` varchar(60) NOT NULL,
  `Endereco` varchar(50) NOT NULL,
  `Data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Status` int NOT NULL DEFAULT '0',
  `Produtos_FK` bigint unsigned DEFAULT NULL,
  `Bebidas_FK` bigint unsigned DEFAULT NULL,
  `Frutas_FK` bigint unsigned DEFAULT NULL,
  `Carnes_FK` bigint unsigned DEFAULT NULL,
  `Cliente_FK` bigint unsigned DEFAULT NULL,
  UNIQUE KEY `Compra_ID` (`Compra_ID`),
  KEY `Alimento_FK` (`Produtos_FK`),
  KEY `Bebida_FK` (`Bebidas_FK`),
  KEY `Fruta_FK` (`Frutas_FK`),
  KEY `Carne_FK` (`Carnes_FK`),
  KEY `Cliente_FK` (`Cliente_FK`),
  CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`Produtos_FK`) REFERENCES `produtos` (`Produtos_ID`),
  CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`Bebidas_FK`) REFERENCES `bebidas` (`Bebidas_ID`),
  CONSTRAINT `compra_ibfk_3` FOREIGN KEY (`Frutas_FK`) REFERENCES `frutas` (`Frutas_ID`),
  CONSTRAINT `compra_ibfk_4` FOREIGN KEY (`Carnes_FK`) REFERENCES `carnes` (`Carnes_ID`),
  CONSTRAINT `compra_ibfk_5` FOREIGN KEY (`Cliente_FK`) REFERENCES `cliente` (`Cliente_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compra`
--

LOCK TABLES `compra` WRITE;
/*!40000 ALTER TABLE `compra` DISABLE KEYS */;
INSERT INTO `compra` VALUES (33,4,'Dario Domingos Nhanombe',872876066,'Absa',4004004004004000,'jnhanombe59@gmail.com','Maputo, Tsalala','2022-07-04 20:38:47',1,NULL,NULL,1,NULL,NULL),(34,4,'DDN',872876066,'E-Mola',NULL,'jnhanombe@gmail.com','Malhampsene','2022-07-24 20:24:01',1,NULL,NULL,NULL,2,NULL),(35,4,'Dario DDN',846387041,'M-Pesa',NULL,'dnhanombe@gmail.com','Mozal','2022-07-24 21:48:13',0,12,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `frutas`
--

DROP TABLE IF EXISTS `frutas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `frutas` (
  `Frutas_ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Codigo` bigint NOT NULL,
  `Produto` varchar(30) NOT NULL,
  `Descricao` varchar(25) NOT NULL,
  `Preco` decimal(10,0) NOT NULL,
  `Imagem` varchar(30) DEFAULT NULL,
  `Validade` date NOT NULL,
  `Admin_FK` bigint unsigned NOT NULL,
  UNIQUE KEY `Fruta_ID` (`Frutas_ID`),
  UNIQUE KEY `Frutas_ID` (`Frutas_ID`),
  KEY `Admin_FK` (`Admin_FK`),
  CONSTRAINT `frutas_ibfk_1` FOREIGN KEY (`Admin_FK`) REFERENCES `administrador` (`Admin_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `frutas`
--

LOCK TABLES `frutas` WRITE;
/*!40000 ALTER TABLE `frutas` DISABLE KEYS */;
INSERT INTO `frutas` VALUES (1,6232022111614263,'Laranjas','1KG',115,'62b44b7e68909laranja.webp','2022-09-30',1),(2,623202211192063,'Abacate','1KG',220,'62b44c38b3ae9abacate.webp','2022-09-30',1),(3,7052022020729161,'Uvas','Uma tigela',100,'62c445a1b4d0duvas.webp','2022-10-01',1),(4,7052022021009245,'Macas','1KG, Vermelhas',100,'62c44641e1ff5maca.webp','2022-11-01',1),(5,7052022021444847,'Ananas','2 Units',90,'62c4475487e24ananas.webp','2022-11-30',1),(6,7072022123959909,'Pera Maca','1KG',100,'62c6d41fb0b9dpera.webp','2022-09-16',1),(7,7072022124253515,'Turanjas','1KG',125,'62c6d4cdc226aturanja.webp','2022-09-16',1),(10,7242022103949403,'Bananas','1KG',45,'62ddca35ac7ddbanana.webp','2022-09-29',1),(11,7242022104345790,'Morangos','Em Pote',180,'62ddcb212213fmorango.webp','2022-10-29',1);
/*!40000 ALTER TABLE `frutas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produtos` (
  `Produtos_ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Codigo` bigint NOT NULL,
  `Produto` varchar(30) NOT NULL,
  `Descricao` varchar(25) NOT NULL,
  `Preco` decimal(10,0) DEFAULT NULL,
  `Imagem` varchar(30) DEFAULT NULL,
  `Validade` date DEFAULT NULL,
  `Admin_FK` bigint unsigned NOT NULL,
  UNIQUE KEY `Alimento_ID` (`Produtos_ID`),
  UNIQUE KEY `Alimentos_ID` (`Produtos_ID`),
  KEY `Admin_FK` (`Admin_FK`),
  CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`Admin_FK`) REFERENCES `administrador` (`Admin_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (8,6222022051233897,'Saco de Cebola','Branca',390,'6290914bf0d42CBranca.webp','2022-09-29',1),(9,6222022051447742,'Saco de Batata','Roxa',480,'62b331e70745aBRoxa.webp','2022-10-04',1),(10,6222022051559831,'Saco de Cebola','Roxa',400,'62b3322f91010CRocha.webp','2022-10-18',1),(11,6222022051706884,'Saco de Batata','Branca',450,'62b332725f27dBbranca.webp','2022-10-20',1),(12,622202205190748,'Saco de Arroz','Mariana, 25KG',1050,'62b332eb17995Mariana.webp','2022-11-02',1),(13,622202205290699,'Saco de Arroz','Feliz Familia, 25KG',1150,'62b335423c87aArroz.webp','2022-09-29',1),(14,6232022100750110,'Farinha de Milho','White Star, 1KG',50,'62b43b76309cadownload.webp','2022-09-23',1),(16,7012022015146303,'Ovos','Meia Duzia',70,'62befbf2882baovos.webp','2022-09-30',1),(17,7052022020557593,'Acucar','Brown Sugar, 1KG',70,'62c445457ef6dsugar.webp','2022-09-29',1);
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relatorio`
--

DROP TABLE IF EXISTS `relatorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `relatorio` (
  `Relatorio_ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Admin_FK` bigint unsigned NOT NULL,
  `Historico` varchar(100) NOT NULL,
  `Data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `Relatorio_ID` (`Relatorio_ID`),
  KEY `Admin_FK` (`Admin_FK`),
  CONSTRAINT `relatorio_ibfk_1` FOREIGN KEY (`Admin_FK`) REFERENCES `administrador` (`Admin_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relatorio`
--

LOCK TABLES `relatorio` WRITE;
/*!40000 ALTER TABLE `relatorio` DISABLE KEYS */;
INSERT INTO `relatorio` VALUES (12,1,'Adicionou produto : Saco de Cebola','2022-06-22 15:12:33'),(13,1,'Adicionou produto : Saco de Batata','2022-06-22 15:14:47'),(14,1,'Adicionou produto : Saco de Cebola','2022-06-22 15:15:59'),(15,1,'Adicionou produto : Saco de Batata','2022-06-22 15:17:06'),(16,1,'Adicionou produto : Saco de Arroz','2022-06-22 15:19:07'),(17,1,'Adicionou produto : Jack Daniels Old','2022-06-22 15:24:23'),(18,1,'Adicionou produto : Vinho','2022-06-22 15:25:50'),(19,1,'Adicionou produto : Carne de Porco','2022-06-22 15:27:53'),(20,1,'Adicionou produto : Saco de Arroz','2022-06-22 15:29:06'),(21,1,'Adicionou produto : Farinha de Milho','2022-06-23 10:07:50'),(22,1,'Adicionou produto : Laranjas','2022-06-23 11:16:14'),(23,1,'Adicionou produto : Abacate','2022-06-23 11:19:21'),(24,1,'Adicionou produto : Ovos','2022-06-23 11:31:15'),(25,1,'Novo Admininistrador adicionado : Dario','2022-06-23 14:15:28'),(26,1,'Adicionou produto : Ovos','2022-07-01 13:51:46'),(27,1,'Adicionou produto : Carne de Porco','2022-07-01 13:53:59'),(28,1,'Adicionou produto : Carne de vaca','2022-07-01 13:56:33'),(29,1,'Novo Admininistrador adicionado : DDN','2022-07-04 15:44:25'),(30,1,'Adicionou produto : Acucar','2022-07-05 14:05:57'),(31,1,'Adicionou produto : Uvas','2022-07-05 14:07:29'),(32,1,'Adicionou produto : Macas','2022-07-05 14:10:10'),(33,1,'Adicionou produto : Ananas','2022-07-05 14:14:44'),(34,1,'Adicionou produto : Pera Maca','2022-07-07 12:39:59'),(35,1,'Adicionou produto : Turanjas','2022-07-07 12:42:53'),(36,1,'Adicionou produto : Teste','2022-07-24 19:36:34'),(37,1,'Produto Actualizado','2022-07-24 19:47:10'),(38,1,'Produto Actualizado','2022-07-24 19:47:11'),(39,1,'Produto Actualizado','2022-07-24 19:47:11'),(40,1,'Produto Actualizado','2022-07-24 19:47:11'),(41,1,'Produto Actualizado','2022-07-24 19:47:20'),(42,1,'Produto Actualizado','2022-07-24 19:47:21'),(43,1,'Produto Actualizado','2022-07-24 19:47:21'),(44,1,'Produto Actualizado','2022-07-24 19:47:21'),(45,1,'Produto Actualizado','2022-07-24 19:51:41'),(46,1,'Produto Actualizado','2022-07-24 19:51:42'),(47,1,'Produto Actualizado','2022-07-24 19:51:42'),(48,1,'Produto Actualizado','2022-07-24 19:51:42'),(49,1,'Produto Actualizado','2022-07-24 19:52:08'),(50,1,'Produto Actualizado','2022-07-24 19:52:08'),(51,1,'Produto Actualizado','2022-07-24 19:52:08'),(52,1,'Produto Actualizado','2022-07-24 19:52:08'),(53,1,'Produto Actualizado','2022-07-24 19:54:13'),(54,1,'Produto Actualizado','2022-07-24 19:54:14'),(55,1,'Produto Actualizado','2022-07-24 19:54:14'),(56,1,'Produto Actualizado','2022-07-24 19:54:14'),(57,1,'Produto Teste Apagado!','2022-07-24 20:10:24'),(58,1,'Adicionou produto : Teste','2022-07-24 20:11:23'),(59,1,'Produto Teste Apagado!','2022-07-24 20:12:57'),(60,1,'Adicionou produto : Bananas','2022-07-24 22:39:50'),(61,1,'Adicionou produto : Morangos','2022-07-24 22:43:45'),(62,1,'Adicionou produto : Mac-Mahon','2022-07-24 22:45:44'),(63,1,'Adicionou produto : Heineken','2022-07-24 22:49:43'),(64,1,'Adicionou produto : Orla Maritima','2022-07-24 22:52:48'),(65,1,'Adicionou produto : Txilar','2022-07-24 22:55:59');
/*!40000 ALTER TABLE `relatorio` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-24 16:02:04
