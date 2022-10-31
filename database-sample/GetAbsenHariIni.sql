CREATE DEFINER=`root`@`localhost` PROCEDURE `mobileabsensipas_pasbar`.`GetAbsenHariIni`(IN `pidadmin` INT, IN `ptgl` DATE)
BEGIN
SELECT 
-- approval_ijin.status_approval as x_approv,
IF(
(SELECT F_APPROV_STATUS(absen5.tgl_absen,absen5.id_user)) IS NOT NULL,(SELECT F_APPROV_STATUS(absen5.tgl_absen,absen5.id_user)),2) as x_approv,
(SELECT F_LAST_APPROV(absen5.tgl_absen,absen5.id_user)) as x_durasi,
IF((SELECT F_Get_StatusAbsen(ptgl,absen5.username)) = 2,
(SELECT F_Get_CekJadwal(ptgl,'IN')),'FALSE') as x_masuk,
IF((SELECT F_Get_StatusAbsen(ptgl,absen5.username)) = 2,
(SELECT F_Get_CekJadwal(ptgl,'OUT')),'FALSE') as x_pulang,
(SELECT F_Get_Keteranagan(ptgl,absen5.username)) as x_ket,
(SELECT F_Get_StatusAbsen(ptgl,absen5.username)) as x_status,
absen5.*
FROM absen5 
-- LEFT JOIN approval_ijin ON approval_ijin.id_absen=absen5.id_absen
WHERE absen5.tgl_absen=ptgl AND absen5.id_admin_instansi=pidadmin
HAVING absen5.id_keterangan IN (0);
END