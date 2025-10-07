

DELIMITER    $$
CREATE PROCEDURE START()
BEGIN 
TRUNCATE TABLE #__regn_resrapport;
INSERT INTO #__regn_resrapport  (Periode,Regnskapsar,nr, tekst,niva,belop) 
SELECT #__regn_hist.periode,#__regn_hist.Regnskapsar,#__regn_kto.rapportlinje, #__regn_resmal.tekst,niva,SUM(#__regn_hist.belop) from #__regn_hist 
inner JOIN  #__regn_resmal,#__regn_kto 
WHERE #__regn_kto.rapportlinje=#__regn_resmal.nr AND #__regn_kto.Ktonr=#__regn_hist.debet 
GROUP BY #__regn_hist.regnskapsar, #__regn_hist.periode,#__regn_resmal.nr;

/* genrerer resrapport fra resmal */
UPDATE #__regn_resrapport  SET periodenr=
case 
when Periode="Januar" then 1
when Periode="Februar" then 2
when Periode="Mars" then 3
when Periode="April" then 4
when Periode="Mai" then 5
when Periode="Juni" then 6
when Periode="Juli" then 7
when Periode="August" then 8
when Periode="September" then 9
when Periode="Oktober" then 10
when Periode="November" then 11
when Periode="Desember" then 12
END;
END$$
DELIMITER    ;









DELIMITER    $$
CREATE PROCEDURE proc_saldo(IN ar1 INT )
BEGIN 

 DECLARE a FLOAT  DEFAULT  0;
 DECLARE b FLOAT  DEFAULT  0;
DECLARE kto1 INT   DEFAULT  0;
DECLARE kto2 INT   DEFAULT  0;
DECLARE pr INT   DEFAULT  0;
 DECLARE siste int  DEFAULT 0;
 DECLARE periodenr int  DEFAULT 1;
DECLARE Periode1 VARCHAR(49) ;
DECLARE resbal1 VARCHAR(10) ;

 SELECT Ktonr INTO siste FROM #__regn_kto ORDER BY Ktonr DESC LIMIT 1;
 
 tt: loop 
 
SELECT  Ktonr,ResBal INTO kto1,resbal1  FROM #__regn_kto WHERE Ktonr = (select min(Ktonr) from #__regn_kto where Ktonr > pr);
-- SELECT  Ktonr INTO kto1  FROM #__regn_kto WHERE Ktonr = (select min(Ktonr) from #__regn_kto where Ktonr > pr);
-- SELECT pr,kto1,resbal1;
SET pr=kto1;

set periodenr=1;

t1: loop


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




SELECT SUM(belop) INTO a FROM #__regn_hist WHERE  Regnskapsar=ar1 AND Periode=Periode1 AND  debet=kto1;
SELECT SUM(belop) INTO b  FROM #__regn_hist WHERE  Regnskapsar=ar1 AND Periode=Periode1 AND  kredit=kto1;
if (a IS NULL) then set a=0; END if;
if (b IS NULL) then set b=0; END if;

SELECT kto INTO kto2 FROM #__regn_saldo WHERE  periode=periodenr AND kto=kto1 AND   ar=ar1;   
 SET @ROW_COUNT2 = FOUND_ROWS();


 if (@ROW_COUNT2=0) then
 begin
INSERT INTO #__regn_saldo (ar,periode,kto,belop,resbal) VALUE (ar1, periodenr,kto1,a-b,resbal1);
-- SELECT "insert",ar1,kto1,periodenr,a-b,resbal1;
END;
ELSE
BEGIN
-- UPDATE #__regn_saldo SET ar=ar1,periode=periodenr,kto=kto1,belop=a-b,resbal=resbal1 WHERE  periode=periodenr AND kto=kto1 AND   ar=ar1;  
UPDATE #__regn_saldo SET belop=a-b,resbal=resbal1 WHERE  periode=periodenr AND kto=kto1 AND   ar=ar1;  
END;
END if;
-- SELECT periodenr;

SET  periodenr=periodenr+1;
 if  periodenr>=13 then  leave  t1; END if; 
 END loop; 



SET pr=kto1;

if  kto1>=siste then  leave  tt; END if; 
END loop; 

 END$$
DELIMITER ;




DELIMITER    $$
CREATE PROCEDURE proc_resrapport(IN ar1 INT )
BEGIN 
 DECLARE rar INT   DEFAULT  0;
 DECLARE nnr INT   DEFAULT  0;
 DECLARE nperiodenr INT   DEFAULT  0;
 DECLARE nrar INT   DEFAULT  0;
 DECLARE SUM1 float   DEFAULT  0;
 
