CREATE DEFINER=`root`@`localhost` PROCEDURE `mobileabsensipas_pasbar`.`GetAbsenHariIni`(IN `pidadmin` INT, IN `ptgl` DATE)
BEGIN
SELECT 
IF((SELECT approval_ijin.status_approval FROM approval_ijin WHERE approval_ijin.id_absen=absen5.id_absen AND absen5.tgl_group=approval_ijin.tgl_pengajuan AND absen5.tgl_absen=ptgl AND approval_ijin.id_admin=pidadmin)<>3,
(SELECT status_approval FROM approval_ijin WHERE approval_ijin.id_absen=absen5.id_absen AND approval_ijin.tgl_pengajuan =absen5.tgl_group AND tgl_pengajuan=ptgl AND id_admin=pidadmin)
,1) as x_approv,
IF((SELECT status_approval FROM approval_ijin WHERE approval_ijin.id_absen=absen5.id_absen AND approval_ijin.tgl_pengajuan =absen5.tgl_group AND   tgl_pengajuan=ptgl AND id_admin=pidadmin)<>3,
(SELECT durasi FROM approval_ijin WHERE approval_ijin.id_absen=absen5.id_absen AND approval_ijin.tgl_pengajuan =absen5.tgl_group AND tgl_pengajuan=ptgl AND id_admin=pidadmin LIMIT 1)
,1) as x_durasi,
IF((SELECT username FROM absen5 a WHERE absen5.id_absen=a.id_absen AND absen5.username=a.username AND a.id_keterangan=1 AND a.tgl_group=ptgl AND a.id_admin_instansi=pidadmin) = absen5.username,
1,0) as x_gruping,
IF((SELECT F_Get_StatusAbsen(ptgl,absen5.username)) = 2,
(SELECT F_Get_CekJadwal(ptgl,'IN')),'FALSE') as x_masuk,
(SELECT approval_ijin.status_approval FROM approval_ijin WHERE approval_ijin.id_absen=absen5.id_absen AND approval_ijin.tgl_pengajuan=absen5.tgl_group AND approval_ijin.tgl_pengajuan=ptgl AND approval_ijin.id_admin=pidadmin) as hole,
(SELECT F_Get_Keteranagan(ptgl,absen5.username)) as x_ket,
(SELECT F_Get_StatusAbsen(ptgl,absen5.username)) as x_status,
absen5.*
FROM absen5 WHERE absen5.tgl_absen=ptgl AND absen5.id_admin_instansi=pidadmin
HAVING absen5.id_keterangan IN (0);
END