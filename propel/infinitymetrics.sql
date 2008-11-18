-- Generated by SQL Maestro for MySQL. Release date 6/10/2008
-- 10/23/2008 10:19:17 AM
-- ----------------------------------
-- Alias: infinitymetricsm303 at localhost
-- Database name: infinitymetricsm303
-- Host: localhost
-- Port number: 3306
-- User name: root
-- Server: 5.0.67-community-nt
-- Session ID: 2
-- Character set: utf8
-- Collation: utf8_bin


SET FOREIGN_KEY_CHECKS=0;


USE `infinitymetricsm303`;

/* Tables */
CREATE TABLE `channel` (
  `channel_id`       int(10) UNSIGNED AUTO_INCREMENT NOT NULL,
  `project_jn_name`  varchar(50) NOT NULL,
  `channel_name`     varchar(30) NOT NULL,
  `title`            varchar(255),
  `category`         enum ('COMMIT','CUSTOMIZED','DOCUMENTATION','FORUM','ISSUE','MAILING_LIST') NOT NULL,
  PRIMARY KEY (`channel_id`, `project_jn_name`, `channel_name`)
) ENGINE = InnoDB;

CREATE TABLE `custom_event` (
  `custom_event_id`       smallint(5) UNSIGNED AUTO_INCREMENT NOT NULL,
  `title`            varchar(64) NOT NULL,
  `date`             date NOT NULL,
  `project_jn_name`  varchar(50) NOT NULL,
  PRIMARY KEY (`custom_event_id`)
) ENGINE = InnoDB;

CREATE TABLE `custom_event_entry` (
  `entry_id`    int(10) UNSIGNED AUTO_INCREMENT NOT NULL,
  `notes`       varchar(255) NOT NULL,
  `custom_event_id` smallint(5) UNSIGNED NOT NULL,
  `date`        timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`entry_id`)
) ENGINE = InnoDB;

CREATE TABLE `event` (
  `channel_id`   int(10) UNSIGNED NOT NULL,
  `event_id`     varchar(30) NOT NULL,
  `jn_username`  varchar(32) NOT NULL,
  `date`         timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`channel_id`, `event_id`)
) ENGINE = InnoDB;

CREATE TABLE `institution` (
  `institution_id`  smallint(5) UNSIGNED AUTO_INCREMENT NOT NULL,
  `name`            varchar(255) NOT NULL,
  `abbreviation`    varchar(16) NOT NULL,
  `city`            varchar(255) NOT NULL,
  `state_province`  varchar(255) NOT NULL,
  `country`         varchar(255) NOT NULL,
  PRIMARY KEY (`institution_id`)
) ENGINE = InnoDB;

CREATE TABLE `project` (
  `project_jn_name`  varchar(50) NOT NULL,
  `summary`          varchar(64),
  PRIMARY KEY (`project_jn_name`)
) ENGINE = InnoDB;

