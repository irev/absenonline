CREATE FUNCTION mobileabsensipas_pasbar.F_APPROV_STATUS(
pTANGGAL DATE,
pIDUSER INT
)
RETURNS INT
BEGIN
DECLARE _durasi INT;
DECLARE _status INT;
DECLARE _status_RESULT INT;
DECLARE _date_start DATE;
DECLARE _date_last DATE;
DECLARE _TEST_RESULT TEXT;
SET
_date_start =
(SELECT
		LAST_VALUE(ai.tgl_pengajuan) OVER (
ORDER BY
		ai.tgl_pengajuan DESC) AS last_approv
FROM
		approval_ijin ai
WHERE
		ai.id_user = pIDUSER
	AND 
		ai.tgl_pengajuan <= pTANGGAL
LIMIT 1);
SET
_durasi =(
SELECT
	ax.durasi
FROM
	approval_ijin ax
WHERE
	tgl_pengajuan = _date_start AND id_user=pIDUSER
LIMIT 1);
SET
_status =(
SELECT
	ap.status_approval 
FROM
	approval_ijin ap
WHERE
	tgl_pengajuan = _date_start AND id_user=pIDUSER
LIMIT 1);
IF ((ADDDATE(_date_start, _durasi)) > 1) THEN
	SET _date_last = ADDDATE(_date_start, _durasi)-1;
ELSE
	SET _date_last = ADDDATE(_date_start, _durasi);
END IF;

IF (pTANGGAL >= _date_start  AND pTANGGAL <= _date_last) THEN
	SET _status_RESULT = _status;
    SET _TEST_RESULT = 'TRUE';
ELSE
	SET _status_RESULT = 2;
    SET _TEST_RESULT = 'FALSE'; 
END IF;
RETURN _status_RESULT;
-- RETURN CONCAT(_TEST_RESULT,' ',pIDUSER,' ',_date_start, ' ~ ',_date_last,' ', pTANGGAL, ' ',(SELECT F_NamaHari(_date_last)), ' ',_durasi,' st:',_status,' ',_status_RESULT);
END
-- ADDDATE(pTANGGAL, _durasi)