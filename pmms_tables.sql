CREATE TABLE `project2_dashboard` (
 `id` int(4) NOT NULL AUTO_INCREMENT,
 `date` varchar(10) NOT NULL,
 `heading` varchar(50) NOT NULL,
 `content` varchar(1000) NOT NULL,
 PRIMARY KEY (`id`)
) 

CREATE TABLE `project2_faq` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `heading` varchar(50) NOT NULL,
 `content` varchar(1000) NOT NULL,
 PRIMARY KEY (`id`)
) 

CREATE TABLE `project2_team` (
 `gid` int(11) NOT NULL AUTO_INCREMENT,
 `id1` varchar(8) NOT NULL,
 `id2` varchar(8) NOT NULL,
 `id3` varchar(8) DEFAULT NULL,
 `id4` varchar(8) DEFAULT NULL,
 `id5` varchar(8) DEFAULT NULL,
 `fid` varchar(3) NOT NULL,
 PRIMARY KEY (`gid`)
)

CREATE TABLE `project2_comment` (
 `id` int(10) NOT NULL AUTO_INCREMENT,
 `date` date NOT NULL,
 `heading` varchar(500) NOT NULL,
 `sid` varchar(8) NOT NULL,
 `fid` tinyint(1) NOT NULL,
 PRIMARY KEY (`id`)
) 

CREATE TABLE `project2_project` (
 `gid` int(11) NOT NULL,
 `definition` varchar(100) NOT NULL,
 `description` varchar(1000) NOT NULL,
 `def_approved` tinyint(1) NOT NULL,
 `def_disapproved` tinyint(1) NOT NULL,
 `ppr1` int(11) NOT NULL,
 `ppr2` int(11) NOT NULL,
 `ppr3` tinyint(1) NOT NULL,
 `ppr4` tinyint(1) NOT NULL,
 `plag_report` tinyint(1) NOT NULL,
 `final_report` tinyint(1) NOT NULL,
 PRIMARY KEY (`gid`),
 UNIQUE KEY `gid` (`gid`)
)

CREATE TABLE `project2_project` (
 `gid` int(11) NOT NULL,
 `definition` varchar(100) NOT NULL,
 `description` varchar(1000) NOT NULL,
 `def_approved` tinyint(1) NOT NULL,
 `def_disapproved` tinyint(1) NOT NULL,
 `ppr1` tinyint(1) NOT NULL,
 `ppr1_approved` tinyint(1) NOT NULL,
 `ppr1_disapproved` tinyint(1) NOT NULL,
 `ppr2` tinyint(1) NOT NULL,
 `ppr2_approved` tinyint(1) NOT NULL,
 `ppr2_disapproved` tinyint(1) NOT NULL,
 `ppr3` tinyint(1) NOT NULL,
 `ppr3_approved` tinyint(1) NOT NULL,
 `ppr3_disapproved` tinyint(1) NOT NULL,
 `ppr4` tinyint(1) NOT NULL,
 `ppr4_approved` tinyint(1) NOT NULL,
 `ppr4_disapproved` tinyint(1) NOT NULL,
 `plag_report` tinyint(1) NOT NULL,
 `plag_approved` tinyint(1) NOT NULL,
 `plag_disapproved` tinyint(1) NOT NULL,
 `final_report` tinyint(1) NOT NULL,
 `final_approved` tinyint(1) NOT NULL,
 `final_disapproved` tinyint(1) NOT NULL,
 PRIMARY KEY (`gid`),
 UNIQUE KEY `gid` (`gid`)
)