CREATE TABLE `student_x_project` (
  `user_id`          int(10) UNSIGNED NOT NULL,
  `project_jn_name`  varchar(50) NOT NULL,
  `is_leader`        tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`, `project_jn_name`)
) ENGINE = InnoDB;

CREATE TABLE `user` (
  `user_id`      int(10) UNSIGNED AUTO_INCREMENT NOT NULL,
  `jn_username`  varchar(32) NOT NULL,
  `jn_password`  varchar(32) NOT NULL,
  `first_name`   varchar(50) NOT NULL,
  `last_name`    varchar(50) NOT NULL,
  `email`        varchar(255) NOT NULL,
  `type`         enum ('S','I','J'),
  `institution_id` smallint(5) UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE = InnoDB;

CREATE TABLE `workpace_x_project` (
  `workspace_id`     mediumint(8) UNSIGNED NOT NULL,
  `project_jn_name`  varchar(50) NOT NULL,
  `summary`          varchar(64),
  PRIMARY KEY (`workspace_id`, `project_jn_name`)
) ENGINE = InnoDB;

CREATE TABLE `workspace` (
  `workspace_id`  mediumint(8) UNSIGNED AUTO_INCREMENT NOT NULL,
  `state`         enum ('NEW','ACTIVE','PAUSED','INACTIVE') NOT NULL DEFAULT 'NEW',
  `user_id`       int(10) UNSIGNED NOT NULL COMMENT 'The creator of this workspace',
  `title`         varchar(64) NOT NULL,
  `description`   varchar(255),
  PRIMARY KEY (`workspace_id`)
) ENGINE = InnoDB;

CREATE TABLE `workspace_share` (
  `workspace_id`  mediumint(8) UNSIGNED NOT NULL,
  `user_id`       int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`workspace_id`, `user_id`)
) ENGINE = InnoDB;

/* Indexes */
CREATE INDEX `idx_channel_category`
  ON `channel`
  (`category`);

CREATE INDEX `idx_fk_channel_project_jn_name`
  ON `channel`
  (`project_jn_name`);

CREATE INDEX `idx_fk_custom_event_project_jn_name`
  ON `custom_event`
  (`project_jn_name`);

CREATE INDEX `idx_fk_entry_custom_event_id`
  ON `custom_event_entry`
  (`custom_event_id`);

CREATE INDEX `idx_fk_user_institution_id`
  ON `user`
  (`institution_id`);

CREATE INDEX `idx_creator_username`
  ON `event`
  (`jn_username`);

CREATE INDEX `idx_publication_date`
  ON `event`
  (`date`);

CREATE INDEX `idx_fk_project_x_project_jn_name`
  ON `student_x_project`
  (`project_jn_name`);

CREATE UNIQUE INDEX `username`
  ON `user`
  (`jn_username`);

CREATE INDEX `idx_fk_workspace_x_project_jn_name`
  ON `workpace_x_project`
  (`project_jn_name`);

CREATE INDEX `idx_fk_worspace_user_id`
  ON `workspace`
  (`user_id`);

CREATE INDEX `idx_state`
  ON `workspace`
  (`state`);

CREATE INDEX `idx_fk_share_user_id`
  ON `workspace_share`
  (`user_id`);

/* Foreign Keys */
ALTER TABLE `channel`
  ADD CONSTRAINT `idx_fk_channel_project_jn_name`
  FOREIGN KEY (`project_jn_name`)
    REFERENCES `project`(`project_jn_name`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT;

ALTER TABLE `user`
  ADD CONSTRAINT `idx_fk_user_institution`
  FOREIGN KEY (`institution_id`)
    REFERENCES `institution`(`institution_id`);

ALTER TABLE `custom_event`
  ADD CONSTRAINT `idx_fk_custom_event_project_jn_name`
  FOREIGN KEY (`project_jn_name`)
    REFERENCES `project`(`project_jn_name`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT;

ALTER TABLE `custom_event_entry`
  ADD CONSTRAINT `idx_fk_entry_custom_event_id`
  FOREIGN KEY (`custom_event_id`)
    REFERENCES `custom_event`(`custom_event_id`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT;

ALTER TABLE `event`
  ADD CONSTRAINT `idx_fk_event_channel_id`
  FOREIGN KEY (`channel_id`)
    REFERENCES `channel`(`channel_id`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT;

ALTER TABLE `event`
  ADD CONSTRAINT `idx_fk_event_jn_username`
  FOREIGN KEY (`jn_username`)
    REFERENCES `user`(`jn_username`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT;

ALTER TABLE `student_x_project`
  ADD CONSTRAINT `idx_fk_project_x_project_jn_name`
  FOREIGN KEY (`project_jn_name`)
    REFERENCES `project`(`project_jn_name`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT;

ALTER TABLE `workpace_x_project`
  ADD CONSTRAINT `idx_fk_workspace_x_project_jn_name`
  FOREIGN KEY (`project_jn_name`)
    REFERENCES `project`(`project_jn_name`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT;

ALTER TABLE `workpace_x_project`
  ADD CONSTRAINT `idx_fk_workspace_x_workspace_id`
  FOREIGN KEY (`workspace_id`)
    REFERENCES `workspace`(`workspace_id`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT;

ALTER TABLE `workspace`
  ADD CONSTRAINT `idx_fk_worspace_user_id`
  FOREIGN KEY (`user_id`)
    REFERENCES `user`(`user_id`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT;

ALTER TABLE `workspace_share`
  ADD CONSTRAINT `idx_fk_share_user_id`
  FOREIGN KEY (`user_id`)
    REFERENCES `user`(`user_id`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT;

ALTER TABLE `workspace_share`
  ADD CONSTRAINT `idx_fk_share_workspace_id`
  FOREIGN KEY (`workspace_id`)
    REFERENCES `workspace`(`workspace_id`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT;

/* Data for table "channel" */
COMMIT;


/* Data for table "custom_event" */
COMMIT;


/* Data for table "custom_event_entry" */
COMMIT;


/* Data for table "event" */
COMMIT;


/* Data for table "institution" */
COMMIT;


/* Data for table "project" */
COMMIT;


/* Data for table "student_x_project" */
COMMIT;


/* Data for table "user" */
COMMIT;


/* Data for table "workpace_x_project" */
COMMIT;


/* Data for table "workspace" */
COMMIT;


/* Data for table "workspace_share" */
COMMIT;