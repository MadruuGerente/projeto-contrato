-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12/06/2024 às 16:28
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
-- Estrutura para tabela `anexos`
--

CREATE TABLE `anexos` (
  `id_anexo` varchar(255) NOT NULL,
  `id_indicador` varchar(255) NOT NULL,
  `nome_anexo` varchar(255) NOT NULL,
  `caminho_anexo` varchar(255) NOT NULL,
  `dt_criada` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `anexos`
--

INSERT INTO `anexos` (`id_anexo`, `id_indicador`, `nome_anexo`, `caminho_anexo`, `dt_criada`) VALUES
('anexoinput2024_003110', 'indicadortextarea2024_00311', 'WhatsApp Video 2024-05-24 at 10.28.09.mp4', '../uploads/anexoinput2024_003110-WhatsApp Video 2024-05-24 at 10.28.09.mp4', '2024-05-27 07:44:13'),
('anexoinput2024_003111', 'indicadortextarea2024_00311', 'babuino.jpg', '../uploads/anexoinput2024_003111-babuino.jpg', '2024-05-27 07:44:13'),
('anexoinput2024_005210', 'indicadortextarea2024_00521', 'babuino.jpg', '../uploads/anexoinput2024_005210-babuino.jpg', '2024-05-29 10:23:10'),
('anexoinput2024_005230', 'indicadortextarea2024_00523', 'WhatsApp Video 2024-05-24 at 10.28.09.mp4', '../uploads/anexoinput2024_005230-WhatsApp Video 2024-05-24 at 10.28.09.mp4', '2024-05-29 10:23:11'),
('anexoinput2024_006110', 'indicadortextarea2024_00611', 'Captura de tela 2024-06-03 085417.png', '../uploads/anexoinput2024_006110-Captura de tela 2024-06-03 085417.png', '2024-06-05 07:27:32'),
('anexoinput2024_007110', 'indicadortextarea2024_00711', 'Historia do judo (2) - Copia.pdf', '../uploads/anexoinput2024_007110-Historia do judo (2) - Copia.pdf', '2024-06-06 11:28:31'),
('anexoinput2024_008110', 'indicadortextarea2024_00811', 'WhatsApp Video 2024-05-24 at 10.28.09.mp4', '../uploads/anexoinput2024_008110-WhatsApp Video 2024-05-24 at 10.28.09.mp4', '2024-06-07 07:56:24'),
('anexoinput2024_008111', 'indicadortextarea2024_00811', 'babuino.jpg', '../uploads/anexoinput2024_008111-babuino.jpg', '2024-06-07 07:56:23'),
('anexoinput2024_008120', 'indicadortextarea2024_00812', 'dd.jpeg', '../uploads/anexoinput2024_008120-dd.jpeg', '2024-06-07 07:56:24'),
('anexoinput2024_009110', 'indicadortextarea2024_00911', 'dd.jpeg', '../uploads/anexoinput2024_009110-dd.jpeg', '2024-06-07 09:56:28'),
('anexoinput2024_013210', 'indicadortextarea2024_01321', 'VID_20040512_033047_914.mp4', '../uploads/anexoinput2024_013210-VID_20040512_033047_914.mp4', '2024-06-12 11:20:46');

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
(54, '32', 61, 40, '2024-03-25 13:54:44', 1, 1),
(55, '123', 61, 44, '2024-04-18 16:12:13', 1, 1),
(56, '001', 60, 39, '2024-04-19 12:43:15', 1, 1),
(57, '001', 63, 42, '2024-04-19 12:43:27', 1, 1),
(58, '123', 64, 45, '2024-04-24 16:05:02', 1, 1),
(59, '123', 64, 46, '2024-04-24 16:07:03', 1, 1),
(60, '111', 65, 47, '2024-05-15 12:57:34', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `contratos`
--

CREATE TABLE `contratos` (
  `id_contrato` varchar(255) NOT NULL,
  `nome_contrato` varchar(255) NOT NULL,
  `numero_contrato` varchar(255) NOT NULL,
  `meses` varchar(255) NOT NULL,
  `bimestre` varchar(255) NOT NULL,
  `contratante` varchar(255) NOT NULL,
  `contratado` varchar(255) NOT NULL,
  `periodo_abrangencia` varchar(255) NOT NULL,
  `objetivo_contrato` varchar(255) NOT NULL,
  `objetivo_contratado` varchar(255) NOT NULL,
  `os_contratados` varchar(250) NOT NULL,
  `contrato_gestao` varchar(250) NOT NULL,
  `plano_trabalho` varchar(250) NOT NULL,
  `cpf_criador` varchar(255) NOT NULL,
  `dt_criada` datetime NOT NULL,
  `dt_atualizada` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `contratos`
--

INSERT INTO `contratos` (`id_contrato`, `nome_contrato`, `numero_contrato`, `meses`, `bimestre`, `contratante`, `contratado`, `periodo_abrangencia`, `objetivo_contrato`, `objetivo_contratado`, `os_contratados`, `contrato_gestao`, `plano_trabalho`, `cpf_criador`, `dt_criada`, `dt_atualizada`) VALUES
('contrato_2024_003', ' RELATÓRIO 1º TRIMESTRE 2023_JANEIRO_MARÇO', 'Nº 01/2022\r\n', ' MAIO E JUNHO DE 2022', '  1º BIMESTRE / 2022', ' Secretaria de Estado do Desenvolvimento Econômico e da Ciência e Tecnologia – SEDETEC/SE.', ' Sergipe Parque Tecnológico – SERGIPETEC.', ' \r\n 	\r\nPERÍODO DE ABRANGÊNCIA DO RELATÓRIO \r\n8 de MAIO de 2022 a 30 de JUNHO de 2022.', ' Celebração de Contrato de Gestão com entidade qualificada como organização social, objetivando a continuidade da parceria entre o poder Público Estadual e o Sergipe Parque Tecnológico – SERGIPETEC, com a finalidade de consolidar o Parque Tecnológico para', ' A promoção do desenvolvimento científico e tecnológico local e regional, através do fomento de atividades de pesquisa e de ensino, do apoio a empreendimentos de base técnica e industrial e da implementação de um parque tecnológico que contemple a gestão ', '  \r\n 	\r\nA OS SERGIPETEC é uma instituição de direito privado, sem fins lucrativos, que implementa políticas públicas não exclusivas de governo, em consonância com as diretrizes e políticas do Estado', '  \r\n 	\r\nO CONTRATO DE GESTÃO nº 01/2022, foi firmado por um período de 5 (cinco) anos, com início em 26 de abril de 2022 e término em 25 de abril de 2027', ' O PLANO DE TRABALHO para o período de 2022 a 2027, atende aos objetivos estratégicos do Contrato de Gestão nº 01/2022 e seus aditivos, sendo composto por, metas, atividades, produto, duração prevista, indicador físico de eficiência, unidade e setor ', '069', '2024-06-12 15:11:02', '0000-00-00 00:00:00'),
('contrato_2024_004', ' terterte', 'JGGHGHFJG ', ' tretete', ' tert', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '069', '2024-06-12 15:39:57', '0000-00-00 00:00:00'),
('contrato_2024_005', ' Testado do meu celular brother ', 'JGGHGHFJG ', ' Jsjsj', ' Sjshs', ' Hshss', ' Shshs', ' Hshs', ' Hshs', ' Shshsh', 'u eueue', ' Hshs', ' Hshsh', '069', '2024-06-12 16:14:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `contratos_programas`
--

CREATE TABLE `contratos_programas` (
  `id` int(11) NOT NULL,
  `id_contrato` varchar(255) NOT NULL,
  `id_programa` varchar(255) NOT NULL,
  `dt_criada` datetime NOT NULL,
  `dt_atualizada` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `contratos_programas`
--

INSERT INTO `contratos_programas` (`id`, `id_contrato`, `id_programa`, `dt_criada`, `dt_atualizada`) VALUES
(72, 'contrato_2024_003', 'programa_2024_009', '2024-06-12 15:11:02', '0000-00-00 00:00:00'),
(73, 'contrato_2024_003', 'programa_2024_008', '2024-06-12 15:11:02', '0000-00-00 00:00:00'),
(74, 'contrato_2024_003', 'programa_2024_007', '2024-06-12 15:11:02', '0000-00-00 00:00:00'),
(78, 'contrato_2024_004', 'programa_2024_012', '2024-06-12 15:39:57', '0000-00-00 00:00:00'),
(79, 'contrato_2024_004', 'programa_2024_011', '2024-06-12 15:39:57', '0000-00-00 00:00:00'),
(80, 'contrato_2024_004', 'programa_2024_010', '2024-06-12 15:39:57', '0000-00-00 00:00:00'),
(81, 'contrato_2024_005', 'programa_2024_004', '2024-06-12 16:14:55', '0000-00-00 00:00:00'),
(82, 'contrato_2024_005', 'programa_2024_005', '2024-06-12 16:14:55', '0000-00-00 00:00:00'),
(83, 'contrato_2024_005', 'programa_2024_006', '2024-06-12 16:14:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `enviar_programas`
--

CREATE TABLE `enviar_programas` (
  `id` int(11) NOT NULL,
  `login_de` varchar(255) NOT NULL,
  `login_para` varchar(255) NOT NULL,
  `id_programa_enviado` varchar(255) NOT NULL,
  `view` tinyint(4) NOT NULL DEFAULT 0,
  `dt_envio` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `enviar_programas`
--

INSERT INTO `enviar_programas` (`id`, `login_de`, `login_para`, `id_programa_enviado`, `view`, `dt_envio`) VALUES
(22, '123', '069', 'programa_2024_003', 1, '2024-05-27 16:11:49'),
(23, '123', '069', 'programa_2024_004', 1, '2024-05-29 15:11:46'),
(24, '123', '069', 'programa_2024_005', 1, '2024-05-29 15:24:49'),
(25, '003', '069', 'programa_2024_006', 1, '2024-06-05 12:28:57'),
(26, '003', '069', 'programa_2024_007', 1, '2024-06-06 16:28:46'),
(27, '32', '222', 'programa_2024_008', 0, '2024-06-07 13:21:37'),
(28, '32', '069', 'programa_2024_008', 1, '2024-06-07 13:47:13'),
(29, '055', '069', 'programa_2024_009', 1, '2024-06-07 14:57:05'),
(30, '003', '069', 'programa_2024_010', 1, '2024-06-12 15:39:10'),
(31, '003', '069', 'programa_2024_011', 1, '2024-06-12 15:39:14'),
(32, '003', '069', 'programa_2024_012', 1, '2024-06-12 15:39:16'),
(33, '123', '069', 'programa_2024_013', 1, '2024-06-12 16:21:06');

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
('meta_areatext12024_003', 'indicadortextarea2024_00311', 'FSDAFASD ', '2024-05-27 07:44:13', '0000-00-00 00:00:00'),
('meta_areatext12024_004', 'indicadortextarea2024_00411', 'dgd', '2024-05-29 08:59:47', '0000-00-00 00:00:00'),
('meta_areatext22024_005', 'indicadortextarea2024_00521', 'Definir os temas para o evento', '2024-05-29 10:23:11', '0000-00-00 00:00:00'),
('meta_areatext22024_005', 'indicadortextarea2024_00522', 'Convidar parceiros para apoio ao evento', '2024-05-29 10:23:11', '0000-00-00 00:00:00'),
('meta_areatext22024_005', 'indicadortextarea2024_00523', 'Definir o local para a realização do evento', '2024-05-29 10:23:11', '0000-00-00 00:00:00'),
('meta_areatext12024_006', 'indicadortextarea2024_00611', '\'', '2024-06-05 07:27:37', '0000-00-00 00:00:00'),
('meta_areatext12024_007', 'indicadortextarea2024_00711', 'INDICADOR DE NÚMERO FESG', '2024-06-06 11:28:31', '0000-00-00 00:00:00'),
('meta_areatext12024_008', 'indicadortextarea2024_00811', 'INDICADOR DE NÚMERO UM              ', '2024-06-07 07:56:24', '0000-00-00 00:00:00'),
('meta_areatext12024_008', 'indicadortextarea2024_00812', 'INDICADOR DE NÚMERO DOIS               ', '2024-06-07 07:56:24', '0000-00-00 00:00:00'),
('meta_areatext12024_009', 'indicadortextarea2024_00911', 'IYUI', '2024-06-07 09:56:33', '0000-00-00 00:00:00'),
('meta_areatext22024_009', 'indicadortextarea2024_00921', '', '2024-06-07 09:56:33', '0000-00-00 00:00:00'),
('meta_areatext12024_010', 'indicadortextarea2024_01011', 'dgd', '2024-06-12 10:38:35', '0000-00-00 00:00:00'),
('meta_areatext12024_011', 'indicadortextarea2024_01111', 'gdg', '2024-06-12 10:38:48', '0000-00-00 00:00:00'),
('meta_areatext12024_012', 'indicadortextarea2024_01211', 'dsgdfg', '2024-06-12 10:39:06', '0000-00-00 00:00:00'),
('meta_areatext22024_013', 'indicadortextarea2024_01321', 'Jejsjs', '2024-06-12 11:20:45', '0000-00-00 00:00:00');

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
  `img_perfil` varchar(255) NOT NULL,
  `tem_img` tinyint(1) NOT NULL DEFAULT 0,
  `dt_login` datetime DEFAULT NULL,
  `dt_upload` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `login`
--

INSERT INTO `login` (`cpf`, `login`, `nome`, `setor`, `senha`, `status`, `perfil`, `img_perfil`, `tem_img`, `dt_login`, `dt_upload`) VALUES
('001', '001', 'Lukinha da pela', 'TI', '$2y$10$dwD6ntaWKFuFhyo1lAX5aeFZakj4cVEnlIGRbgFs.125xZ/qOQjfS', 'ativo', 'Gestor', '', 0, '2024-02-02 12:01:40', '0000-00-00 00:00:00'),
('002', '002', 'Levi', 'adm', '$2y$10$dwD6ntaWKFuFhyo1lAX5aeFZakj4cVEnlIGRbgFs.125xZ/qOQjfS', 'ativo', 'Gestor', '', 0, '2024-02-02 12:00:43', '0000-00-00 00:00:00'),
('003', '003', 'SENHOR MELB LAU', 'cvt', '$2y$10$VAYzhGNfGT7dJ487ICJ1DeeBhMsecmLuNSCzRs84tBtVxdh.Tz3/6', ' ativo', 'Gestor', '', 0, '2024-02-02 11:50:52', '0000-00-00 00:00:00'),
('0032', '0032', 'GUILHERME GOIABADA DO BODI SANTOS', 'CVT', '$2y$10$qXId24tZ4F046sLF4NvPUOVhnR0lnNlMfAgf69Q5xQEYzd1NhRjHe', 'ativo', 'Mega Gestor', '', 0, '2024-05-24 16:28:23', '0000-00-00 00:00:00'),
('006', '006', 'ho my good', 'lalla', '$2y$10$6tpNmQQ95anMD/4c2vbnF.3ukC6JslHj2P4RxOAfQdkh.tb4OZvaa', 'inativo', 'Gestor', '', 0, '2024-04-19 13:02:04', '0000-00-00 00:00:00'),
('055', '055', 'IGOR MORCEGO ', 'CVT', '$2y$10$D/3X2BPTB2K0wq2K05utWOD4RbTahhNS2LnXuo/Wfxl/zHd77blue', 'ativo', 'Gestor', '../imagens/img_perfil/055-images.jpg', 1, '2024-06-07 14:52:49', '0000-00-00 00:00:00'),
('069', '069', 'RAFAEL PINHO DE SANTANA MEGA CHEFE', 'CVT', '$2y$10$gK5Its6v4LCt2EL82h3tuu0ivwDAaUpMmJji/qqXg8GNkAjqdDGX.', 'ativo', 'Mega Gestor', '../imagens/img_perfil/069-dd.jpeg', 1, '2024-05-15 12:52:26', '0000-00-00 00:00:00'),
('111', '111', 'VICTOR MONETEIRO CHEFE', 'CVT', '$2y$10$OhxLcf5p6r/MTqq6/CB8q.Zdz7jkBkKZVCRXOCFOL3lqYPY5xj6fK', 'ativo', 'Gestor', '', 0, '2024-05-15 12:48:37', '0000-00-00 00:00:00'),
('123', '123', 'zibora', 'cvt', '$2y$10$SOSgjexQo46trrLO7fHF0OVs9aLPxMRCCK/l5mDeR7oP1E9KV9o.S', 'ativo', 'Gestor', '../imagens/img_perfil/123-17182018737274257630669226938398.jpg', 1, '2024-02-02 11:55:22', '0000-00-00 00:00:00'),
('222', '222', 'GUILHERME MARCOS SANTOS ', 'TI', '$2y$10$sw8qC89YhSO5D2RCXL577.2g5DVl/9f52mBdw3hSx/csQwE/gvIV6', 'ativo', 'Mega Gestor', '', 0, '2024-05-15 13:50:08', '0000-00-00 00:00:00'),
('32', '32', 'Carla beatriz ', 'cvt', '$2y$10$b80zbH.yneGKdFtatpkAPON6SeC5H5weOQNK1HWDmFCnKhGoLXJGO', 'ativo', 'Gestor', '', 0, '2024-02-02 11:58:41', '0000-00-00 00:00:00'),
('777', '777', 'leleu', 'cvt', '$2y$10$dwD6ntaWKFuFhyo1lAX5aeFZakj4cVEnlIGRbgFs.125xZ/qOQjfS', 'ativo', 'Gestor', '', 0, '2024-04-24 12:40:17', '0000-00-00 00:00:00'),
('999', '999', 'Lukinha muia perfirr', 'cvt', '$2y$10$Hsm.V03OVZ89gHyuO6TozOM0e3tRAQKtIrVtiaDOvuvShVJnD5JDC', 'ativo', 'Gestor', '', 0, '2024-04-25 13:42:01', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `metas`
--

CREATE TABLE `metas` (
  `id_programa` varchar(255) NOT NULL,
  `id_meta` varchar(400) NOT NULL,
  `nome_meta` varchar(255) NOT NULL,
  `tem_indicador` int(1) NOT NULL,
  `dt_criada` datetime NOT NULL,
  `dt_atualizada` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `metas`
--

INSERT INTO `metas` (`id_programa`, `id_meta`, `nome_meta`, `tem_indicador`, `dt_criada`, `dt_atualizada`) VALUES
('programa_2024_003', 'meta_areatext12024_003', 'SDFSDF ', 1, '2024-05-27 07:44:13', '0000-00-00 00:00:00'),
('programa_2024_004', 'meta_areatext12024_004', 'PRIMEIRA META ', 1, '2024-05-29 08:59:47', '0000-00-00 00:00:00'),
('programa_2024_005', 'meta_areatext12024_005', 'Incubar Projetos prioritariamente nos seguimentos de: finanças, agronegócio, energia e saúde', 0, '2024-05-29 10:19:38', '0000-00-00 00:00:00'),
('programa_2024_006', 'meta_areatext12024_006', '\'', 1, '2024-06-05 07:27:37', '0000-00-00 00:00:00'),
('programa_2024_007', 'meta_areatext12024_007', 'C É LOCO ', 1, '2024-06-06 11:28:31', '0000-00-00 00:00:00'),
('programa_2024_008', 'meta_areatext12024_008', 'UMA META COM DOISdd INDICADORES               ', 1, '2024-06-07 07:56:24', '0000-00-00 00:00:00'),
('programa_2024_009', 'meta_areatext12024_009', 'YKIUU', 1, '2024-06-07 09:56:33', '0000-00-00 00:00:00'),
('programa_2024_010', 'meta_areatext12024_010', 'fsfssg', 1, '2024-06-12 10:38:35', '0000-00-00 00:00:00'),
('programa_2024_011', 'meta_areatext12024_011', 'gdgdgdfg', 1, '2024-06-12 10:38:48', '0000-00-00 00:00:00'),
('programa_2024_012', 'meta_areatext12024_012', 'gdfgdffgsagd', 1, '2024-06-12 10:39:06', '0000-00-00 00:00:00'),
('programa_2024_013', 'meta_areatext12024_013', 'Neta', 0, '2024-06-12 11:18:14', '0000-00-00 00:00:00'),
('programa_2024_004', 'meta_areatext22024_004', 'SEGUNDA META ', 0, '2024-05-29 08:59:47', '0000-00-00 00:00:00'),
('programa_2024_005', 'meta_areatext22024_005', 'Realizar \"bootcamp\", \"hackathon\", \"challenge\" e palestras.\n', 1, '2024-05-29 10:23:11', '0000-00-00 00:00:00'),
('programa_2024_006', 'meta_areatext22024_006', '\'', 0, '2024-06-05 07:27:37', '0000-00-00 00:00:00'),
('programa_2024_009', 'meta_areatext22024_009', '', 1, '2024-06-07 09:56:33', '0000-00-00 00:00:00'),
('programa_2024_013', 'meta_areatext22024_013', 'Do mario', 1, '2024-06-12 11:20:45', '0000-00-00 00:00:00'),
('programa_2024_006', 'meta_areatext32024_006', '\'', 0, '2024-06-05 07:27:37', '0000-00-00 00:00:00');

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
('indicadortextarea2024_00311', 'text_previsao_inicial_2024_00311', 'text_previsao_final_2024_00311', 'FSDFSAD ', 'FASDFSADF ', '2024-05-27 07:44:13', '0000-00-00 00:00:00'),
('indicadortextarea2024_00411', 'text_previsao_inicial_2024_00411', 'text_previsao_final_2024_00411', 'gdg', 'gdsgfd', '2024-05-29 08:59:47', '0000-00-00 00:00:00'),
('indicadortextarea2024_00521', 'text_previsao_inicial_2024_00521', 'text_previsao_final_2024_00521', 'Maio/24', 'Outubro/24', '2024-05-29 10:23:11', '0000-00-00 00:00:00'),
('indicadortextarea2024_00522', 'text_previsao_inicial_2024_00522', 'text_previsao_final_2024_00522', 'Maio/24', 'Outubro/24', '2024-05-29 10:23:11', '0000-00-00 00:00:00'),
('indicadortextarea2024_00523', 'text_previsao_inicial_2024_00523', 'text_previsao_final_2024_00523', 'Junho/24', 'Outubro/24', '2024-05-29 10:23:11', '0000-00-00 00:00:00'),
('indicadortextarea2024_00611', 'text_previsao_inicial_2024_00611', 'text_previsao_final_2024_00611', '\'', '\'', '2024-06-05 07:27:37', '0000-00-00 00:00:00'),
('indicadortextarea2024_00711', 'text_previsao_inicial_2024_00711', 'text_previsao_final_2024_00711', 'FFHFGHH', 'HFGHFGHFG', '2024-06-06 11:28:31', '0000-00-00 00:00:00'),
('indicadortextarea2024_00811', 'text_previsao_inicial_2024_00811', 'text_previsao_final_2024_00811', '23/JULHO         vxcxc     ', '23/ABRIL              ', '2024-06-07 07:56:24', '0000-00-00 00:00:00'),
('indicadortextarea2024_00812', 'text_previsao_inicial_2024_00812', 'text_previsao_final_2024_00812', '23/JULHO              ', '45/ABRILjjhg     ', '2024-06-07 07:56:24', '0000-00-00 00:00:00'),
('indicadortextarea2024_00911', 'text_previsao_inicial_2024_00911', 'text_previsao_final_2024_00911', 'YYUI', '', '2024-06-07 09:56:33', '0000-00-00 00:00:00'),
('indicadortextarea2024_00921', 'text_previsao_inicial_2024_00921', 'text_previsao_final_2024_00921', '', '', '2024-06-07 09:56:33', '0000-00-00 00:00:00'),
('indicadortextarea2024_01011', 'text_previsao_inicial_2024_01011', 'text_previsao_final_2024_01011', 'gfgd', 'gdgdfg', '2024-06-12 10:38:35', '0000-00-00 00:00:00'),
('indicadortextarea2024_01111', 'text_previsao_inicial_2024_01111', 'text_previsao_final_2024_01111', 'dgdgd', 'gdgdfd', '2024-06-12 10:38:48', '0000-00-00 00:00:00'),
('indicadortextarea2024_01211', 'text_previsao_inicial_2024_01211', 'text_previsao_final_2024_01211', 'gdg', 'dfgdfs', '2024-06-12 10:39:06', '0000-00-00 00:00:00'),
('indicadortextarea2024_01321', 'text_previsao_inicial_2024_01321', 'text_previsao_final_2024_01321', 'Hsjshs', 'Bsnshs', '2024-06-12 11:20:45', '0000-00-00 00:00:00');

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
('previsto_table2024_00311', 4501, 1, '1 °Bim'),
('previsto_table2024_00311', 4502, 0, '2 °Trim'),
('previsto_table2024_00311', 4503, 1, '3 °Trim'),
('previsto_table2024_00311', 4504, 0, '4 °Trim'),
('previsto_table2024_00411', 4505, 0, '1 °Bim'),
('previsto_table2024_00411', 4506, 0, '2 °Trim'),
('previsto_table2024_00411', 4507, 0, '3 °Trim'),
('previsto_table2024_00411', 4508, 0, '4 °Trim'),
('previsto_table2024_00521', 4509, 0, '1 °Bim'),
('previsto_table2024_00521', 4510, 0, '2 °Trim'),
('previsto_table2024_00521', 4511, 3, '3 °Trim'),
('previsto_table2024_00521', 4512, 0, '4 °Trim'),
('previsto_table2024_00522', 4513, 0, '1 °Bim'),
('previsto_table2024_00522', 4514, 0, '2 °Trim'),
('previsto_table2024_00522', 4515, 1, '3 °Trim'),
('previsto_table2024_00522', 4516, 0, '4 °Trim'),
('previsto_table2024_00523', 4517, 0, '1 °Bim'),
('previsto_table2024_00523', 4518, 0, '2 °Trim'),
('previsto_table2024_00523', 4519, 1, '3 °Trim'),
('previsto_table2024_00523', 4520, 0, '4 °Trim'),
('previsto_table2024_00611', 4525, 1111, '1 °Bim'),
('previsto_table2024_00611', 4526, 0, '2 °Trim'),
('previsto_table2024_00611', 4527, 11111, '3 °Trim'),
('previsto_table2024_00611', 4528, 1111, '4 °Trim'),
('previsto_table2024_00711', 4529, 0, '1 °Bim'),
('previsto_table2024_00711', 4530, 1, '2 °Trim'),
('previsto_table2024_00711', 4531, 0, '3 °Trim'),
('previsto_table2024_00711', 4532, 1, '4 °Trim'),
('previsto_table2024_00811', 4533, 0, '1 °Bim'),
('previsto_table2024_00811', 4534, 2, '2 °Trim'),
('previsto_table2024_00811', 4535, 2, '3 °Trim'),
('previsto_table2024_00811', 4536, 0, '4 °Trim'),
('previsto_table2024_00812', 4537, 2, '1 °Bim'),
('previsto_table2024_00812', 4538, 1, '2 °Trim'),
('previsto_table2024_00812', 4539, 2, '3 °Trim'),
('previsto_table2024_00812', 4540, 1, '4 °Trim'),
('previsto_table2024_00911', 4541, 0, '1 °Bim'),
('previsto_table2024_00911', 4542, 0, '2 °Trim'),
('previsto_table2024_00911', 4543, 0, '3 °Trim'),
('previsto_table2024_00911', 4544, 0, '4 °Trim'),
('previsto_table2024_00921', 4545, 0, '1 °Bim'),
('previsto_table2024_00921', 4546, 0, '2 °Trim'),
('previsto_table2024_00921', 4547, 0, '3 °Trim'),
('previsto_table2024_00921', 4548, 0, '4 °Trim'),
('previsto_table2024_01011', 4565, 0, '1 °Bim'),
('previsto_table2024_01011', 4566, 0, '2 °Trim'),
('previsto_table2024_01011', 4567, 0, '3 °Trim'),
('previsto_table2024_01011', 4568, 0, '4 °Trim'),
('previsto_table2024_01111', 4569, 0, '1 °Bim'),
('previsto_table2024_01111', 4570, 0, '2 °Trim'),
('previsto_table2024_01111', 4571, 0, '3 °Trim'),
('previsto_table2024_01111', 4572, 0, '4 °Trim'),
('previsto_table2024_01211', 4573, 0, '1 °Bim'),
('previsto_table2024_01211', 4574, 0, '2 °Trim'),
('previsto_table2024_01211', 4575, 0, '3 °Trim'),
('previsto_table2024_01211', 4576, 0, '4 °Trim'),
('previsto_table2024_01321', 4577, 1, '1 °Bim'),
('previsto_table2024_01321', 4578, 0, '2 °Trim'),
('previsto_table2024_01321', 4579, 0, '3 °Trim'),
('previsto_table2024_01321', 4580, 0, '4 °Trim');

-- --------------------------------------------------------

--
-- Estrutura para tabela `programa`
--

CREATE TABLE `programa` (
  `id_programa` varchar(155) NOT NULL,
  `nome_programa` varchar(255) NOT NULL,
  `cpf_criador` varchar(255) NOT NULL,
  `contrato_pertecente` varchar(255) NOT NULL,
  `numero` int(255) NOT NULL,
  `data_criada` datetime NOT NULL,
  `data_atualizada` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `programa`
--

INSERT INTO `programa` (`id_programa`, `nome_programa`, `cpf_criador`, `contrato_pertecente`, `numero`, `data_criada`, `data_atualizada`) VALUES
('programa_2024_003', 'muis\n', '123', '', 0, '2024-05-27 07:44:13', '0000-00-00 00:00:00'),
('programa_2024_004', 'gdfgdfgdsg', '123', '', 0, '2024-05-29 08:59:32', '0000-00-00 00:00:00'),
('programa_2024_005', ' INCUBAR PROJETOS PRIORITARIAMENTE NOS SEGMENTOS DE: FINANÇAS, AGRONEGÓCIO, ENERGIA E SAÚDE.', '123', '', 0, '2024-05-29 10:19:38', '0000-00-00 00:00:00'),
('programa_2024_006', ' TESTANDO MEU MANO ', '003', '', 0, '2024-06-05 07:27:32', '0000-00-00 00:00:00'),
('programa_2024_007', ' BIG BROTHER BRASIL KKK', '003', '', 0, '2024-06-06 11:28:30', '0000-00-00 00:00:00'),
('programa_2024_008', ' TESTANDO FUNCI\n', '32', '', 0, '2024-06-07 07:56:22', '0000-00-00 00:00:00'),
('programa_2024_009', ' JHJHJ', '055', '', 0, '2024-06-07 09:56:27', '0000-00-00 00:00:00'),
('programa_2024_010', 'programa 1', '003', '', 0, '2024-06-12 10:38:35', '0000-00-00 00:00:00'),
('programa_2024_011', ' programa 2', '003', '', 0, '2024-06-12 10:38:48', '0000-00-00 00:00:00'),
('programa_2024_012', ' programa 3', '003', '', 0, '2024-06-12 10:39:05', '0000-00-00 00:00:00'),
('programa_2024_013', ' Fritando ', '123', '', 0, '2024-06-12 11:18:14', '0000-00-00 00:00:00');

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
(63, 'PROGRAMA 4- SOLAR', '003', '..projetos/projetos/', 'REALIZAR PROJETOS DE ENERGIAS RENOVÁVEIS DO ESTADO.', '2024-02-02 12:23:39'),
(64, 'tete', '003', '..projetos/projetos/', 'criar tu ', '2024-04-24 19:04:34'),
(65, 'nome', '069', '..projetos/projetos/', 'criar um projeto ', '2024-05-15 15:56:50'),
(66, 'YUIKYIIYRIRYI', '069', '..projetos/projetos/', 'YUIYIYI', '2024-06-05 16:10:56');

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
('previsto_table2024_00311', 4551, 0, '1 °Bim'),
('previsto_table2024_00311', 4552, 1, '2 °Trim'),
('previsto_table2024_00311', 4553, 0, '3 °Trim'),
('previsto_table2024_00311', 4554, 1, '4 °Trim'),
('previsto_table2024_00411', 4555, 0, '1 °Bim'),
('previsto_table2024_00411', 4556, 0, '2 °Trim'),
('previsto_table2024_00411', 4557, 0, '3 °Trim'),
('previsto_table2024_00411', 4558, 0, '4 °Trim'),
('previsto_table2024_00521', 4559, 0, '1 °Bim'),
('previsto_table2024_00521', 4560, 0, '2 °Trim'),
('previsto_table2024_00521', 4561, 0, '3 °Trim'),
('previsto_table2024_00521', 4562, 0, '4 °Trim'),
('previsto_table2024_00522', 4563, 0, '1 °Bim'),
('previsto_table2024_00522', 4564, 0, '2 °Trim'),
('previsto_table2024_00522', 4565, 0, '3 °Trim'),
('previsto_table2024_00522', 4566, 0, '4 °Trim'),
('previsto_table2024_00523', 4567, 0, '1 °Bim'),
('previsto_table2024_00523', 4568, 0, '2 °Trim'),
('previsto_table2024_00523', 4569, 0, '3 °Trim'),
('previsto_table2024_00523', 4570, 0, '4 °Trim'),
('previsto_table2024_00611', 4575, 0, '1 °Bim'),
('previsto_table2024_00611', 4576, 0, '2 °Trim'),
('previsto_table2024_00611', 4577, 111, '3 °Trim'),
('previsto_table2024_00611', 4578, 1, '4 °Trim'),
('previsto_table2024_00711', 4579, 1, '1 °Bim'),
('previsto_table2024_00711', 4580, 0, '2 °Trim'),
('previsto_table2024_00711', 4581, 1, '3 °Trim'),
('previsto_table2024_00711', 4582, 0, '4 °Trim'),
('previsto_table2024_00811', 4583, 0, '1 °Bim'),
('previsto_table2024_00811', 4584, 2, '2 °Trim'),
('previsto_table2024_00811', 4585, 2, '3 °Trim'),
('previsto_table2024_00811', 4586, 0, '4 °Trim'),
('previsto_table2024_00812', 4587, 1, '1 °Bim'),
('previsto_table2024_00812', 4588, 2, '2 °Trim'),
('previsto_table2024_00812', 4589, 1, '3 °Trim'),
('previsto_table2024_00812', 4590, 2, '4 °Trim'),
('previsto_table2024_00911', 4591, 0, '1 °Bim'),
('previsto_table2024_00911', 4592, 0, '2 °Trim'),
('previsto_table2024_00911', 4593, 0, '3 °Trim'),
('previsto_table2024_00911', 4594, 0, '4 °Trim'),
('previsto_table2024_00921', 4595, 0, '1 °Bim'),
('previsto_table2024_00921', 4596, 0, '2 °Trim'),
('previsto_table2024_00921', 4597, 0, '3 °Trim'),
('previsto_table2024_00921', 4598, 0, '4 °Trim'),
('previsto_table2024_01011', 4615, 0, '1 °Bim'),
('previsto_table2024_01011', 4616, 0, '2 °Trim'),
('previsto_table2024_01011', 4617, 0, '3 °Trim'),
('previsto_table2024_01011', 4618, 0, '4 °Trim'),
('previsto_table2024_01111', 4619, 0, '1 °Bim'),
('previsto_table2024_01111', 4620, 0, '2 °Trim'),
('previsto_table2024_01111', 4621, 0, '3 °Trim'),
('previsto_table2024_01111', 4622, 0, '4 °Trim'),
('previsto_table2024_01211', 4623, 0, '1 °Bim'),
('previsto_table2024_01211', 4624, 0, '2 °Trim'),
('previsto_table2024_01211', 4625, 0, '3 °Trim'),
('previsto_table2024_01211', 4626, 0, '4 °Trim'),
('previsto_table2024_01321', 4627, 0, '1 °Bim'),
('previsto_table2024_01321', 4628, 0, '2 °Trim'),
('previsto_table2024_01321', 4629, 0, '3 °Trim'),
('previsto_table2024_01321', 4630, 0, '4 °Trim');

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
(56, 61, 40, '32', 'Missa 01-03 (1).pdf', '..\\documentos/PROGRAMA 2- IA e JOVEM TECH32/META-1/a399b0459bcd1c362721ca2152c810be.pdf', '2024-03-25 12:55:02'),
(57, 60, 39, '123', 'file (2).pdf', '..\\documentos/PROGRAMA 1- INOVAÇÃO123/META-1/7baf07af51bfefebd0e247dbde2df21b.pdf', '2024-04-18 14:10:47'),
(58, 60, 39, '001', 'ESCALA 2024 - ABRIL E MAIO 2024.pdf', '..\\documentos/PROGRAMA 1- INOVAÇÃO001/META-1/bce37b74621d680fa3e870ecb42ea724.pdf', '2024-04-19 10:43:54'),
(59, 63, 42, '001', 'ESCALA 2024 - ABRIL E MAIO 2024.pdf', '..\\documentos/PROGRAMA 4- SOLAR001/META-1/46fe09abbf3ae636c1d1eb14ad8900a8.pdf', '2024-04-19 10:44:03'),
(60, 65, 47, '111', '46.pdf', '..\\documentos/nome111/cpof/6f53b4840638b9b164de10c9310b3c13.pdf', '2024-05-15 10:58:12');

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
(43, 'cvt studio', 61, '003', 'QSOtewrterterer', '2024-03-25 13:59:27'),
(44, 'RUH', 61, '003', 'GANHAR MEMBRO PARA A LIGA DA JUSTIÇA ', '2024-04-18 16:12:01'),
(45, 'uttyut', 64, '003', 'ututyu', '2024-04-24 16:04:48'),
(46, 'cvt studio', 64, '003', 'MATAR BARATAS ', '2024-04-24 16:06:54'),
(47, 'cpof', 65, '069', 'criar um projeto ', '2024-05-15 12:57:22'),
(48, 'IYUIYTIYUI', 66, '069', 'YUIYIYI', '2024-06-05 13:11:02');

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
('indicadortextarea2024_00311', 'totaltable_2024_00311', 0, 0, '2024-05-27 07:44:13', '0000-00-00 00:00:00'),
('indicadortextarea2024_00411', 'totaltable_2024_00411', 0, 0, '2024-05-29 08:59:47', '0000-00-00 00:00:00'),
('indicadortextarea2024_00521', 'totaltable_2024_00521', 3, 0, '2024-05-29 10:23:11', '0000-00-00 00:00:00'),
('indicadortextarea2024_00522', 'totaltable_2024_00522', 1, 0, '2024-05-29 10:23:11', '0000-00-00 00:00:00'),
('indicadortextarea2024_00523', 'totaltable_2024_00523', 1, 0, '2024-05-29 10:23:11', '0000-00-00 00:00:00'),
('indicadortextarea2024_00611', 'totaltable_2024_00611', 2, 1, '2024-06-05 07:27:37', '0000-00-00 00:00:00'),
('indicadortextarea2024_00711', 'totaltable_2024_00711', 2, 3, '2024-06-06 11:28:31', '0000-00-00 00:00:00'),
('indicadortextarea2024_00811', 'totaltable_2024_00811', 2, 2, '2024-06-07 07:56:24', '0000-00-00 00:00:00'),
('indicadortextarea2024_00812', 'totaltable_2024_00812', 2, 2, '2024-06-07 07:56:24', '0000-00-00 00:00:00'),
('indicadortextarea2024_00911', 'totaltable_2024_00911', 0, 0, '2024-06-07 09:56:33', '0000-00-00 00:00:00'),
('indicadortextarea2024_00921', 'totaltable_2024_00921', 0, 0, '2024-06-07 09:56:33', '0000-00-00 00:00:00'),
('indicadortextarea2024_01011', 'totaltable_2024_01011', 0, 0, '2024-06-12 10:38:35', '0000-00-00 00:00:00'),
('indicadortextarea2024_01111', 'totaltable_2024_01111', 0, 0, '2024-06-12 10:38:48', '0000-00-00 00:00:00'),
('indicadortextarea2024_01211', 'totaltable_2024_01211', 0, 0, '2024-06-12 10:39:06', '0000-00-00 00:00:00'),
('indicadortextarea2024_01321', 'totaltable_2024_01321', 1, 2, '2024-06-12 11:20:45', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_previsoes`
--

CREATE TABLE `tb_previsoes` (
  `id_indicador` varchar(255) NOT NULL,
  `id_tabela` varchar(255) NOT NULL,
  `total_previstos` int(11) NOT NULL,
  `total_realizados` int(11) NOT NULL,
  `acumulativo` int(2) NOT NULL,
  `dt_criada` datetime NOT NULL,
  `dt_atualizada` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_previsoes`
--

INSERT INTO `tb_previsoes` (`id_indicador`, `id_tabela`, `total_previstos`, `total_realizados`, `acumulativo`, `dt_criada`, `dt_atualizada`) VALUES
('indicadortextarea2024_00311', 'previsto_table2024_00311', 2, 2, 0, '2024-05-27 07:44:13', '0000-00-00 00:00:00'),
('indicadortextarea2024_00411', 'previsto_table2024_00411', 0, 0, 0, '2024-05-29 08:59:47', '0000-00-00 00:00:00'),
('indicadortextarea2024_00521', 'previsto_table2024_00521', 3, 0, 0, '2024-05-29 10:23:11', '0000-00-00 00:00:00'),
('indicadortextarea2024_00522', 'previsto_table2024_00522', 1, 0, 0, '2024-05-29 10:23:11', '0000-00-00 00:00:00'),
('indicadortextarea2024_00523', 'previsto_table2024_00523', 1, 0, 0, '2024-05-29 10:23:11', '0000-00-00 00:00:00'),
('indicadortextarea2024_00611', 'previsto_table2024_00611', 3, 1, 0, '2024-06-05 07:27:37', '0000-00-00 00:00:00'),
('indicadortextarea2024_00711', 'previsto_table2024_00711', 2, 3, 1, '2024-06-06 11:28:31', '0000-00-00 00:00:00'),
('indicadortextarea2024_00811', 'previsto_table2024_00811', 2, 3, 6, '2024-06-07 07:56:24', '0000-00-00 00:00:00'),
('indicadortextarea2024_00812', 'previsto_table2024_00812', 2, 3, 2, '2024-06-07 07:56:24', '0000-00-00 00:00:00'),
('indicadortextarea2024_00911', 'previsto_table2024_00911', 0, 0, 0, '2024-06-07 09:56:33', '0000-00-00 00:00:00'),
('indicadortextarea2024_00921', 'previsto_table2024_00921', 0, 0, 0, '2024-06-07 09:56:33', '0000-00-00 00:00:00'),
('indicadortextarea2024_01011', 'previsto_table2024_01011', 0, 0, 0, '2024-06-12 10:38:35', '0000-00-00 00:00:00'),
('indicadortextarea2024_01111', 'previsto_table2024_01111', 0, 0, 0, '2024-06-12 10:38:48', '0000-00-00 00:00:00'),
('indicadortextarea2024_01211', 'previsto_table2024_01211', 0, 0, 0, '2024-06-12 10:39:06', '0000-00-00 00:00:00'),
('indicadortextarea2024_01321', 'previsto_table2024_01321', 1, 0, 0, '2024-06-12 11:20:45', '0000-00-00 00:00:00');

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
('indicadortextarea2024_00311', 'text_texto_avaliativo2024_003111', 'SDFSD', '2024-05-27 07:44:13', '0000-00-00 00:00:00'),
('indicadortextarea2024_00311', 'text_texto_avaliativo2024_003112', 'SFFSDFSD', '2024-05-27 07:44:13', '0000-00-00 00:00:00'),
('indicadortextarea2024_00311', 'text_texto_avaliativo2024_003113', 'FSDFSDFS', '2024-05-27 07:44:13', '0000-00-00 00:00:00'),
('indicadortextarea2024_00411', 'text_texto_avaliativo2024_004111', 'gdg', '2024-05-29 08:59:32', '0000-00-00 00:00:00'),
('indicadortextarea2024_00411', 'text_texto_avaliativo2024_004112', 'dfgdgd', '2024-05-29 08:59:32', '0000-00-00 00:00:00'),
('indicadortextarea2024_00411', 'text_texto_avaliativo2024_004113', 'dgdfg', '2024-05-29 08:59:32', '0000-00-00 00:00:00'),
('indicadortextarea2024_00521', 'text_texto_avaliativo2024_005211', '', '2024-05-29 10:23:10', '0000-00-00 00:00:00'),
('indicadortextarea2024_00521', 'text_texto_avaliativo2024_005212', '', '2024-05-29 10:23:10', '0000-00-00 00:00:00'),
('indicadortextarea2024_00521', 'text_texto_avaliativo2024_005213', '', '2024-05-29 10:23:10', '0000-00-00 00:00:00'),
('indicadortextarea2024_00522', 'text_texto_avaliativo2024_005221', 'Atividade prevista para ser concluida até outubro 20224.', '2024-05-29 10:23:10', '0000-00-00 00:00:00'),
('indicadortextarea2024_00522', 'text_texto_avaliativo2024_005222', '', '2024-05-29 10:23:10', '0000-00-00 00:00:00'),
('indicadortextarea2024_00522', 'text_texto_avaliativo2024_005223', '', '2024-05-29 10:23:10', '0000-00-00 00:00:00'),
('indicadortextarea2024_00523', 'text_texto_avaliativo2024_005231', 'Atividade prevista para ser concluida até outubro 2024.', '2024-05-29 10:23:10', '0000-00-00 00:00:00'),
('indicadortextarea2024_00523', 'text_texto_avaliativo2024_005232', '', '2024-05-29 10:23:10', '0000-00-00 00:00:00'),
('indicadortextarea2024_00523', 'text_texto_avaliativo2024_005233', '', '2024-05-29 10:23:10', '0000-00-00 00:00:00'),
('indicadortextarea2024_00611', 'text_texto_avaliativo2024_006111', '\'', '2024-06-05 07:27:32', '0000-00-00 00:00:00'),
('indicadortextarea2024_00611', 'text_texto_avaliativo2024_006112', '\'', '2024-06-05 07:27:32', '0000-00-00 00:00:00'),
('indicadortextarea2024_00611', 'text_texto_avaliativo2024_006113', '\'', '2024-06-05 07:27:32', '0000-00-00 00:00:00'),
('indicadortextarea2024_00711', 'text_texto_avaliativo2024_007111', 'FHFG', '2024-06-06 11:28:30', '0000-00-00 00:00:00'),
('indicadortextarea2024_00711', 'text_texto_avaliativo2024_007112', 'HHHFGHF', '2024-06-06 11:28:30', '0000-00-00 00:00:00'),
('indicadortextarea2024_00711', 'text_texto_avaliativo2024_007113', 'HFHFHG', '2024-06-06 11:28:30', '0000-00-00 00:00:00'),
('indicadortextarea2024_00811', 'text_texto_avaliativo2024_008111', 'GFDHFGH', '2024-06-07 07:56:22', '0000-00-00 00:00:00'),
('indicadortextarea2024_00811', 'text_texto_avaliativo2024_008112', 'FHFGHFH', '2024-06-07 07:56:22', '0000-00-00 00:00:00'),
('indicadortextarea2024_00811', 'text_texto_avaliativo2024_008113', 'FGHFHFG', '2024-06-07 07:56:22', '0000-00-00 00:00:00'),
('indicadortextarea2024_00812', 'text_texto_avaliativo2024_008121', 'DD44utyut', '2024-06-07 07:56:23', '0000-00-00 00:00:00'),
('indicadortextarea2024_00812', 'text_texto_avaliativo2024_008122', 'DD44', '2024-06-07 07:56:23', '0000-00-00 00:00:00'),
('indicadortextarea2024_00812', 'text_texto_avaliativo2024_008123', 'DD44', '2024-06-07 07:56:23', '0000-00-00 00:00:00'),
('indicadortextarea2024_00911', 'text_texto_avaliativo2024_009111', '', '2024-06-07 09:56:27', '0000-00-00 00:00:00'),
('indicadortextarea2024_00911', 'text_texto_avaliativo2024_009112', '', '2024-06-07 09:56:27', '0000-00-00 00:00:00'),
('indicadortextarea2024_00911', 'text_texto_avaliativo2024_009113', '', '2024-06-07 09:56:27', '0000-00-00 00:00:00'),
('indicadortextarea2024_00921', 'text_texto_avaliativo2024_009211', '', '2024-06-07 09:56:31', '0000-00-00 00:00:00'),
('indicadortextarea2024_00921', 'text_texto_avaliativo2024_009212', '', '2024-06-07 09:56:31', '0000-00-00 00:00:00'),
('indicadortextarea2024_00921', 'text_texto_avaliativo2024_009213', '', '2024-06-07 09:56:31', '0000-00-00 00:00:00'),
('indicadortextarea2024_01011', 'text_texto_avaliativo2024_010111', '', '2024-06-12 10:38:35', '0000-00-00 00:00:00'),
('indicadortextarea2024_01011', 'text_texto_avaliativo2024_010112', '', '2024-06-12 10:38:35', '0000-00-00 00:00:00'),
('indicadortextarea2024_01011', 'text_texto_avaliativo2024_010113', '', '2024-06-12 10:38:35', '0000-00-00 00:00:00'),
('indicadortextarea2024_01111', 'text_texto_avaliativo2024_011111', 'gdggdg', '2024-06-12 10:38:48', '0000-00-00 00:00:00'),
('indicadortextarea2024_01111', 'text_texto_avaliativo2024_011112', 'dgd', '2024-06-12 10:38:48', '0000-00-00 00:00:00'),
('indicadortextarea2024_01111', 'text_texto_avaliativo2024_011113', 'ggdsg', '2024-06-12 10:38:48', '0000-00-00 00:00:00'),
('indicadortextarea2024_01211', 'text_texto_avaliativo2024_012111', 'fdgdfgdsf', '2024-06-12 10:39:05', '0000-00-00 00:00:00'),
('indicadortextarea2024_01211', 'text_texto_avaliativo2024_012112', 'gdfg', '2024-06-12 10:39:05', '0000-00-00 00:00:00'),
('indicadortextarea2024_01211', 'text_texto_avaliativo2024_012113', 'gdsgdf', '2024-06-12 10:39:05', '0000-00-00 00:00:00'),
('indicadortextarea2024_01321', 'text_texto_avaliativo2024_013211', 'Sss', '2024-06-12 11:20:44', '0000-00-00 00:00:00'),
('indicadortextarea2024_01321', 'text_texto_avaliativo2024_013212', 'Ssss', '2024-06-12 11:20:44', '0000-00-00 00:00:00'),
('indicadortextarea2024_01321', 'text_texto_avaliativo2024_013213', 'Eussj', '2024-06-12 11:20:44', '0000-00-00 00:00:00');

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
('totaltable_2024_00311', 6795, 0, '2024'),
('totaltable_2024_00311', 6796, 0, '2025'),
('totaltable_2024_00311', 6797, 0, '2026'),
('totaltable_2024_00311', 6798, 0, '2027'),
('totaltable_2024_00311', 6799, 0, '2028'),
('totaltable_2024_00311', 6800, 0, '2029'),
('totaltable_2024_00411', 6801, 0, '2024'),
('totaltable_2024_00411', 6802, 0, '2025'),
('totaltable_2024_00411', 6803, 0, '2026'),
('totaltable_2024_00411', 6804, 0, '2027'),
('totaltable_2024_00411', 6805, 0, '2028'),
('totaltable_2024_00411', 6806, 0, '2029'),
('totaltable_2024_00521', 6807, 0, '2024'),
('totaltable_2024_00521', 6808, 0, '2025'),
('totaltable_2024_00521', 6809, 0, '2026'),
('totaltable_2024_00521', 6810, 0, '2027'),
('totaltable_2024_00521', 6811, 0, '2028'),
('totaltable_2024_00521', 6812, 0, '2029'),
('totaltable_2024_00522', 6813, 0, '2024'),
('totaltable_2024_00522', 6814, 0, '2025'),
('totaltable_2024_00522', 6815, 0, '2026'),
('totaltable_2024_00522', 6816, 0, '2027'),
('totaltable_2024_00522', 6817, 0, '2028'),
('totaltable_2024_00522', 6818, 0, '2029'),
('totaltable_2024_00523', 6819, 0, '2024'),
('totaltable_2024_00523', 6820, 0, '2025'),
('totaltable_2024_00523', 6821, 0, '2026'),
('totaltable_2024_00523', 6822, 0, '2027'),
('totaltable_2024_00523', 6823, 0, '2028'),
('totaltable_2024_00523', 6824, 0, '2029'),
('totaltable_2024_00611', 6831, 0, '2024'),
('totaltable_2024_00611', 6832, 1111, '2025'),
('totaltable_2024_00611', 6833, 0, '2026'),
('totaltable_2024_00611', 6834, 0, '2027'),
('totaltable_2024_00611', 6835, 0, '2028'),
('totaltable_2024_00611', 6836, 0, '2029'),
('totaltable_2024_00711', 6837, 1, '2024'),
('totaltable_2024_00711', 6838, 1, '2025'),
('totaltable_2024_00711', 6839, 0, '2026'),
('totaltable_2024_00711', 6840, 0, '2027'),
('totaltable_2024_00711', 6841, 0, '2028'),
('totaltable_2024_00711', 6842, 1, '2029'),
('totaltable_2024_00811', 6843, 0, '2024'),
('totaltable_2024_00811', 6844, 1, '2025'),
('totaltable_2024_00811', 6845, 0, '2026'),
('totaltable_2024_00811', 6846, 1, '2027'),
('totaltable_2024_00811', 6847, 0, '2028'),
('totaltable_2024_00811', 6848, 0, '2029'),
('totaltable_2024_00812', 6849, 1, '2024'),
('totaltable_2024_00812', 6850, 2, '2025'),
('totaltable_2024_00812', 6851, 1, '2026'),
('totaltable_2024_00812', 6852, 2, '2027'),
('totaltable_2024_00812', 6853, 1, '2028'),
('totaltable_2024_00812', 6854, 0, '2029'),
('totaltable_2024_00911', 6855, 0, '2024'),
('totaltable_2024_00911', 6856, 0, '2025'),
('totaltable_2024_00911', 6857, 0, '2026'),
('totaltable_2024_00911', 6858, 0, '2027'),
('totaltable_2024_00911', 6859, 0, '2028'),
('totaltable_2024_00911', 6860, 0, '2029'),
('totaltable_2024_00921', 6861, 0, '2024'),
('totaltable_2024_00921', 6862, 0, '2025'),
('totaltable_2024_00921', 6863, 0, '2026'),
('totaltable_2024_00921', 6864, 0, '2027'),
('totaltable_2024_00921', 6865, 0, '2028'),
('totaltable_2024_00921', 6866, 0, '2029'),
('totaltable_2024_01011', 6891, 0, '2024'),
('totaltable_2024_01011', 6892, 0, '2025'),
('totaltable_2024_01011', 6893, 0, '2026'),
('totaltable_2024_01011', 6894, 0, '2027'),
('totaltable_2024_01011', 6895, 0, '2028'),
('totaltable_2024_01011', 6896, 0, '2029'),
('totaltable_2024_01111', 6897, 0, '2024'),
('totaltable_2024_01111', 6898, 0, '2025'),
('totaltable_2024_01111', 6899, 0, '2026'),
('totaltable_2024_01111', 6900, 0, '2027'),
('totaltable_2024_01111', 6901, 0, '2028'),
('totaltable_2024_01111', 6902, 0, '2029'),
('totaltable_2024_01211', 6903, 0, '2024'),
('totaltable_2024_01211', 6904, 0, '2025'),
('totaltable_2024_01211', 6905, 0, '2026'),
('totaltable_2024_01211', 6906, 0, '2027'),
('totaltable_2024_01211', 6907, 0, '2028'),
('totaltable_2024_01211', 6908, 0, '2029'),
('totaltable_2024_01321', 6909, 0, '2024'),
('totaltable_2024_01321', 6910, 2, '2025'),
('totaltable_2024_01321', 6911, 0, '2026'),
('totaltable_2024_01321', 6912, 0, '2027'),
('totaltable_2024_01321', 6913, 0, '2028'),
('totaltable_2024_01321', 6914, 0, '2029');

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
('totaltable_2024_00311', 6629, 0, '2024'),
('totaltable_2024_00311', 6630, 0, '2025'),
('totaltable_2024_00311', 6631, 0, '2026'),
('totaltable_2024_00311', 6632, 0, '2027'),
('totaltable_2024_00311', 6633, 0, '2028'),
('totaltable_2024_00311', 6634, 0, '2029'),
('totaltable_2024_00411', 6635, 0, '2024'),
('totaltable_2024_00411', 6636, 0, '2025'),
('totaltable_2024_00411', 6637, 0, '2026'),
('totaltable_2024_00411', 6638, 0, '2027'),
('totaltable_2024_00411', 6639, 0, '2028'),
('totaltable_2024_00411', 6640, 0, '2029'),
('totaltable_2024_00521', 6641, 3, '2024'),
('totaltable_2024_00521', 6642, 0, '2025'),
('totaltable_2024_00521', 6643, 0, '2026'),
('totaltable_2024_00521', 6644, 0, '2027'),
('totaltable_2024_00521', 6645, 0, '2028'),
('totaltable_2024_00521', 6646, 0, '2029'),
('totaltable_2024_00522', 6647, 1, '2024'),
('totaltable_2024_00522', 6648, 0, '2025'),
('totaltable_2024_00522', 6649, 0, '2026'),
('totaltable_2024_00522', 6650, 0, '2027'),
('totaltable_2024_00522', 6651, 0, '2028'),
('totaltable_2024_00522', 6652, 0, '2029'),
('totaltable_2024_00523', 6653, 1, '2024'),
('totaltable_2024_00523', 6654, 0, '2025'),
('totaltable_2024_00523', 6655, 0, '2026'),
('totaltable_2024_00523', 6656, 0, '2027'),
('totaltable_2024_00523', 6657, 0, '2028'),
('totaltable_2024_00523', 6658, 0, '2029'),
('totaltable_2024_00611', 6665, 111, '2024'),
('totaltable_2024_00611', 6666, 0, '2025'),
('totaltable_2024_00611', 6667, 0, '2026'),
('totaltable_2024_00611', 6668, 0, '2027'),
('totaltable_2024_00611', 6669, 11111, '2028'),
('totaltable_2024_00611', 6670, 0, '2029'),
('totaltable_2024_00711', 6671, 1, '2024'),
('totaltable_2024_00711', 6672, 0, '2025'),
('totaltable_2024_00711', 6673, 0, '2026'),
('totaltable_2024_00711', 6674, 0, '2027'),
('totaltable_2024_00711', 6675, 1, '2028'),
('totaltable_2024_00711', 6676, 0, '2029'),
('totaltable_2024_00811', 6677, 1, '2024'),
('totaltable_2024_00811', 6678, 0, '2025'),
('totaltable_2024_00811', 6679, 0, '2026'),
('totaltable_2024_00811', 6680, 0, '2027'),
('totaltable_2024_00811', 6681, 0, '2028'),
('totaltable_2024_00811', 6682, 1, '2029'),
('totaltable_2024_00812', 6683, 6, '2024'),
('totaltable_2024_00812', 6684, 1, '2025'),
('totaltable_2024_00812', 6685, 2, '2026'),
('totaltable_2024_00812', 6686, 1, '2027'),
('totaltable_2024_00812', 6687, 1, '2028'),
('totaltable_2024_00812', 6688, 0, '2029'),
('totaltable_2024_00911', 6689, 0, '2024'),
('totaltable_2024_00911', 6690, 0, '2025'),
('totaltable_2024_00911', 6691, 0, '2026'),
('totaltable_2024_00911', 6692, 0, '2027'),
('totaltable_2024_00911', 6693, 0, '2028'),
('totaltable_2024_00911', 6694, 0, '2029'),
('totaltable_2024_00921', 6695, 0, '2024'),
('totaltable_2024_00921', 6696, 0, '2025'),
('totaltable_2024_00921', 6697, 0, '2026'),
('totaltable_2024_00921', 6698, 0, '2027'),
('totaltable_2024_00921', 6699, 0, '2028'),
('totaltable_2024_00921', 6700, 0, '2029'),
('totaltable_2024_01011', 6725, 0, '2024'),
('totaltable_2024_01011', 6726, 0, '2025'),
('totaltable_2024_01011', 6727, 0, '2026'),
('totaltable_2024_01011', 6728, 0, '2027'),
('totaltable_2024_01011', 6729, 0, '2028'),
('totaltable_2024_01011', 6730, 0, '2029'),
('totaltable_2024_01111', 6731, 0, '2024'),
('totaltable_2024_01111', 6732, 0, '2025'),
('totaltable_2024_01111', 6733, 0, '2026'),
('totaltable_2024_01111', 6734, 0, '2027'),
('totaltable_2024_01111', 6735, 0, '2028'),
('totaltable_2024_01111', 6736, 0, '2029'),
('totaltable_2024_01211', 6737, 0, '2024'),
('totaltable_2024_01211', 6738, 0, '2025'),
('totaltable_2024_01211', 6739, 0, '2026'),
('totaltable_2024_01211', 6740, 0, '2027'),
('totaltable_2024_01211', 6741, 0, '2028'),
('totaltable_2024_01211', 6742, 0, '2029'),
('totaltable_2024_01321', 6743, 0, '2024'),
('totaltable_2024_01321', 6744, 1, '2025'),
('totaltable_2024_01321', 6745, 0, '2026'),
('totaltable_2024_01321', 6746, 0, '2027'),
('totaltable_2024_01321', 6747, 0, '2028'),
('totaltable_2024_01321', 6748, 0, '2029');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `anexos`
--
ALTER TABLE `anexos`
  ADD PRIMARY KEY (`id_anexo`),
  ADD KEY `teste` (`id_indicador`);

--
-- Índices de tabela `col_projeto`
--
ALTER TABLE `col_projeto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projeto_col` (`id_projeto`),
  ADD KEY `col_setor` (`id_setor`);

--
-- Índices de tabela `contratos`
--
ALTER TABLE `contratos`
  ADD PRIMARY KEY (`id_contrato`);

--
-- Índices de tabela `contratos_programas`
--
ALTER TABLE `contratos_programas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prog_cont` (`id_programa`),
  ADD KEY `cont_prog` (`id_contrato`);

--
-- Índices de tabela `enviar_programas`
--
ALTER TABLE `enviar_programas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_programa` (`id_programa_enviado`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de tabela `contratos_programas`
--
ALTER TABLE `contratos_programas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de tabela `enviar_programas`
--
ALTER TABLE `enviar_programas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `notatividades`
--
ALTER TABLE `notatividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de tabela `previstos_no_trimestre`
--
ALTER TABLE `previstos_no_trimestre`
  MODIFY `id_previsto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4581;

--
-- AUTO_INCREMENT de tabela `projetos`
--
ALTER TABLE `projetos`
  MODIFY `id_projeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de tabela `realizados_no_trimestre`
--
ALTER TABLE `realizados_no_trimestre`
  MODIFY `id_realizado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4631;

--
-- AUTO_INCREMENT de tabela `relatorios`
--
ALTER TABLE `relatorios`
  MODIFY `id_relatorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de tabela `setor`
--
ALTER TABLE `setor`
  MODIFY `id_setor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de tabela `total_executados`
--
ALTER TABLE `total_executados`
  MODIFY `id_total_executados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6915;

--
-- AUTO_INCREMENT de tabela `total_por_ano`
--
ALTER TABLE `total_por_ano`
  MODIFY `id_total_por_ano` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6749;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `anexos`
--
ALTER TABLE `anexos`
  ADD CONSTRAINT `teste` FOREIGN KEY (`id_indicador`) REFERENCES `indicadores` (`id_indicador`) ON DELETE CASCADE;

--
-- Restrições para tabelas `col_projeto`
--
ALTER TABLE `col_projeto`
  ADD CONSTRAINT `col_setor` FOREIGN KEY (`id_setor`) REFERENCES `setor` (`id_setor`),
  ADD CONSTRAINT `projeto_col` FOREIGN KEY (`id_projeto`) REFERENCES `projetos` (`id_projeto`);

--
-- Restrições para tabelas `contratos_programas`
--
ALTER TABLE `contratos_programas`
  ADD CONSTRAINT `cont_prog` FOREIGN KEY (`id_contrato`) REFERENCES `contratos` (`id_contrato`) ON DELETE CASCADE,
  ADD CONSTRAINT `prog_cont` FOREIGN KEY (`id_programa`) REFERENCES `programa` (`id_programa`);

--
-- Restrições para tabelas `enviar_programas`
--
ALTER TABLE `enviar_programas`
  ADD CONSTRAINT `id_programa` FOREIGN KEY (`id_programa_enviado`) REFERENCES `programa` (`id_programa`);

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
