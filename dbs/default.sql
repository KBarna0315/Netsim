CREATE
DATABASE IF NOT EXISTS `default` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE
`default`;


CREATE TABLE `device`
(
    `Device_ID`      int(11) NOT NULL AUTO_INCREMENT,
    `Name`           varchar(255) NOT NULL,
    `Type`           varchar(50)  DEFAULT '',
    `Symbol`         varchar(50)  DEFAULT '',
    `IPaddr`         varchar(50)  DEFAULT '',
    `Netmask`        varchar(50)  DEFAULT '',
    `MAC`            varchar(50)  DEFAULT NULL,
    `Left`           int(11) DEFAULT '0',
    `Top`            int(11) DEFAULT '0',
    `Right`          int(11) DEFAULT '0',
    `Bottom`         int(11) DEFAULT '0',
    PRIMARY KEY (`Device_ID`),
    UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `network`
(
    `Network_ID` int(11) NOT NULL AUTO_INCREMENT,
    `Name`       varchar(255) NOT NULL,
    `Network`    varchar(50) DEFAULT NULL,
    `Netmask`    varchar(50) DEFAULT NULL,
    `Gateway`    varchar(50) DEFAULT NULL,
    `Type`       varchar(50) DEFAULT NULL,
    `Left`       int(11) DEFAULT NULL,
    `Right`      int(11) DEFAULT NULL,
    `Top`        int(11) DEFAULT NULL,
    `Bottom`     int(11) DEFAULT NULL,
    PRIMARY KEY (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;