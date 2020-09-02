SET @lang = "EN";
DELETE
  FROM cdm_meta
 WHERE cd_set = 'COLOUR';
DELETE
  FROM cdm_code
 WHERE cd_set = 'COLOUR';
INSERT INTO cdm_meta (cd_set, cd_type, cd_len, val_type, val_len, cd_desc)
VALUES ('COLOUR', 'CHAR', 2, 'VARCHAR', 8, 'Colour Codes');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param)
VALUES ('COLOUR', @lang, 'RD', NULL, 'Red', 'The colour red', NULL);
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param)
VALUES ('COLOUR', @lang, 'GR', NULL, 'Green', 'The colour green', NULL);
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param)
VALUES ('COLOUR', @lang, 'BU', NULL, 'Blue', 'The colour blue', NULL);
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param)
VALUES ('COLOUR', @lang, 'YE', NULL, 'Yellow', 'The colour yellow', NULL);
