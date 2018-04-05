DROP TABLE IF EXISTS `import_wachtdienst`;
CREATE TABLE `import_wachtdienst` (
  `id`                      INT                  AUTO_INCREMENT,
  `contact_id`              INT,
  `contact_name`            VARCHAR(128),
  `riziv`                   VARCHAR(14),
  `arts_naam`               VARCHAR(128),
  `activity_type`           INT,
  `onderwerp`               VARCHAR(100),
  `datumtijd_start`         VARCHAR(20),
  `datumtijd_eind`          VARCHAR(20),
  `wachtdienst_id`          INT,
  `wachtdienst_naam`        VARCHAR(128),
  `processed`               VARCHAR(1)  NOT NULL DEFAULT 'N',
  `message`                 TEXT                 DEFAULT NULL,
  PRIMARY KEY (`id`)
) COLLATE `utf8_unicode_ci`;
