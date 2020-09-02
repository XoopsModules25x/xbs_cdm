SET @lang = "";
DELETE
  FROM xbscdm_meta
 WHERE cd_set = 'COLOUR';
DELETE
  FROM xbscdm_code
 WHERE cd_set = 'COLOUR';
