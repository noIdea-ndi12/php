SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';


-- -----------------------------------------------------
-- Table `nuitinfo`.`cities`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `nuitinfo`.`cities` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL DEFAULT NULL ,
  `zip_code` VARCHAR(10) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `nuitinfo`.`types`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `nuitinfo`.`types` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `nuitinfo`.`streets`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `nuitinfo`.`streets` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL DEFAULT NULL ,
  `abstract` TEXT NULL DEFAULT NULL ,
  `cities_id` INT NOT NULL ,
  `types_id` INT NOT NULL ,
  `history` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_streets_cities1` (`cities_id` ASC) ,
  INDEX `fk_streets_types1` (`types_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `nuitinfo`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `nuitinfo`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `login` VARCHAR(255) NULL DEFAULT NULL ,
  `pass` VARCHAR(255) NULL DEFAULT NULL ,
  `type` INT NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `nuitinfo`.`locations`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `nuitinfo`.`locations` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `content` TEXT NULL DEFAULT NULL ,
  `name` VARCHAR(255) NULL DEFAULT NULL ,
  `gps_x` FLOAT NULL DEFAULT NULL ,
  `gps_y` FLOAT NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `nuitinfo`.`comments`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `nuitinfo`.`comments` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `date` DATE NULL DEFAULT NULL ,
  `eval` INT NULL DEFAULT NULL ,
  `users_id` INT NOT NULL ,
  `streets_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_comments_users1` (`users_id` ASC) ,
  INDEX `fk_comments_streets1` (`streets_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `nuitinfo`.`pictures`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `nuitinfo`.`pictures` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `url` VARCHAR(100) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `nuitinfo`.`streets_pictures`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `nuitinfo`.`streets_pictures` (
  `streets_id` INT NOT NULL ,
  `pictures_id` INT NOT NULL ,
  PRIMARY KEY (`streets_id`, `pictures_id`) ,
  INDEX `fk_streets_has_pictures_pictures1` (`pictures_id` ASC) ,
  INDEX `fk_streets_has_pictures_streets` (`streets_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `nuitinfo`.`streets_plates_pictures`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `nuitinfo`.`streets_plates_pictures` (
  `streets_id` INT NOT NULL ,
  `pictures_id` INT NOT NULL ,
  `evaluation` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`streets_id`, `pictures_id`) ,
  INDEX `fk_streets_has_pictures_pictures2` (`pictures_id` ASC) ,
  INDEX `fk_streets_has_pictures_streets1` (`streets_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `nuitinfo`.`pictures_locations`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `nuitinfo`.`pictures_locations` (
  `pictures_id` INT NOT NULL ,
  `locations_id` INT NOT NULL ,
  PRIMARY KEY (`pictures_id`, `locations_id`) ,
  INDEX `fk_pictures_has_locations_locations1` (`locations_id` ASC) ,
  INDEX `fk_pictures_has_locations_pictures1` (`pictures_id` ASC) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
