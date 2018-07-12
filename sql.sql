CREATE TABLE `project` (
 `gid` int(10) NOT NULL,
 `definiton` varchar(500) NOT NULL,
 `description` varchar(500) NOT NULL,
 `def_approve` tinyint(1) NOT NULL,
 `def_disapprove` tinyint(1) NOT NULL,
 PRIMARY KEY (`gid`)
)