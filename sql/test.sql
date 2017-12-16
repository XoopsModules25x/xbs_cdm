set @lang = "EN";
delete from cdm_meta where cd_set = 'COLOUR';
delete from cdm_code where cd_set = 'COLOUR';
insert into cdm_meta (cd_set,cd_type,cd_len,val_type,val_len,cd_desc) values ('COLOUR','CHAR',2,'VARCHAR',8,'Colour Codes');
insert into cdm_code (cd_set,cd_lang,cd,cd_prnt,cd_value,cd_desc,cd_param) values ('COLOUR',@lang,'RD',NULL,'Red','The colour red',NULL);
insert into cdm_code (cd_set,cd_lang,cd,cd_prnt,cd_value,cd_desc,cd_param) values ('COLOUR',@lang,'GR',NULL,'Green','The colour green',NULL);
insert into cdm_code (cd_set,cd_lang,cd,cd_prnt,cd_value,cd_desc,cd_param) values ('COLOUR',@lang,'BU',NULL,'Blue','The colour blue',NULL);
insert into cdm_code (cd_set,cd_lang,cd,cd_prnt,cd_value,cd_desc,cd_param) values ('COLOUR',@lang,'YE',NULL,'Yellow','The colour yellow',NULL);
