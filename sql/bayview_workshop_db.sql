-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 05-Dez-2019 às 21:21
-- Versão do servidor: 5.7.24
-- versão do PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bayview_workshop_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `carro`
--

DROP TABLE IF EXISTS `carro`;
CREATE TABLE IF NOT EXISTS `carro` (
  `idcarro` int(11) NOT NULL AUTO_INCREMENT,
  `placa` varchar(11) NOT NULL,
  `modelo` varchar(255) DEFAULT NULL,
  `ano` varchar(5) DEFAULT NULL,
  `cliente_id_cliente` int(11) NOT NULL,
  PRIMARY KEY (`idcarro`),
  UNIQUE KEY `placa_UNIQUE` (`placa`),
  KEY `fk_carro_cliente1_idx` (`cliente_id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `carro`
--

INSERT INTO `carro` (`idcarro`, `placa`, `modelo`, `ano`, `cliente_id_cliente`) VALUES
(2, 'PNQ-0248', 'Onix', '2017', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `telefone` varchar(11) DEFAULT NULL,
  `cidade` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `id_cliente_UNIQUE` (`id_cliente`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome`, `cpf`, `telefone`, `cidade`) VALUES
(2, 'Renan Moreira', '685.765.858-57', '76575-7575', 'Russas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

DROP TABLE IF EXISTS `funcionario`;
CREATE TABLE IF NOT EXISTS `funcionario` (
  `id_funcionario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `telefone` varchar(11) DEFAULT NULL,
  `cidade` varchar(20) DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  `nivel` int(11) NOT NULL,
  `disp` int(1) NOT NULL,
  PRIMARY KEY (`id_funcionario`),
  UNIQUE KEY `id_funcionario_UNIQUE` (`id_funcionario`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`id_funcionario`, `nome`, `cpf`, `telefone`, `cidade`, `senha`, `nivel`, `disp`) VALUES
(1, 'Renan Moreira', '000.000.000-01', '56585-7585', 'Russas', 'admin', 1, 1),
(2, 'Hugo Regis', '000.000.000-02', '99999-9991', 'Russas', 'admin', 0, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `func_max_num_serv`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `func_max_num_serv`;
CREATE TABLE IF NOT EXISTS `func_max_num_serv` (
`funcionario_id_funcionario` int(11)
,`quant_serv` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `maior_quant_servico`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `maior_quant_servico`;
CREATE TABLE IF NOT EXISTS `maior_quant_servico` (
`maior` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `quantidade_servico`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `quantidade_servico`;
CREATE TABLE IF NOT EXISTS `quantidade_servico` (
`funcionario_id_funcionario` int(11)
,`quant_serv` bigint(21)
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

DROP TABLE IF EXISTS `servico`;
CREATE TABLE IF NOT EXISTS `servico` (
  `id_servico` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) NOT NULL,
  `carro_idcarro` int(11) NOT NULL,
  `funcionario_id_funcionario` int(11) NOT NULL,
  PRIMARY KEY (`id_servico`),
  KEY `fk_servico_carro1_idx` (`carro_idcarro`),
  KEY `fk_servico_funcionario1_idx` (`funcionario_id_funcionario`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `servico`
--

INSERT INTO `servico` (`id_servico`, `tipo`, `carro_idcarro`, `funcionario_id_funcionario`) VALUES
(2, 'cambagem', 2, 2);

-- --------------------------------------------------------

--
-- Structure for view `func_max_num_serv`
--
DROP TABLE IF EXISTS `func_max_num_serv`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `func_max_num_serv`  AS  select `quantidade_servico`.`funcionario_id_funcionario` AS `funcionario_id_funcionario`,`quantidade_servico`.`quant_serv` AS `quant_serv` from `quantidade_servico` where (`quantidade_servico`.`quant_serv` = (select `maior_quant_servico`.`maior` from `maior_quant_servico`)) order by `quantidade_servico`.`funcionario_id_funcionario` ;

-- --------------------------------------------------------

--
-- Structure for view `maior_quant_servico`
--
DROP TABLE IF EXISTS `maior_quant_servico`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `maior_quant_servico`  AS  select max(`quantidade_servico`.`quant_serv`) AS `maior` from `quantidade_servico` ;

-- --------------------------------------------------------

--
-- Structure for view `quantidade_servico`
--
DROP TABLE IF EXISTS `quantidade_servico`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `quantidade_servico`  AS  select `servico`.`funcionario_id_funcionario` AS `funcionario_id_funcionario`,count(`servico`.`funcionario_id_funcionario`) AS `quant_serv` from `servico` group by `servico`.`funcionario_id_funcionario` ;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `carro`
--
ALTER TABLE `carro`
  ADD CONSTRAINT `fk_carro_cliente1` FOREIGN KEY (`cliente_id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `servico`
--
ALTER TABLE `servico`
  ADD CONSTRAINT `fk_servico_carro1` FOREIGN KEY (`carro_idcarro`) REFERENCES `carro` (`idcarro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_servico_funcionario1` FOREIGN KEY (`funcionario_id_funcionario`) REFERENCES `funcionario` (`id_funcionario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
