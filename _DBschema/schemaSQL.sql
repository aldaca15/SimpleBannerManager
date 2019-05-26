-- MySQL Script generated by MySQL Workbench
-- 05/22/19 10:11:11
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema adcampaigns
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `adcampaigns` ;

-- -----------------------------------------------------
-- Schema adcampaigns
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `adcampaigns` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `adcampaigns` ;

-- -----------------------------------------------------
-- Table `adcampaigns`.`organization`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adcampaigns`.`organization` ;

CREATE TABLE IF NOT EXISTS `adcampaigns`.`organization` (
  `idOrganization` SMALLINT(6) NOT NULL AUTO_INCREMENT,
  `organizationName` VARCHAR(100) NOT NULL,
  `address` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `phoneNumber` VARCHAR(45) NOT NULL,
  `registration` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `taxName` VARCHAR(45) NOT NULL,
  `comments` VARCHAR(64) NULL DEFAULT NULL,
  PRIMARY KEY (`idOrganization`),
  UNIQUE INDEX `taxName_UNIQUE` (`taxName` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `adcampaigns`.`banner`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adcampaigns`.`banner` ;

CREATE TABLE IF NOT EXISTS `adcampaigns`.`banner` (
  `idBanner` SMALLINT NOT NULL AUTO_INCREMENT,
  `idOrganization` SMALLINT(6) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `registration` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idBanner`),
  INDEX `organizationBannerFk` (`idOrganization` ASC),
  CONSTRAINT `organizationBannerFk`
    FOREIGN KEY (`idOrganization`)
    REFERENCES `adcampaigns`.`organization` (`idOrganization`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `adcampaigns`.`media`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adcampaigns`.`media` ;

CREATE TABLE IF NOT EXISTS `adcampaigns`.`media` (
  `idMedia` SMALLINT(6) NOT NULL AUTO_INCREMENT,
  `resource` VARCHAR(120) NOT NULL,
  `destinationURL` VARCHAR(125) NOT NULL,
  `registration` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idBanner` SMALLINT NOT NULL,
  `viewCount` INT NOT NULL DEFAULT 0,
  `width` SMALLINT NOT NULL,
  `height` SMALLINT NOT NULL,
  PRIMARY KEY (`idMedia`),
  INDEX `bannerMediaFk` (`idBanner` ASC),
  CONSTRAINT `bannerMediaFk`
    FOREIGN KEY (`idBanner`)
    REFERENCES `adcampaigns`.`banner` (`idBanner`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `adcampaigns`.`role`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adcampaigns`.`role` ;

CREATE TABLE IF NOT EXISTS `adcampaigns`.`role` (
  `idRole` TINYINT(4) NOT NULL,
  `role` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idRole`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `adcampaigns`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adcampaigns`.`user` ;

CREATE TABLE IF NOT EXISTS `adcampaigns`.`user` (
  `idUser` TINYINT(4) NOT NULL AUTO_INCREMENT,
  `idOrganization` SMALLINT(6) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `role` TINYINT(4) NOT NULL,
  PRIMARY KEY (`idUser`),
  INDEX `idRoleFk_idx` (`role` ASC),
  INDEX `organizationFk_idx` (`idOrganization` ASC),
  CONSTRAINT `organizationFk`
    FOREIGN KEY (`idOrganization`)
    REFERENCES `adcampaigns`.`organization` (`idOrganization`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `roleFk`
    FOREIGN KEY (`role`)
    REFERENCES `adcampaigns`.`role` (`idRole`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO `organization` (`idOrganization`, `organizationName`, `address`, `email`, `phoneNumber`, `registration`, `taxName`, `comments`) VALUES
(1, 'FakeBanners', 'Fake St. 123', 'fakebanners@fakebanners.com', '9099099090', '2019-05-22 03:14:28', '12345678', 'None.'),
(2, 'Fake Client', 'Fake St. 456', 'organization@yourclient.com', '5551112233', '2019-05-22 03:18:14', '987564321', 'None at all.');

INSERT INTO `banner` (`idBanner`, `idOrganization`, `name`, `registration`) VALUES
(1, 2, '468x120 upper banner', '2019-05-22 04:45:07'),
(2, 2, '300x250 medium banner', '2019-05-22 04:45:07');

INSERT INTO `media` (`idMedia`, `resource`, `destinationURL`, `registration`, `idBanner`, `viewCount`, `width`, `height`) VALUES
(1, '//res.cloudinary.com/dsmkeakpc/image/upload/v1558501427/e9er2re07wnuz4cp0wlc.gif', '//google.com', '2019-05-22 05:05:38', 1, 0, 468, 120),
(2, '//res.cloudinary.com/dsmkeakpc/image/upload/v1558501462/mtbyhvzvlt9uefrtb2tz.gif', '//amazon.com', '2019-05-22 05:05:38', 2, 0, 300, 250);

INSERT INTO `role` (`idRole`, `role`) VALUES
(1, 'ADMIN'),
(2, 'CLIENT');

INSERT INTO `user` (`idUser`, `idOrganization`, `name`, `email`, `password`, `role`) VALUES
(1, 1, 'Owen Owner', 'admin@bannersite.com', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(2, 2, 'Clint Client', 'client@company.com', '01cfcd4f6b8770febfb40cb906715822', 2);