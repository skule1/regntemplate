-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for procedure test2.Oppdater_trans
DROP PROCEDURE IF EXISTS `Oppdater_trans`;
DELIMITER //
CREATE PROCEDURE `Oppdater_trans`()
BEGIN
 DECLARE a INT   DEFAULT  0;
 DECLARE c INT   DEFAULT  0;
 DECLARE LAST1 INT   DEFAULT  0;
 DECLARE ar2 INT   DEFAULT  0;
 DECLARE dat1 DATE    DEFAULT  0;
DECLARE bel1 FLOAT     DEFAULT  0;
DECLARE deb1 VARCHAR (50)     DEFAULT  "";
DECLARE kred1 VARCHAR (50)     DEFAULT  "";

SELECT  Ref INTO LAST1 FROM qo7sn_regn_trans  ORDER BY Ref DESC LIMIT 1;  -- lagrer siste post

  myloop:loop -- WHILE  a<100 DO
  -- select from resmal: 
  
 SELECT  Ref,Dato,debet,kredit,belop INTO c,dat1,deb1,kred1,bel1 FROM qo7sn_regn_trans   where Ref = (select min(Ref) from qo7sn_regn_resmal where Ref > a)  ORDER BY Ref LIMIT 1;
 SET @ROW_COUNT1 = FOUND_ROWS();
 SET a=c;
SELECT @ROW_COUNT1,c,dat1,deb1,kred1,bel1;
 
 -- SELECT * FROM qo7sn_regn_saldo WHERE ar=YEAR(dat1) AND periode=MONTH(dat1) AND kto=deb1;
 -- SELECT * FROM qo7sn_regn_saldo WHERE ar=YEAR(dat1) AND periode=MONTH(dat1) AND kto=deb1;
--    SELECT * FROM qo7sn_regn_saldo WHERE ar=YEAR(dat1) AND periode=MONTH(dat1) AND kto=kred1;
--     INSERT INTO qo7sn_regn_saldo (ar,periode,kto,belop)  VALUE (YEAR(dat1),MONTH(dat1),deb1,bel1);
	  
	  
 if (@ROW_COUNT1=1) then  -- funnet linje i trans

 SELECT * FROM qo7sn_regn_saldo WHERE ar=YEAR(dat1) AND periode=MONTH(dat1) AND kto=deb1;
 if ( FOUND_ROWS()=0) then
  INSERT INTO qo7sn_regn_saldo (ar,periode,kto,belop)  VALUE (YEAR(dat1),MONTH(dat1),deb1,bel1);
    ELSE 
 UPDATE qo7sn_regn_saldo set belop=belop+bel1 WHERE  ar=YEAR(dat1) and periode=MONTH(dat1) and kto=deb1;
  END if;
  
SELECT * FROM qo7sn_regn_saldo WHERE ar=YEAR(dat1) AND periode=MONTH(dat1) AND kto=kred1;
 if ( FOUND_ROWS()=0) then
  INSERT INTO qo7sn_regn_saldo (ar,periode,kto,belop)  VALUE (YEAR(dat1),MONTH(dat1),kred1,-bel1);
    ELSE 
 UPDATE qo7sn_regn_saldo set belop=belop-bel1 WHERE  ar=YEAR(dat1) and periode=MONTH(dat1)and kto=kred1;
  END if;
  /*
   SELECT * FROM qo7sn_regn_saldo WHERE ar=YEAR(dat1) AND periode=MONTH(dat1) AND kto=kred1;
 if (FOUND_ROWS()=0)
   INSERT INTO qo7sn_regn_saldo (ar,periode,kto,belop)  VALUE (YEAR(dat1),MONTH(dat1),kred1,-bel1);
  ELSE 
  UPDATE qo7sn_regn_saldo SET ar=YEAR(dat1),periode=MONTH(dat1),kto=kred1,belop=belop-bel1;
  END if;
*/
 END if;
  
  if a=LAST1 then LEAVE myloop;end if;
-- END while myloop ;
END loop myloop ;


 END//
DELIMITER ;

-- Dumping structure for procedure test2.proc_fjorarstall
DROP PROCEDURE IF EXISTS `proc_fjorarstall`;
DELIMITER //
CREATE PROCEDURE `proc_fjorarstall`(IN ar INT, IN per int)
BEGIN

DROP TABLE IF EXISTS resrapport;
CREATE TABLE resrapport AS SELECT   * FROM qo7sn_regn_resrapport  WHERE qo7sn_regn_resrapport.regnskapsar=ar-1 AND qo7sn_regn_resrapport.periodenr=per;


UPDATE qo7sn_regn_resrapport INNER JOIN resrapport ON   qo7sn_regn_resrapport.nr=resrapport.nr and qo7sn_regn_resrapport.periode=resrapport.periode
     set qo7sn_regn_resrapport.fjorarstall = resrapport.belop  
    WHERE  qo7sn_regn_resrapport.regnskapsar = ar  AND qo7sn_regn_resrapport.periodenr=per;

END//
DELIMITER ;

-- Dumping structure for procedure test2.proc_gruppesum
DROP PROCEDURE IF EXISTS `proc_gruppesum`;
DELIMITER //
CREATE PROCEDURE `proc_gruppesum`(IN regnar INT,pernr INT)
BEGIN 

 DECLARE r_hittil INT  DEFAULT 0;
 DECLARE f INT  DEFAULT 0;
 DECLARE bu FLOAT  DEFAULT  0;
 DECLARE a INT  DEFAULT 0;
 DECLARE m_nr INT  DEFAULT 0;
 DECLARE aa INT  DEFAULT 0;
 DECLARE LAST1 INT  DEFAULT 0;
 DECLARE m_niva FLOAT  DEFAULT  0;
 DECLARE c FLOAT  DEFAULT  0;
 DECLARE m_tekst VARCHAR(30)  ;
 DECLARE r_niva FLOAT  DEFAULT  0;
 DECLARE r_nr FLOAT  DEFAULT  0;
 DECLARE r_tekst VARCHAR(30)  ;
 
 DECLARE e FLOAT  DEFAULT  0;
 DECLARE r_belop FLOAT  DEFAULT  0;
 DECLARE n1 FLOAT  DEFAULT  0;
 DECLARE n2 FLOAT  DEFAULT  0;
 DECLARE n3 FLOAT  DEFAULT  0;
 DECLARE n4 FLOAT  DEFAULT  0;
 DECLARE n5 FLOAT  DEFAULT  0;
 DECLARE n6 FLOAT  DEFAULT  0;
 
 DECLARE h1 FLOAT  DEFAULT  0;
 DECLARE h2 FLOAT  DEFAULT  0;
 DECLARE h3 FLOAT  DEFAULT  0;
 DECLARE h4 FLOAT  DEFAULT  0;
 DECLARE h5 FLOAT  DEFAULT  0;
 DECLARE h6 FLOAT  DEFAULT  0;
 
 DECLARE f1 FLOAT  DEFAULT  0;
 DECLARE f2 FLOAT  DEFAULT  0;
 DECLARE f3 FLOAT  DEFAULT  0;
 DECLARE f4 FLOAT  DEFAULT  0;
 DECLARE f5 FLOAT  DEFAULT  0;
 DECLARE f6 FLOAT  DEFAULT  0;

 DECLARE bu1 FLOAT  DEFAULT  0;
 DECLARE bu2 FLOAT  DEFAULT  0;
 DECLARE bu3 FLOAT  DEFAULT  0;
 DECLARE bu4 FLOAT  DEFAULT  0;
 DECLARE bu5 FLOAT  DEFAULT  0;
 DECLARE bu6 FLOAT  DEFAULT  0;

 SELECT   nr,BR  INTO LAST1,m_tekst FROM qo7sn_regn_resmal WHERE BR='R' ORDER BY nr DESC LIMIT 1;    -- lagrer sluttpunktet for resmal
