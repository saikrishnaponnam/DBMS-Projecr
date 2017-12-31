<?php

include("database.php");
//SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
//SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
//SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

//Schema cfadb

$sql ="CREATE  SCHEMA IF NOT EXISTS `cfadb` DEFAULT CHARACTER SET utf8 ";
$conn->query($sql);
//USE `cfadb` ;

// Table `cfadb`.`admin`
/*
$sql ="CREATE  TABLE IF NOT EXISTS `cfadb`.`admin` (
  `username` VARCHAR(20) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`username`))
ENGINE = InnoDB";

$conn->query($sql);
*/

// Table `cfadb`.`fa_login`

$sql ="CREATE  TABLE IF NOT EXISTS `cfadb`.`fa_login` (
  `fa_id` VARCHAR(20) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`fa_id`),
  UNIQUE INDEX `fa_id_UNIQUE` (`fa_id` ASC))
ENGINE = InnoDB";

$conn->query($sql);

// Table `cfadb`.`fa`

$sql ="CREATE  TABLE IF NOT EXISTS `cfadb`.`fa` (
  `fa_login_fa_id` VARCHAR(20) NOT NULL,
  `name` VARCHAR(45) NULL,
  `forbatch` VARCHAR(5) NULL,
  `email_id` VARCHAR(45) NULL,
  `mobile` INT NULL,
  `Designation` VARCHAR(45) NULL,
  INDEX `fk_fa_fa_login1_idx` (`fa_login_fa_id` ASC),
  PRIMARY KEY (`fa_login_fa_id`),
  CONSTRAINT `fk_fa_fa_login1`
    FOREIGN KEY (`fa_login_fa_id`)
    REFERENCES `cfadb`.`fa_login` (`fa_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB";

$conn->query($sql);

// Table `cfadb`.`student_login`

$sql ="CREATE  TABLE IF NOT EXISTS `cfadb`.`student_login` (
  `roll_number` VARCHAR(10) NOT NULL,
  `password` VARCHAR(50) NOT NULL,
  `details_filled` ENUM('y', 'n') DEFAULT 'n',
  `fa_fa_login_fa_id` VARCHAR(20),
  PRIMARY KEY (`roll_number`),
  UNIQUE INDEX `roll_number_UNIQUE` (`roll_number` ASC),
  INDEX `fk_student_login_fa1_idx` (`fa_fa_login_fa_id` ASC),
  CONSTRAINT `fk_student_login_fa1`
    FOREIGN KEY (`fa_fa_login_fa_id`)
    REFERENCES `cfadb`.`fa` (`fa_login_fa_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB";

$conn->query($sql);

// Table `cfadb`.`student_details`

$sql ="CREATE  TABLE IF NOT EXISTS `cfadb`.`student_details` (
  `student_login_roll_number` VARCHAR(10) NOT NULL,
  `name` VARCHAR(30) NOT NULL,
  `joinyear` INT NOT NULL,
  `presentsem` INT NULL,
  `dob` DATE NOT NULL,
  `nationality` VARCHAR(45) NOT NULL,
  `religion` VARCHAR(45) NOT NULL,
  `caste` VARCHAR(45) NOT NULL,
  `contact_no` VARCHAR(45) NOT NULL,
  `email_id` VARCHAR(45) NOT NULL,
  `permanent_address` VARCHAR(100) NOT NULL,
  `present_address` VARCHAR(100) NOT NULL,
  `local_guardian` VARCHAR(45) NULL,
  `father_name` VARCHAR(45) NOT NULL,
  `mother_name` VARCHAR(45) NOT NULL,
  `fa_name` VARCHAR(45) NOT NULL,
  `parent_contact` VARCHAR(45) NOT NULL,
  `parent_email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`student_login_roll_number`),
  CONSTRAINT `fk_student_details_student_login1`
    FOREIGN KEY (`student_login_roll_number`)
    REFERENCES `cfadb`.`student_login` (`roll_number`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB";

$conn->query($sql);

// Table  Student_record

$sql ="CREATE  TABLE IF NOT EXISTS `cfadb`.`student_record` (
  `student_login_roll_number` VARCHAR(10) NOT NULL,
  `cgpa` FLOAT NULL,
  `project` VARCHAR(45) NULL,
  `joinyear` INT NULL,
  `batch` CHAR NULL,
  `project_guide` VARCHAR(100) NULL,
  `internship` VARCHAR(100) NULL,
  `condonation_details` VARCHAR(45) NULL,
  `no_of_condonations` VARCHAR(45) NULL,
  `probation_details` VARCHAR(45) NULL,
  `medical_discontinuation` ENUM('Y', 'N') NULL,
  `medical_discontinuation_details` VARCHAR(45) NULL,
  `extra_curricular_activities` VARCHAR(45) NULL,
  `Dept_association_activities` VARCHAR(45) NULL,
  `achievements` VARCHAR(45) NULL,
  `disciplinary_action` VARCHAR(45) NULL,
  `placement_details` VARCHAR(45) NULL,
  `alternate_email` VARCHAR(45) NULL,
  `facebook` VARCHAR(45) NULL,
  `linkedIn` VARCHAR(45) NULL,
  PRIMARY KEY (`student_login_roll_number`),
  CONSTRAINT `fk_student_record_student_login1`
    FOREIGN KEY (`student_login_roll_number`)
    REFERENCES `cfadb`.`student_login` (`roll_number`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
    ENGINE = InnoDB";
$conn->query($sql);


// Table `cfadb`.`student_academic_details`

$sql ="CREATE  TABLE IF NOT EXISTS `cfadb`.`student_academic_details` (
  `sem` INT NOT NULL,
  `grade` ENUM('S', 'A', 'B', 'C', 'D', 'E', 'F', 'R') NULL,
  `attendance` ENUM('H', 'N', 'W') NULL,
  `cid` VARCHAR(10) NOT NULL,
  `course_name` VARCHAR(45) NULL,
  `credits` INT NULL,
  `student_login_roll_number` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`student_login_roll_number`,`sem`,`cid`),
  INDEX `fk_student_academic_details_student_login1_idx` (`student_login_roll_number` ASC),
  CONSTRAINT `fk_student_academic_details_student_login1`
    FOREIGN KEY (`student_login_roll_number`)
    REFERENCES `cfadb`.`student_login` (`roll_number`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB";

$conn->query($sql);


// Table `cfadb`.`courses`
$sql="CREATE TABLE IF NOT EXISTS `cfadb`.`courses` (
  `cid` VARCHAR(10) NOT NULL,
  `course_name` VARCHAR(45) NOT NULL,
  `sem` INT NOT NULL,
  `credits` INT NOT NULL,
  `fa_login_fa_id` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`cid`),
  INDEX `fk_courses_fa_login1_idx` (`fa_login_fa_id` ASC),
  CONSTRAINT `fk_courses_fa_login1`
    FOREIGN KEY (`fa_login_fa_id`)
    REFERENCES `cfadb`.`fa_login` (`fa_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB";

$conn->query($sql);

// Table `cfadb`.`grade_report`

$sql ="CREATE  TABLE IF NOT EXISTS `cfadb`.`grade_report` (
  `s1` FLOAT NULL,
  `s2` FLOAT NULL,
  `s3` FLOAT NULL,
  `s4` FLOAT NULL,
  `s5` FLOAT NULL,
  `s6` FLOAT NULL,
  `s7` FLOAT NULL,
  `s8` FLOAT NULL,
  `v1` ENUM('y', 'n') NULL DEFAULT 'n',
  `v2` ENUM('y', 'n') NULL DEFAULT 'n',
  `v3` ENUM('y', 'n') NULL DEFAULT 'n',
  `v4` ENUM('y', 'n') NULL DEFAULT 'n',
  `v5` ENUM('y', 'n') NULL DEFAULT 'n',
  `v6` ENUM('y', 'n') NULL DEFAULT 'n',
  `v7` ENUM('y', 'n') NULL DEFAULT 'n',
  `v8` ENUM('y', 'n') NULL DEFAULT 'n',
  `student_login_roll_number` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`student_login_roll_number`),
  CONSTRAINT `fk_grade_report_student_login1`
    FOREIGN KEY (`student_login_roll_number`)
    REFERENCES `cfadb`.`student_login` (`roll_number`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB";

$conn->query($sql);



// Table `cfadb`.`messages`

$sql ="CREATE  TABLE IF NOT EXISTS `cfadb`.`messages` (
  `message` VARCHAR(500) NULL,
  `read` ENUM('y', 'n') NULL DEFAULT 'n',
  `from_` ENUM('s','f') NULL ,
  `fa_login_fa_id` VARCHAR(20) NOT NULL,
  `student_login_roll_number` VARCHAR(10) NOT NULL,
  INDEX `fk_messages_fa_login1_idx` (`fa_login_fa_id` ASC),
  INDEX `fk_messages_student_login1_idx` (`student_login_roll_number` ASC),
  CONSTRAINT `fk_messages_fa_login1`
    FOREIGN KEY (`fa_login_fa_id`)
    REFERENCES `cfadb`.`fa_login` (`fa_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_messages_student_login1`
    FOREIGN KEY (`student_login_roll_number`)
    REFERENCES `cfadb`.`student_login` (`roll_number`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB";

$conn->query($sql);

// Table `cfadb`.`notifications`

$sql ="CREATE  TABLE IF NOT EXISTS `cfadb`.`notifications` (
  `notification` VARCHAR(1000) NOT NULL,
  `updated_on` TIMESTAMP NOT NULL)
ENGINE = InnoDB";

$conn->query($sql);

// Table `cfadb`.`appointments`

$sql ="CREATE  TABLE IF NOT EXISTS `cfadb`.`appointments` (
  `appointment_details` VARCHAR(45) NULL,
  `appointment_status` ENUM('A', 'R') NULL,
  `date` DATE NOT NULL,
  `appointment_id` INT(200) NOT NULL AUTO_INCREMENT,
  `student_login_roll_number` VARCHAR(10) NOT NULL,
  `fa_login_fa_id` VARCHAR(20) NOT NULL,
  UNIQUE INDEX `appointment_id_UNIQUE` (`appointment_id` ASC),
  PRIMARY KEY (`appointment_id`),
  INDEX `fk_appointments_student_login1_idx` (`student_login_roll_number` ASC),
  INDEX `fk_appointments_fa_login1_idx` (`fa_login_fa_id` ASC),
  CONSTRAINT `fk_appointments_student_login1`
    FOREIGN KEY (`student_login_roll_number`)
    REFERENCES `cfadb`.`student_login` (`roll_number`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_appointments_fa_login1`
    FOREIGN KEY (`fa_login_fa_id`)
    REFERENCES `cfadb`.`fa_login` (`fa_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB";

$conn->query($sql);



// Table `cfadb`.`HOD`

$sql ="CREATE  TABLE IF NOT EXISTS `cfadb`.`HOD` (
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `name` VARCHAR(45),
  `email_id` VARCHAR(45),
  `mobile` VARCHAR(45),
  `Designation` VARCHAR(45),
  PRIMARY KEY (`username`))
ENGINE = InnoDB";

$conn->query($sql);


//SET SQL_MODE=@OLD_SQL_MODE;
//SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
//SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


?>