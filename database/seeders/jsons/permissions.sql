/*
-- Query: SELECT * FROM permissions
LIMIT 0, 50000

-- Date: 2022-01-07 12:13
*/
INSERT INTO `permissions` (`name`,`groups`,`slug`,`description`) VALUES ('Acesso ao Painel Administrativo','Painel','admin-painel','Permissão para acessar o Painel Administrativo');
INSERT INTO `permissions` (`name`,`groups`,`slug`,`description`) VALUES ('Administrador','Administrador','admin','Permissão para Administrativo');
INSERT INTO `permissions` (`name`, `slug`, `groups`, `description`) VALUES ('Configurações', 'settings.config', 'Configurações', 'Permissão para entrar em configurações');

INSERT INTO `permissions` (`name`,`groups`,`slug`,`description`) VALUES ('Gerenciador de Usuarios','Usuários','users','Permissão para fazer o gerenciamento');
INSERT INTO `permissions` (`name`,`groups`,`slug`,`description`) VALUES ('Visualizar Usuário(s)','Usuários','view-users','Permissão para VER os usuários cadastrados no sistema');
INSERT INTO `permissions` (`name`,`groups`,`slug`,`description`) VALUES ('Editar Usuário(s)','Usuários','updated-users','Permissão para EDITAR os usuários cadastrados no sistema');
INSERT INTO `permissions` (`name`,`groups`,`slug`,`description`) VALUES ('Deletar Usuário(s)','Usuários','destroy-users','Permissão para DELETAR os usuários cadastrados no sistema');
INSERT INTO `permissions` (`name`,`groups`,`slug`,`description`) VALUES ('Adicionar Usuário(s)','Usuários','store-users','Permissão para ADICIONAR os usuários cadastrados no sistema');

INSERT INTO `permissions` (`name`,`groups`,`slug`,`description`) VALUES ('Visualizar Funçõe(s)','Funções','view-roles','Permissão para VER os Funções cadastrados no sistema');
INSERT INTO `permissions` (`name`,`groups`,`slug`,`description`) VALUES ('Editar Funçõe(s)','Funções','updated-roles','Permissão para ALTERAR as Funções cadastrados no sistema');
INSERT INTO `permissions` (`name`, `slug`, `groups`, `description`) VALUES ('Adicionar Funçõe(s)', 'store-roles', 'Funções', 'Permissão para ADICIONAR Funções no sistema');
INSERT INTO `permissions` (`name`, `slug`, `groups`, `description`) VALUES ('Deletar Funçõe(s)', 'destroy-roles', 'Funções', 'Permissão para DELETAR Funções no sistema');

INSERT INTO `permissions` (`name`,`groups`,`slug`,`description`) VALUES ('Visualizar Permissões','Permissões','view-permissions','Permissão para VER os Permissões cadastrados no sistema');
INSERT INTO `permissions` (`name`,`groups`,`slug`,`description`) VALUES ('Editar Permissões','Permissões','updated-permissions','Permissão para ALTERAR as Permissões cadastrados no sistema');
INSERT INTO `permissions` (`name`, `slug`, `groups`, `description`) VALUES ('Adicionar Permissões', 'store-permissions', 'Permissões', 'Permissão para ADICIONAR Permissões no sistema');
INSERT INTO `permissions` (`name`, `slug`, `groups`, `description`) VALUES ('Deletar Permissões', 'destroy-permissions', 'Permissões', 'Permissão para DELETAR Permissões no sistema');
