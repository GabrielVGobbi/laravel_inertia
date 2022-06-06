/*
-- Query: SELECT * FROM menus
LIMIT 0, 50000

-- Date: 2022-03-14 21:42
*/
INSERT INTO `menus` (`name`,`slug`,`route`,`icon`,`permission`,`collapse`,`group`,`sub_menu`,`order`) VALUES ('Dashboard','dashboard','painel','ri-dashboard-line','painel',0,'base',NULL,1);
INSERT INTO `menus` (`name`,`slug`,`route`,`icon`,`permission`,`collapse`,`group`,`sub_menu`,`order`) VALUES ('Developer','dev','','ri-dashboard-line','',1,'dev',NULL,1);
INSERT INTO `menus` (`name`,`slug`,`route`,`icon`,`permission`,`collapse`,`group`,`sub_menu`,`order`) VALUES ('Users','users','users.index','ri-account-circle-line','view-users',0,'dev','2',1);
INSERT INTO `menus` (`name`,`slug`,`route`,`icon`,`permission`,`collapse`,`group`,`sub_menu`,`order`) VALUES ('Permissions','permissions','permissions.index','ri-pencil-ruler-2-line','view-permissions',0,'dev','2',2);
INSERT INTO `menus` (`name`,`slug`,`route`,`icon`,`permission`,`collapse`,`group`,`sub_menu`,`order`) VALUES ('Roles','roles','roles.index','ri-vip-crown-2-line','view-roles',0,'dev','2',3);
