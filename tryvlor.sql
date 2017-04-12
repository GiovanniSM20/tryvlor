-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 13-Jan-2017 às 13:33
-- Versão do servidor: 5.7.9
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tryvlor`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `try_cities`
--

DROP TABLE IF EXISTS `try_cities`;
CREATE TABLE IF NOT EXISTS `try_cities` (
  `idCity` int(11) NOT NULL AUTO_INCREMENT,
  `nameCity` varchar(120) NOT NULL,
  `photoCity` varchar(150) NOT NULL,
  `latCity` float(10,6) NOT NULL,
  `lngCity` float(10,6) NOT NULL,
  PRIMARY KEY (`idCity`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `try_cities`
--

INSERT INTO `try_cities` (`idCity`, `nameCity`, `photoCity`, `latCity`, `lngCity`) VALUES
(10, 'Sooretama', 'http://mw2.google.com/mw-panoramio/photos/medium/65787989.jpg', -19.194494, -40.099270);

-- --------------------------------------------------------

--
-- Estrutura da tabela `try_comodities_list`
--

DROP TABLE IF EXISTS `try_comodities_list`;
CREATE TABLE IF NOT EXISTS `try_comodities_list` (
  `idComoditie` int(11) NOT NULL AUTO_INCREMENT,
  `nameComoditie` varchar(255) NOT NULL,
  `iconComoditie` varchar(100) NOT NULL,
  PRIMARY KEY (`idComoditie`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=utf8 COMMENT='iconComoditie = class ''fa-x''';

--
-- Extraindo dados da tabela `try_comodities_list`
--

INSERT INTO `try_comodities_list` (`idComoditie`, `nameComoditie`, `iconComoditie`) VALUES
(1, 'Academia', 'fa-user'),
(2, 'Acessível a Hóspedes com Mobilidade Reduzida', 'fa-universal-access'),
(3, 'Aluguel de Bicicletas', 'fa-bycicle'),
(4, 'Aluguel de Carros', 'fa-car'),
(5, 'Amenidade de Banho', 'fa-shower'),
(6, 'Apropriado para Eventos / Reuniões', 'fa-calendar'),
(7, 'Aquecedor', 'fa-thermometer'),
(8, 'Ar-Condicionado', 'fa-snowflake-o'),
(9, 'Áreas específicas para Fumantes', 'fa-expand'),
(10, 'Babá / Serviços para crianças', 'fa-child'),
(11, 'Banheira de Hidromassagem', 'fa-bathtub'),
(12, 'Bar', 'fa-beer'),
(13, 'Bar na Piscina', 'fa-beer'),
(14, 'Beira-Bar', 'fa-beer'),
(15, 'Business Center', 'fa-industry'),
(16, 'Café da Manhã', 'fa-coffee'),
(17, 'Caixa Eletrônico na Propriedade', 'fa-money'),
(18, 'Check In / Check Out Expressos', 'fa-check-square-o'),
(19, 'Check In / Check Out Privativos', 'fa-check-square'),
(20, 'Cofre', 'fa-bank'),
(21, 'Comodidades VIP', 'fa-magic'),
(22, 'Comporta Reuniões / Banquetes', 'fa-industry'),
(23, 'Cozinha', 'fa-glass'),
(24, 'Depósito de Bagagens', 'fa-folder'),
(25, 'Despertador', 'fa-clock-o'),
(26, 'Engraxate', 'fa-square'),
(27, 'Estacionamento Grátis nas Instalações', 'fa-car'),
(28, 'Estacionamento Pago nas Instalações', 'fa-car'),
(29, 'Elevador', 'fa-arrows-v'),
(30, 'Fax / Fotocópia', 'fa-copy'),
(31, 'Frigobar', 'fa-thermometer-0'),
(32, 'Idiomas extrangeiros', 'fa-language'),
(33, 'Isolamento de Som', 'fa-bell'),
(34, 'Jornais', 'fa-newspaper-o'),
(35, 'Lareira Interna', 'fa-fire'),
(36, 'Lavanderia', 'fa-tint'),
(37, 'Lavagem a Seco', 'fa-tint'),
(38, 'Lojas na Propriedade', 'fa-shopping-bang'),
(39, 'Lounge Compartilhado', 'fa-handshake-o'),
(40, 'Mesa de Trabalho', 'fa-table'),
(41, 'Permitido Fumar', 'fa-free-code-camp'),
(42, 'Permitido Fumar em Áreas Específicas', 'fa-free-code-camp'),
(43, 'Pets Não Permitidos', 'fa-minus'),
(44, 'Pets Permitidos', 'fa-plus'),
(45, 'Piscina ao ar Livre', 'fa-life-saver'),
(46, 'Piscina Coberta', 'fa-life-saver'),
(47, 'Proibido Fumar em Todo Hotel', 'fa-minus'),
(48, 'Projetores', 'fa-film'),
(49, 'Quartos com Isolamento Acústico', 'fa-file-sound-o'),
(50, 'Quadra de Futebol', 'fa-futbol-o'),
(51, 'Quadra de Tênis', 'fa-futbol-o'),
(52, 'Quartos para Fumantes', 'fa-plus'),
(53, 'Quartos não Fumantes', 'fa-minus'),
(54, 'Recepção 24h', 'fa-users'),
(55, 'Restaurante', 'fa-cutlery'),
(56, 'Restaurante (buffet)', 'fa-cutlery'),
(57, 'Restaurante (à la carte)', 'fa-cutlery'),
(58, 'Salão de Festas', 'fa-hand-peace-o'),
(59, 'Salão de Jogos', 'fa-gamepad'),
(60, 'Sauna', 'fa-thermometer-three-quarters'),
(61, 'Scanner/Impressora', 'fa-copy'),
(62, 'Secador de Cabelo', 'fa-ravelry'),
(63, 'Serviço de Concierge', 'fa-user'),
(64, 'Serviço de Despertar', 'fa-clock-o'),
(65, 'Serviço de Limpeza', 'fa-trash'),
(66, 'Serviço de Massagem', 'fa-hand-grab-o'),
(67, 'Serviço de Manobrista', 'fa-car'),
(68, 'Serviço de Passar Roupas', 'fa-square'),
(69, 'Serviço de Quarto', 'fa-thumbs-up'),
(70, 'Serviço de Transfer', 'fa-automobile'),
(71, 'Sem Estacionamento', 'fa-minus'),
(72, 'Spa', 'fa-hotel'),
(73, 'Telefone', 'fa-phone'),
(74, 'Terraço ao ar Livre', 'fa-leaf'),
(75, 'Translado Aeroporto', 'fa-plane'),
(76, 'TV', 'fa-tv'),
(77, 'TV a Cabo', 'fa-tv'),
(78, 'Wi-Fi Grátis', 'fa-wifi'),
(79, 'Wi-Fi Pago', 'fa-wifi');

-- --------------------------------------------------------

--
-- Estrutura da tabela `try_hotels`
--

DROP TABLE IF EXISTS `try_hotels`;
CREATE TABLE IF NOT EXISTS `try_hotels` (
  `idHotel` int(11) NOT NULL AUTO_INCREMENT,
  `nameHotel` varchar(150) NOT NULL,
  `descriptionHotel` text NOT NULL,
  `bomsaber` text NOT NULL,
  `latHotel` float(10,6) NOT NULL,
  `lngHotel` float(10,6) NOT NULL,
  `idCity` int(11) NOT NULL,
  PRIMARY KEY (`idHotel`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `try_hotels`
--

INSERT INTO `try_hotels` (`idHotel`, `nameHotel`, `descriptionHotel`, `bomsaber`, `latHotel`, `lngHotel`, `idCity`) VALUES
(1, 'Eluz Sooretama', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod             tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,             quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo             consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse             cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non             proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'No momento do check-in será cobrada taxa de 10% de serviço. Seus objetos pessoais serão analisados por um "verificador de metal" para segurança de nossos outros clientes.', -19.190525, -40.100147, 10),
(2, 'Eluz Sooretama 2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod             tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,             quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo             consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse             cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non             proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'No momento do check-in será cobrada taxa de 10% de serviço. Seus objetos pessoais serão analisados por um "verificador de metal" para segurança de nossos outros clientes.', -19.191000, -40.100548, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `try_hotels_cards`
--

DROP TABLE IF EXISTS `try_hotels_cards`;
CREATE TABLE IF NOT EXISTS `try_hotels_cards` (
  `idCard` int(11) NOT NULL AUTO_INCREMENT,
  `idHotel` int(11) NOT NULL,
  `card` varchar(255) NOT NULL,
  PRIMARY KEY (`idCard`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `try_hotels_cards`
--

INSERT INTO `try_hotels_cards` (`idCard`, `idHotel`, `card`) VALUES
(1, 1, 'Visa'),
(2, 1, 'MasterCard');

-- --------------------------------------------------------

--
-- Estrutura da tabela `try_hotels_comodities`
--

DROP TABLE IF EXISTS `try_hotels_comodities`;
CREATE TABLE IF NOT EXISTS `try_hotels_comodities` (
  `idComoditie` int(11) NOT NULL AUTO_INCREMENT,
  `idHotel` int(11) NOT NULL,
  `comoditie` int(11) NOT NULL,
  PRIMARY KEY (`idComoditie`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `try_hotels_comodities`
--

INSERT INTO `try_hotels_comodities` (`idComoditie`, `idHotel`, `comoditie`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `try_hotels_evaluations`
--

DROP TABLE IF EXISTS `try_hotels_evaluations`;
CREATE TABLE IF NOT EXISTS `try_hotels_evaluations` (
  `idEvaluation` int(11) NOT NULL AUTO_INCREMENT,
  `hotelEvaluation` int(11) NOT NULL,
  `stars` int(1) NOT NULL,
  `ipEvaluation` varchar(15) NOT NULL,
  PRIMARY KEY (`idEvaluation`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `try_hotels_evaluations`
--

INSERT INTO `try_hotels_evaluations` (`idEvaluation`, `hotelEvaluation`, `stars`, `ipEvaluation`) VALUES
(8, 1, 1, '192.168.137.114'),
(7, 1, 5, '192.168.137.1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `try_hotels_images`
--

DROP TABLE IF EXISTS `try_hotels_images`;
CREATE TABLE IF NOT EXISTS `try_hotels_images` (
  `idImage` int(11) NOT NULL AUTO_INCREMENT,
  `idHotel` int(11) NOT NULL,
  `urlImage` varchar(255) NOT NULL,
  PRIMARY KEY (`idImage`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `try_hotels_images`
--

INSERT INTO `try_hotels_images` (`idImage`, `idHotel`, `urlImage`) VALUES
(1, 1, 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/86/Parque_Botânico_em_Sooretama,_Linhares-ES,_Brasil.jpg/290px-Parque_Botânico_em_Sooretama,_Linhares-ES,_Brasil.jpg'),
(2, 1, 'http://www.icmbio.gov.br/rebiosooretama/images/stories/Sede_da_UC.jpg'),
(3, 1, 'http://www.euviemlinhares.net/admin/k6_imagens/noticias_57162577c426d.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
