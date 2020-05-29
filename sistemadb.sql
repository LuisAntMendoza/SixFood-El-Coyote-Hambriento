-- MariaDB dump 10.17  Distrib 10.4.11-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: sistemadb
-- ------------------------------------------------------
-- Server version	10.4.11-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `antojito`
--

DROP TABLE IF EXISTS `antojito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `antojito` (
  `id_antojito` int(3) NOT NULL AUTO_INCREMENT,
  `nombre` char(35) NOT NULL,
  `id_presentacion` int(2) NOT NULL,
  `porcion` int(2) NOT NULL,
  `cantidadA` int(1) DEFAULT 1,
  `precio` int(2) NOT NULL,
  `existencias` int(3) DEFAULT NULL,
  PRIMARY KEY (`id_antojito`),
  KEY `id_presentacion` (`id_presentacion`),
  CONSTRAINT `antojito_ibfk_1` FOREIGN KEY (`id_presentacion`) REFERENCES `presentacion` (`id_presentacion`)
) ENGINE=InnoDB AUTO_INCREMENT=331 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `antojito`
--

LOCK TABLES `antojito` WRITE;
/*!40000 ALTER TABLE `antojito` DISABLE KEYS */;
INSERT INTO `antojito` VALUES (300,'Molletes',1,2,1,12,0),(301,'Sopes sencillo',1,1,1,12,0),(302,'Sopes con queso',2,1,1,15,0),(303,'Sopes con queso y carne',2,1,1,20,0),(304,'Tacos de pollo',5,3,1,20,0),(305,'Tocos de bistec',4,1,1,17,0),(306,'Chilaquiles chicos pollo o huevo',6,1,1,25,0),(307,'Chilaqueles grandes pollo o huevo',6,1,1,35,0),(308,'Chilaquiles chicos bistec',6,1,1,30,0),(309,'Chilaqules grandes bistec',6,1,1,40,0),(310,'Pambazos',1,1,1,18,0),(311,'Pambazos',2,1,1,25,0),(312,'Papas a la francesa',3,1,1,15,0),(313,'Papas a la francesa',4,1,1,25,0),(314,'Hamburguesa sencilla',7,1,1,25,0),(315,'Hamburguesa con queso',7,1,1,30,0),(316,'Hamburguesa doble',7,1,1,40,NULL);
/*!40000 ALTER TABLE `antojito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bebida`
--

DROP TABLE IF EXISTS `bebida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bebida` (
  `id_bebida` int(3) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `id_tipoB` int(3) NOT NULL,
  `id_porcionB` int(2) NOT NULL,
  `precio` int(2) NOT NULL,
  `existencias` int(3) DEFAULT NULL,
  PRIMARY KEY (`id_bebida`),
  KEY `id_tipoB` (`id_tipoB`),
  KEY `id_cantidad` (`id_porcionB`),
  CONSTRAINT `bebida_ibfk_1` FOREIGN KEY (`id_tipoB`) REFERENCES `tipob` (`id_tipoB`),
  CONSTRAINT `bebida_ibfk_2` FOREIGN KEY (`id_porcionB`) REFERENCES `porcionb` (`id_porcionB`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bebida`
--