-- TRUNCATE TABLE #__regn_resrapport;
DELETE FROM #__regn_resrapport WHERE regnskapsar=ar1;
-- SELECT nr,periodenr,regnskapsar INTO nnr,nperiodenr,rar FROM  #__regn_resrapport;
-- SELECT  nnr,nperiodenr,rar;
 /*SET @ROW_COUNT2 = FOUND_ROWS();
/* SELECT  @ROW_COUNT2;
/* if @ROW_COUNT2=0 then  */
INSERT INTO #__regn_resrapport  (periodenr,regnskapsar,nr, tekst,niva,belop,kontoer) 
SELECT #__regn_saldo.periode,#__regn_saldo.ar,#__regn_kto.rapportlinje, #__regn_resmal.tekst,#__regn_resmal.niva,sum(#__regn_saldo.belop),#__regn_kto.Ktonr from #__regn_saldo
inner JOIN  #__regn_resmal,#__regn_kto 
WHERE #__regn_kto.rapportlinje=#__regn_resmal.nr AND   #__regn_saldo.resbal='R' AND   #__regn_saldo.ar=ar1 AND #__regn_kto.Ktonr=#__regn_saldo.kto 
GROUP BY #__regn_saldo.ar, #__regn_saldo.periode,#__regn_resmal.nr;
/*ELSE 
BEGIN
 SELECT SUM(beop) into SUM1 FROM #__regn_kto WHERE rapportlinje=#__regn_resmal.nr AND   #__regn_saldo.resbal='R' AND   #__regn_saldo.ar=ar1 AND #__regn_kto.Ktonr=#__regn_saldo.kto ; 
 UPDATE #__regn_resrapport SET belop=sum(#__regn_saldo.belop) WHERE  periodenr=nperiodenr AND nr=nr AND regnskapsar=rar;
END;
END if;

/* genrerer resrapport fra resmal * /
UPDATE #__regn_resrapport  SET periodenr=
case 
when Periode="Januar" then 1
when Periode="Februar" then 2
when Periode="Mars" then 3
when Periode="April" then 4
when Periode="Mai" then 5
when Periode="Juni" then 6
when Periode="Juli" then 7
when Periode="August" then 8
when Periode="September" then 9
when Periode="Oktober" then 10
when Periode="November" then 11
when Periode="Desember" then 12
END;*/


UPDATE #__regn_resrapport  SET Periode=
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
 END$$
 

DELIMITER ;




DELIMITER    $$
CREATE PROCEDURE proc_gruppesum(IN regnar INT,pernr INT)

BEGIN 

 DECLARE h INT  DEFAULT 0;
 DECLARE f INT  DEFAULT 0;
 DECLARE bu FLOAT  DEFAULT  0;
 DECLARE a INT  DEFAULT 0;
 DECLARE aa INT  DEFAULT 0;
 DECLARE last INT  DEFAULT 0;
 DECLARE b FLOAT  DEFAULT  0;
 DECLARE c FLOAT  DEFAULT  0;
 DECLARE d VARCHAR(30)  ;
 DECLARE b1 FLOAT  DEFAULT  0;
 DECLARE c1 FLOAT  DEFAULT  0;
 DECLARE d1 VARCHAR(30)  ;
 
 DECLARE e FLOAT  DEFAULT  0;
 DECLARE e1 FLOAT  DEFAULT  0;
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

 SELECT   nr INTO last  FROM #__regn_resmal ORDER BY nr DESC LIMIT 1;
-- SET last=38;
 myloop:loop -- WHILE  a<100 DO
  -- select from resmal: 
 SELECT   niva,nr,tekst INTO b,c,d FROM #__regn_resmal   where nr = (select min(nr) from #__regn_resmal where nr > a)  ORDER BY nr;
 SET @ROW_COUNT1 = FOUND_ROWS();
 SET a=c;

-- select from resreappoart:
 SELECT niva, nr , tekst,belop,hittil,fjorarstall,budsjett  INTO b1,c1, d1,e1,h,f,bu  FROM #__regn_resrapport WHERe regnskapsar=regnar AND periodenr=pernr and nr=c ORDER BY nr;    
 SET @ROW_COUNT2 = FOUND_ROWS();
SELECT "1",a,b,c,d,e,@ROW_COUNT1,@ROW_COUNT2,b1,c1,d1,regnar,pernr,e1,n2,n3,n4,n5;


IF(bu IS NULL) THEN
        SET bu=0;END if;

-- SELECT a,b,bu,bu1,bu2,bu3,bu4,bu5;
if  @ROW_COUNT2>0 then
BEGIN 



   IF b=1 THEN SET e=e+e1;SET h1=h1+h;SET f1=f1+f;SET bu1=bu1+bu;
   ELSEIF b=2 then  SET n2=n2+e; SET e1=e;  SET e=0; 
                    SET h2=h2+h1; SET h=h1;  SET h1=0;  
                    SET f2=f2+f1; SET f=f1;  SET f1=0;  
                    SET bu2=bu2+bu1; SET bu=bu1;  SET bu1=0;  
