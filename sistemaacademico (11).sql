-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05/04/2024 às 16:16
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistemaacademico`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `atividades`
--

CREATE TABLE `atividades` (
  `remetente` varchar(255) NOT NULL,
  `destinatario` varchar(255) NOT NULL,
  `mensagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `col_projeto`
--

CREATE TABLE `col_projeto` (
  `id` int(11) NOT NULL,
  `login_colaborador` varchar(255) NOT NULL,
  `id_projeto` int(255) NOT NULL,
  `id_setor` int(255) NOT NULL,
  `dt_entrada` datetime NOT NULL,
  `view_projeto` tinyint(1) NOT NULL,
  `view_setor` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `col_projeto`
--

INSERT INTO `col_projeto` (`id`, `login_colaborador`, `id_projeto`, `id_setor`, `dt_entrada`, `view_projeto`, `view_setor`) VALUES
(48, '123', 60, 39, '2024-02-02 13:28:21', 1, 1),
(49, '123', 61, 40, '2024-02-02 13:28:30', 1, 1),
(50, '123', 62, 41, '2024-02-02 13:28:37', 1, 1),
(51, '123', 63, 42, '2024-02-02 13:28:44', 1, 1),
(52, '32', 60, 39, '2024-03-25 13:52:03', 1, 1),
(53, '32', 63, 42, '2024-03-25 13:53:10', 1, 1),
(54, '32', 61, 40, '2024-03-25 13:54:44', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `indicadores`
--

CREATE TABLE `indicadores` (
  `id_meta` varchar(255) NOT NULL,
  `id_indicador` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `dt_criada` datetime NOT NULL,
  `dt_atualizada` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `indicadores`
--

INSERT INTO `indicadores` (`id_meta`, `id_indicador`, `nome`, `dt_criada`, `dt_atualizada`) VALUES
('meta_areatext11', 'indicadortextarea111', 'FSFS', '2024-04-05 10:07:31', '0000-00-00 00:00:00'),
('meta_areatext21', 'indicadortextarea121', 'RYRTYTRY', '2024-04-05 10:07:31', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `login`
--

CREATE TABLE `login` (
  `cpf` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `nome` varchar(155) NOT NULL,
  `setor` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `status` text NOT NULL DEFAULT 'ativo',
  `perfil` text NOT NULL DEFAULT 'funcionario',
  `dt_login` datetime DEFAULT NULL,
  `dt_upload` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `login`
--

INSERT INTO `login` (`cpf`, `login`, `nome`, `setor`, `senha`, `status`, `perfil`, `dt_login`, `dt_upload`) VALUES
('001', '001', 'Lukinha da pela', 'TI', '001', 'ativo', 'funcionario', '2024-02-02 12:01:40', '0000-00-00 00:00:00'),
('002', '002', 'Levi', 'adm', '002', 'ativo', 'gestor', '2024-02-02 12:00:43', '0000-00-00 00:00:00'),
('003', '003', 'SENHOR MELB LAU', 'cvt', '003', 'ativo', 'gestor', '2024-02-02 11:50:52', '0000-00-00 00:00:00'),
('123', '123', 'zibora', 'cvt', '123', 'ativo', 'funcionario', '2024-02-02 11:55:22', '0000-00-00 00:00:00'),
('32', '32', 'Carla beatriz ', 'cvt', '32', 'ativo', 'funcionario', '2024-02-02 11:58:41', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `metas`
--

CREATE TABLE `metas` (
  `id_programa` varchar(255) NOT NULL,
  `id_meta` varchar(400) NOT NULL,
  `nome_meta` varchar(255) NOT NULL,
  `tem_indicador` tinyint(1) NOT NULL,
  `dt_criada` datetime NOT NULL,
  `dt_atualizada` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `metas`
--

INSERT INTO `metas` (`id_programa`, `id_meta`, `nome_meta`, `tem_indicador`, `dt_criada`, `dt_atualizada`) VALUES
('programa1', 'meta_areatext11', 'SFSAFSF', 0, '2024-04-05 10:07:31', '0000-00-00 00:00:00'),
('programa1', 'meta_areatext21', 'YRYRTYRYRY', 1, '2024-04-05 10:07:31', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `notatividades`
--

CREATE TABLE `notatividades` (
  `id` int(11) NOT NULL,
  `de` varchar(255) NOT NULL,
  `para` varchar(255) NOT NULL,
  `projeto` varchar(255) NOT NULL,
  `datanot` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `notatividades`
--

INSERT INTO `notatividades` (`id`, `de`, `para`, `projeto`, `datanot`) VALUES
(14, '222', '1234', 'iaa ,uleka', '0000-00-00'),
(15, 'zibora', 'zibora', 'iaa ,uleka', '0000-00-00'),
(16, 'SENHOR MELB LAU', 'zibora', 'rtreter', '0000-00-00'),
(17, 'SENHOR MELB LAU', 'zibora', 'rtreter', '0000-00-00'),
(18, '003', '1234', 'rtreter', '0000-00-00'),
(19, '003', '1234', 'terewtewbty 4ry', '0000-00-00'),
(20, 'SENHOR MELB LAU', 'zibora', 'terewtewbty 4ry', '0000-00-00'),
(21, 'SENHOR MELB LAU', 'zibora', '547475475767575', '0000-00-00'),
(22, 'SENHOR MELB LAU', 'zibora', 'kççok', '0000-00-00'),
(23, '003', '1234', 'rtreter', '0000-00-00'),
(24, '222', '1234', 'va tomar no cukkkkkkkkkk', '0000-00-00'),
(25, '1234', '1234', 'va tomar no cukkkkkkkkkk', '0000-00-00'),
(26, '222', '1234', '', '0000-00-00'),
(27, '222', '1234', 'va tomar no cukkkkkkkkkk', '0000-00-00'),
(28, 'zibora', 'zibora', 'va tomar no cukkkkkkkkkk', '0000-00-00'),
(29, 'levi', 'zibora', '', '0000-00-00'),
(30, 'levi', 'zibora', 'Gosto de piza', '0000-00-00'),
(31, 'levi', 'zibora', 'Tomar no cu', '0000-00-00'),
(32, '222', '222', 'va tomar no cukkkkkkkkkk', '0000-00-00'),
(33, '', '1234', 'w11ww', '0000-00-00'),
(34, '003', '1234', '3fre', '0000-00-00'),
(35, '003', '1234', 'y56y6u', '0000-00-00'),
(36, '', '1234', 'wefwf', '0000-00-00'),
(37, '', '1234', '4444', '0000-00-00'),
(38, '', '1234', '4444', '0000-00-00'),
(39, '', '1234', '09-=80u0olk', '0000-00-00'),
(40, '4444', '1234', '4444', '0000-00-00'),
(41, '4444', '1234', 'htrhhe', '0000-00-00'),
(42, '4444', '1234', 'htrhhe', '0000-00-00'),
(43, '4444', '1234', 'htrhhe', '0000-00-00'),
(44, '4444', '1234', 'htrhhe', '0000-00-00'),
(45, '003', '0000', 'iae meh paecrf', '2024-01-18');

-- --------------------------------------------------------

--
-- Estrutura para tabela `previsoes`
--

CREATE TABLE `previsoes` (
  `id_indicador` varchar(255) NOT NULL,
  `id_previsao_inicial` varchar(255) NOT NULL,
  `id_previsao_final` varchar(255) NOT NULL,
  `nome_previsao_inicial` varchar(255) NOT NULL,
  `nome_previsao_final` varchar(2555) NOT NULL,
  `dt_criada` datetime NOT NULL,
  `dt_atualizada` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `previsoes`
--

INSERT INTO `previsoes` (`id_indicador`, `id_previsao_inicial`, `id_previsao_final`, `nome_previsao_inicial`, `nome_previsao_final`, `dt_criada`, `dt_atualizada`) VALUES
('indicadortextarea111', 'text_previsao_inicial111', 'text_previsao_final111', 'FSFSFS', 'FSFS', '2024-04-05 10:07:31', '0000-00-00 00:00:00'),
('indicadortextarea121', 'text_previsao_inicial121', 'text_previsao_final121', 'RTY', 'RTYRYR', '2024-04-05 10:07:31', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `previstos_no_trimestre`
--

CREATE TABLE `previstos_no_trimestre` (
  `id_tabela` varchar(255) NOT NULL,
  `id_previsto` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `bimestre_trimestre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `previstos_no_trimestre`
--

INSERT INTO `previstos_no_trimestre` (`id_tabela`, `id_previsto`, `valor`, `bimestre_trimestre`) VALUES
('previsto_table111', 1118, 1, '1 °Bim'),
('previsto_table111', 1119, 2, '2 °Trim'),
('previsto_table111', 1120, 3, '3 °Trim'),
('previsto_table111', 1121, 4, '4 °Trim'),
('previsto_table121', 1122, 0, '1 °Bim'),
('previsto_table121', 1123, 0, '2 °Trim'),
('previsto_table121', 1124, 0, '3 °Trim'),
('previsto_table121', 1125, 0, '4 °Trim');

-- --------------------------------------------------------

--
-- Estrutura para tabela `programa`
--

CREATE TABLE `programa` (
  `id_programa` varchar(155) NOT NULL,
  `nome_programa` varchar(255) NOT NULL,
  `login_criador` varchar(255) NOT NULL,
  `data_criada` datetime NOT NULL,
  `data_atualizada` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `programa`
--

INSERT INTO `programa` (`id_programa`, `nome_programa`, `login_criador`, `data_criada`, `data_atualizada`) VALUES
('programa1', ' TENTANDO ', '', '2024-04-05 10:07:22', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `projetos`
--

CREATE TABLE `projetos` (
  `id_projeto` int(11) NOT NULL,
  `nome_projeto` varchar(255) NOT NULL,
  `login_criador` varchar(255) NOT NULL,
  `caminho_projeto` varchar(255) NOT NULL,
  `objetivo` varchar(400) NOT NULL,
  `dt_criada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `projetos`
--

INSERT INTO `projetos` (`id_projeto`, `nome_projeto`, `login_criador`, `caminho_projeto`, `objetivo`, `dt_criada`) VALUES
(60, 'PROGRAMA 1- INOVAÇÃO', '003', '..projetos/projetos/', ' INCUBAR PROJETOS PRIORITARIAMENTE NOS SEGMENTOS DE: FINANÇAS, AGRONEGÓCIO, ENERGIA E SAÚDE.', '2024-02-02 12:27:18'),
(61, 'PROGRAMA 2- IA e JOVEM TECH', '003', '..projetos/projetos/', 'CAPACITAR ESTUDANTES, PROFISSIONAIS E GESTORES PÚBLICOS EM INTELIGÊNCIA ARTIFICIAL (IA) E ESTUDANTES NO PROGRAMA SERGIPE JOVEM TECH.', '2024-02-02 16:20:50'),
(62, 'PROGRAMA 3- HIDROGÊNIO VERDE', '003', ' ..projetos/projetos/', ' REALIZAR A PESQUISA EM HIDROGÊNIO VERDE NO ESTADO', '2024-02-02 12:23:25'),
(63, 'PROGRAMA 4- SOLAR', '003', '..projetos/projetos/', 'REALIZAR PROJETOS DE ENERGIAS RENOVÁVEIS DO ESTADO.', '2024-02-02 12:23:39');

-- --------------------------------------------------------

--
-- Estrutura para tabela `realizados_no_trimestre`
--

CREATE TABLE `realizados_no_trimestre` (
  `id_tabela` varchar(255) NOT NULL,
  `id_realizado` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `bimestre_trimestre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `realizados_no_trimestre`
--

INSERT INTO `realizados_no_trimestre` (`id_tabela`, `id_realizado`, `valor`, `bimestre_trimestre`) VALUES
('previsto_table111', 1169, 5, '1 °Bim'),
('previsto_table111', 1170, 6, '2 °Trim'),
('previsto_table111', 1171, 7, '3 °Trim'),
('previsto_table111', 1172, 8, '4 °Trim'),
('previsto_table121', 1173, 0, '1 °Bim'),
('previsto_table121', 1174, 0, '2 °Trim'),
('previsto_table121', 1175, 0, '3 °Trim'),
('previsto_table121', 1176, 0, '4 °Trim');

-- --------------------------------------------------------

--
-- Estrutura para tabela `relatorios`
--

CREATE TABLE `relatorios` (
  `id_relatorio` int(11) NOT NULL,
  `id_projeto` int(11) DEFAULT NULL,
  `id_setor` int(255) NOT NULL,
  `login_remetente` varchar(255) NOT NULL,
  `nome_relatorio` varchar(255) NOT NULL,
  `caminho_pdf` varchar(255) NOT NULL,
  `data_upload` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `relatorios`
--

INSERT INTO `relatorios` (`id_relatorio`, `id_projeto`, `id_setor`, `login_remetente`, `nome_relatorio`, `caminho_pdf`, `data_upload`) VALUES
(55, 63, 42, '32', 'file (3).pdf', '..\\documentos/PROGRAMA 4- SOLAR32/META-1/862ac475cc5abae96e5cb58f31961ed4.pdf', '2024-03-25 12:54:00'),
(56, 61, 40, '32', 'Missa 01-03 (1).pdf', '..\\documentos/PROGRAMA 2- IA e JOVEM TECH32/META-1/a399b0459bcd1c362721ca2152c810be.pdf', '2024-03-25 12:55:02');

-- --------------------------------------------------------

--
-- Estrutura para tabela `setor`
--

CREATE TABLE `setor` (
  `id_setor` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `id_projeto` int(11) NOT NULL,
  `login_criador` varchar(255) NOT NULL,
  `objetivo_setor` varchar(400) NOT NULL,
  `dt_criado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `setor`
--

INSERT INTO `setor` (`id_setor`, `nome`, `id_projeto`, `login_criador`, `objetivo_setor`, `dt_criado`) VALUES
(39, 'META-1', 60, '003', 'Incubar Projetos prioritariamente nos seguimentos de: finanças, agronegócio, energia e saúde', '2024-02-02 13:16:53'),
(40, 'META-1', 61, '003', 'Firmar parceria com instituições de ensino e pesquisa que são referência em IA no Brasil', '2024-02-02 13:25:05'),
(41, 'META-1', 62, '003', 'Coordenar pesquisas em parceria com academia no uso de Hidrogênio Verde', '2024-02-02 13:25:33'),
(42, 'META-1', 63, '003', 'Desenvolvimento de Projeto Piloto para Utilização de Energia Solar em prédio público', '2024-02-02 13:25:51'),
(43, 'cvt studio', 61, '003', 'QSOtewrterterer', '2024-03-25 13:59:27');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_contratos`
--

CREATE TABLE `tb_contratos` (
  `id_indicador` varchar(255) NOT NULL,
  `id_tabela` varchar(255) NOT NULL,
  `total_contratos` int(11) NOT NULL,
  `total_executados` int(11) NOT NULL,
  `dt_criada` datetime NOT NULL,
  `dt_atualizada` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_contratos`
--

INSERT INTO `tb_contratos` (`id_indicador`, `id_tabela`, `total_contratos`, `total_executados`, `dt_criada`, `dt_atualizada`) VALUES
('indicadortextarea111', 'totaltable111', 21, 57, '2024-04-05 10:07:31', '0000-00-00 00:00:00'),
('indicadortextarea121', 'totaltable121', 21, 57, '2024-04-05 10:07:31', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_previsoes`
--

CREATE TABLE `tb_previsoes` (
  `id_indicador` varchar(255) NOT NULL,
  `id_tabela` varchar(255) NOT NULL,
  `total_previstos` int(11) NOT NULL,
  `total_realizados` int(11) NOT NULL,
  `acumulativo` int(11) NOT NULL,
  `dt_criada` datetime NOT NULL,
  `dt_atualizada` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_previsoes`
--

INSERT INTO `tb_previsoes` (`id_indicador`, `id_tabela`, `total_previstos`, `total_realizados`, `acumulativo`, `dt_criada`, `dt_atualizada`) VALUES
('indicadortextarea111', 'previsto_table111', 10, 35, 9, '2024-04-05 10:07:31', '0000-00-00 00:00:00'),
('indicadortextarea121', 'previsto_table121', 10, 35, 0, '2024-04-05 10:07:31', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `texto_avaliativo`
--

CREATE TABLE `texto_avaliativo` (
  `id_indicador` varchar(255) NOT NULL,
  `id_texto_avaliativo` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `dt_criada` datetime NOT NULL,
  `dt_atualizada` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `texto_avaliativo`
--

INSERT INTO `texto_avaliativo` (`id_indicador`, `id_texto_avaliativo`, `valor`, `dt_criada`, `dt_atualizada`) VALUES
('indicadortextarea111', 'text_texto_avaliativo1111', 'FGGDFGD', '2024-04-05 10:07:22', '0000-00-00 00:00:00'),
('indicadortextarea111', 'text_texto_avaliativo1112', 'GDFG', '2024-04-05 10:07:22', '0000-00-00 00:00:00'),
('indicadortextarea111', 'text_texto_avaliativo1113', 'GFDGDFGDS', '2024-04-05 10:07:22', '0000-00-00 00:00:00'),
('indicadortextarea121', 'text_texto_avaliativo1211', '', '2024-04-05 10:07:31', '0000-00-00 00:00:00'),
('indicadortextarea121', 'text_texto_avaliativo1212', '', '2024-04-05 10:07:31', '0000-00-00 00:00:00'),
('indicadortextarea121', 'text_texto_avaliativo1213', '', '2024-04-05 10:07:31', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `total_executados`
--

CREATE TABLE `total_executados` (
  `id_tabela` varchar(255) NOT NULL,
  `id_total_executados` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `ano` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `total_executados`
--

INSERT INTO `total_executados` (`id_tabela`, `id_total_executados`, `valor`, `ano`) VALUES
('totaltable111', 1708, 7, '2024'),
('totaltable111', 1709, 8, '2025'),
('totaltable111', 1710, 9, '2026'),
('totaltable111', 1711, 10, '2027'),
('totaltable111', 1712, 11, '2028'),
('totaltable111', 1713, 12, '2029'),
('totaltable121', 1714, 0, '2024'),
('totaltable121', 1715, 0, '2025'),
('totaltable121', 1716, 0, '2026'),
('totaltable121', 1717, 0, '2027'),
('totaltable121', 1718, 0, '2028'),
('totaltable121', 1719, 0, '2029');

-- --------------------------------------------------------

--
-- Estrutura para tabela `total_por_ano`
--

CREATE TABLE `total_por_ano` (
  `id_tabela` varchar(255) NOT NULL,
  `id_total_por_ano` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `ano` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `total_por_ano`
--

INSERT INTO `total_por_ano` (`id_tabela`, `id_total_por_ano`, `valor`, `ano`) VALUES
('totaltable111', 1537, 1, '2024'),
('totaltable111', 1538, 2, '2025'),
('totaltable111', 1539, 3, '2026'),
('totaltable111', 1540, 4, '2027'),
('totaltable111', 1541, 5, '2028'),
('totaltable111', 1542, 6, '2029'),
('totaltable121', 1543, 0, '2024'),
('totaltable121', 1544, 0, '2025'),
('totaltable121', 1545, 0, '2026'),
('totaltable121', 1546, 0, '2027'),
('totaltable121', 1547, 0, '2028'),
('totaltable121', 1548, 0, '2029');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `col_projeto`
--
ALTER TABLE `col_projeto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projeto_col` (`id_projeto`),
  ADD KEY `col_setor` (`id_setor`);

--
-- Índices de tabela `indicadores`
--
ALTER TABLE `indicadores`
  ADD PRIMARY KEY (`id_indicador`),
  ADD KEY `metas_indicadores` (`id_meta`);

--
-- Índices de tabela `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices de tabela `metas`
--
ALTER TABLE `metas`
  ADD PRIMARY KEY (`id_meta`),
  ADD KEY `programa_meta` (`id_programa`);

--
-- Índices de tabela `notatividades`
--
ALTER TABLE `notatividades`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `previsoes`
--
ALTER TABLE `previsoes`
  ADD PRIMARY KEY (`id_previsao_inicial`),
  ADD UNIQUE KEY `id_previsao_final` (`id_previsao_final`),
  ADD KEY `previsoes_indicadores` (`id_indicador`);

--
-- Índices de tabela `previstos_no_trimestre`
--
ALTER TABLE `previstos_no_trimestre`
  ADD PRIMARY KEY (`id_previsto`),
  ADD KEY `previstos_trimestre_tb_previsoes` (`id_tabela`);

--
-- Índices de tabela `programa`
--
ALTER TABLE `programa`
  ADD PRIMARY KEY (`id_programa`);

--
-- Índices de tabela `projetos`
--
ALTER TABLE `projetos`
  ADD PRIMARY KEY (`id_projeto`),
  ADD KEY `login_projetos` (`login_criador`);

--
-- Índices de tabela `realizados_no_trimestre`
--
ALTER TABLE `realizados_no_trimestre`
  ADD PRIMARY KEY (`id_realizado`),
  ADD KEY `realizadas_timestre_tb_previsoes` (`id_tabela`);

--
-- Índices de tabela `relatorios`
--
ALTER TABLE `relatorios`
  ADD PRIMARY KEY (`id_relatorio`),
  ADD KEY `id_projeto` (`id_projeto`),
  ADD KEY `relatorio_setor` (`id_setor`),
  ADD KEY `login_relatorio` (`login_remetente`);

--
-- Índices de tabela `setor`
--
ALTER TABLE `setor`
  ADD PRIMARY KEY (`id_setor`),
  ADD KEY `setor_projetos` (`id_projeto`),
  ADD KEY `login_setor` (`login_criador`);

--
-- Índices de tabela `tb_contratos`
--
ALTER TABLE `tb_contratos`
  ADD PRIMARY KEY (`id_tabela`),
  ADD KEY `tb_contratos_indicadores` (`id_indicador`);

--
-- Índices de tabela `tb_previsoes`
--
ALTER TABLE `tb_previsoes`
  ADD PRIMARY KEY (`id_tabela`),
  ADD KEY `tb_previsoes_indicadores` (`id_indicador`);

--
-- Índices de tabela `texto_avaliativo`
--
ALTER TABLE `texto_avaliativo`
  ADD PRIMARY KEY (`id_texto_avaliativo`),
  ADD KEY `texto_avaliativo_indicadores` (`id_indicador`);

--
-- Índices de tabela `total_executados`
--
ALTER TABLE `total_executados`
  ADD PRIMARY KEY (`id_total_executados`),
  ADD KEY `total_executados_td_contratos` (`id_tabela`);

--
-- Índices de tabela `total_por_ano`
--
ALTER TABLE `total_por_ano`
  ADD PRIMARY KEY (`id_total_por_ano`),
  ADD KEY `total_por_ano_tb_contratos` (`id_tabela`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `col_projeto`
--
ALTER TABLE `col_projeto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de tabela `notatividades`
--
ALTER TABLE `notatividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de tabela `previstos_no_trimestre`
--
ALTER TABLE `previstos_no_trimestre`
  MODIFY `id_previsto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1126;

--
-- AUTO_INCREMENT de tabela `projetos`
--
ALTER TABLE `projetos`
  MODIFY `id_projeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de tabela `realizados_no_trimestre`
--
ALTER TABLE `realizados_no_trimestre`
  MODIFY `id_realizado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1177;

--
-- AUTO_INCREMENT de tabela `relatorios`
--
ALTER TABLE `relatorios`
  MODIFY `id_relatorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de tabela `setor`
--
ALTER TABLE `setor`
  MODIFY `id_setor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de tabela `total_executados`
--
ALTER TABLE `total_executados`
  MODIFY `id_total_executados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1720;

--
-- AUTO_INCREMENT de tabela `total_por_ano`
--
ALTER TABLE `total_por_ano`
  MODIFY `id_total_por_ano` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1549;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `col_projeto`
--
ALTER TABLE `col_projeto`
  ADD CONSTRAINT `col_setor` FOREIGN KEY (`id_setor`) REFERENCES `setor` (`id_setor`),
  ADD CONSTRAINT `projeto_col` FOREIGN KEY (`id_projeto`) REFERENCES `projetos` (`id_projeto`);

--
-- Restrições para tabelas `indicadores`
--
ALTER TABLE `indicadores`
  ADD CONSTRAINT `metas_indicadores` FOREIGN KEY (`id_meta`) REFERENCES `metas` (`id_meta`) ON DELETE CASCADE;

--
-- Restrições para tabelas `metas`
--
ALTER TABLE `metas`
  ADD CONSTRAINT `programa_meta` FOREIGN KEY (`id_programa`) REFERENCES `programa` (`id_programa`) ON DELETE CASCADE;

--
-- Restrições para tabelas `previsoes`
--
ALTER TABLE `previsoes`
  ADD CONSTRAINT `previsoes_indicadores` FOREIGN KEY (`id_indicador`) REFERENCES `indicadores` (`id_indicador`) ON DELETE CASCADE;

--
-- Restrições para tabelas `previstos_no_trimestre`
--
ALTER TABLE `previstos_no_trimestre`
  ADD CONSTRAINT `previstos_trimestre_tb_previsoes` FOREIGN KEY (`id_tabela`) REFERENCES `tb_previsoes` (`id_tabela`) ON DELETE CASCADE;

--
-- Restrições para tabelas `projetos`
--
ALTER TABLE `projetos`
  ADD CONSTRAINT `login_projetos` FOREIGN KEY (`login_criador`) REFERENCES `login` (`login`);

--
-- Restrições para tabelas `realizados_no_trimestre`
--
ALTER TABLE `realizados_no_trimestre`
  ADD CONSTRAINT `realizadas_timestre_tb_previsoes` FOREIGN KEY (`id_tabela`) REFERENCES `tb_previsoes` (`id_tabela`) ON DELETE CASCADE;

--
-- Restrições para tabelas `relatorios`
--
ALTER TABLE `relatorios`
  ADD CONSTRAINT `login_relatorio` FOREIGN KEY (`login_remetente`) REFERENCES `login` (`login`),
  ADD CONSTRAINT `relatorio_setor` FOREIGN KEY (`id_setor`) REFERENCES `setor` (`id_setor`),
  ADD CONSTRAINT `relatorios_ibfk_1` FOREIGN KEY (`id_projeto`) REFERENCES `projetos` (`id_projeto`);

--
-- Restrições para tabelas `setor`
--
ALTER TABLE `setor`
  ADD CONSTRAINT `login_setor` FOREIGN KEY (`login_criador`) REFERENCES `login` (`login`),
  ADD CONSTRAINT `setor_projetos` FOREIGN KEY (`id_projeto`) REFERENCES `projetos` (`id_projeto`);

--
-- Restrições para tabelas `tb_contratos`
--
ALTER TABLE `tb_contratos`
  ADD CONSTRAINT `tb_contratos_indicadores` FOREIGN KEY (`id_indicador`) REFERENCES `indicadores` (`id_indicador`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tb_previsoes`
--
ALTER TABLE `tb_previsoes`
  ADD CONSTRAINT `tb_previsoes_indicadores` FOREIGN KEY (`id_indicador`) REFERENCES `indicadores` (`id_indicador`) ON DELETE CASCADE;

--
-- Restrições para tabelas `texto_avaliativo`
--
ALTER TABLE `texto_avaliativo`
  ADD CONSTRAINT `texto_avaliativo_indicadores` FOREIGN KEY (`id_indicador`) REFERENCES `indicadores` (`id_indicador`) ON DELETE CASCADE;

--
-- Restrições para tabelas `total_executados`
--
ALTER TABLE `total_executados`
  ADD CONSTRAINT `total_executados_td_contratos` FOREIGN KEY (`id_tabela`) REFERENCES `tb_contratos` (`id_tabela`) ON DELETE CASCADE;

--
-- Restrições para tabelas `total_por_ano`
--
ALTER TABLE `total_por_ano`
  ADD CONSTRAINT `total_por_ano_tb_contratos` FOREIGN KEY (`id_tabela`) REFERENCES `tb_contratos` (`id_tabela`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
