DROP PROCEDURE usuiu;
DELIMITER //
		CREATE PROCEDURE usuiu(idus bigint(11), nomus varchar(50), apeus varchar(50),docus varchar(11), pefi bigint(11), dirus varchar(100), telus varchar(10), codub bigint(11), emaus varchar(100), pasus varchar(100), imgu varchar(120), depus bigint(11), actus tinyint(1))
		BEGIN
		IF NOT EXISTS(SELECT idusu FROM usuario WHERE idusu=idus) THEN 
			INSERT INTO usuario (nomusu, apeusu, docusu, pefid, dirusu, telusu, codubi, emausu, pasusu, imgus, depusu, actusu) VALUES (nomus, apeus, docus, pefi, dirus, telus, codub, emaus, pasus, imgu, depus, actus);
		ELSE
			UPDATE usuario 
			SET nomusu=nomus, apeusu=apeus, docusu=docus, pefid=pefi, dirusu=dirus, telusu=telus, codubi=codub, emausu=emausu, imgus=imgus
			WHERE idusu=idus;
		END IF;
	END //
DELIMITER ;

DROP PROCEDURE inscate;
DELIMITER //
		CREATE PROCEDURE inscate(idcat bigint(11), cnam varchar(50),cico varchar(50))
		BEGIN
		IF NOT EXISTS(SELECT idcate FROM category WHERE idcate=idcat) THEN 
			INSERT INTO category (cname, cicon) VALUES (cnam, cico);
		ELSE
			UPDATE category 
			SET cname=cnam, cicon=cico
			WHERE idcate=idcat;
		END IF;
	END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE delcate(idcat bigint(11))
BEGIN
  DELETE FROM category WHERE idcate = idcat;
END //
DELIMITER ;



DROP PROCEDURE insprod;
DELIMITER //
		CREATE PROCEDURE insprod(idpro bigint(11), pnam varchar(50), pric varchar(50), trademar varchar(50), mode varchar(100), categor bigint(11), discoun tinyint(2), cdescriptio text,cstatu tinyint(1))
		BEGIN
		IF NOT EXISTS(SELECT idprod FROM product WHERE idprod=idpro) THEN 
			INSERT INTO product (pname, price, trademark, model, category, discount, cdescription, cstatus) VALUES (pnam, pric, trademar, mode, categor, discoun, cdescriptio, cstatu);
		ELSE
			UPDATE product 
			SET pname=pnam, price=pric, trademark=trademar, model=mode, category=categor, discount=discoun, cdescription=cdescriptio, cstatus=cstatu
			WHERE idprod=idpro;
		END IF;
	END //
DELIMITER ;

DROP PROCEDURE insdom;
DELIMITER //
		CREATE PROCEDURE insdom(iddo bigint(11), nomdo varchar(70), pardo varchar(50))
		BEGIN
		IF NOT EXISTS(SELECT iddom FROM dominio WHERE iddom=iddo) THEN 
			INSERT INTO dominio (nomdom, pardom) VALUES (nomdo, pardo);
		ELSE
			UPDATE dominio 
			SET nomdom= nomdo, pardom= pardo
			WHERE iddom=iddo;
		END IF;
	END //
DELIMITER ;
DROP PROCEDURE insprodimg;
DELIMITER //
		CREATE PROCEDURE insprodimg(idim bigint(11),pfilenam varchar(250), idpro bigint(11))
		BEGIN
		IF NOT EXISTS(SELECT idimg FROM files WHERE idimg=idim) THEN 
			INSERT INTO files (pfilename, idprod) VALUES (pfilenam, idpro);
		ELSE
			UPDATE files 
			SET pfilename= pfilenam, idprod=idpro
			WHERE idimg=idim;
		END IF;
	END //
DELIMITER ;

DROP PROCEDURE updateconfig;
DELIMITER //
		CREATE PROCEDURE updateconfig(idconfi bigint(12), tittl varchar(20),  mnam varchar(20), mdescriptio	varchar(250), heade varchar(40), foote varchar(100), caddres varchar(50), faceboo	varchar(300), instagra	varchar(300), log	varchar(300), favico varchar(300), ma	varchar(300), abou	text, cservice text, phon varchar(20), colorpr varchar(32), colorse varchar(32), fon varchar(50))
		BEGIN
		UPDATE html_configuration 
		SET tittle=tittl, mname=mnam, mdescription=mdescriptio, header=heade, footer=foote, caddress=caddres, facebook=faceboo, instagram=instagra, logo=log, favicon=favico, map=ma, about=abou, cservices=cservice, phone=phon, colorpry=colorpr, colorsec=colorse, font=fon
		WHERE idconfig=idconfi;
	END //
DELIMITER ;


DROP PROCEDURE instrade;
DELIMITER //
		CREATE PROCEDURE instrade(idtrademar bigint(11),tnam varchar(50),tim varchar(250))
		BEGIN
		IF NOT EXISTS(SELECT idtrademark FROM trademark WHERE idtrademark=idtrademar) THEN 
			INSERT INTO trademark (tname, timg) VALUES (tnam, tim);
		ELSE
			UPDATE trademark 
			SET tname=tnam, timg=tim
			WHERE idtrademark=idtrademar;
		END IF;
	END //
DELIMITER ;


DROP PROCEDURE deltrade;
DELIMITER //
CREATE PROCEDURE deltrade(idtrademar bigint(11))
BEGIN
  DELETE FROM trademark WHERE idtrademark = idtrademar;
END //
DELIMITER ;