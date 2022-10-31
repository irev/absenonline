CREATE DEFINER=`root`@`localhost` FUNCTION `mobileabsensipas_pasbar`.`F_Get_StatusAbsen`(pTGL date,pUSER TEXT) RETURNS text CHARSET utf8
BEGIN
	IF ((SELECT COUNT(keterangan) FROM absen5 WHERE username=pUSER AND tgl_group=pTGL AND keterangan IS NOT NULL)=1) THEN
		RETURN (SELECT status FROM absen5 WHERE username=pUSER AND tgl_group=pTGL AND keterangan IS NOT NULL); 
	ELSE
		RETURN (SELECT status FROM absen5 WHERE username=pUSER AND tgl_absen=pTGL AND keterangan IS NOT NULL);
	END IF;
END