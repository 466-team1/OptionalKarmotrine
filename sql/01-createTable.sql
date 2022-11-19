-- Matt Borek
-- Z1951125, CSCI-466-1.
DROP TABLE IF EXISTS `HAS`, `DRINKS`, `ORDERS`;

CREATE TABLE `ORDERS`(
    `ORDER_NUM`    INT  AUTO_INCREMENT,
    `COST`         REAL  NOT NULL,
    `CUS_NAME`     VARCHAR(46)  NOT NULL,
    `CUS_ADDRESS`  VARCHAR(92)  NOT NULL,
    `CUS_EMAIL`    VARCHAR(254)  NOT NULL, 
    `STATUS`       VARCHAR(32)  NOT NULL,
    `NOTE`         VARCHAR(256),
    `TRACKING`     VARCHAR(32),

    PRIMARY KEY (`ORDER_NUM`)
);

CREATE TABLE `DRINKS`(
    `NAME`     VARCHAR(20)  PRIMARY KEY,
    `TYPE`     VARCHAR(20)  NOT NULL,
    `CATEGORY` VARCHAR(20)  NOT NULL,
    `FLAVOR`   VARCHAR(16)  NOT NULL,
    `PRICE`    SMALLINT  NOT NULL,
    `STOCK`    INT  DEFAULT 69
);

CREATE TABLE `HAS`(
    `ORDER_NUM`  INT  NOT NULL,
    `NAME`       VARCHAR(20)  NOT NULL,
    `QTY`        SMALLINT  NOT NULL,

    PRIMARY KEY (`ORDER_NUM`, `NAME`),
    FOREIGN KEY (`ORDER_NUM`) REFERENCES `ORDERS`(`ORDER_NUM`),
    FOREIGN KEY (`NAME`) REFERENCES `DRINKS`(`NAME`)
);