/*SET f2=f2+e; SET f1=e;  SET f=0; 
SET n2=n2+e; SET e1=e;  SET e=0;  
   */
   ELSEIF b=3 then begin SET n3=n3+n2+e; SET e1=n2+e;SET n2=0;  SET e=0;  
                        	SET h3=h3+h2+h1; SET h=h2+h1;SET h2=0;  SET h1=0;  
                        	SET f3=f3+f2+f1; SET f=f2+f1;SET f2=0;  SET f1=0;  
                        	SET bu3=bu3+bu2+bu1; SET bu=bu2+bu1;SET bu2=0;  SET bu1=0;  
	
		
	END; 
   ELSEIF b=4 then begin SET n4=n4+n3+n2+e; SET e1=n3+e; SET n3=0; SET e=0;
                         SET h4=h4+h3+h2+h1; SET h=h3+h1; SET h3=0; SET h2=0; SET h1=0; 
                         SET f4=f4+f3+f2+f1; SET f=f3+f1; SET f3=0; SET f2=0; SET f1=0; 
                         SET bu4=bu4+bu3+bu2+bu1; SET bu=bu3+bu1; SET bu3=0; SET bu2=0; SET bu1=0; 
	END;
   ELSEIF b=5 then begin SET n5=n5+n4+n3+n2+e; SET e1=n4+e; SET n4=0;SET e=0; 
                        SET h5=h5+h4+h3+h2+h1; SET h=h4+h1; SET h4=0; SET h3=0; SET h2=0; SET h1=0; 
                        SET f5=f5+f4+f3+f2+f1; SET f=f4+f1; SET f4=0; SET f3=0; SET f2=0; SET f1=0; 
                        SET bu5=bu5+bu4+bu3+bu2+bu1; SET bu=bu4+bu1; SET bu4=0; SET bu3=0; SET bu2=0; SET bu1=0; 
	END;
  END if;
  END;
END if;

-- SELECT "Etter: ",a,b,bu,bu1,bu2,bu3,bu4,bu5;
SELECT "2",a,b,c,d,e,@ROW_COUNT1,@ROW_COUNT2,b1,c1,d1,regnar,pernr,e1,n2,n3,n4,n5;
 
if  @ROW_COUNT2=0 then
INSERT INTO #__regn_resrapport (nr,niva,tekst,belop,regnskapsar,periodenr,hittil,fjorarstall,budsjett) VALUES (c,b,d,e1,regnar,pernr,h,f,bu) ;
ELSE
UPDATE #__regn_resrapport set belop=e1,hittil=h,fjorarstall=f,budsjett=bu WHERE  nr=c AND regnskapsar=regnar AND periodenr=pernr;
END if;

-- if @ROW_COUNT1=0 then LEAVE myloop;end if;
if a=last then LEAVE myloop;end if;
-- END while myloop ;
END loop myloop ;

UPDATE #__regn_resrapport  SET Periode=
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

END$$




DELIMITER    $$
CREATE PROCEDURE proc_fjorarstall(IN ar INT)
BEGIN

DROP TABLE IF EXISTS resrapport;
CREATE TABLE IF NOT EXISTS resrapport LIKE #__regn_resrapport;
INSERT resrapport
SELECT * FROM #__regn_resrapport;

UPDATE #__regn_resrapport INNER JOIN resrapport ON   #__regn_resrapport.nr=resrapport.nr and #__regn_resrapport.periode=resrapport.periode
     set #__regn_resrapport.fjorarstall = resrapport.belop  
    WHERE  #__regn_resrapport.regnskapsar = ar and resrapport.regnskapsar=ar+1;
  
END$$

DELIMITER ;




DELIMITER    $$
CREATE PROCEDURE #__hittil(IN regnar INT)

BEGIN 
   DECLARE b INT DEFAULT 0;    -- rapportlinje
   DECLARE a INT DEFAULT 1 ;   -- periode
   DECLARE c INT DEFAULT 0 ;   -- løpende rapportlinje
   DECLARE LAST1 INT DEFAULT 0 ;  -- siste rapportlinje
   
 SELECT   nr INTO LAST1  FROM #__regn_resrapport where regnskapsar=regnar and periodenr=a  ORDER BY nr DESC LIMIT 1;
 SELECT LAST1 ;
    set a=1;   -- periode
    
perode: loop   -- perode
set b=0;
  rapportlinje: loop      -- rapportlinje
  
  SELECT   niva,nr INTO b,c FROM #__regn_resrapport   where regnskapsar=regnar and periodenr=a and nr = (select min(nr) from #__regn_resrapport where nr > b)  ;
  SET b=c;   
 -- SELECT b;
     SELECT SUM(belop) into @belop FROM #__regn_resrapport WHERE  periodenr<=a AND nr=b AND Regnskapsar=regnar;
     UPDATE #__regn_resrapport SET hittil=@belop WHERE periodenr=a  AND nr=b  AND Regnskapsar=regnar ;

   if b=LAST1 then leave rapportlinje ;END if;
   END LOOP rapportlinje;

SET a=a+1;
   if a>13 then leave perode ;END if;      
    END loop perode;


END$$
DELIMITER ;

