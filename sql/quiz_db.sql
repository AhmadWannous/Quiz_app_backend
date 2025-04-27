-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema quiz_db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema quiz_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `quiz_db` DEFAULT CHARACTER SET utf8 ;
USE `quiz_db` ;

-- -----------------------------------------------------
-- Table `quiz_db`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quiz_db`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE (`email`),
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `quiz_db`.`quizzes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `quiz_db`.`quizzes`;

CREATE TABLE IF NOT EXISTS `quiz_db`.`quizzes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  `created_by` INT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_quizzes_users_idx` (`created_by`),
  CONSTRAINT `fk_quizzes_users`
    FOREIGN KEY (`created_by`)
    REFERENCES `quiz_db`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `quiz_db`.`questions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `quiz_db`.`questions`;

CREATE TABLE IF NOT EXISTS `quiz_db`.`questions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `quiz_id` INT NOT NULL,
  `question_text` TEXT NOT NULL,
  `option_1` TEXT NOT NULL,
  `option_2` TEXT NOT NULL,
  `option_3` TEXT NOT NULL,
  `correct_option` TINYINT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_questions_quizzes1_idx` (`quiz_id`),
  CONSTRAINT `fk_questions_quizzes1`
    FOREIGN KEY (`quiz_id`)
    REFERENCES `quiz_db`.`quizzes` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `quiz_db`.`scores`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `quiz_db`.`scores`;

CREATE TABLE IF NOT EXISTS `quiz_db`.`scores` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `quiz_id` INT NOT NULL,
  `score` INT NOT NULL,
  `taken_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_scores_users1_idx` (`user_id`),
  INDEX `fk_scores_quizzes1_idx` (`quiz_id`),
  CONSTRAINT `fk_scores_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `quiz_db`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_scores_quizzes1`
    FOREIGN KEY (`quiz_id`)
    REFERENCES `quiz_db`.`quizzes` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;