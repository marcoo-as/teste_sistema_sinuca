# teste_sistema_sinuca
Desenvolvido em PHP para avaliação de código e armazenando dados em um BD MySQL.

Para utilização baixe o código e crie as tabelas em um banco de dados MySQL.

# Criação Database
```
--
-- Banco de dados: `sinuca`
--
CREATE DATABASE IF NOT EXISTS `sinuca` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sinuca`;
```

# Criação da tabela Tabelas
```
--
-- Estrutura da tabela `tabelas`
--

CREATE TABLE `tabelas` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `descricao` longtext NOT NULL,
  `pontuacao` int(11) NOT NULL DEFAULT 0,
  `regra_pontuacao` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tabelas`
--
ALTER TABLE `tabelas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabela `tabelas`
--
ALTER TABLE `tabelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
```

# Criação da tabela de Times
```
--
-- Estrutura da tabela `times`
--

CREATE TABLE `times` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `jogador1` varchar(60) NOT NULL,
  `jogador2` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabela `times`
--
ALTER TABLE `times`
  ADD PRIMARY KEY (`id`);
  
--
-- AUTO_INCREMENT de tabela `times`
--
ALTER TABLE `times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
  
``` 

# Criação da tabela Tabelas_Times
```
--
-- Estrutura da tabela `tabelas_times`
--

CREATE TABLE `tabelas_times` (
  `id` int(11) NOT NULL,
  `idTabela` int(11) NOT NULL,
  `idTime` int(11) NOT NULL,
  `pontos` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabela `tabelas_times`
--
ALTER TABLE `tabelas_times`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tabelas` (`idTabela`),
  ADD KEY `fk_times` (`idTime`);

--
-- AUTO_INCREMENT de tabela `tabelas_times`
--
ALTER TABLE `tabelas_times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Limitadores para a tabela `tabelas_times`
--
ALTER TABLE `tabelas_times`
  ADD CONSTRAINT `fk_tabelas` FOREIGN KEY (`idTabela`) REFERENCES `tabelas` (`id`),
  ADD CONSTRAINT `fk_times` FOREIGN KEY (`idTime`) REFERENCES `times` (`id`);
```

# Usuário de acesso ao BD
Para acessar o seu banco de dados com o usuário correto altere as informações no arquivo [Connection.class.php](assets/Classe/Database/Connection.class.php)
