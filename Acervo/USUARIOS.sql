-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 11-Ago-2021 às 22:14
-- Versão do servidor: 8.0.25
-- versão do PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `BANCOCOMUM`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `USUARIOS`
--

CREATE TABLE `USUARIOS` (
  `USRCODIGO` int UNSIGNED NOT NULL,
  `USRNOME` varchar(150) DEFAULT NULL,
  `USRLOGIN` varchar(15) NOT NULL,
  `USREMAIL` varchar(150) NOT NULL,
  `USRSENHA` varchar(50) NOT NULL,
  `USRBLOQUEIO` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `USUARIOS`
--

INSERT INTO `USUARIOS` (`USRCODIGO`, `USRNOME`, `USRLOGIN`, `USREMAIL`, `USRSENHA`, `USRBLOQUEIO`) VALUES
(1, 'Roberto Sinistro Poderosa', 'RobsPower', 'robertosinistro@gmail.com', '25f9e794323b453885f5181f1b624d0b', 0),
(3, 'Administrador', 'Admin', 'admin@servidor.com', '827ccb0eea8a706c4c34a16891f84e7b', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `USUARIOS`
--
ALTER TABLE `USUARIOS`
  ADD PRIMARY KEY (`USRCODIGO`),
  ADD UNIQUE KEY `USRLOGIN` (`USRLOGIN`),
  ADD UNIQUE KEY `USREMAIL` (`USREMAIL`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `USUARIOS`
--
ALTER TABLE `USUARIOS`
  MODIFY `USRCODIGO` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