LOCK TABLES `bebida` WRITE;
/*!40000 ALTER TABLE `bebida` DISABLE KEYS */;
INSERT INTO `bebida` VALUES (101,'Agua jamaica',1,10,7,0),(102,'Agua horchata',1,10,7,0),(103,'Agua limón',1,10,7,0),(104,'Agua limon chia',1,10,7,0),(105,'Jugo naranja',3,10,12,0),(106,'Jugo zanahoria',3,10,12,0),(107,'Jugo mandarina',3,10,12,0),(108,'Jugo betabel',3,10,12,0),(109,'Jugo vampiro',4,10,20,0),(110,'Jugo cítrico',4,10,20,0),(111,'Jugo verde',4,10,20,0),(112,'Boing mango',1,11,12,0),(113,'Boing manzana',1,11,12,0),(114,'Boing guayaba',1,11,12,0),(115,'Boing uva',1,11,12,0),(116,'Boing fresa',1,11,12,0),(117,'Botella de agua ',2,11,10,0),(118,'Coca-cola',5,12,13,0),(119,'Power Punch',5,12,12,0),(120,'Refresco limon',5,12,12,0),(121,'Fanta',5,12,12,0),(122,'Pepsi',5,12,12,0),(123,'Arizona mango',1,11,12,0),(124,'Arizona sandia',1,11,12,NULL);
/*!40000 ALTER TABLE `bebida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entrega`
--

DROP TABLE IF EXISTS `entrega`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entrega` (
  `id_lugar` int(1) NOT NULL AUTO_INCREMENT,
  `grado` int(1) NOT NULL,
  `lugar` varchar(20) NOT NULL,
  PRIMARY KEY (`id_lugar`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entrega`
--

LOCK TABLES `entrega` WRITE;
/*!40000 ALTER TABLE `entrega` DISABLE KEYS */;
INSERT INTO `entrega` VALUES (1,4,'Patio de cuartos\r'),(2,4,'Canchas\r'),(3,5,'Patio de quintos\r'),(4,5,'Pulpo\r'),(5,6,'Patio de sextos\r'),(6,6,'Pimpos\r'),(7,7,'Area administrativa\r'),(8,7,'Sala de maestros');
/*!40000 ALTER TABLE `entrega` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `porcionb`
--

DROP TABLE IF EXISTS `porcionb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `porcionb` (
  `id_porcionB` int(2) NOT NULL,
  `cantidad` char(15) NOT NULL,
  PRIMARY KEY (`id_porcionB`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `porcionb`
--

LOCK TABLES `porcionb` WRITE;
/*!40000 ALTER TABLE `porcionb` DISABLE KEYS */;
INSERT INTO `porcionb` VALUES (10,'Vaso 500 mL'),(11,'1L'),(12,'600 ml');
/*!40000 ALTER TABLE `porcionb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `preparado`
--

DROP TABLE IF EXISTS `preparado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `preparado` (
  `id_comida` int(3) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `cantidadP` int(2) NOT NULL,
  `precio` int(2) NOT NULL,
  `existencias` int(3) DEFAULT NULL,
  PRIMARY KEY (`id_comida`)
) ENGINE=InnoDB AUTO_INCREMENT=215 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preparado`
--

LOCK TABLES `preparado` WRITE;
/*!40000 ALTER TABLE `preparado` DISABLE KEYS */;
INSERT INTO `preparado` VALUES (200,'Maruchan res',1,10,0),(201,'Maruchan camaron',1,10,0),(202,'Maruchan pollo',1,10,0),(203,'Sandwich pollo',1,15,0),(204,'Sandwich jamon',1,15,0),(205,'Sandwich vegetariano',1,15,0),(206,'Torta jamon',1,15,0),(207,'Torta salchicha',1,15,0),(208,'Torta rusa',1,25,0),(209,'Torta pierna',1,25,0),(210,'Torta cubana',1,25,0),(211,'Torta hawaina',1,25,NULL);
/*!40000 ALTER TABLE `preparado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `presentacion`
--

DROP TABLE IF EXISTS `presentacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `presentacion` (
  `id_presentacion` int(2) NOT NULL,
  `presentacion` char(25) NOT NULL,
  PRIMARY KEY (`id_presentacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `presentacion`
--

LOCK TABLES `presentacion` WRITE;
/*!40000 ALTER TABLE `presentacion` DISABLE KEYS */;
INSERT INTO `presentacion` VALUES (1,'sencillos'),(2,'especial'),(3,'chicos'),(4,'grandes'),(5,'orden'),(6,'queso, crema, cebolla'),(7,'con papas a la francesa');
/*!40000 ALTER TABLE `presentacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recogerpedido`
--

DROP TABLE IF EXISTS `recogerpedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recogerpedido` (
  `id_recoger` int(1) NOT NULL,
  `nombre` varchar(16) NOT NULL,
  PRIMARY KEY (`id_recoger`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recogerpedido`
--

LOCK TABLES `recogerpedido` WRITE;
/*!40000 ALTER TABLE `recogerpedido` DISABLE KEYS */;
INSERT INTO `recogerpedido` VALUES (1,'en cafeteria'),(2,'entrega personal');
/*!40000 ALTER TABLE `recogerpedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tiempoespera`
--

DROP TABLE IF EXISTS `tiempoespera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tiempoespera` (
  `id_espera` int(2) NOT NULL,
  `id_recoger` int(1) NOT NULL,
  `id_tipoentrega` int(2) NOT NULL,
  `tiempo_min` int(2) NOT NULL,
  PRIMARY KEY (`id_espera`),
  KEY `id_recoger` (`id_recoger`),
  KEY `id_tipoentrega` (`id_tipoentrega`),
  CONSTRAINT `tiempoespera_ibfk_1` FOREIGN KEY (`id_recoger`) REFERENCES `recogerpedido` (`id_recoger`),
  CONSTRAINT `tiempoespera_ibfk_2` FOREIGN KEY (`id_tipoentrega`) REFERENCES `tipoentrega` (`id_tipoEntrega`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiempoespera`
--

LOCK TABLES `tiempoespera` WRITE;
/*!40000 ALTER TABLE `tiempoespera` DISABLE KEYS */;
INSERT INTO `tiempoespera` VALUES (10,1,11,20),(11,1,12,15),(12,1,13,10),(13,2,11,30),(14,2,12,25),(15,2,13,20);
/*!40000 ALTER TABLE `tiempoespera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipob`
--

DROP TABLE IF EXISTS `tipob`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipob` (
  `id_tipoB` int(3) NOT NULL,
  `tipo` char(10) NOT NULL,
  PRIMARY KEY (`id_tipoB`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipob`
--

LOCK TABLES `tipob` WRITE;
/*!40000 ALTER TABLE `tipob` DISABLE KEYS */;
INSERT INTO `tipob` VALUES (1,'sabor'),(2,'simple'),(3,'sencillo'),(4,'preparado'),(5,'original');
/*!40000 ALTER TABLE `tipob` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipoentrega`
--

DROP TABLE IF EXISTS `tipoentrega`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipoentrega` (
  `id_tipoEntrega` int(2) NOT NULL,
  `nombre` char(10) NOT NULL,
  `cantidad` int(2) NOT NULL,
  PRIMARY KEY (`id_tipoEntrega`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipoentrega`
--

LOCK TABLES `tipoentrega` WRITE;
/*!40000 ALTER TABLE `tipoentrega` DISABLE KEYS */;
INSERT INTO `tipoentrega` VALUES (11,'normal',0),(12,'express',5),(13,'urgente',10);
/*!40000 ALTER TABLE `tipoentrega` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipousuario`
--

DROP TABLE IF EXISTS `tipousuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipousuario` (
  `id_tipousuario` int(1) NOT NULL,
  `tipo` char(10) DEFAULT NULL,
  PRIMARY KEY (`id_tipousuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipousuario`
--

LOCK TABLES `tipousuario` WRITE;
/*!40000 ALTER TABLE `tipousuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipousuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` varchar(128) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `apellidoPat` varchar(128) NOT NULL,
  `apellidoMat` varchar(128) DEFAULT NULL,
  `grupo` int(3) DEFAULT NULL,
  `colegio` char(25) DEFAULT NULL,
  `contraseña` varchar(128) NOT NULL,
  `id_tipousuario` int(1) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `id_usuario` (`id_usuario`),
  KEY `id_tipousuario` (`id_tipousuario`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_tipousuario`) REFERENCES `tipousuario` (`id_tipousuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta`
--

DROP TABLE IF EXISTS `venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta` (
  `id_venta` varchar(128) NOT NULL,
  `id_usuario` varchar(128) NOT NULL,
  `id_comida` int(3) DEFAULT NULL,
  `id_bebida` int(3) DEFAULT NULL,
  `id_antojito` int(3) DEFAULT NULL,
  `cantidadC` int(2) DEFAULT NULL,
  `cantidadB` int(2) DEFAULT NULL,
  `cantidadA` int(2) DEFAULT NULL,
  `total` varchar(5) NOT NULL,
  `id_lugar` int(2) NOT NULL,
  `id_espera` int(1) NOT NULL,
  KEY `id_usuario` (`id_usuario`),
  KEY `id_comida` (`id_comida`),
  KEY `id_bebida` (`id_bebida`),
  KEY `id_antojito` (`id_antojito`),
  KEY `id_lugar` (`id_lugar`),
  KEY `id_espera` (`id_espera`),
  CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`id_comida`) REFERENCES `preparado` (`id_comida`),
  CONSTRAINT `venta_ibfk_3` FOREIGN KEY (`id_bebida`) REFERENCES `bebida` (`id_bebida`),
  CONSTRAINT `venta_ibfk_4` FOREIGN KEY (`id_antojito`) REFERENCES `antojito` (`id_antojito`),
  CONSTRAINT `venta_ibfk_5` FOREIGN KEY (`id_lugar`) REFERENCES `entrega` (`id_lugar`),
  CONSTRAINT `venta_ibfk_6` FOREIGN KEY (`id_espera`) REFERENCES `tiempoespera` (`id_espera`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta`
--

LOCK TABLES `venta` WRITE;
/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-29 13:48:41
