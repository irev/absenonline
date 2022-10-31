CREATE DEFINER=`root`@`localhost` PROCEDURE `mobileabsensipas_pasbar`.`Get_Jadwal`(pTGL DATE)
BEGIN
	DECLARE HARI TEXT DEFAULT NULL;
    SET HARI = (SELECT F_NamaHari(pTGL));
    IF ((SELECT COUNT(*) AS SETTING_JADWAL FROM jam j WHERE j.tanggal=pTGL) = 1) THEN 
		SELECT 
	    	hari,pTGL,
			j_masuk as masuk, 
			bts_awal_masuk as masuk_awal,
			bts_akhir_masuk as masuk_akhir,
			j_pulang as pulang,
			bts_awal_pulang as pulang_awal,
			bts_akhir_pulang  as pulang_akhir,
			jadwal,
			tanggal
		FROM jam 
		WHERE jadwal != 'default' AND tanggal=pTGL AND tanggal IS NOT NULL LIMIT 1 ;
	ELSE
		SELECT 
	    	hari,pTGL,
			j_masuk as masuk, 
			bts_awal_masuk as masuk_awal,
			bts_akhir_masuk as masuk_akhir,
			j_pulang as pulang,
			bts_awal_pulang as pulang_awal,
			bts_akhir_pulang  as pulang_akhir,
			jadwal,
			tanggal
		FROM jam
		WHERE hari=HARI LIMIT 1;
	END IF;	
END