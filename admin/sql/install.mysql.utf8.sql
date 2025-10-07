-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.11.0.7065
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table reg100001.qo7sn_regn_aktiviteter
DROP TABLE IF EXISTS `qo7sn_regn_aktiviteter`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_aktiviteter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Navn` varchar(50) DEFAULT NULL,
  `Prosjektid` varchar(50) DEFAULT NULL,
  `Ressurs` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table reg100001.qo7sn_regn_aktiviteter: ~3 rows (approximately)
REPLACE INTO `qo7sn_regn_aktiviteter` (`id`, `Navn`, `Prosjektid`, `Ressurs`) VALUES
	(1, 'Snekker', '1', NULL),
	(2, 'Elektriker', '1', NULL),
	(3, 'Innkjøp', '1', NULL);

-- Dumping structure for table reg100001.qo7sn_regn_bank
DROP TABLE IF EXISTS `qo7sn_regn_bank`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_bank` (
  `dato` date DEFAULT NULL,
  `tekst` varchar(100) DEFAULT NULL,
  `inn` float DEFAULT NULL,
  `ut` float DEFAULT NULL,
  `recnr` int(11) DEFAULT NULL,
  `debet` varchar(30) DEFAULT NULL,
  `kredit` varchar(30) DEFAULT NULL,
  `belop` float DEFAULT NULL,
  `tekstbilag` varchar(100) DEFAULT NULL,
  `oppdatert` binary(1) DEFAULT NULL,
  `indeks` int(11) NOT NULL AUTO_INCREMENT,
  `kto` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`indeks`),
  KEY `alleidx` (`dato`,`tekst`,`ut`,`inn`),
  KEY `datoidx` (`dato`,`ut`),
  KEY `kto` (`kto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table reg100001.qo7sn_regn_bank: 0 rows
/*!40000 ALTER TABLE `qo7sn_regn_bank` DISABLE KEYS */;
/*!40000 ALTER TABLE `qo7sn_regn_bank` ENABLE KEYS */;

-- Dumping structure for table reg100001.qo7sn_regn_bilagsarter
DROP TABLE IF EXISTS `qo7sn_regn_bilagsarter`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_bilagsarter` (
  `id` int(11) DEFAULT NULL,
  `beskrivelse` varchar(50) DEFAULT NULL,
  `Column 3` varchar(50) DEFAULT NULL,
  `dato` date DEFAULT NULL,
  `debet` varchar(50) DEFAULT NULL,
  `kredit` varchar(50) DEFAULT NULL,
  `belop` float DEFAULT NULL,
  `tekst` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table reg100001.qo7sn_regn_bilagsarter: ~4 rows (approximately)
REPLACE INTO `qo7sn_regn_bilagsarter` (`id`, `beskrivelse`, `Column 3`, `dato`, `debet`, `kredit`, `belop`, `tekst`) VALUES
	(3, 'ssssssssssss', NULL, NULL, '4010', '2011', NULL, NULL),
	(4, 'bil', NULL, '0000-00-00', '4014', '2011', NULL, 'Bil'),
	(1, 'ssssssssssss', NULL, NULL, '4010', '2011', NULL, NULL),
	(2, 'eeeeeeee', NULL, '2024-09-27', NULL, NULL, NULL, NULL);

-- Dumping structure for table reg100001.qo7sn_regn_bunt
DROP TABLE IF EXISTS `qo7sn_regn_bunt`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_bunt` (
  `buntnr` int(11) DEFAULT NULL,
  `antall_bilag` int(11) DEFAULT NULL,
  `meldt_buntsum` float DEFAULT NULL,
  `reg_buntsum` float DEFAULT NULL,
  `periode` varchar(50) DEFAULT NULL,
  `regdato` date DEFAULT NULL,
  `oppdater` date DEFAULT NULL,
  `loppdatert` varchar(20) DEFAULT NULL,
  `forste_bilag` int(11) DEFAULT NULL,
  `siste_bilag` int(11) DEFAULT NULL,
  `arstall` int(11) DEFAULT NULL,
  `filnavn` varchar(100) DEFAULT NULL,
  KEY `forsteidx` (`buntnr`),
  KEY `buntidx` (`buntnr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table reg100001.qo7sn_regn_bunt: 10 rows
/*!40000 ALTER TABLE `qo7sn_regn_bunt` DISABLE KEYS */;
REPLACE INTO `qo7sn_regn_bunt` (`buntnr`, `antall_bilag`, `meldt_buntsum`, `reg_buntsum`, `periode`, `regdato`, `oppdater`, `loppdatert`, `forste_bilag`, `siste_bilag`, `arstall`, `filnavn`) VALUES
	(602, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'F:\\trans_csv\\bk\\trans602.csv'),
	(602, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'F:\\trans_csv\\bk\\trans602_1.csv'),
	(602, 1526, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'F:\\trans_csv\\bk\\trans602_2.csv'),
	(602, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'F:\\trans_csv\\bk\\trans602_4.csv'),
	(602, 277, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'F:\\trans_csv\\bk\\trans602_5.csv'),
	(602, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'F:\\trans_csv\\bk\\trans602.csv'),
	(602, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'F:\\trans_csv\\bk\\trans602_1.csv'),
	(602, 1526, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'F:\\trans_csv\\bk\\trans602_2.csv'),
	(602, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'F:\\trans_csv\\bk\\trans602_4.csv'),
	(602, 277, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'F:\\trans_csv\\bk\\trans602_5.csv');
/*!40000 ALTER TABLE `qo7sn_regn_bunt` ENABLE KEYS */;

-- Dumping structure for table reg100001.qo7sn_regn_debitorer
DROP TABLE IF EXISTS `qo7sn_regn_debitorer`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_debitorer` (
  `reskontronr` int(11) DEFAULT NULL,
  `Navn` varchar(80) DEFAULT NULL,
  `Adresse` varchar(80) DEFAULT NULL,
  `postnr` varchar(6) DEFAULT NULL,
  `Sted` varchar(80) DEFAULT NULL,
  `Telefon` varchar(80) DEFAULT NULL,
  `epost` varchar(80) DEFAULT NULL,
  `Column 8` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table reg100001.qo7sn_regn_debitorer: ~0 rows (approximately)

-- Dumping structure for table reg100001.qo7sn_regn_firma
DROP TABLE IF EXISTS `qo7sn_regn_firma`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_firma` (
  `Firmanavn` varchar(80) DEFAULT NULL,
  `Adresse` varchar(100) DEFAULT NULL,
  `Postnr` varchar(20) DEFAULT NULL,
  `Poststed` varchar(80) DEFAULT NULL,
  `telefon` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `epost` varchar(100) DEFAULT NULL,
  `kontaktperson` varchar(100) DEFAULT NULL,
  `debitorkto` varchar(100) DEFAULT NULL,
  `kreditorkto` varchar(100) DEFAULT NULL,
  `neste_bilagsnr` varchar(20) DEFAULT NULL,
  `buntnr` varchar(20) DEFAULT NULL,
  `periode` varchar(50) DEFAULT NULL,
  `bilagref` varchar(20) DEFAULT NULL,
  `bunter` varchar(20) DEFAULT NULL,
  `autoperiode` varchar(20) DEFAULT NULL,
  `budsjett` varchar(80) DEFAULT NULL,
  `antall_perioder` varchar(20) DEFAULT NULL,
  `regnskapsar` varchar(20) DEFAULT NULL,
  `forarstall` varchar(20) DEFAULT NULL,
  `registreringsnummer` varchar(20) DEFAULT NULL,
  `inngfaktref` varchar(20) DEFAULT NULL,
  `oppstart_status` varchar(20) DEFAULT NULL,
  `oppstart_registrering` varchar(20) DEFAULT NULL,
  `oppstart_prosjekt` varchar(20) DEFAULT NULL,
  `oppstart_resultat` varchar(20) DEFAULT NULL,
  `oppstart_inngfakt` varchar(20) DEFAULT NULL,
  `bilagsreg_innfakt` varchar(20) DEFAULT NULL,
  `bilagsreg_bunt` varchar(20) DEFAULT NULL,
  `bilagsreg_prosjekt` varchar(20) DEFAULT NULL,
  `bilags_budsjett` varchar(20) DEFAULT NULL,
  `bilags_bunter` varchar(20) DEFAULT NULL,
  `bilags_fjorarstall` varchar(20) DEFAULT NULL,
  `bilags_inngfakt` varchar(20) DEFAULT NULL,
  `regnskapsmodus` varchar(20) DEFAULT NULL,
  `avdelingsmodus` varchar(20) DEFAULT NULL,
  `valgt_avdeling` varchar(20) DEFAULT NULL,
  `valgt_periode` varchar(30) DEFAULT NULL,
  `budsjett_fordeling` varchar(20) DEFAULT NULL,
  `Skannet_lagringsmappe` varchar(80) DEFAULT NULL,
  `res_sortering` varchar(80) DEFAULT NULL,
  `konfig` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`konfig`)),
  `passord` varchar(50) DEFAULT NULL,
  `brukernavn` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table reg100001.qo7sn_regn_firma: 1 rows
/*!40000 ALTER TABLE `qo7sn_regn_firma` DISABLE KEYS */;
REPLACE INTO `qo7sn_regn_firma` (`Firmanavn`, `Adresse`, `Postnr`, `Poststed`, `telefon`, `fax`, `epost`, `kontaktperson`, `debitorkto`, `kreditorkto`, `neste_bilagsnr`, `buntnr`, `periode`, `bilagref`, `bunter`, `autoperiode`, `budsjett`, `antall_perioder`, `regnskapsar`, `forarstall`, `registreringsnummer`, `inngfaktref`, `oppstart_status`, `oppstart_registrering`, `oppstart_prosjekt`, `oppstart_resultat`, `oppstart_inngfakt`, `bilagsreg_innfakt`, `bilagsreg_bunt`, `bilagsreg_prosjekt`, `bilags_budsjett`, `bilags_bunter`, `bilags_fjorarstall`, `bilags_inngfakt`, `regnskapsmodus`, `avdelingsmodus`, `valgt_avdeling`, `valgt_periode`, `budsjett_fordeling`, `Skannet_lagringsmappe`, `res_sortering`, `konfig`, `passord`, `brukernavn`) VALUES
	('Meg', 'sfgsfg', '3453', '', '', NULL, 'skule@sormo.no', 'admin', '1020', '2030', NULL, '815', 'April', NULL, NULL, NULL, NULL, NULL, '2025', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'budsjett', '{"ar":"2022","periode":"April","ant_post":"40","sort":"dato","retn":"desc"}', NULL, NULL);
/*!40000 ALTER TABLE `qo7sn_regn_firma` ENABLE KEYS */;

-- Dumping structure for table reg100001.qo7sn_regn_hist
DROP TABLE IF EXISTS `qo7sn_regn_hist`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_hist` (
  `ref` int(11) NOT NULL DEFAULT 0,
  `bilagsart` varchar(30) NOT NULL DEFAULT '',
  `Bilag` int(11) NOT NULL DEFAULT 0,
  `Dato` date DEFAULT NULL,
  `debet` varchar(20) DEFAULT NULL,
  `kredit` varchar(20) DEFAULT NULL,
  `belop` float(12,2) DEFAULT NULL,
  `currency` varchar(50) DEFAULT NULL,
  `currency_rate` float DEFAULT NULL,
  `currency_amount` float DEFAULT NULL,
  `Tekst` varchar(200) NOT NULL DEFAULT '',
  `kontoinfo` varchar(200) DEFAULT NULL,
  `reskontro` varchar(80) DEFAULT NULL,
  `reskontronr` varchar(80) DEFAULT NULL,
  `Regdato` date DEFAULT NULL,
  `Buntnr` smallint(6) NOT NULL DEFAULT 0,
  `Periode` varchar(50) NOT NULL DEFAULT '',
  `Forfallsdato` date DEFAULT NULL,
  `Dummy` float DEFAULT NULL,
  `Prosjektnr` varchar(200) NOT NULL DEFAULT '0',
  `Aktivitetsnr` varchar(100) NOT NULL DEFAULT '0',
  `Kostnadssted` varchar(50) NOT NULL DEFAULT '',
  `Endret_dato` date DEFAULT NULL,
  `Endret_rec` int(11) NOT NULL DEFAULT 0,
  `Regnskapsar` varchar(10) DEFAULT NULL,
  `Avdeling` varchar(30) NOT NULL DEFAULT '',
  `verifisert` tinyint(1) DEFAULT NULL,
  `Dato_verifisert` date DEFAULT NULL,
  `reskontkat` varchar(80) DEFAULT NULL,
  `saldo` float(12,2) DEFAULT NULL,
  `Saldo_ktoutskr` float(12,2) DEFAULT NULL,
  `dato_verif` varchar(50) DEFAULT NULL,
  `bilagsart1` varchar(50) DEFAULT NULL,
  `Skannet` varchar(50) DEFAULT NULL,
  `sted` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ref`),
  KEY `belopsindx` (`Regnskapsar`,`belop`),
  KEY `Bilagidx` (`Regnskapsar`,`Bilag`,`Dato`),
  KEY `Buntidx` (`Buntnr`),
  KEY `Datobelopidx` (`Regnskapsar`,`belop`,`Dato`),
  KEY `Dkidx` (`debet`,`kredit`),
  KEY `dktoidx` (`Regnskapsar`,`debet`),
  KEY `kreditidx` (`Regnskapsar`,`kredit`,`Regdato`),
  KEY `refdix` (`ref`),
  KEY `dato` (`Regnskapsar`,`Dato`,`belop`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table reg100001.qo7sn_regn_hist: 0 rows
/*!40000 ALTER TABLE `qo7sn_regn_hist` DISABLE KEYS */;
/*!40000 ALTER TABLE `qo7sn_regn_hist` ENABLE KEYS */;

-- Dumping structure for table reg100001.qo7sn_regn_kontoperiode
DROP TABLE IF EXISTS `qo7sn_regn_kontoperiode`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_kontoperiode` (
  `ktonr` int(11) DEFAULT NULL,
  `periodenavn` varchar(80) DEFAULT NULL,
  `periode` varchar(50) DEFAULT NULL,
  `saldo` float DEFAULT NULL,
  `budsjett` float DEFAULT NULL,
  `fjorarstall` float DEFAULT NULL,
  `regnskapsar` int(11) DEFAULT NULL,
  `hittil` float DEFAULT NULL,
  KEY `ktopernavnindx` (`periodenavn`),
  KEY `ktopernavnidx` (`periode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table reg100001.qo7sn_regn_kontoperiode: 0 rows
/*!40000 ALTER TABLE `qo7sn_regn_kontoperiode` DISABLE KEYS */;
/*!40000 ALTER TABLE `qo7sn_regn_kontoperiode` ENABLE KEYS */;

-- Dumping structure for table reg100001.qo7sn_regn_kreditorer
DROP TABLE IF EXISTS `qo7sn_regn_kreditorer`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_kreditorer` (
  `reskontronr` int(11) DEFAULT NULL,
  `Navn` varchar(80) DEFAULT NULL,
  `Adresse` varchar(80) DEFAULT NULL,
  `postnr` varchar(6) DEFAULT NULL,
  `Sted` varchar(80) DEFAULT NULL,
  `Telefon` varchar(80) DEFAULT NULL,
  `epost` varchar(80) DEFAULT NULL,
  `Column 8` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table reg100001.qo7sn_regn_kreditorer: ~0 rows (approximately)

-- Dumping structure for table reg100001.qo7sn_regn_kto
DROP TABLE IF EXISTS `qo7sn_regn_kto`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_kto` (
  `Ktonr` int(11) DEFAULT NULL,
  `Navn` varchar(100) DEFAULT NULL,
  `rapportlinje` int(11) DEFAULT NULL,
  `ResBal` varchar(1) DEFAULT NULL,
  `Avdeling` tinyint(1) DEFAULT NULL,
  `Prosjekt` tinyint(1) DEFAULT NULL,
  `Rapport1` int(11) DEFAULT NULL,
  `Rapport2` int(11) DEFAULT NULL,
  `Rapport3` int(11) DEFAULT NULL,
  `Likvid` int(11) DEFAULT NULL,
  `Option_directory` varchar(100) DEFAULT NULL,
  `Option_dll` varchar(100) DEFAULT NULL,
  `importfilformat` varchar(100) DEFAULT NULL,
  `Nettbank` varchar(100) DEFAULT NULL,
  `synlig` char(10) DEFAULT NULL,
  `skannet` varchar(50) DEFAULT NULL,
  KEY `ktolinje` (`ResBal`,`rapportlinje`),
  KEY `ktonrodxe` (`Ktonr`),
  KEY `rapplinjeidx` (`rapportlinje`,`Ktonr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table reg100001.qo7sn_regn_kto: 94 rows
/*!40000 ALTER TABLE `qo7sn_regn_kto` DISABLE KEYS */;
REPLACE INTO `qo7sn_regn_kto` (`Ktonr`, `Navn`, `rapportlinje`, `ResBal`, `Avdeling`, `Prosjekt`, `Rapport1`, `Rapport2`, `Rapport3`, `Likvid`, `Option_directory`, `Option_dll`, `importfilformat`, `Nettbank`, `synlig`, `skannet`) VALUES
	(4037, 'Orgelundervisning', 30, 'R', 0, NULL, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(4040, 'komm avgifter', 30, 'R', 0, NULL, 1, NULL, NULL, 15, NULL, NULL, NULL, NULL, NULL, NULL),
	(4036, 'hallo', 30, 'R', 0, NULL, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(4034, 'månedslønn barn', 30, 'R', 0, NULL, 1, NULL, NULL, 23, NULL, NULL, NULL, NULL, NULL, NULL),
	(4035, 'Pensjonsforsikring', 60, 'R', 0, NULL, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(4033, 'Kroppspleie', 22, 'R', -1, NULL, 1, NULL, NULL, 9, NULL, NULL, NULL, NULL, NULL, NULL),
	(4032, 'medisin, lege', 22, 'R', -1, NULL, 1, NULL, NULL, 22, NULL, NULL, NULL, NULL, NULL, NULL),
	(4031, 'renter omk', 61, 'R', 0, NULL, 1, NULL, NULL, 40, NULL, NULL, NULL, NULL, NULL, NULL),
	(4030, 'skadeforsikring', 37, 'R', 0, NULL, 1, NULL, NULL, 15, NULL, NULL, NULL, NULL, NULL, NULL),
	(4025, 'Internet og kabeltv', 28, 'R', 0, NULL, 1, NULL, NULL, 20, NULL, NULL, NULL, NULL, NULL, NULL),
	(4024, 'mobiltelefon', 28, 'R', -1, NULL, 1, NULL, NULL, 20, NULL, NULL, NULL, NULL, NULL, NULL),
	(4023, 'telefon', 28, 'R', 0, NULL, 1, NULL, NULL, 20, NULL, NULL, NULL, NULL, NULL, NULL),
	(4022, 'kabeltv', 28, 'R', 0, NULL, 1, NULL, NULL, 20, NULL, NULL, NULL, NULL, NULL, NULL),
	(4021, 'hybelkost', 30, 'R', 0, NULL, 1, NULL, NULL, 15, NULL, NULL, NULL, NULL, NULL, NULL),
	(4020, 'trening, idrett, turliv', 24, 'R', -1, NULL, 1, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL),
	(4019, 'div1', 30, 'R', -1, NULL, 1, NULL, NULL, 23, NULL, NULL, NULL, NULL, NULL, NULL),
	(4018, 'Kontorhold', 29, 'R', 0, NULL, 1, NULL, NULL, 19, NULL, NULL, NULL, NULL, NULL, NULL),
	(4014, 'Bilhold', 20, 'R', 0, NULL, 1, NULL, NULL, 16, NULL, NULL, NULL, NULL, NULL, NULL),
	(4015, 'Hus, hage', 40, 'R', 0, NULL, 1, NULL, NULL, 31, NULL, NULL, NULL, NULL, NULL, NULL),
	(4016, 'Datarekvisita', 32, 'R', 0, NULL, 1, NULL, NULL, 19, NULL, NULL, NULL, NULL, NULL, NULL),
	(4017, 'Feriereiser', 21, 'R', 0, NULL, 1, NULL, NULL, 15, NULL, NULL, NULL, NULL, NULL, NULL),
	(3019, 'Arv1', 5, 'R', 0, NULL, 1, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL),
	(4010, 'Kosthold', 18, 'R', 0, NULL, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(4011, 'klær', 18, 'R', 0, NULL, 1, NULL, NULL, 12, NULL, NULL, NULL, NULL, NULL, NULL),
	(4012, 'Reiser', 18, 'R', 0, NULL, 1, NULL, NULL, 15, NULL, NULL, NULL, NULL, NULL, NULL),
	(3018, 'div inntekter', 5, 'R', 0, NULL, 1, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL),
	(3017, 'Renteinntekter', 5, 'R', 0, NULL, 1, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL),
	(3016, 'Inntekt video', 5, 'R', 0, NULL, 1, NULL, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL),
	(3015, 'Inntekt Fonds', 5, 'R', 0, NULL, 1, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL),
	(3012, 'bidrag ernst amundsen', 5, 'R', 0, NULL, 1, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL),
	(3013, 'bidrag Oddlaug Sørmo', 3, 'R', 0, NULL, 1, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(3011, 'Hybelutleie', 5, 'R', 0, NULL, 1, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL),
	(3010, 'Lønn', 1, 'R', 0, NULL, 3, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(2036, 'Siba', 2, 'B', 0, NULL, 1, NULL, NULL, 53, NULL, NULL, NULL, NULL, NULL, NULL),
	(2035, 'Master Card Cresco', 2, 'B', 0, NULL, 1, NULL, NULL, 53, 'F:\\Dokumenter\\download\\mastercard\\365Privat-86041410673-2007', NULL, NULL, NULL, NULL, NULL),
	(2034, 'Ivtech dnb 5361,81,84346', 25, 'B', NULL, NULL, 1, NULL, NULL, 63, NULL, NULL, NULL, NULL, NULL, NULL),
	(2033, 'lånekassen', 22, 'B', NULL, NULL, 1, NULL, NULL, 62, NULL, NULL, NULL, NULL, NULL, NULL),
	(2032, 'Ivtech dnb 7450,80,73163', 25, 'B', NULL, NULL, 1, NULL, NULL, 61, NULL, NULL, NULL, NULL, NULL, NULL),
	(2030, 'Storebrand pantelån', 21, 'B', NULL, NULL, 1, NULL, NULL, 61, 'I:\\Dokumenter\\bank\\storebrand lån\\Transliste1.csv', NULL, NULL, NULL, NULL, NULL),
	(2021, 'Smart Club', 2, 'B', NULL, NULL, 1, NULL, NULL, 53, NULL, NULL, NULL, NULL, NULL, NULL),
	(2020, 'GE kapital', 2, 'B', NULL, NULL, 1, NULL, NULL, 53, NULL, NULL, NULL, NULL, NULL, NULL),
	(2015, 'spb1 hybeldepositum', 4, 'B', NULL, NULL, 1, NULL, NULL, 52, NULL, NULL, NULL, NULL, NULL, NULL),
	(2014, 'DNB 5365,10,14189', 1, 'B', NULL, NULL, 1, NULL, NULL, 51, NULL, NULL, NULL, NULL, NULL, NULL),
	(2013, 'DNB 5361,63,45601', 1, 'B', NULL, NULL, 1, NULL, NULL, 51, NULL, NULL, NULL, NULL, NULL, NULL),
	(2012, 'DNB 5631,10,86500', 4, 'B', NULL, NULL, 1, NULL, NULL, 51, NULL, NULL, NULL, NULL, NULL, NULL),
	(2011, 'Bank Storebrand 9100,21,07150', 2, 'B', NULL, NULL, 1, NULL, NULL, 51, 'F:\\Dokumenter\\bank\\storebrrand brukskto\\2012a\\Transliste (1).csv', 'storebrand_dll.dll', 'Felt med faste posisjoner', 'https://bank.storebrand.no/wps/portal/9680', NULL, NULL),
	(2010, 'Bank sparebank 1', 1, 'B', NULL, NULL, 1, NULL, NULL, 51, 'I:\\Dokumenter\\bank\\sparebanken\\OversiktKonti190809.csv', NULL, 'Felt skilt med semikolon', 'https://www2.sparebank1.no/portal/4210/3_privat?_nfpb=true&_pageLabel=sb1_bank_login', NULL, NULL),
	(1615, 'Hus og hage', 10, 'B', NULL, NULL, 1, NULL, NULL, 56, NULL, NULL, NULL, NULL, NULL, NULL),
	(1614, 'vertøy', 5, 'B', NULL, NULL, 1, NULL, NULL, 55, NULL, NULL, NULL, NULL, NULL, NULL),
	(1613, 'bil', 5, 'B', NULL, NULL, 1, NULL, NULL, 56, NULL, NULL, NULL, NULL, NULL, NULL),
	(1612, 'bøker', 13, 'B', NULL, NULL, 1, NULL, NULL, 55, NULL, NULL, NULL, NULL, NULL, NULL),
	(1611, 'Hobbyutstyr', 5, 'B', NULL, NULL, 1, NULL, NULL, 55, NULL, NULL, NULL, NULL, NULL, NULL),
	(1610, 'Utstyr', 5, 'B', NULL, NULL, 1, NULL, NULL, 55, NULL, NULL, NULL, NULL, NULL, NULL),
	(1063, 'Tilgode andre', 5, 'B', NULL, NULL, 1, NULL, NULL, 54, NULL, NULL, NULL, NULL, NULL, NULL),
	(1062, 'Pensjonsfond Britt 47552x', 3, 'B', NULL, NULL, 1, NULL, NULL, 53, NULL, NULL, NULL, NULL, NULL, NULL),
	(1061, 'Samvirke', 4, 'B', NULL, NULL, 1, NULL, NULL, 53, NULL, NULL, NULL, NULL, NULL, NULL),
	(1060, 'Fonds', 3, 'B', NULL, NULL, 1, NULL, NULL, 53, NULL, 'load_storebrand.dll', NULL, NULL, NULL, NULL),
	(1059, 'Sparebanken pluss sparing britt', 2, 'B', NULL, NULL, 1, NULL, NULL, 52, NULL, NULL, NULL, NULL, NULL, NULL),
	(1058, 'Scandb hus  9713.19.61190', 2, 'B', NULL, NULL, 1, NULL, NULL, 51, NULL, 'sbanken.dll', NULL, NULL, NULL, NULL),
	(1057, 'Scandb term 9713.19.61239', 2, 'B', NULL, NULL, 1, NULL, NULL, 51, NULL, NULL, NULL, NULL, NULL, NULL),
	(1056, 'PayPal', 4, 'B', NULL, NULL, 1, NULL, NULL, 53, NULL, NULL, NULL, NULL, NULL, NULL),
	(1055, 'utlegg andre', 24, 'B', 0, NULL, 1, NULL, NULL, 66, NULL, NULL, NULL, NULL, NULL, NULL),
	(1054, 'sparebank pluss 3000,16,36045', 2, 'B', NULL, NULL, 1, NULL, NULL, 51, NULL, NULL, NULL, NULL, NULL, NULL),
	(1053, 'storebrand 9100,23,36370', 2, 'B', NULL, NULL, 1, NULL, NULL, 52, 'F:\\Dokumenter\\bank\\storebrand spar\\Transliste1.csv', NULL, NULL, NULL, NULL, NULL),
	(1052, 'Britt 8220,60,54316 inntekt', 2, 'B', NULL, NULL, 3, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1051, 'Depositum hybler', 3, 'B', NULL, NULL, 1, NULL, NULL, 52, NULL, NULL, NULL, NULL, NULL, NULL),
	(1010, 'kasse', 1, 'B', NULL, NULL, 1, NULL, NULL, 50, 'F:\\Dokumenter\\bank\\storebrrand brukskto\\test\\bk\\Transliste.csv', NULL, NULL, 'http://www.vg.no', NULL, NULL),
	(4044, 'bidragstrekk', 10, 'R', -1, NULL, 1, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL),
	(4045, 'skattetrekk', 9, 'R', -1, NULL, 1, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL),
	(4046, 'pensjonstrekk', 7, 'R', -1, NULL, 1, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL),
	(4047, 'strøm varme', 38, 'R', -1, NULL, 1, NULL, NULL, 33, NULL, NULL, NULL, NULL, NULL, NULL),
	(4048, 'hobby', 25, 'R', -1, NULL, 1, NULL, NULL, 20, NULL, NULL, NULL, NULL, NULL, NULL),
	(4049, 'video, foto, cd, musikk', 31, 'R', -1, NULL, 1, NULL, NULL, 20, NULL, NULL, NULL, NULL, NULL, NULL),
	(4050, 'overført barna', 50, 'R', -1, NULL, 1, NULL, NULL, 42, NULL, NULL, NULL, NULL, NULL, NULL),
	(4051, 'kontigenter, abonnementer', 78, 'R', -1, NULL, 1, NULL, NULL, 21, NULL, NULL, NULL, NULL, NULL, NULL),
	(4052, 'Annet trekk', 11, 'R', -1, NULL, 1, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL),
	(4053, 'Gaver til andre', 76, 'R', -1, NULL, 1, NULL, NULL, 43, NULL, NULL, NULL, NULL, NULL, NULL),
	(4054, 'fagforening', 8, 'R', -1, NULL, 1, NULL, NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL),
	(4055, 'bilhold britt', 20, 'R', -1, NULL, 1, NULL, NULL, 16, NULL, NULL, NULL, NULL, NULL, NULL),
	(4056, 'bryllupsfeiring/ jubileumsfeiring', 34, 'R', 0, NULL, 1, NULL, NULL, 23, NULL, NULL, NULL, NULL, NULL, NULL),
	(4057, 'Misjonsgaver', 75, 'R', -1, NULL, 1, NULL, NULL, 43, NULL, NULL, NULL, NULL, NULL, NULL),
	(4058, 'Pengespill', 77, 'R', 0, NULL, 1, NULL, NULL, 44, NULL, NULL, NULL, NULL, NULL, NULL),
	(4059, 'Noni', 30, 'R', 0, NULL, 1, NULL, NULL, 44, NULL, NULL, NULL, NULL, NULL, NULL),
	(4060, 'renter  omk ivtech', 32, 'R', -1, NULL, 1, NULL, NULL, 40, NULL, NULL, NULL, NULL, NULL, NULL),
	(9000, 'Egenkapital', 99, 'B', 0, NULL, 1, NULL, NULL, 99, NULL, NULL, NULL, NULL, NULL, NULL),
	(4029, 'Livsforsikring', 37, 'R', 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2016, 'Bank Norwegian', 1, 'B', NULL, NULL, NULL, NULL, NULL, 52, 'F:\\Dokumenter\\bank\\bankNorw\\', 'bnorw_dll.dll', NULL, NULL, NULL, NULL),
	(1064, 'Ida Marie', 5, 'B', NULL, NULL, 1, NULL, NULL, 54, NULL, NULL, NULL, NULL, NULL, NULL),
	(1065, 'Vipps', 2, 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3020, 'Pensjonsutbetaling Storebrand', 5, 'R', 1, NULL, 1, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL),
	(4001, 'Til fordeling', 30, 'R', NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(4061, 'ukjent', 30, 'R', 0, NULL, 1, NULL, NULL, 40, NULL, NULL, NULL, NULL, NULL, NULL),
	(2017, 'Storebrand Kreditkort', NULL, 'B', 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(4009, 'Vaktselskap', 4, '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `qo7sn_regn_kto` ENABLE KEYS */;

-- Dumping structure for table reg100001.qo7sn_regn_kto_hittil_budsjet
DROP TABLE IF EXISTS `qo7sn_regn_kto_hittil_budsjet`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_kto_hittil_budsjet` (
  `Ktonr` int(11) DEFAULT NULL,
  `regnskapsar` varchar(50) DEFAULT NULL,
  `periode` varchar(50) DEFAULT NULL,
  `belop` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table reg100001.qo7sn_regn_kto_hittil_budsjet: ~2 rows (approximately)
REPLACE INTO `qo7sn_regn_kto_hittil_budsjet` (`Ktonr`, `regnskapsar`, `periode`, `belop`) VALUES
	(4010, '2015', '2', 1000),
	(4010, '2015', '2', 1000);

-- Dumping structure for table reg100001.qo7sn_regn_oppstart
DROP TABLE IF EXISTS `qo7sn_regn_oppstart`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_oppstart` (
  `nr` int(11) DEFAULT NULL,
  `Tekst` varchar(80) DEFAULT NULL,
  `Niva` int(11) DEFAULT NULL,
  `belop` float DEFAULT NULL,
  `budsjett` float DEFAULT NULL,
  `prosent` float DEFAULT NULL,
  `fjorarstall` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table reg100001.qo7sn_regn_oppstart: 0 rows
/*!40000 ALTER TABLE `qo7sn_regn_oppstart` DISABLE KEYS */;
/*!40000 ALTER TABLE `qo7sn_regn_oppstart` ENABLE KEYS */;

-- Dumping structure for table reg100001.qo7sn_regn_perioder
DROP TABLE IF EXISTS `qo7sn_regn_perioder`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_perioder` (
  `nr` int(11) NOT NULL DEFAULT 0,
  `Periodenavn` varchar(80) DEFAULT NULL,
  `saldo` float DEFAULT NULL,
  PRIMARY KEY (`nr`),
  UNIQUE KEY `nr` (`nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table reg100001.qo7sn_regn_perioder: 13 rows
/*!40000 ALTER TABLE `qo7sn_regn_perioder` DISABLE KEYS */;
REPLACE INTO `qo7sn_regn_perioder` (`nr`, `Periodenavn`, `saldo`) VALUES
	(0, 'Alle perioder', NULL),
	(1, 'Januar', NULL),
	(2, 'Februar', NULL),
	(3, 'Mars', NULL),
	(4, 'April', NULL),
	(5, 'Mai', NULL),
	(6, 'Juni', NULL),
	(7, 'Juli', NULL),
	(8, 'August', NULL),
	(9, 'September', NULL),
	(10, 'Oktober', NULL),
	(11, 'November', NULL),
	(12, 'Desember', NULL);
/*!40000 ALTER TABLE `qo7sn_regn_perioder` ENABLE KEYS */;

-- Dumping structure for table reg100001.qo7sn_regn_periodesaldo
DROP TABLE IF EXISTS `qo7sn_regn_periodesaldo`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_periodesaldo` (
  `ar` varchar(10) DEFAULT NULL,
  `periode` varchar(30) DEFAULT NULL,
  `ktonr` varchar(30) DEFAULT NULL,
  `avd` varchar(50) DEFAULT NULL,
  `sted` varchar(50) DEFAULT NULL,
  `prosjekt` varchar(50) DEFAULT NULL,
  `belop` float DEFAULT NULL,
  `budsjett` float DEFAULT NULL,
  KEY `saldoidx` (`ar`,`periode`,`ktonr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table reg100001.qo7sn_regn_periodesaldo: 10 rows
/*!40000 ALTER TABLE `qo7sn_regn_periodesaldo` DISABLE KEYS */;
REPLACE INTO `qo7sn_regn_periodesaldo` (`ar`, `periode`, `ktonr`, `avd`, `sted`, `prosjekt`, `belop`, `budsjett`) VALUES
	('2002', 'August', '2010', '', '', '', 34988.8, 0),
	('2010', 'juni', '4010', '', '', '', 34.5, 0),
	('2010', 'juni', '4010', '', '', '', 34.5, 0),
	('2010', 'juni', '4010', '', '', '', 34.5, 0),
	('2001', 'August', '2010', '', '', '', 17494.4, 0),
	('2002', 'August', '2010', '', '', '', 34988.8, 0),
	('2010', 'juni', '4010', '', '', '', 34.5, 0),
	('2010', 'juni', '4010', '', '', '', 34.5, 0),
	('2010', 'juni', '4010', '', '', '', 34.5, 0),
	('2001', 'August', '2010', '', '', '', 17494.4, 0);
/*!40000 ALTER TABLE `qo7sn_regn_periodesaldo` ENABLE KEYS */;

-- Dumping structure for table reg100001.qo7sn_regn_postnr
DROP TABLE IF EXISTS `qo7sn_regn_postnr`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_postnr` (
  `Postnummer` int(11) DEFAULT NULL,
  `Poststed` varchar(100) DEFAULT NULL,
  `Kommunenummer` int(11) DEFAULT NULL,
  `Kommunenavn` varchar(100) DEFAULT NULL,
  `Kategori` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table reg100001.qo7sn_regn_postnr: ~0 rows (approximately)

-- Dumping structure for table reg100001.qo7sn_regn_prosjekt
DROP TABLE IF EXISTS `qo7sn_regn_prosjekt`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_prosjekt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Navn` varchar(200) DEFAULT NULL,
  `Startdato` date DEFAULT NULL,
  `Sluttdato` date DEFAULT NULL,
  `Ressurs` varchar(100) DEFAULT NULL,
  `Aktiviter` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table reg100001.qo7sn_regn_prosjekt: ~0 rows (approximately)

-- Dumping structure for table reg100001.qo7sn_regn_prosj_tidslinje
DROP TABLE IF EXISTS `qo7sn_regn_prosj_tidslinje`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_prosj_tidslinje` (
  `id` int(11) DEFAULT NULL,
  `Start` datetime DEFAULT NULL,
  `Ferdig` datetime DEFAULT NULL,
  `Aktivitet` varchar(50) DEFAULT NULL,
  `Ressurs` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table reg100001.qo7sn_regn_prosj_tidslinje: ~0 rows (approximately)

-- Dumping structure for table reg100001.qo7sn_regn_regnskapsar
DROP TABLE IF EXISTS `qo7sn_regn_regnskapsar`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_regnskapsar` (
  `regnskapsar` varchar(30) DEFAULT NULL,
  KEY `regnskapsar` (`regnskapsar`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table reg100001.qo7sn_regn_regnskapsar: 27 rows
/*!40000 ALTER TABLE `qo7sn_regn_regnskapsar` DISABLE KEYS */;
REPLACE INTO `qo7sn_regn_regnskapsar` (`regnskapsar`) VALUES
	('2000'),
	('2001'),
	('2002'),
	('2003'),
	('2004'),
	('2005'),
	('2006'),
	('2007'),
	('2008'),
	('2009'),
	('2010'),
	('2011'),
	('2012'),
	('2013'),
	('2014'),
	('2015'),
	('2016'),
	('2017'),
	('2018'),
	('2019'),
	('2020'),
	('2021'),
	('2022'),
	('2023'),
	('2024'),
	('2025'),
	('Alle år');
/*!40000 ALTER TABLE `qo7sn_regn_regnskapsar` ENABLE KEYS */;

-- Dumping structure for table reg100001.qo7sn_regn_resindex
DROP TABLE IF EXISTS `qo7sn_regn_resindex`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_resindex` (
  `navn` varchar(100) NOT NULL DEFAULT '',
  `kto` varchar(20) DEFAULT NULL,
  `reskontro` varchar(20) DEFAULT NULL,
  `reskontronavn` varchar(80) DEFAULT NULL,
  `merknader` varchar(200) DEFAULT NULL,
  `tekst` varchar(100) DEFAULT NULL,
  `oppdater` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`navn`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table reg100001.qo7sn_regn_resindex: 0 rows
/*!40000 ALTER TABLE `qo7sn_regn_resindex` DISABLE KEYS */;
/*!40000 ALTER TABLE `qo7sn_regn_resindex` ENABLE KEYS */;

-- Dumping structure for table reg100001.qo7sn_regn_resindex1
DROP TABLE IF EXISTS `qo7sn_regn_resindex1`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_resindex1` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `kontonr` varchar(20) DEFAULT NULL,
  `tekst` varchar(100) DEFAULT NULL,
  `reskontronr` varchar(100) DEFAULT NULL,
  `reskontronavn` varchar(100) DEFAULT NULL,
  `oppdater` binary(1) DEFAULT NULL,
  `merknader` varchar(100) DEFAULT NULL,
  `prioritet` int(11) DEFAULT NULL,
  PRIMARY KEY (`idx`),
  KEY `tekst` (`tekst`),
  KEY `reskontronr` (`reskontronr`,`reskontronavn`),
  KEY `reskontronavn` (`reskontronavn`)
) ENGINE=MyISAM AUTO_INCREMENT=3109 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table reg100001.qo7sn_regn_resindex1: 0 rows
/*!40000 ALTER TABLE `qo7sn_regn_resindex1` DISABLE KEYS */;
/*!40000 ALTER TABLE `qo7sn_regn_resindex1` ENABLE KEYS */;

-- Dumping structure for table reg100001.qo7sn_regn_resindex2
DROP TABLE IF EXISTS `qo7sn_regn_resindex2`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_resindex2` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `kontonr` varchar(20) DEFAULT NULL,
  `tekst` varchar(300) DEFAULT NULL,
  `reskontronr` varchar(200) DEFAULT NULL,
  `reskontronavn` varchar(200) DEFAULT NULL,
  `oppdater` binary(1) DEFAULT NULL,
  `merknader` varchar(200) DEFAULT NULL,
  `prioritet` int(11) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=2243 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table reg100001.qo7sn_regn_resindex2: 0 rows
/*!40000 ALTER TABLE `qo7sn_regn_resindex2` DISABLE KEYS */;
/*!40000 ALTER TABLE `qo7sn_regn_resindex2` ENABLE KEYS */;

-- Dumping structure for table reg100001.qo7sn_regn_reskontro1
DROP TABLE IF EXISTS `qo7sn_regn_reskontro1`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_reskontro1` (
  `nr` varchar(20) DEFAULT NULL,
  `navn` varchar(80) DEFAULT NULL,
  `adresse` varchar(80) DEFAULT NULL,
  `postnr` varchar(5) DEFAULT NULL,
  `poststed` varchar(80) DEFAULT NULL,
  `tlf` varchar(20) DEFAULT NULL,
  `epost` varchar(60) DEFAULT NULL,
  `hjemmeside` varchar(120) DEFAULT NULL,
  `bank` varchar(80) DEFAULT NULL,
  `referanse` varchar(80) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table reg100001.qo7sn_regn_reskontro1: 0 rows
/*!40000 ALTER TABLE `qo7sn_regn_reskontro1` DISABLE KEYS */;
/*!40000 ALTER TABLE `qo7sn_regn_reskontro1` ENABLE KEYS */;

-- Dumping structure for table reg100001.qo7sn_regn_resmal
DROP TABLE IF EXISTS `qo7sn_regn_resmal`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_resmal` (
  `nr` int(11) NOT NULL,
  `BR` varchar(10) NOT NULL,
  `tekst` varchar(100) DEFAULT NULL,
  `niva` int(11) DEFAULT NULL,
  `belop` float DEFAULT NULL,
  `budsjett` float DEFAULT NULL,
  `prosent` float DEFAULT NULL,
  `fjorarstall` float DEFAULT NULL,
  `hittil` float DEFAULT NULL,
  `avvik` float DEFAULT NULL,
  `ar` int(11) DEFAULT NULL,
  `kontoer` varchar(200) DEFAULT NULL,
  `periode` varchar(100) DEFAULT NULL,
  `periodenr` int(11) DEFAULT NULL,
  PRIMARY KEY (`nr`,`BR`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table reg100001.qo7sn_regn_resmal: 57 rows
/*!40000 ALTER TABLE `qo7sn_regn_resmal` DISABLE KEYS */;
REPLACE INTO `qo7sn_regn_resmal` (`nr`, `BR`, `tekst`, `niva`, `belop`, `budsjett`, `prosent`, `fjorarstall`, `hittil`, `avvik`, `ar`, `kontoer`, `periode`, `periodenr`) VALUES
	(1, 'B', 'Kontanter', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(1, 'R', 'Kontanter', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 'B', 'Bank1', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 'R', 'Bank1', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 'B', 'Fonds', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 'R', 'Fonds', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 'B', 'Aksjer', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 'R', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(5, 'B', 'Utstyr', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(5, 'R', 'Utstyr', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(6, 'R', 'Sum inntekter', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(7, 'R', 'Pensjonstrekk', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(8, 'R', 'Fagforening', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(9, 'R', 'Skattetrekk', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(10, 'B', 'Hus', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(10, 'R', 'Bidragstrekk', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(11, 'R', 'Annet trekk', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(13, 'R', 'sgf', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(14, 'R', 'Sum trekk', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(15, 'R', 'Netto inntekt', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(17, 'R', '555', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(18, 'R', 'Kosthold', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(19, 'R', 'Klær', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(20, 'R', 'Bilhold', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(21, 'R', 'Reiser', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(22, 'R', 'Lege Kroppspleie', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(23, 'R', '333', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(24, 'R', 'Tur Trening Friluft', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(25, 'R', 'Hobby', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(28, 'R', 'Mobiltelefon Internett', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(29, 'R', 'Kontorhold', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(30, 'R', 'Diverse', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(31, 'R', 'Video CD Musikk Foto', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(32, 'R', 'Data', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(33, 'R', 'Sum personlig forbruk', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(34, 'R', 'bryllupsfeiring/ jubileumsfeiring', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(37, 'R', 'Livsforsikring', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(38, 'R', 'Strøm Varme', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(39, 'R', 'Kommunale utgifter', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(40, 'B', 'Kreditkort1', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(40, 'R', 'Kreditkort1', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(41, 'R', 'Sum kap', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(43, 'B', 'Pantelån hus', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(44, 'B', 'Gjeld til andre', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(50, 'R', 'Overført barna', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(51, 'R', 'Gaver til andre', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(57, 'R', 'Misjonsgaver', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(58, 'R', 'Sum gaver', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(60, 'R', 'Pensjonsforsikring', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(61, 'R', 'Sum gaver', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(62, 'R', 'Renteutg Kapitalutg', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(77, 'R', 'Lotto', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(78, 'R', 'Kontigenter Abonnementer', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(79, 'R', 'Sum  kapital', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(80, 'R', 'Sum utfiter', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(144, 'R', '4', 44, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(5435, 'R', 'ff', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `qo7sn_regn_resmal` ENABLE KEYS */;

-- Dumping structure for table reg100001.qo7sn_regn_resrapport
DROP TABLE IF EXISTS `qo7sn_regn_resrapport`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_resrapport` (
  `nr` int(11) DEFAULT NULL,
  `tekst` varchar(100) DEFAULT NULL,
  `niva` int(11) DEFAULT NULL,
  `belop` float DEFAULT NULL,
  `budsjett` float DEFAULT NULL,
  `avvik_budsjett` float DEFAULT NULL,
  `prosent_budsjett` varchar(50) DEFAULT NULL,
  `fjorarstall` float DEFAULT NULL,
  `avvik_fjorar` float DEFAULT NULL,
  `prosent_fjorar` varchar(50) DEFAULT NULL,
  `hittil` float DEFAULT NULL,
  `hittil_fjorar` float DEFAULT NULL,
  `avvik_hittil` float DEFAULT NULL,
  `prosent_hittil` varchar(50) DEFAULT NULL,
  `ar` int(11) DEFAULT NULL,
  `kontoer` varchar(200) DEFAULT NULL,
  `periode` varchar(100) DEFAULT NULL,
  `periodenr` int(11) DEFAULT NULL,
  `regnskapsar` int(11) DEFAULT NULL,
  `konfig` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table reg100001.qo7sn_regn_resrapport: 0 rows
/*!40000 ALTER TABLE `qo7sn_regn_resrapport` DISABLE KEYS */;
/*!40000 ALTER TABLE `qo7sn_regn_resrapport` ENABLE KEYS */;

-- Dumping structure for table reg100001.qo7sn_regn_ressurs
DROP TABLE IF EXISTS `qo7sn_regn_ressurs`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_ressurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Navn` varchar(50) DEFAULT NULL,
  `Prosjektid` int(11) DEFAULT NULL,
  `Timesats` float DEFAULT NULL,
  `Kostnad` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table reg100001.qo7sn_regn_ressurs: ~4 rows (approximately)
REPLACE INTO `qo7sn_regn_ressurs` (`id`, `Navn`, `Prosjektid`, `Timesats`, `Kostnad`) VALUES
	(1, 'Snekker', 33, 33, 333),
	(2, 'Elektriker', NULL, NULL, NULL),
	(3, 'Innkjøp', NULL, NULL, NULL),
	(4, 'Andre', NULL, NULL, NULL);

-- Dumping structure for table reg100001.qo7sn_regn_saldo
DROP TABLE IF EXISTS `qo7sn_regn_saldo`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_saldo` (
  `ar` int(11) DEFAULT NULL,
  `periode` int(11) DEFAULT NULL,
  `kto` int(11) DEFAULT NULL,
  `belop` decimal(20,2) DEFAULT NULL,
  `hittil` float DEFAULT NULL,
  `avvik_hittil` float DEFAULT NULL,
  `budsjett` float DEFAULT NULL,
  `avvik_budsjett` float DEFAULT NULL,
  `budsjett_hittil` float DEFAULT NULL,
  `fjorar` float DEFAULT NULL,
  `fjorar_hittil` float DEFAULT NULL,
  `hittil_fjor` float DEFAULT NULL,
  `avvik_fjorar` float DEFAULT NULL,
  `avvik_hittil_fjor` float DEFAULT NULL,
  `resbal` varchar(10) DEFAULT NULL,
  `raplinje` int(11) DEFAULT NULL,
  `kontoer` varchar(250) DEFAULT NULL,
  `konfig` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`konfig`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table reg100001.qo7sn_regn_saldo: ~2 rows (approximately)
REPLACE INTO `qo7sn_regn_saldo` (`ar`, `periode`, `kto`, `belop`, `hittil`, `avvik_hittil`, `budsjett`, `avvik_budsjett`, `budsjett_hittil`, `fjorar`, `fjorar_hittil`, `hittil_fjor`, `avvik_fjorar`, `avvik_hittil_fjor`, `resbal`, `raplinje`, `kontoer`, `konfig`) VALUES
	(2025, 4, 4010, 400.00, 400, 0, 0, -400, NULL, 0, 0, 0, 0, 0, 'R', 18, '["4010"]', '{\n    "oppdatert": "2025-04-27-15:07:44"\n}'),
	(2025, 4, 2010, -400.00, -400, 0, 0, 400, NULL, 0, 0, 0, 0, 0, 'B', 1, '["2010"]', '{\n    "oppdatert": "2025-04-27-15:07:44"\n}'),
	(2025, 10, 2011, -400.00, -400, 0, 0, 400, NULL, 0, 0, 0, 0, 0, 'B', 2, '["2011"]', '{"oppdatert":"2025-10-05"}');

-- Dumping structure for table reg100001.qo7sn_regn_saldoliste
DROP TABLE IF EXISTS `qo7sn_regn_saldoliste`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_saldoliste` (
  `ar` int(11) DEFAULT NULL,
  `kto` varchar(50) DEFAULT NULL,
  `v1` float DEFAULT NULL,
  `v2` float DEFAULT NULL,
  `v3` float DEFAULT NULL,
  `v4` float DEFAULT NULL,
  `v5` float DEFAULT NULL,
  `v6` float DEFAULT NULL,
  `v7` float DEFAULT NULL,
  `v8` float DEFAULT NULL,
  `v9` float DEFAULT NULL,
  `v10` float DEFAULT NULL,
  `v11` float DEFAULT NULL,
  `v12` float DEFAULT NULL,
  `konfig` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`konfig`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table reg100001.qo7sn_regn_saldoliste: ~0 rows (approximately)

-- Dumping structure for table reg100001.qo7sn_regn_skipord
DROP TABLE IF EXISTS `qo7sn_regn_skipord`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_skipord` (
  `skipord` varchar(50) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table reg100001.qo7sn_regn_skipord: ~19 rows (approximately)
REPLACE INTO `qo7sn_regn_skipord` (`skipord`, `id`) VALUES
	('Avtalegiro til', 1),
	('Avtalegiro til', 2),
	('Girobetaling til ', 3),
	('VIPPS', 5),
	('kontaktløs', 6),
	('Overføring', 7),
	('Straksbetaling', 8),
	('Varekjøp', 9),
	('Giro til ', 10),
	('Giro - ', 11),
	('Gebyr', 12),
	('eFaktura:', 13),
	('overført', 14),
	('konto', 15),
	('til', 16),
	('fra', 17),
	('Vipps*', 18),
	('PAYPAL *', 19),
	('kontaktløs', 20);

-- Dumping structure for table reg100001.qo7sn_regn_trans
DROP TABLE IF EXISTS `qo7sn_regn_trans`;
CREATE TABLE IF NOT EXISTS `qo7sn_regn_trans` (
  `Ref` int(11) NOT NULL DEFAULT 0,
  `Buntnr` int(11) DEFAULT NULL,
  `Bilagsart` varchar(30) DEFAULT NULL,
  `periode` varchar(20) DEFAULT NULL,
  `bilag` int(11) DEFAULT NULL,
  `Dato` date DEFAULT NULL,
  `debet` varchar(30) DEFAULT NULL,
  `kredit` varchar(30) DEFAULT NULL,
  `belop` float(12,2) DEFAULT NULL,
  `currency` varchar(50) DEFAULT NULL,
  `currency_rate` float DEFAULT NULL,
  `currency_amount` float DEFAULT NULL,
  `tekst` varchar(100) DEFAULT NULL,
  `kontoinfo` varchar(100) DEFAULT NULL,
  `sokebegrep` varchar(50) DEFAULT NULL,
  `reskontronr` varchar(20) DEFAULT NULL,
  `reskontro` varchar(80) DEFAULT NULL,
  `Regdato` date DEFAULT NULL,
  `forfallsdato` date DEFAULT NULL,
  `prosjektnr` varchar(100) DEFAULT NULL,
  `aktivitetsnr` varchar(100) DEFAULT NULL,
  `kostnadsted` varchar(100) DEFAULT NULL,
  `Avdeling` varchar(30) DEFAULT NULL,
  `verifisert` tinyint(1) DEFAULT NULL,
  `Dato_verifisert` date DEFAULT NULL,
  `klarert` tinyint(1) DEFAULT NULL,
  `bank_saldo` float DEFAULT NULL,
  `bank_ver_dato` date DEFAULT NULL,
  `sted` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `bilagsart1` varchar(50) DEFAULT NULL,
  `Skannet` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Ref`),
  KEY `bilag` (`bilag`),
  KEY `Dato` (`Dato`),
  KEY `Ref` (`Ref`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table reg100001.qo7sn_regn_trans: 0 rows
/*!40000 ALTER TABLE `qo7sn_regn_trans` DISABLE KEYS */;
/*!40000 ALTER TABLE `qo7sn_regn_trans` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
