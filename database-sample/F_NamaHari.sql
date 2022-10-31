CREATE DEFINER=`root`@`localhost` FUNCTION `mobileabsensipas_pasbar`.`F_NamaHari`(`pTGL` DATE) RETURNS varchar(30) CHARSET utf8
BEGIN
	IF DAYNAME(pTGL)= 'Sunday' THEN 
		RETURN 'Minggu';
	ELSEIF DAYNAME(pTGL)= 'Monday' THEN 
		RETURN 'Senin';
	ELSEIF DAYNAME(pTGL)= 'Tuesday' THEN 
		RETURN 'Selasa';
	ELSEIF DAYNAME(pTGL)= 'Wednesday' THEN 
		RETURN 'Rabu';
	ELSEIF DAYNAME(pTGL)= 'Thursday' THEN 
		RETURN 'Kamis';
	ELSEIF DAYNAME(pTGL)= 'Friday' THEN 
		RETURN 'Jumat';
	ELSEIF DAYNAME(pTGL)= 'Saturday' THEN 
		RETURN 'Sabtu';
	ELSE 
		RETURN DAYNAME(pTGL);
	END IF;
END