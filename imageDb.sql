-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema imageDb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema imageDb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `imageDb` DEFAULT CHARACTER SET utf8 ;
USE `imageDb` ;

-- -----------------------------------------------------
-- Table `imageDb`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `imageDb`.`user` ;

CREATE TABLE IF NOT EXISTS `imageDb`.`user` (
  `userId` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(250) NULL,
  `mail` VARCHAR(250) NOT NULL,
  `password` VARCHAR(300) NOT NULL,
  `isAdmin` TINYINT(1) NULL,
  PRIMARY KEY (`userId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `imageDb`.`gallery`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `imageDb`.`gallery` ;

CREATE TABLE IF NOT EXISTS `imageDb`.`gallery` (
  `galleryId` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`galleryId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `imageDb`.`image`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `imageDb`.`image` ;

CREATE TABLE IF NOT EXISTS `imageDb`.`image` (
  `imageId` INT NOT NULL AUTO_INCREMENT,
  `file` VARCHAR(300) NULL,
  `thumbnail` VARCHAR(300) NULL,
  `name` VARCHAR(200) NULL,
  `gallery_galleryId` INT NOT NULL,
  PRIMARY KEY (`imageId`),
  INDEX `fk_image_galary1_idx` (`gallery_galleryId` ASC),
  CONSTRAINT `fk_image_galary1`
    FOREIGN KEY (`gallery_galleryId`)
    REFERENCES `imageDb`.`gallery` (`galleryId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `imageDb`.`tag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `imageDb`.`tag` ;

CREATE TABLE IF NOT EXISTS `imageDb`.`tag` (
  `tagId` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`tagId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `imageDb`.`image_tag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `imageDb`.`image_tag` ;

CREATE TABLE IF NOT EXISTS `imageDb`.`image_tag` (
  `image_tagId` INT NOT NULL AUTO_INCREMENT,
  `image_imageId` INT NOT NULL,
  `tag_tagId` INT NOT NULL,
  PRIMARY KEY (`image_tagId`),
  INDEX `fk_image_tag_image1_idx` (`image_imageId` ASC),
  INDEX `fk_image_tag_tag1_idx` (`tag_tagId` ASC),
  CONSTRAINT `fk_image_tag_image1`
    FOREIGN KEY (`image_imageId`)
    REFERENCES `imageDb`.`image` (`imageId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_image_tag_tag1`
    FOREIGN KEY (`tag_tagId`)
    REFERENCES `imageDb`.`tag` (`tagId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `imageDb`.`gallery_user_rolle`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `imageDb`.`gallery_user_rolle` ;

CREATE TABLE IF NOT EXISTS `imageDb`.`gallery_user_rolle` (
  `gallery_user_rolleId` INT NOT NULL AUTO_INCREMENT,
  `isOwner` TINYINT(1) NOT NULL,
  `user_userId` INT NOT NULL,
  `gallery_galleryId` INT NOT NULL,
  PRIMARY KEY (`gallery_user_rolleId`),
  INDEX `fk_galary_user_rolle_user_idx` (`user_userId` ASC),
  INDEX `fk_galary_user_rolle_galary1_idx` (`gallery_galleryId` ASC),
  CONSTRAINT `fk_galary_user_rolle_user`
    FOREIGN KEY (`user_userId`)
    REFERENCES `imageDb`.`user` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_galary_user_rolle_galary1`
    FOREIGN KEY (`gallery_galleryId`)
    REFERENCES `imageDb`.`gallery` (`galleryId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