-- SELECT   LAST1,m_tekst ;--  FROM qo7sn_regn_resmal  WHERE BR='R' ORDER BY nr  ;

  myloop:loop -- WHILE  a<100 DO
  -- select from resmal: 
  
 SELECT   niva,nr,tekst INTO m_niva,m_nr,m_tekst FROM qo7sn_regn_resmal   where nr = (select min(nr) from qo7sn_regn_resmal where nr > a)  ORDER BY nr LIMIT 1;   -- neste mallinje
 SET @ROW_COUNT1 = FOUND_ROWS();
 SELECT a,m_nr;
 SET a=m_nr;

-- select from resreappoart:
 SELECT niva, nr , tekst,belop,hittil,fjorarstall,budsjett  INTO r_niva,r_nr, r_tekst,r_belop,r_hittil,f,bu  FROM qo7sn_regn_resrapport WHERe regnskapsar=regnar AND periodenr=pernr and nr=m_nr ORDER BY nr LIMIT 1;    
-- SELECT niva, nr , tekst,belop,hittil,fjorarstall,budsjett    FROM qo7sn_regn_resrapport WHERe regnskapsar=regnar AND periodenr=pernr and nr=m_nr ORDER BY nr ;    
 SET @ROW_COUNT2 = FOUND_ROWS();
--  SELECT "1",a,m_niva,m_nr,m_tekst,e,@ROW_COUNT1,@ROW_COUNT2,r_niva,r_nr,r_tekst,regnar,pernr,r_belop,n2,n3,n4,n5;
-- SELECT "1",a,m_niva,m_nr,m_tekst,e,@ROW_COUNT1,@ROW_COUNT2,r_niva,r_nr,r_tekst,regnar,pernr,r_belop,n2,n3,n4,n5;

IF(bu IS NULL) THEN
        SET bu=0;END if;

