-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 01-Out-2017 às 02:41
-- Versão do servidor: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `construsys`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastros_categoriaproduto`
--

CREATE TABLE `cadastros_categoriaproduto` (
  `idcategoriaproduto` int(11) NOT NULL COMMENT 'Código',
  `catdescricao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Categoria dos produtos';

--
-- Extraindo dados da tabela `cadastros_categoriaproduto`
--

INSERT INTO `cadastros_categoriaproduto` (`idcategoriaproduto`, `catdescricao`) VALUES
(1, 'Teste2'),
(2, 'Teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastros_cliente`
--

CREATE TABLE `cadastros_cliente` (
  `idcliente` int(11) NOT NULL COMMENT 'Código',
  `idpessoa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastros_entidade`
--

CREATE TABLE `cadastros_entidade` (
  `identidade` int(11) NOT NULL,
  `idpessoa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cadastros_entidade`
--

INSERT INTO `cadastros_entidade` (`identidade`, `idpessoa`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastros_fornecedor`
--

CREATE TABLE `cadastros_fornecedor` (
  `idfornecedor` int(11) NOT NULL COMMENT 'Código',
  `idpessoa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastros_pessoa`
--

CREATE TABLE `cadastros_pessoa` (
  `idpessoa` int(11) NOT NULL COMMENT 'Código',
  `pestipo` smallint(6) NOT NULL,
  `pesnome` varchar(200) NOT NULL,
  `pescpfcnpj` varchar(20) NOT NULL,
  `pesrgie` varchar(15) NOT NULL,
  `pesativo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Pessoas';

--
-- Extraindo dados da tabela `cadastros_pessoa`
--

INSERT INTO `cadastros_pessoa` (`idpessoa`, `pestipo`, `pesnome`, `pescpfcnpj`, `pesrgie`, `pesativo`) VALUES
(1, 2, 'Construtora de Demonstração', '0', '0', 1),
(2, 1, 'Admin', '0', '0', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastros_pessoacontato`
--

CREATE TABLE `cadastros_pessoacontato` (
  `idpessoacontato` int(11) NOT NULL COMMENT 'Id',
  `idpessoa` int(11) NOT NULL,
  `pectipo` smallint(6) NOT NULL,
  `peccontato` varchar(100) NOT NULL,
  `pecprefencial` tinyint(1) DEFAULT NULL COMMENT 'Contato preferencial'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cadastros_pessoacontato`
--

INSERT INTO `cadastros_pessoacontato` (`idpessoacontato`, `idpessoa`, `pectipo`, `peccontato`, `pecprefencial`) VALUES
(14, 1, 1, '47996568579', NULL),
(15, 1, 2, '47996568579', NULL),
(16, 1, 2, '47996568579', NULL),
(17, 1, 3, 'renan_rsantos@hotmail.com', NULL),
(18, 2, 1, '47996568579', NULL),
(19, 2, 3, 'renan_rsantos@hotmail.com', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastros_pessoaendereco`
--

CREATE TABLE `cadastros_pessoaendereco` (
  `idpessoaendereco` int(11) NOT NULL COMMENT 'Id',
  `peetipo` smallint(6) NOT NULL,
  `idpessoa` int(11) NOT NULL,
  `peeestado` varchar(50) DEFAULT NULL,
  `peecidade` varchar(200) DEFAULT NULL,
  `peebairro` varchar(100) DEFAULT NULL COMMENT 'Bairro',
  `peelogradouro` varchar(200) DEFAULT NULL,
  `peecep` varchar(10) DEFAULT NULL,
  `peenumero` varchar(10) DEFAULT 'S/N',
  `peecomplemento` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cadastros_pessoaendereco`
--

INSERT INTO `cadastros_pessoaendereco` (`idpessoaendereco`, `peetipo`, `idpessoa`, `peeestado`, `peecidade`, `peebairro`, `peelogradouro`, `peecep`, `peenumero`, `peecomplemento`) VALUES
(1, 1, 1, 'SC', 'Rio do Sul', 'Laranjeiras', 'Rua São Joaquim', '89167-430', '631', NULL),
(3, 2, 2, 'SC', 'RIO DO SUL', 'Laranjeiras', 'Rua São Joaquim', '89167-430', '631', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastros_produto`
--

CREATE TABLE `cadastros_produto` (
  `idproduto` int(11) NOT NULL COMMENT 'Código',
  `prddescricao` varchar(500) NOT NULL,
  `prddescdet` varchar(4000) DEFAULT NULL COMMENT 'Descrição detalhada',
  `prdcodigobarras` varchar(50) NOT NULL,
  `idunidademedida` int(11) NOT NULL,
  `idcategoriaproduto` int(11) NOT NULL,
  `idsubcategoriaproduto` int(11) DEFAULT NULL COMMENT 'Subcategoria'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Produtos';

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastros_subcategoriaproduto`
--

CREATE TABLE `cadastros_subcategoriaproduto` (
  `idsubcategoriaproduto` int(11) NOT NULL COMMENT 'Código',
  `sbcdescricao` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Sub categoria dos produtos';

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastros_unidademedida`
--

CREATE TABLE `cadastros_unidademedida` (
  `idunidademedida` int(11) NOT NULL COMMENT 'Código',
  `unmsigla` varchar(20) NOT NULL,
  `unmdescricao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Unidade de medida';

--
-- Extraindo dados da tabela `cadastros_unidademedida`
--

INSERT INTO `cadastros_unidademedida` (`idunidademedida`, `unmsigla`, `unmdescricao`) VALUES
(1, 'UN', 'Unidade'),
(2, 'SC', 'Saco');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastros_usuario`
--

CREATE TABLE `cadastros_usuario` (
  `idusuario` int(11) NOT NULL,
  `idpessoa` int(11) NOT NULL,
  `usulogin` varchar(100) NOT NULL,
  `ususenha` varchar(200) NOT NULL,
  `usupermissao` smallint(6) NOT NULL,
  `usuadministrador` tinyint(1) NOT NULL DEFAULT '0',
  `usutoken` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cadastros_usuario`
--

INSERT INTO `cadastros_usuario` (`idusuario`, `idpessoa`, `usulogin`, `ususenha`, `usupermissao`, `usuadministrador`, `usutoken`) VALUES
(1, 2, 'admin', '$2a$06$GhfGrAbwIkWzmD/.G1YlzOHSmBN/hKtol9bcIMBNfRkI55tGV9Eaa', 1, 1, 'DXqmH9NnXIabrf0fIlZQftYa5VkAeYjdDw1KRPFXc8H2uO8XgHrLfvYYVH6v');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estrutura_modulo`
--

CREATE TABLE `estrutura_modulo` (
  `idmodulo` int(11) NOT NULL COMMENT 'Código',
  `modnome` varchar(100) NOT NULL,
  `modpath` varchar(200) NOT NULL,
  `modicone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estrutura_modulo`
--

INSERT INTO `estrutura_modulo` (`idmodulo`, `modnome`, `modpath`, `modicone`) VALUES
(1, 'Estrutura', '/estrutura', 'fa fa-cog'),
(2, 'Cadastros', '/cadastros', 'fa fa-globe'),
(3, 'Obras', '/obras', 'fa fa-building');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estrutura_moduloinstalado`
--

CREATE TABLE `estrutura_moduloinstalado` (
  `idmoduloinstalado` int(11) NOT NULL,
  `idmodulo` int(11) NOT NULL,
  `identidade` int(11) NOT NULL,
  `mdiativo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estrutura_moduloinstalado`
--

INSERT INTO `estrutura_moduloinstalado` (`idmoduloinstalado`, `idmodulo`, `identidade`, `mdiativo`) VALUES
(1, 2, 1, 1),
(2, 3, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `estrutura_rotina`
--

CREATE TABLE `estrutura_rotina` (
  `idrotina` int(11) NOT NULL COMMENT 'Código',
  `idmodulo` int(11) NOT NULL,
  `rotnome` varchar(200) NOT NULL,
  `rotpath` varchar(200) DEFAULT NULL,
  `roticone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estrutura_rotina`
--

INSERT INTO `estrutura_rotina` (`idrotina`, `idmodulo`, `rotnome`, `rotpath`, `roticone`) VALUES
(1, 1, 'Módulos', '/modulo', 'fa fa-folder-o'),
(2, 1, 'Rotina', '/rotina', 'fa fa-cog'),
(3, 1, 'Sub Rotina', '/subrotina', 'fa fa-cogs'),
(4, 2, 'Pessoa', '/pessoa', 'fa fa-user'),
(6, 2, 'Produtos', '/produto', 'fa fa-archive'),
(7, 3, 'Cadastros', NULL, 'fa fa-cog'),
(8, 3, 'Gerenciar', NULL, 'fa fa-cogs');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estrutura_subrotina`
--

CREATE TABLE `estrutura_subrotina` (
  `idsubrotina` int(11) NOT NULL COMMENT 'Código',
  `idrotina` int(11) NOT NULL,
  `sbrnome` varchar(200) NOT NULL,
  `sbrpath` varchar(200) NOT NULL,
  `sbricone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estrutura_subrotina`
--

INSERT INTO `estrutura_subrotina` (`idsubrotina`, `idrotina`, `sbrnome`, `sbrpath`, `sbricone`) VALUES
(1, 1, 'Módulos Instalados', '/moduloinstalado', 'fa fa-cogs'),
(2, 6, 'Unidade de Medida', '/unidademedida', 'fa fa-tag'),
(3, 6, 'Categoria', '/categoriaproduto', 'fa fa-tags'),
(4, 7, 'Tipos de Cômodos', '/tipocomodo', 'fa fa-home'),
(5, 8, 'Obras', '/obra', 'fa fa-building'),
(6, 7, 'Fases da Obra', '/fase', 'fa fa-tag');

-- --------------------------------------------------------

--
-- Estrutura da tabela `obras_comodo`
--

CREATE TABLE `obras_comodo` (
  `idcomodo` int(11) NOT NULL,
  `idobra` int(11) NOT NULL,
  `idtipocomodo` int(11) NOT NULL,
  `comdescricao` varchar(1000) DEFAULT NULL,
  `comtamanho` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `obras_fase`
--

CREATE TABLE `obras_fase` (
  `idfase` int(11) NOT NULL,
  `fsedescricao` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `obras_fase`
--

INSERT INTO `obras_fase` (`idfase`, `fsedescricao`) VALUES
(1, 'Serviços Gerais'),
(2, 'Fundação'),
(3, 'Paredes'),
(4, 'Laje'),
(5, 'Telhado'),
(6, 'Reboco'),
(7, 'Forro'),
(8, 'Pisos e azulejos'),
(9, 'Elétrica'),
(10, 'Hidráulica'),
(11, 'Pintura');

-- --------------------------------------------------------

--
-- Estrutura da tabela `obras_faseobra`
--

CREATE TABLE `obras_faseobra` (
  `idfaseobra` int(11) NOT NULL,
  `idobra` int(11) NOT NULL,
  `fsoporcentagem` decimal(10,2) NOT NULL DEFAULT '0.00',
  `fsodatainicio` date DEFAULT NULL,
  `fsoobservacao` varchar(1000) DEFAULT NULL,
  `fsostatus` smallint(6) NOT NULL DEFAULT '1',
  `idfase` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `obras_obra`
--

CREATE TABLE `obras_obra` (
  `idobra` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `idorcamento` int(11) NOT NULL,
  `obrtamanho` decimal(10,2) NOT NULL DEFAULT '0.00',
  `obrdescricao` varchar(1000) NOT NULL,
  `obrdatainicio` date NOT NULL,
  `obrprevisao` smallint(6) NOT NULL,
  `obrvalororcado` decimal(10,2) NOT NULL DEFAULT '0.00',
  `obrtipoprevisao` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `obras_orcamento`
--

CREATE TABLE `obras_orcamento` (
  `idorcamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `obras_tipocomodo`
--

CREATE TABLE `obras_tipocomodo` (
  `idtipocomodo` int(11) NOT NULL,
  `tconome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `obras_tipocomodo`
--

INSERT INTO `obras_tipocomodo` (`idtipocomodo`, `tconome`) VALUES
(1, 'Quarto'),
(2, 'Sala'),
(3, 'Cozinha'),
(4, 'Banheiro');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cadastros_categoriaproduto`
--
ALTER TABLE `cadastros_categoriaproduto`
  ADD PRIMARY KEY (`idcategoriaproduto`);

--
-- Indexes for table `cadastros_cliente`
--
ALTER TABLE `cadastros_cliente`
  ADD PRIMARY KEY (`idcliente`),
  ADD KEY `cadastros_pessoa_cadastros_cliente_fk` (`idpessoa`);

--
-- Indexes for table `cadastros_entidade`
--
ALTER TABLE `cadastros_entidade`
  ADD PRIMARY KEY (`identidade`),
  ADD KEY `cadastros_pessoa_cadastros_entidade_fk` (`idpessoa`);

--
-- Indexes for table `cadastros_fornecedor`
--
ALTER TABLE `cadastros_fornecedor`
  ADD PRIMARY KEY (`idfornecedor`),
  ADD KEY `cadastros_pessoa_cadastros_fornecedor_fk` (`idpessoa`);

--
-- Indexes for table `cadastros_pessoa`
--
ALTER TABLE `cadastros_pessoa`
  ADD PRIMARY KEY (`idpessoa`);

--
-- Indexes for table `cadastros_pessoacontato`
--
ALTER TABLE `cadastros_pessoacontato`
  ADD PRIMARY KEY (`idpessoacontato`),
  ADD KEY `cadastros_pessoa_cadastros_pessoacontato_fk` (`idpessoa`);

--
-- Indexes for table `cadastros_pessoaendereco`
--
ALTER TABLE `cadastros_pessoaendereco`
  ADD PRIMARY KEY (`idpessoaendereco`),
  ADD KEY `cadastros_pessoa_cadastros_pessoaendereco_fk` (`idpessoa`);

--
-- Indexes for table `cadastros_produto`
--
ALTER TABLE `cadastros_produto`
  ADD PRIMARY KEY (`idproduto`),
  ADD KEY `cadastros_categoriaproduto_cadastros_produto_fk` (`idcategoriaproduto`),
  ADD KEY `cadastros_subcategoriaproduto_cadastros_produto_fk` (`idsubcategoriaproduto`),
  ADD KEY `cadastros_unidademedida_cadastros_produto_fk` (`idunidademedida`);

--
-- Indexes for table `cadastros_subcategoriaproduto`
--
ALTER TABLE `cadastros_subcategoriaproduto`
  ADD PRIMARY KEY (`idsubcategoriaproduto`);

--
-- Indexes for table `cadastros_unidademedida`
--
ALTER TABLE `cadastros_unidademedida`
  ADD PRIMARY KEY (`idunidademedida`);

--
-- Indexes for table `cadastros_usuario`
--
ALTER TABLE `cadastros_usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `cadastros_pessoa_cadastros_usuario_fk` (`idpessoa`);

--
-- Indexes for table `estrutura_modulo`
--
ALTER TABLE `estrutura_modulo`
  ADD PRIMARY KEY (`idmodulo`);

--
-- Indexes for table `estrutura_moduloinstalado`
--
ALTER TABLE `estrutura_moduloinstalado`
  ADD PRIMARY KEY (`idmoduloinstalado`),
  ADD KEY `cadastros_entidade_estrutura_moduloinstalado_fk` (`identidade`),
  ADD KEY `estrutura_modulo_estrutura_moduloinstalado_fk` (`idmodulo`);

--
-- Indexes for table `estrutura_rotina`
--
ALTER TABLE `estrutura_rotina`
  ADD PRIMARY KEY (`idrotina`),
  ADD KEY `estrutura_modulo_estrutura_rotina_fk` (`idmodulo`);

--
-- Indexes for table `estrutura_subrotina`
--
ALTER TABLE `estrutura_subrotina`
  ADD PRIMARY KEY (`idsubrotina`),
  ADD KEY `estrutura_rotina_estrutura_subrotina_fk` (`idrotina`);

--
-- Indexes for table `obras_comodo`
--
ALTER TABLE `obras_comodo`
  ADD PRIMARY KEY (`idcomodo`),
  ADD KEY `obras_obra_obras_comodos_fk` (`idobra`),
  ADD KEY `obras_tipocomodo_obras_comodo_fk` (`idtipocomodo`);

--
-- Indexes for table `obras_fase`
--
ALTER TABLE `obras_fase`
  ADD PRIMARY KEY (`idfase`);

--
-- Indexes for table `obras_faseobra`
--
ALTER TABLE `obras_faseobra`
  ADD PRIMARY KEY (`idfaseobra`),
  ADD KEY `obras_fase_obras_faseobra_fk` (`idfase`),
  ADD KEY `obras_obra_obras_faseobra_fk` (`idobra`);

--
-- Indexes for table `obras_obra`
--
ALTER TABLE `obras_obra`
  ADD PRIMARY KEY (`idobra`),
  ADD KEY `cadastros_cliente_obras_obra_fk` (`idcliente`),
  ADD KEY `obras_orcamento_obras_obra_fk` (`idorcamento`);

--
-- Indexes for table `obras_orcamento`
--
ALTER TABLE `obras_orcamento`
  ADD PRIMARY KEY (`idorcamento`);

--
-- Indexes for table `obras_tipocomodo`
--
ALTER TABLE `obras_tipocomodo`
  ADD PRIMARY KEY (`idtipocomodo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cadastros_categoriaproduto`
--
ALTER TABLE `cadastros_categoriaproduto`
  MODIFY `idcategoriaproduto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Código', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cadastros_entidade`
--
ALTER TABLE `cadastros_entidade`
  MODIFY `identidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cadastros_pessoa`
--
ALTER TABLE `cadastros_pessoa`
  MODIFY `idpessoa` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Código', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cadastros_pessoacontato`
--
ALTER TABLE `cadastros_pessoacontato`
  MODIFY `idpessoacontato` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id', AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `cadastros_pessoaendereco`
--
ALTER TABLE `cadastros_pessoaendereco`
  MODIFY `idpessoaendereco` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cadastros_unidademedida`
--
ALTER TABLE `cadastros_unidademedida`
  MODIFY `idunidademedida` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Código', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cadastros_usuario`
--
ALTER TABLE `cadastros_usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `estrutura_moduloinstalado`
--
ALTER TABLE `estrutura_moduloinstalado`
  MODIFY `idmoduloinstalado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `obras_comodo`
--
ALTER TABLE `obras_comodo`
  MODIFY `idcomodo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `obras_fase`
--
ALTER TABLE `obras_fase`
  MODIFY `idfase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `obras_faseobra`
--
ALTER TABLE `obras_faseobra`
  MODIFY `idfaseobra` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `obras_obra`
--
ALTER TABLE `obras_obra`
  MODIFY `idobra` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `obras_orcamento`
--
ALTER TABLE `obras_orcamento`
  MODIFY `idorcamento` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `obras_tipocomodo`
--
ALTER TABLE `obras_tipocomodo`
  MODIFY `idtipocomodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `cadastros_cliente`
--
ALTER TABLE `cadastros_cliente`
  ADD CONSTRAINT `cadastros_pessoa_cadastros_cliente_fk` FOREIGN KEY (`idpessoa`) REFERENCES `cadastros_pessoa` (`idpessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `cadastros_entidade`
--
ALTER TABLE `cadastros_entidade`
  ADD CONSTRAINT `cadastros_pessoa_cadastros_entidade_fk` FOREIGN KEY (`idpessoa`) REFERENCES `cadastros_pessoa` (`idpessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `cadastros_fornecedor`
--
ALTER TABLE `cadastros_fornecedor`
  ADD CONSTRAINT `cadastros_pessoa_cadastros_fornecedor_fk` FOREIGN KEY (`idpessoa`) REFERENCES `cadastros_pessoa` (`idpessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `cadastros_pessoacontato`
--
ALTER TABLE `cadastros_pessoacontato`
  ADD CONSTRAINT `cadastros_pessoa_cadastros_pessoacontato_fk` FOREIGN KEY (`idpessoa`) REFERENCES `cadastros_pessoa` (`idpessoa`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `cadastros_pessoaendereco`
--
ALTER TABLE `cadastros_pessoaendereco`
  ADD CONSTRAINT `cadastros_pessoa_cadastros_pessoaendereco_fk` FOREIGN KEY (`idpessoa`) REFERENCES `cadastros_pessoa` (`idpessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `cadastros_produto`
--
ALTER TABLE `cadastros_produto`
  ADD CONSTRAINT `cadastros_categoriaproduto_cadastros_produto_fk` FOREIGN KEY (`idcategoriaproduto`) REFERENCES `cadastros_categoriaproduto` (`idcategoriaproduto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cadastros_subcategoriaproduto_cadastros_produto_fk` FOREIGN KEY (`idsubcategoriaproduto`) REFERENCES `cadastros_subcategoriaproduto` (`idsubcategoriaproduto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cadastros_unidademedida_cadastros_produto_fk` FOREIGN KEY (`idunidademedida`) REFERENCES `cadastros_unidademedida` (`idunidademedida`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `cadastros_usuario`
--
ALTER TABLE `cadastros_usuario`
  ADD CONSTRAINT `cadastros_pessoa_cadastros_usuario_fk` FOREIGN KEY (`idpessoa`) REFERENCES `cadastros_pessoa` (`idpessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `estrutura_moduloinstalado`
--
ALTER TABLE `estrutura_moduloinstalado`
  ADD CONSTRAINT `cadastros_entidade_estrutura_moduloinstalado_fk` FOREIGN KEY (`identidade`) REFERENCES `cadastros_entidade` (`identidade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `estrutura_modulo_estrutura_moduloinstalado_fk` FOREIGN KEY (`idmodulo`) REFERENCES `estrutura_modulo` (`idmodulo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `estrutura_rotina`
--
ALTER TABLE `estrutura_rotina`
  ADD CONSTRAINT `estrutura_modulo_estrutura_rotina_fk` FOREIGN KEY (`idmodulo`) REFERENCES `estrutura_modulo` (`idmodulo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `estrutura_subrotina`
--
ALTER TABLE `estrutura_subrotina`
  ADD CONSTRAINT `estrutura_rotina_estrutura_subrotina_fk` FOREIGN KEY (`idrotina`) REFERENCES `estrutura_rotina` (`idrotina`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `obras_comodo`
--
ALTER TABLE `obras_comodo`
  ADD CONSTRAINT `obras_obra_obras_comodos_fk` FOREIGN KEY (`idobra`) REFERENCES `obras_obra` (`idobra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `obras_tipocomodo_obras_comodo_fk` FOREIGN KEY (`idtipocomodo`) REFERENCES `obras_tipocomodo` (`idtipocomodo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `obras_faseobra`
--
ALTER TABLE `obras_faseobra`
  ADD CONSTRAINT `obras_fase_obras_faseobra_fk` FOREIGN KEY (`idfase`) REFERENCES `obras_fase` (`idfase`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `obras_obra_obras_faseobra_fk` FOREIGN KEY (`idobra`) REFERENCES `obras_obra` (`idobra`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `obras_obra`
--
ALTER TABLE `obras_obra`
  ADD CONSTRAINT `cadastros_cliente_obras_obra_fk` FOREIGN KEY (`idcliente`) REFERENCES `cadastros_cliente` (`idcliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `obras_orcamento_obras_obra_fk` FOREIGN KEY (`idorcamento`) REFERENCES `obras_orcamento` (`idorcamento`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
