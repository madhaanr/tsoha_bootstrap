-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO KUKA (nimi, salasana) VALUES ('nsa','nsa');
INSERT INTO LUOKKA (nimi, kuvaus) VALUES ('Kasvit','kasveja tässä');
INSERT INTO ASKARE (nimi, kuvaus, lisatty, kuka_id) VALUES ('Kasvien lajittelu','hmm',NOW(),1);
INSERT INTO ASKARE (nimi, kuvaus, lisatty, kuka_id) VALUES ('Kahvi','hmm',NOW(),1);
INSERT INTO ASKARE (nimi, kuvaus, lisatty, kuka_id) VALUES ('Kasvien kastelu','joo',NOW(),1);
INSERT INTO ASKARE_LUOKKA VALUES (1,1);