-- SELECT a,b,bu,bu1,bu2,bu3,bu4,bu5;/*
if  @ROW_COUNT2>0  or m_niva>1 then
 
   SELECT 1, @ROW_COUNT2 ,r_niva,r_nr, r_tekst,r_belop,m_niva,m_nr,m_tekst,e,n2,n3,n4,n5;
   
   IF m_niva=1 THEN SET e=e+r_belop;SET h1=h1+r_hittil;SET f1=f1+f;SET bu1=bu1+bu;
   ELSEIF m_niva=2 then  SET n2=n2+e; SET r_belop=e;  SET e=0; 
                    SET h2=h2+h1; SET r_hittil=h1;  SET h1=0;  
                    SET f2=f2+f1; SET f=f1;  SET f1=0;  
                    SET bu2=bu2+bu1; SET bu=bu1;  SET bu1=0;  
   ELSEIF m_niva=3 then begin SET n3=n3+n2+e; SET r_belop=n2+e;SET n2=0;  SET e=0;  
                        	SET h3=h3+h2+h1; SET r_hittil=h2+h1;SET h2=0;  SET h1=0;  
                        	SET f3=f3+f2+f1; SET f=f2+f1;SET f2=0;  SET f1=0;  
                        	SET bu3=bu3+bu2+bu1; SET bu=bu2+bu1;SET bu2=0;  SET bu1=0;  	
	END; 
   ELSEIF m_niva=4 then begin SET n4=n4+n3+n2+e; SET r_belop=n3+e; SET n3=0; SET e=0;
                         SET h4=h4+h3+h2+h1; SET r_hittil=h3+h1; SET h3=0; SET h2=0; SET h1=0; 
                         SET f4=f4+f3+f2+f1; SET f=f3+f1; SET f3=0; SET f2=0; SET f1=0; 
                         SET bu4=bu4+bu3+bu2+bu1; SET bu=bu3+bu1; SET bu3=0; SET bu2=0; SET bu1=0; 
	END;
   ELSEIF m_niva=5 then begin SET n5=n5+n4+n3+n2+e; SET r_belop=n4+e; SET n4=0;SET e=0; 
                        SET h5=h5+h4+h3+h2+h1; SET r_hittil=h4+h1; SET h4=0; SET h3=0; SET h2=0; SET h1=0; 
                        SET f5=f5+f4+f3+f2+f1; SET f=f4+f1; SET f4=0; SET f3=0; SET f2=0; SET f1=0; 
                        SET bu5=bu5+bu4+bu3+bu2+bu1; SET bu=bu4+bu1; SET bu4=0; SET bu3=0; SET bu2=0; SET bu1=0; 
	END;
end if;
-- SELECT "Etter: ",a,b,bu,bu1,bu2,bu3,bu4,bu5;
-- SELECT "2",a,m_niva,m_nr,m_tekst,e,@ROW_COUNT1,@ROW_COUNT2,d1,regnar,pernr,r_belop,n2,n3,n4,n5;
-- SELECT "2",a,m_niva,m_nr,m_tekst,e,@ROW_COUNT1,@ROW_COUNT2,d1,regnar,pernr,r_belop,n2,n3,n4,n5;
SELECT 2,r_niva,r_nr, r_tekst,r_belop,m_niva,m_nr,m_tekst,e,n2,n3,n4,n5,c;
 
-- if  @ROW_COUNT2=0  and r_belop>0 then
if m_nr>1 then
if m_niva=2 then set r_belop=n2;SET e=0;
ELSEif  m_niva=3 then set r_belop=n3; SET n2=0;
ELSEif  m_niva=4 then set r_belop=n4;SET n3=0;
ELSEif  m_niva=5 then set r_belop=n5;SET n4=0;
END if;
END if;

SELECT 3,@ROW_COUNT2,r_niva,r_nr, r_tekst,r_belop,m_niva,m_nr,m_tekst,e,n2,n3,n4,n5,c;

if ((m_niva>1) AND (r_belop!=0)) then 
if @ROW_COUNT2=0  then
INSERT INTO qo7sn_regn_resrapport (nr,niva,tekst,belop,regnskapsar,ar,periodenr,hittil,fjorarstall,budsjett,konfig) VALUES (m_nr,m_niva,m_tekst,r_belop,regnar,regnar,pernr,r_hittil,f,bu,NOW()) ;
ELSE
 UPDATE qo7sn_regn_resrapport set belop=r_belop,hittil=r_hittil,fjorarstall=f,budsjett=bu, konfig=NOW() WHERE  nr=m_nr AND regnskapsar=regnar AND periodenr=pernr;
END if;
END if;
END if;

-- if @ROW_COUNT1=0 then LEAVE myloop;end if;
if a=LAST1 then LEAVE myloop;end if;
-- END while myloop ;
END loop myloop ;

UPDATE qo7sn_regn_resrapport  SET Periode=
case 
when periodenr=1 then "Januar" 
when periodenr=2 then "Februar"
when periodenr=3 then "Mars" 
when periodenr=4 then "April" 
when periodenr=5 then "Mai" 
when periodenr=6 then "Juni" 
when periodenr=7 then "Juli" 
when periodenr=8 then "August" 
when periodenr=9 then "September" 
when periodenr=10 then "Oktober" 
when periodenr=11 then "November" 
when periodenr=12 then "Desember" 
END;

END//
DELIMITER ;

-- Dumping structure for procedure test2.proc_gruppesum2
DROP PROCEDURE IF EXISTS `proc_gruppesum2`;
DELIMITER //
CREATE PROCEDURE `proc_gruppesum2`(IN regnar INT,pernr INT)
BEGIN 

 DECLARE a INT  DEFAULT 0;
 DECLARE b INT  DEFAULT 0;
 DECLARE nr1 INT  DEFAULT 0;
 DECLARE nr_mal INT  DEFAULT 0;
 DECLARE m_nr INT  DEFAULT 0;
 
 DECLARE gg  INT  DEFAULT 12;
 DECLARE h   INT  DEFAULT 0;
 DECLARE f   INT  DEFAULT 0;
 DECLARE bu  FLOAT  DEFAULT  0;
 DECLARE m_niva INT  DEFAULT 0;
 DECLARE aa  INT  DEFAULT 0;
 DECLARE LAST1 INT  DEFAULT 0;

 DECLARE d  VARCHAR(30)  ;
 DECLARE n_niva FLOAT  DEFAULT  0;
 DECLARE n_nr FLOAT  DEFAULT  0;
 DECLARE n_tekst VARCHAR(30)  ;
 DECLARE m_tekst VARCHAR(30)  ;
 DECLARE e  FLOAT  DEFAULT  0;
 DECLARE n_belop FLOAT  DEFAULT  0;
 DECLARE n1 FLOAT  DEFAULT  0;
 DECLARE n2 FLOAT  DEFAULT  0;
 DECLARE n3 FLOAT  DEFAULT  0;
 DECLARE n4 FLOAT  DEFAULT  0;
 DECLARE n5 FLOAT  DEFAULT  0;
 DECLARE n6 FLOAT  DEFAULT  0;
 
 DECLARE h1 FLOAT  DEFAULT  0;
 DECLARE h2 FLOAT  DEFAULT  0;
 DECLARE h3 FLOAT  DEFAULT  0;
 DECLARE h4 FLOAT  DEFAULT  0;
 DECLARE h5 FLOAT  DEFAULT  0;
 DECLARE h6 FLOAT  DEFAULT  0;
 
 DECLARE f1 FLOAT  DEFAULT  0;
 DECLARE f2 FLOAT  DEFAULT  0;
 DECLARE f3 FLOAT  DEFAULT  0;
 DECLARE f4 FLOAT  DEFAULT  0;
 DECLARE f5 FLOAT  DEFAULT  0;
 DECLARE f6 FLOAT  DEFAULT  0;

 DECLARE bu1 FLOAT  DEFAULT  0;
 DECLARE bu2 FLOAT  DEFAULT  0;
 DECLARE bu3 FLOAT  DEFAULT  0;
 DECLARE bu4 FLOAT  DEFAULT  0;
 DECLARE bu5 FLOAT  DEFAULT  0;
 DECLARE bu6 FLOAT  DEFAULT  0;

 SELECT nr INTO LAST1  FROM qo7sn_regn_resrapport where  regnskapsar=regnar AND periodenr=pernr  ORDER BY nr DESC LIMIT 1;
  
 
tt: loop
SELECT   nr INTO n_nr  FROM qo7sn_regn_resrapport WHERE nr = (select min(nr) from qo7sn_regn_resrapport where nr > nr1 AND regnskapsar=regnar AND periodenr=pernr ) AND  regnskapsar=regnar AND periodenr=pernr ORDER BY nr  ;    
SET nr1=n_nr;



if (nr1>nr_mal) then
SELECT  nr INTO m_nr  from qo7sn_regn_resmal   WHERE niva>1   AND nr = (select min(nr) from qo7sn_regn_resmal where nr > nr_mal and niva>1) ORDER BY nr ;
SET nr_mal=m_nr;
END if;

SELECT nr,niva,tekst INTO m_nr,m_niva,m_tekst FROM qo7sn_regn_resmal   WHERE   nr=nr_mal LIMIT 1; 
SELECT nr,niva,tekst,belop,hittil,fjorarstall,budsjett  INTO n_nr,n_niva, n_tekst,n_belop,h,f,bu  FROM qo7sn_regn_resrapport WHERe regnskapsar=regnar AND periodenr=pernr and nr=nr1 ORDER BY nr;    



 	 


IF(bu IS NULL) THEN
        SET bu=0;END if;







iF  n_niva=1 THEN SET e=e+n_belop;SET n1=n1+n_belop;SET h1=h1+h;SET f1=f1+f;SET bu1=bu1+bu;

ELSEIF n_niva=2 then    SET n_belop=0; SET n2=n2+n1;    SET n1=0;
                      SET h2=h2+h1; SET h=h1;  SET h1=0;  
                      SET f2=f2+f1; SET f=f1;  SET f1=0;  
                      SET bu2=bu2+bu1; SET bu=bu1;  SET bu1=0;  
                   



ELSEIF n_niva=3 then begin SET n3=n3+n2+n1;  SET e=n2+n1;SET n2=0; SET n1=0; 
                        	SET h3=h3+h2+h1; SET h=h2+h1;SET h2=0;  SET h1=0;  
                        	SET f3=f3+f2+f1; SET f=f2+f1;SET f2=0;  SET f1=0;  
                        	SET bu3=bu3+bu2+bu1; SET bu=bu2+bu1;SET bu2=0;  SET bu1=0;  

		
	END; 
ELSEIF n_niva=4 then begin SET n4=n4+n3+n2+n1; SET e=n3+n2+n1; SET n3=0; SET n2=0; SET n1=0; 
                         SET h4=h4+h3+h2+h1; SET h=h3+h2+h1; SET h3=0; SET h2=0; SET h1=0; 
                         SET f4=f4+f3+f2+f1; SET f=f3+f2+f1; SET f3=0; SET f2=0; SET f1=0; 
                         SET bu4=bu4+bu3+bu2+bu1; SET bu=bu3+bu2+bu1; SET bu3=0; SET bu2=0; SET bu1=0; 
                  
	END;
ELSEIF n_niva=5 then begin SET n5=n5+n4+n3+n2+n1;  SET e=n4+n3+n2+n1;SET n4=0;SET n3=0;SET n2=0;SET n1=0;  
                        SET h5=h5+h4+h3+h2+h1; SET h=h4+h3+h2+h1; SET h4=0; SET h3=0; SET h2=0; SET h1=0; 
                        SET f5=f5+f4+f3+f2+f1; SET f=f4+f3+f3+f1; SET f4=0; SET f3=0; SET f2=0; SET f1=0; 
                        SET bu5=bu5+bu4+bu3+bu2+bu1; SET bu=bu4+bu3+bu2+bu1; SET bu4=0; SET bu3=0; SET bu2=0; SET bu1=0; 
                 
END; 

END if;


 



 
if (n_niva>1) then
BEGIN
 SET n_belop=0;
SELECT COUNT(*) INTO @ROW_COUNT1 FROM  qo7sn_regn_resrapport WHERE  nr=n_nr AND regnskapsar=regnar AND periodenr=pernr;

if @ROW_COUNT1=0 then 
INSERT INTO qo7sn_regn_resrapport (nr,niva,tekst,belop,regnskapsar,periodenr,hittil,fjorarstall,budsjett) VALUES (n_nr) ;
ELSE
begin
UPDATE qo7sn_regn_resrapport set belop=e,hittil=h,fjorarstall=f,budsjett=bu WHERE  nr=n_nr AND regnskapsar=regnar AND periodenr=pernr;

END;

end if;

END;
SET e=0;
END if;








if  n_nr>=LAST1 then  leave  tt; END if; 
END loop; 


 END//
DELIMITER ;

-- Dumping structure for procedure test2.proc_hittil1
DROP PROCEDURE IF EXISTS `proc_hittil1`;
DELIMITER //
CREATE PROCEDURE `proc_hittil1`(IN regnar INT,pernr INT )
BEGIN 
   DECLARE pr INT DEFAULT 0;    
   DECLARE b INT DEFAULT 0;    
   DECLARE a INT DEFAULT 1 ;   
   DECLARE c INT DEFAULT 0 ;   
   DECLARE belp FLOAT  DEFAULT 0 ;   
   DECLARE LAST1 INT DEFAULT 0 ;  

 SELECT   nr INTO LAST1  FROM qo7sn_regn_resrapport where regnskapsar=regnar and periodenr=pernr  ORDER BY nr DESC LIMIT 1;
 
rapportlinje: loop   

SELECT nr INTO b  FROM qo7sn_regn_resrapport  WHERE regnskapsar=regnar and periodenr=pernr AND  nr > pr order by nr limit 1; 
 
 SET pr=b;

     SELECT SUM(belop) into belp FROM qo7sn_regn_resrapport WHERE  periodenr<=pernr AND nr=b AND regnskapsar=regnar;
     UPDATE qo7sn_regn_resrapport SET hittil=belp WHERE periodenr=pernr  AND nr=b  AND regnskapsar=regnar ;
     SET a=a+1;



   if  b=LAST1 then leave rapportlinje ;END if;
   END LOOP rapportlinje;
   
   
   
END//
DELIMITER ;

-- Dumping structure for procedure test2.proc_oppdater_trans1
DROP PROCEDURE IF EXISTS `proc_oppdater_trans1`;
DELIMITER //
CREATE PROCEDURE `proc_oppdater_trans1`()
BEGIN
 DECLARE a INT   DEFAULT  0;
 DECLARE c INT   DEFAULT  0;
 DECLARE LAST1 INT   DEFAULT  0;
 DECLARE ar2 INT   DEFAULT  0;
 DECLARE dat1 DATE    DEFAULT  0;
DECLARE bel1 FLOAT     DEFAULT  0;
DECLARE deb1 VARCHAR (50)     DEFAULT  "";
DECLARE kred1 VARCHAR (50)     DEFAULT  "";

SELECT  Ref INTO LAST1 FROM qo7sn_regn_trans  ORDER BY Ref DESC LIMIT 1;  -- lagrer siste post

  myloop:loop -- WHILE  a<100 DO
  -- select from resmal: 
  
 SELECT  Ref,Dato,debet,kredit,belop INTO c,dat1,deb1,kred1,bel1 FROM qo7sn_regn_trans   where Ref = (select min(Ref) from qo7sn_regn_resmal where Ref > a)  ORDER BY Ref LIMIT 1;
 SET @ROW_COUNT1 = FOUND_ROWS();
 SET a=c;
SELECT @ROW_COUNT1,c,dat1,deb1,kred1,bel1;
 
 if (@ROW_COUNT1=1) then  -- funnet linje i trans

 SELECT * FROM qo7sn_regn_saldo WHERE ar=YEAR(dat1) AND periode=MONTH(dat1) AND kto=deb1;
 if ( FOUND_ROWS()=0) then
  INSERT INTO qo7sn_regn_saldo (ar,periode,kto,belop)  VALUE (YEAR(dat1),MONTH(dat1),deb1,bel1);
    ELSE 
 UPDATE qo7sn_regn_saldo set belop=belop+bel1 WHERE  ar=YEAR(dat1) and periode=MONTH(dat1) and kto=deb1;
  END if;
  
SELECT * FROM qo7sn_regn_saldo WHERE ar=YEAR(dat1) AND periode=MONTH(dat1) AND kto=kred1;
 if ( FOUND_ROWS()=0) then
  INSERT INTO qo7sn_regn_saldo (ar,periode,kto,belop)  VALUE (YEAR(dat1),MONTH(dat1),kred1,-bel1);
    ELSE 
 UPDATE qo7sn_regn_saldo set belop=belop-bel1 WHERE  ar=YEAR(dat1) and periode=MONTH(dat1)and kto=kred1;
  END if;
 END if;
  
  if a=LAST1 then LEAVE myloop;end if;
END loop myloop ;

INSERT INTO qo7sn_regn_hist (ref,Dato,debet, kredit,belop,Tekst,Buntnr,Regdato,Bilag,Bilagsart,Periode)
		SELECT Ref,Dato,debet, kredit,belop,Tekst,Buntnr,Regdato,bilag,Bilagsart,periode
		FROM qo7sn_regn_trans;

TRUNCATE qo7sn_regn_trans;		
		
		
 END//
DELIMITER ;

-- Dumping structure for function test2.proc_periode
DROP FUNCTION IF EXISTS `proc_periode`;
DELIMITER //
CREATE FUNCTION `proc_periode`(periodenr int) RETURNS varchar(20) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
    DETERMINISTIC
BEGIN
  DECLARE Periode1 VARCHAR(50) ; 
-- SET Periode1="hhh";

 SET Periode1=
case 
when periodenr=1 then "Januar" 
when periodenr=2 then "Februar"
when periodenr=3 then "Mars" 
when periodenr=4 then "April" 
when periodenr=5 then "Mai" 
when periodenr=6 then "Juni" 
when periodenr=7 then "Juli" 
when periodenr=8 then "August" 
when periodenr=9 then "September" 
when periodenr=10 then "Oktober" 
when periodenr=11 then "November" 
when periodenr=12 then "Desember" 
END;

RETURN Periode1;
END//
DELIMITER ;

-- Dumping structure for procedure test2.proc_resrapport
DROP PROCEDURE IF EXISTS `proc_resrapport`;
DELIMITER //
CREATE PROCEDURE `proc_resrapport`(IN ar1 INT ,per int)
BEGIN 
 DECLARE siste INT   DEFAULT  0;
 DECLARE nnr INT   DEFAULT  0;
 DECLARE pr INT   DEFAULT  0; 
 DECLARE nrb VARCHAR (1)   DEFAULT  '';
 DECLARE periode1 VARCHAR (20)   DEFAULT  '';
 DECLARE nlinje INT   DEFAULT  0;
 DECLARE a INT   DEFAULT  0;
 DECLARE b INT   DEFAULT  0;
 DECLARE ar2 INT   DEFAULT  0; 
 DECLARE per2 INT   DEFAULT  0; 
 DECLARE nkontoer VARCHAR (100)   DEFAULT  ''; 	



DELETE FROM  qo7sn_regn_resrapport WHERE regnskapsar=ar1  AND periodenr= per;  -- slett aktuell periode og ar

 SELECT ar,periode INTO ar2,per2 FROM qo7sn_regn_saldo WHERE ar=ar1 AND periode=per LIMIT 1;   -- sjekk om saldoliste eksisterer
  if  FOUND_ROWS()=0 then
 CALL proc_saldo2(ar1,per);
 END if;

-- CALL proc_fjorarstall(ar1,per);
-- CALL proc_hittil1(ar1,per); 



INSERT INTO qo7sn_regn_resrapport  (nr,niva,tekst,belop,budsjett,fjorarstall,hittil ,avvik_fjorar,avvik_hittil,avvik_budsjett,prosent_fjorar,ar,regnskapsar,periodenr,periode,kontoer,konfig)
SELECT m.nr,m.niva,m.tekst,sum(s.belop),SUM(s.budsjett) ,SUM(s.fjorar),s.hittil ,s.belop-s.fjorar,s.belop-s.hittil,s.belop-s.budsjett,FORMAT((s.belop-s.fjorar)*100/s.belop,2),s.ar,s.ar,s.periode ,proc_periode(s.periode),CONCAT('[', s.kto, ']') ,NOW()       -- ('[', s.kto, ']'),NOW()
FROM qo7sn_regn_resmal m
INNER JOIN qo7sn_regn_kto k on m.nr= k.rapportlinje AND k.ResBal='R'
INNER JOIN qo7sn_regn_saldo s ON s.kto=k.Ktonr
WHERE s.ar=ar1 AND s.periode=per AND m.BR='R'
GROUP BY k.rapportlinje;
call proc_gruppesum(ar1,per);

SELECT Ktonr INTO siste  FROM qo7sn_regn_kto ORDER BY Ktonr DESC LIMIT 1;

 myloop: loop
  SELECT  Ktonr,ResBal,rapportlinje INTO nnr,nrb,nlinje  FROM qo7sn_regn_kto WHERE Ktonr = (select min(Ktonr) from qo7sn_regn_resmal where Ktonr > pr) LIMIT 1;
 SET pr=nnr;

if nrb="R" then
SELECT s.kto,k.rapportlinje  FROM  qo7sn_regn_saldo  s
INNER JOIN  qo7sn_regn_kto k  ON k.Ktonr=s.kto
WHERE s.ar=ar1 AND s.periode= per  AND k.ResBal='R' AND  k.rapportlinje=nlinje;  
SET @r= FOUND_ROWS();
-- SELECT @r;

if @r>1 then

-- SELECT nnr,@r;
SELECT kontoer INTO nkontoer FROM qo7sn_regn_resrapport WHERE regnskapsar=ar1 AND periodenr=per AND nr=nlinje;
-- select JSON_CONTAINS(JSON_EXTRACT(nkontoer , '$'),nnr,'$'),nlinje,nnr ;
 if JSON_CONTAINS(JSON_EXTRACT(nkontoer , '$'),nnr,'$')=0 then 
 UPDATE qo7sn_regn_resrapport SET kontoer=JSON_ARRAY_INSERT(kontoer, "$[0]", nnr) WHERE regnskapsar=ar1 AND periodenr=per AND nr=nlinje;
END if;
END if;
END if ;
-- END if;

if pr>=siste then LEAVE myloop;end if;
END loop  ;


END//
DELIMITER ;

-- Dumping structure for procedure test2.proc_resrapport4
DROP PROCEDURE IF EXISTS `proc_resrapport4`;
DELIMITER //
CREATE PROCEDURE `proc_resrapport4`(IN ar1 INT ,per int)
BEGIN 
 DECLARE rar INT   DEFAULT  0;
 DECLARE nnr INT   DEFAULT  0;
 DECLARE nperiodenr INT   DEFAULT  0;
 DECLARE nrar INT   DEFAULT  0;
 DECLARE SUM1 float   DEFAULT  0;
 

DELETE FROM qo7sn_regn_resrapport WHERE regnskapsar=ar1 AND periodenr=per;


 


INSERT INTO qo7sn_regn_resrapport   (periodenr,regnskapsar,nr, tekst,niva,belop,kontoer) 
SELECT qo7sn_regn_saldo.periode,qo7sn_regn_saldo.ar,qo7sn_regn_resmal.nr, qo7sn_regn_resmal.tekst,qo7sn_regn_resmal.niva,sum(qo7sn_regn_saldo.belop),qo7sn_regn_kto.Ktonr from qo7sn_regn_saldo
inner JOIN  qo7sn_regn_resmal,qo7sn_regn_kto 
WHERE   qo7sn_regn_kto.rapportlinje=qo7sn_regn_resmal.nr  AND qo7sn_regn_saldo.resbal='R' AND  qo7sn_regn_resmal.BR='R' and qo7sn_regn_saldo.ar=ar1 AND qo7sn_regn_kto.Ktonr=qo7sn_regn_saldo.kto 
GROUP BY qo7sn_regn_saldo.ar, qo7sn_regn_resmal.nr;














UPDATE qo7sn_regn_resrapport  SET Periode=
case 
when periodenr=1 then "Januar" 
when periodenr=2 then "Februar"
when periodenr=3 then "Mars" 
when periodenr=4 then "April" 
when periodenr=5 then "Mai" 
when periodenr=6 then "Juni" 
when periodenr=7 then "Juli" 
when periodenr=8 then "August" 
when periodenr=9 then "September" 
when periodenr=10 then "Oktober" 
when periodenr=11 then "November" 
when periodenr=12 then "Desember" 
END;
 END//
DELIMITER ;

-- Dumping structure for procedure test2.proc_resrapport5
DROP PROCEDURE IF EXISTS `proc_resrapport5`;
DELIMITER //
CREATE PROCEDURE `proc_resrapport5`(IN ar1 INT ,per int)
BEGIN 
 DECLARE nnr INT   DEFAULT  0;
 DECLARE pr INT   DEFAULT  0; 
 DECLARE siste INT   DEFAULT  0;
 DECLARE nperiodenr INT   DEFAULT  0;
 DECLARE ar INT   DEFAULT  0;
 DECLARE ar2 INT   DEFAULT  0;
 DECLARE per2 INT   DEFAULT  0;
 DECLARE nlinje INT   DEFAULT  0;
 DECLARE n1nr INT   DEFAULT  0;
 DECLARE SUM1 float   DEFAULT  0;
 DECLARE nbelop float   DEFAULT  0;
 DECLARE nrb VARCHAR (1)   DEFAULT  '';
 DECLARE nkontoer VARCHAR (100)   DEFAULT  '';
 
 SELECT ar,periode INTO ar2,per2 FROM qo7sn_regn_saldo WHERE ar=ar1 AND periode=per;
  if  FOUND_ROWS()=0 then
 CALL proc_saldo3(ar1,per);
 END if;

DELETE FROM  qo7sn_regn_resrapport WHERE ar=ar1  AND periodenr= per;





END//
DELIMITER ;

-- Dumping structure for procedure test2.proc_saldo2
DROP PROCEDURE IF EXISTS `proc_saldo2`;
DELIMITER //
CREATE PROCEDURE `proc_saldo2`(IN ar1 INT, periodenr int )
BEGIN 

 DECLARE a FLOAT  DEFAULT  0;
 DECLARE b FLOAT  DEFAULT  0;
 DECLARE c FLOAT  DEFAULT  0;
 DECLARE d FLOAT  DEFAULT  0;
 DECLARE e FLOAT  DEFAULT  0;
 DECLARE f FLOAT  DEFAULT  0;
 DECLARE g FLOAT  DEFAULT  0;
 DECLARE h FLOAT  DEFAULT  0;
 DECLARE kto1 INT   DEFAULT  0;
 DECLARE kto2 INT   DEFAULT  0;
 DECLARE pr INT   DEFAULT  0;
 DECLARE siste int  DEFAULT 0;

 DECLARE Periode1 VARCHAR(49) ;
 DECLARE resbal1 VARCHAR(10) ;
 
DELETE FROM  qo7sn_regn_saldo WHERE ar=ar1  AND periode= periodenr;

 SELECT Ktonr INTO siste FROM qo7sn_regn_kto ORDER BY Ktonr DESC LIMIT 1;
 SELECT "siste ",siste;
 
 tt: loop 
 
SELECT  Ktonr,ResBal INTO kto1,resbal1  FROM qo7sn_regn_kto WHERE Ktonr = (select min(Ktonr) from qo7sn_regn_kto where Ktonr > pr);


SET pr=kto1;






SET Periode1=
case 
when periodenr=1 then "Januar" 
when periodenr=2 then "Februar"
when periodenr=3 then "Mars" 
when periodenr=4 then "April" 
when periodenr=5 then "Mai" 
when periodenr=6 then "Juni" 
when periodenr=7 then "Juli" 
when periodenr=8 then "August" 
when periodenr=9 then "September" 
when periodenr=10 then "Oktober" 
when periodenr=11 then "November" 
when periodenr=12 then "Desember" 
END;





SELECT SUM(belop) INTO a FROM qo7sn_regn_hist WHERE  Regnskapsar=ar1 AND Periode=Periode1 AND  debet=kto1;
SELECT SUM(belop) INTO b  FROM qo7sn_regn_hist WHERE  Regnskapsar=ar1 AND Periode=Periode1 AND  kredit=kto1;
SELECT SUM(belop) INTO c FROM qo7sn_regn_hist WHERE  Regnskapsar=ar1-1 AND Periode=Periode1 AND  debet=kto1;
SELECT SUM(belop) INTO d FROM qo7sn_regn_hist WHERE  Regnskapsar=ar1-1 AND Periode=Periode1 AND  kredit=kto1;
SELECT SUM(belop) INTO e FROM qo7sn_regn_hist WHERE  Regnskapsar=ar1 AND  DATE_FORMAT(Dato, "%m" )<=periodenr AND  debet=kto1;
SELECT SUM(belop) INTO f FROM qo7sn_regn_hist WHERE  Regnskapsar=ar1 AND  DATE_FORMAT(Dato, "%m" )<=periodenr AND  kredit=kto1;
SELECT SUM(belop) INTO g FROM qo7sn_regn_hist WHERE  Regnskapsar=ar1-1 AND  DATE_FORMAT(Dato, "%m" )<=periodenr AND  debet=kto1;
SELECT SUM(belop) INTO h FROM qo7sn_regn_hist WHERE  Regnskapsar=ar1-1 AND  DATE_FORMAT(Dato, "%m" )<=periodenr AND  kredit=kto1;
if (a IS NULL) then set a=0; END if;
if (b IS NULL) then set b=0; END if;
if (c IS NULL) then set c=0; END if;
if (d IS NULL) then set d=0; END if;
if (e IS NULL) then set e=0; END if;
if (f IS NULL) then set f=0; END if;
if (g IS NULL) then set e=0; END if;
if (h IS NULL) then set f=0; END if;



SELECT kto INTO kto2 FROM qo7sn_regn_saldo WHERE  periode=periodenr AND kto=kto1 AND   ar=ar1;   
 SET @ROW_COUNT2 = FOUND_ROWS();

 if (a-b<>0) then 
 if (@ROW_COUNT2=0) then
BEGIN

INSERT INTO qo7sn_regn_saldo (ar,periode,kto,belop,fjorar,fjorar_hittil,hittil,resbal,konfig) VALUE (ar1, periodenr,kto1,a-b,c-d,e-f,g-h,resbal1, NOW());           


END;
ELSE
BEGIN

UPDATE qo7sn_regn_saldo SET belop=belop+a-b,fjorarstall=fjorarstall+c-d,resbal=resbal1 WHERE  periode=periodenr AND kto=kto1 AND   ar=ar1;  
SELECT 'update';
END;
END if; 
END if;


if  kto1>=siste then  leave  tt; END if; 
END loop; 

 END//
DELIMITER ;

-- Dumping structure for procedure test2.proc_saldo3
DROP PROCEDURE IF EXISTS `proc_saldo3`;
DELIMITER //
CREATE PROCEDURE `proc_saldo3`(IN ar1 INT,periodenr INT )
BEGIN 

 DECLARE a FLOAT  DEFAULT  0;
 DECLARE b FLOAT  DEFAULT  0;
DECLARE kto1 INT   DEFAULT  0;
DECLARE kto2 INT   DEFAULT  0;
DECLARE pr INT   DEFAULT  0;
 DECLARE siste int  DEFAULT 0;

DECLARE Periode1 VARCHAR(49) ;
DECLARE resbal1 VARCHAR(10) ;

 SELECT Ktonr INTO siste FROM qo7sn_regn_kto ORDER BY Ktonr DESC LIMIT 1;
 SELECT "siste ",siste;
 
 tt: loop 
 
SELECT  Ktonr,ResBal INTO kto1,resbal1  FROM qo7sn_regn_kto WHERE Ktonr = (select min(Ktonr) from qo7sn_regn_kto where Ktonr > pr);


SET pr=kto1;






SET Periode1=
case 
when periodenr=1 then "Januar" 
when periodenr=2 then "Februar"
when periodenr=3 then "Mars" 
when periodenr=4 then "April" 
when periodenr=5 then "Mai" 
when periodenr=6 then "Juni" 
when periodenr=7 then "Juli" 
when periodenr=8 then "August" 
when periodenr=9 then "September" 
when periodenr=10 then "Oktober" 
when periodenr=11 then "November" 
when periodenr=12 then "Desember" 
END;




SELECT SUM(belop) INTO a FROM qo7sn_regn_hist WHERE  Regnskapsar=ar1 AND Periode=Periode1 AND  debet=kto1;
SELECT SUM(belop) INTO b  FROM qo7sn_regn_hist WHERE  Regnskapsar=ar1 AND Periode=Periode1 AND  kredit=kto1;
if (a IS NULL) then set a=0; END if;
if (b IS NULL) then set b=0; END if;

SELECT kto INTO kto2 FROM qo7sn_regn_saldo WHERE  periode=periodenr AND kto=kto1 AND   ar=ar1;   
 SET @ROW_COUNT2 = FOUND_ROWS();

 if (a-b<>0) then 
 if (@ROW_COUNT2=0) then
 begin
INSERT INTO qo7sn_regn_saldo (ar,periode,kto,belop,resbal,konfig) VALUE (ar1, periodenr,kto1,a-b,resbal1,JSON_SET(konfig, '$.oppdatert', NOW()));

END;
ELSE
BEGIN

UPDATE qo7sn_regn_saldo SET belop=a-b,resbal=resbal1, konfig=JSON_SET(konfig, '$.oppdatert', NOW()) WHERE  periode=periodenr AND kto=kto1 AND   ar=ar1;  

END;
END if; 
END if;








SET pr=kto1;

if  kto1>=siste then  leave  tt; END if; 
END loop; 

 END//
DELIMITER ;

-- Dumping structure for procedure test2.proc_saldoliste
DROP PROCEDURE IF EXISTS `proc_saldoliste`;
DELIMITER //
CREATE PROCEDURE `proc_saldoliste`(IN regnar INT)
BEGIN 



 DECLARE a1 FLOAT  DEFAULT 0;
 DECLARE a2 FLOAT  DEFAULT 0;
 DECLARE a3 FLOAT  DEFAULT 0;
 DECLARE a4 FLOAT  DEFAULT 0;
 DECLARE a5 FLOAT  DEFAULT 0;
 DECLARE a6 FLOAT  DEFAULT 0;
 DECLARE a7 FLOAT  DEFAULT 0;
 DECLARE a8 FLOAT  DEFAULT 0;
 DECLARE a9 FLOAT  DEFAULT 0;
 DECLARE a10 FLOAT  DEFAULT 0;
 DECLARE a11 FLOAT  DEFAULT 0;
 DECLARE a12 FLOAT  DEFAULT 0;
 
  DECLARE b1 FLOAT  DEFAULT 0;
 DECLARE b2 FLOAT  DEFAULT 0;
 DECLARE b3 FLOAT  DEFAULT 0;
 DECLARE b4 FLOAT  DEFAULT 0;
 DECLARE b5 FLOAT  DEFAULT 0;
 DECLARE b6 FLOAT  DEFAULT 0;
 DECLARE b7 FLOAT  DEFAULT 0;
 DECLARE b8 FLOAT  DEFAULT 0;
 DECLARE b9 FLOAT  DEFAULT 0;
 DECLARE b10 FLOAT  DEFAULT 0;
 DECLARE b11 FLOAT  DEFAULT 0;
 DECLARE b12 FLOAT  DEFAULT 0;
 
 DECLARE a FLOAT  DEFAULT 0;
 DECLARE k FLOAT  DEFAULT 0;

DECLARE kto1 int  DEFAULT 0;
DECLARE siste int  DEFAULT 0;
DECLARE pr int  DEFAULT 0;

SELECT Ktonr INTO siste  FROM qo7sn_regn_kto ORDER BY Ktonr DESC LIMIT 1;

tt: loop 

SELECT  Ktonr INTO kto1  FROM qo7sn_regn_kto WHERE Ktonr = (select min(Ktonr) from qo7sn_regn_kto where Ktonr > pr);
SET pr=kto1;


 SELECT sum(belop) INTO a1 FROM qo7sn_regn_hist WHERE regnskapsar=regnar AND periode="Januar" AND debet=kto1 ;
 SELECT sum(belop) INTO a2 FROM qo7sn_regn_hist WHERE regnskapsar=regnar AND periode="Februar" AND debet=kto1;
 SELECT sum(belop) INTO a3 FROM qo7sn_regn_hist WHERE regnskapsar=regnar AND periode="Mars" AND debet=kto1;
 SELECT sum(belop) INTO a4 FROM qo7sn_regn_hist WHERE regnskapsar=regnar AND periode="April" AND debet=kto1;
 SELECT sum(belop) INTO a5 FROM qo7sn_regn_hist WHERE regnskapsar=regnar AND periode="Mai" AND debet=kto1;
 SELECT sum(belop) INTO a6 FROM qo7sn_regn_hist WHERE regnskapsar=regnar AND periode="Juni" AND debet=kto1;
 SELECT sum(belop) INTO a7 FROM qo7sn_regn_hist WHERE regnskapsar=regnar AND periode="Juli" AND debet=kto1 ;
 SELECT sum(belop) INTO a8 FROM qo7sn_regn_hist WHERE regnskapsar=regnar AND periode="August" AND debet=kto1;
 SELECT sum(belop) INTO a9 FROM qo7sn_regn_hist WHERE regnskapsar=regnar AND periode="September" AND debet=kto1;
 SELECT sum(belop) INTO a10 FROM qo7sn_regn_hist WHERE regnskapsar=regnar AND periode="Oktober" AND debet=kto1;
 SELECT sum(belop) INTO a11 FROM qo7sn_regn_hist WHERE regnskapsar=regnar AND periode="November" AND debet=kto1;
 SELECT sum(belop) INTO a12 FROM qo7sn_regn_hist WHERE regnskapsar=regnar AND periode="Desember" AND debet=kto1;
 
  SELECT sum(belop) INTO b1 FROM qo7sn_regn_hist WHERE regnskapsar=regnar AND periode="Januar" AND kredit=kto1 ;
 SELECT sum(belop) INTO b2 FROM qo7sn_regn_hist WHERE regnskapsar=regnar AND periode="Februar" AND kredit=kto1;
 SELECT sum(belop) INTO b3 FROM qo7sn_regn_hist WHERE regnskapsar=regnar AND periode="Mars" AND kredit=kto1;
 SELECT sum(belop) INTO b4 FROM qo7sn_regn_hist WHERE regnskapsar=regnar AND periode="April" AND kredit=kto1;
 SELECT sum(belop) INTO b5 FROM qo7sn_regn_hist WHERE regnskapsar=regnar AND periode="Mai" AND kredit=kto1;
 SELECT sum(belop) INTO b6 FROM qo7sn_regn_hist WHERE regnskapsar=regnar AND periode="Juni" AND kredit=kto1;
 SELECT sum(belop) INTO b7 FROM qo7sn_regn_hist WHERE regnskapsar=regnar AND periode="Juli" AND kredit=kto1 ;
 SELECT sum(belop) INTO b8 FROM qo7sn_regn_hist WHERE regnskapsar=regnar AND periode="August" AND kredit=kto1;
 SELECT sum(belop) INTO b9 FROM qo7sn_regn_hist WHERE regnskapsar=regnar AND periode="September" AND kredit=kto1;
 SELECT sum(belop) INTO b10 FROM qo7sn_regn_hist WHERE regnskapsar=regnar AND periode="Oktober" AND kredit=kto1;
 SELECT sum(belop) INTO b11 FROM qo7sn_regn_hist WHERE regnskapsar=regnar AND periode="November" AND kredit=kto1;
 SELECT sum(belop) INTO b12 FROM qo7sn_regn_hist WHERE regnskapsar=regnar AND periode="Desember" AND kredit=kto1;
 
if (a1 IS NULL) then set  a1=0; END if;
if (a2 IS NULL) then SET  a2=0; END if;
if (a3 IS NULL) then set  a3=0; END if;
if (a4 IS NULL) then set  a4=0; END if;
if (a5 IS NULL) then SET  a5=0; END if;
if (a6 IS NULL) then set  a6=0; END if;
if (a7 IS NULL) then SET  a7=0; END if;
if (a8 IS NULL) then SET  a8=0; END if;
if (a9 IS NULL) then SET  a9=0; END if;
if (a10 IS NULL) then set  a10=0; END if;
if (a11 IS NULL) then set  a11=0; END if;
if (a12 IS NULL) then set  a12=0; END if;

if (b1 IS NULL) then set  b1=0; END if;
if (b2 IS NULL) then SET  b2=0; END if;
if (b3 IS NULL) then SET  b3=0; END if;
if (b4 IS NULL) then SET  b4=0; END if;
if (b5 IS NULL) then SET  b5=0; END if;
if (b8 IS NULL) then SET  b6=0; END if;
if (b7 IS NULL) then SET  b7=0; END if;
if (b8 IS NULL) then SET  b8=0; END if;
if (b9 IS NULL) then SET  b9=0; END if;
if (b10 IS NULL) then set  b10=0; END if;
if (b11 IS NULL) then set  b11=0; END if;
if (b12 IS NULL) then set  b12=0; END if;

 SELECT ar,kto INTO  a,k FROM qo7sn_regn_saldoliste WHERE ar=regnar AND kto=kto1;
 SET @ROW_COUNT2 = FOUND_ROWS();


 if (@ROW_COUNT2=0) then 
INSERT INTO qo7sn_regn_saldoliste  (ar,kto,v1,v2,v3,v4,v5,v6,v7,v8,v9,v10,v11,v12) VALUES (regnar,kto1,a1-b1,a2-b2,a3-b3,a4-b4,a5-b5,a6-b6,a7-b7,a8-b8,a9-b9,a10-b10,a11-b11,a12-b12);
 else
 UPDATE qo7sn_regn_saldoliste SET v1=a1-b1, v2=a2-b2, v3=a3-b3, v4=a4-b4, v5=a5-b5, v6=a6-b6, v7=a7-b7, v8=a8-b8, v9=a9-b9, v10=a10-b10, v11=a11-b11, v12=a12-b12 WHERE ar=regnar AND kto=kto1;
 END if;
 
 if  kto1>=siste then  leave  tt; END if; 
 END loop; 

 END//
DELIMITER ;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
