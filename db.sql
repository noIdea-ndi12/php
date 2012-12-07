SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`cities`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`cities` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  `zip_code` VARCHAR(10) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`types`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`types` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`streets`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`streets` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  `abstract` TEXT NULL ,
  `cities_id` INT NOT NULL ,
  `types_id` INT NOT NULL ,
  `history` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_streets_cities1` (`cities_id` ASC) ,
  INDEX `fk_streets_types1` (`types_id` ASC) ,
  CONSTRAINT `fk_streets_cities1`
    FOREIGN KEY (`cities_id` )
    REFERENCES `mydb`.`cities` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_streets_types1`
    FOREIGN KEY (`types_id` )
    REFERENCES `mydb`.`types` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `login` VARCHAR(255) NULL ,
  `pass` VARCHAR(255) NULL ,
  `type` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`locations`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`locations` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `content` TEXT NULL ,
  `name` VARCHAR(255) NULL ,
  `gps_x` FLOAT NULL ,
  `gps_y` FLOAT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`comments`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`comments` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `date` DATE NULL ,
  `eval` INT NULL ,
  `users_id` INT NOT NULL ,
  `streets_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_comments_users1` (`users_id` ASC) ,
  INDEX `fk_comments_streets1` (`streets_id` ASC) ,
  CONSTRAINT `fk_comments_users1`
    FOREIGN KEY (`users_id` )
    REFERENCES `mydb`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_streets1`
    FOREIGN KEY (`streets_id` )
    REFERENCES `mydb`.`streets` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`pictures`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`pictures` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `url` VARCHAR(100) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`streets_pictures`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`streets_pictures` (
  `streets_id` INT NOT NULL ,
  `pictures_id` INT NOT NULL ,
  PRIMARY KEY (`streets_id`, `pictures_id`) ,
  INDEX `fk_streets_has_pictures_pictures1` (`pictures_id` ASC) ,
  INDEX `fk_streets_has_pictures_streets` (`streets_id` ASC) ,
  CONSTRAINT `fk_streets_has_pictures_streets`
    FOREIGN KEY (`streets_id` )
    REFERENCES `mydb`.`streets` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_streets_has_pictures_pictures1`
    FOREIGN KEY (`pictures_id` )
    REFERENCES `mydb`.`pictures` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`streets_plates_pictures`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`streets_plates_pictures` (
  `streets_id` INT NOT NULL ,
  `pictures_id` INT NOT NULL ,
  `evaluation` VARCHAR(45) NULL ,
  PRIMARY KEY (`streets_id`, `pictures_id`) ,
  INDEX `fk_streets_has_pictures_pictures2` (`pictures_id` ASC) ,
  INDEX `fk_streets_has_pictures_streets1` (`streets_id` ASC) ,
  CONSTRAINT `fk_streets_has_pictures_streets1`
    FOREIGN KEY (`streets_id` )
    REFERENCES `mydb`.`streets` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_streets_has_pictures_pictures2`
    FOREIGN KEY (`pictures_id` )
    REFERENCES `mydb`.`pictures` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`pictures_locations`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`pictures_locations` (
  `pictures_id` INT NOT NULL ,
  `locations_id` INT NOT NULL ,
  PRIMARY KEY (`pictures_id`, `locations_id`) ,
  INDEX `fk_pictures_has_locations_locations1` (`locations_id` ASC) ,
  INDEX `fk_pictures_has_locations_pictures1` (`pictures_id` ASC) ,
  CONSTRAINT `fk_pictures_has_locations_pictures1`
    FOREIGN KEY (`pictures_id` )
    REFERENCES `mydb`.`pictures` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pictures_has_locations_locations1`
    FOREIGN KEY (`locations_id` )
    REFERENCES `mydb`.`locations` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`insolites`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`insolites` (
  `streets_id` INT NOT NULL ,
  `users_id` INT NOT NULL ,
  PRIMARY KEY (`streets_id`, `users_id`) ,
  INDEX `fk_streets_has_users_users1` (`users_id` ASC) ,
  INDEX `fk_streets_has_users_streets1` (`streets_id` ASC) ,
  CONSTRAINT `fk_streets_has_users_streets1`
    FOREIGN KEY (`streets_id` )
    REFERENCES `mydb`.`streets` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_streets_has_users_users1`
    FOREIGN KEY (`users_id` )
    REFERENCES `mydb`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
