CREATE DEFINER=`root`@`localhost` FUNCTION `mobileabsensipas_pasbar`.`F_Get_CekJadwal`(`pTGL` DATE, `pJADWAL` VARCHAR(100) CHARSET utf8) 
RETURNS DATETIME
BEGIN
	DECLARE HARI VARCHAR(50) DEFAULT (SELECT F_NamaHari(pTGL)); 
    DECLARE JAM TIME DEFAULT CONCAT(pTGL,' ', '00:00:00');
    DECLARE _DATE_TIME DATETIME;
    SET HARI = (SELECT F_NamaHari(pTGL));
	If pJADWAL = 'IN' THEN
		SET JAM = (SELECT j_masuk as `IN` FROM jam WHERE hari=HARI LIMIT 1);
	elseif pJADWAL = 'MIN_IN' THEN
		SET JAM = (SELECT bts_akhir_masuk as `OUT` FROM jam WHERE hari=HARI LIMIT 1);
	elseif pJADWAL = 'MAX_IN' THEN
		SET JAM = (SELECT bts_akhir_masuk as `OUT` FROM jam WHERE hari=HARI LIMIT 1);
	elseif pJADWAL = 'OUT' THEN
		SET JAM = (SELECT j_pulang as `OUT` FROM jam WHERE hari=HARI LIMIT 1);
	elseif pJADWAL = 'MIN_OUT' THEN
		SET JAM = (SELECT bts_awal_pulang as `OUT` FROM jam WHERE hari=HARI LIMIT 1);
	elseif pJADWAL = 'MAX_OUT' THEN
		SET JAM = (SELECT bts_akhir_pulang as `OUT` FROM jam WHERE hari=HARI LIMIT 1);
	else
		SET JAM = CONCAT(pTGL,' ', '00:00:00');
	end if; 
SET _DATE_TIME = DATE_FORMAT(CONCAT(pTGL,' ', JAM), '%Y-%m-%d %H:%i:%S') ;
RETURN _DATE_TIME;
END