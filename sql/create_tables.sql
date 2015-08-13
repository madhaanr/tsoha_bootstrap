-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE KUKA (
    id SERIAL PRIMARY KEY,
    nimi varchar(50) NOT NULL,
    salasana varchar(50) NOT NULL
);
CREATE TABLE LUOKKA (
    id SERIAL PRIMARY KEY,
    nimi varchar(100),
    kuvaus varchar
);
CREATE TABLE ASKARE (
    id SERIAL PRIMARY KEY,
    nimi varchar(50) NOT NULL,
    tarkeys integer,
    luokka varchar,
    kuvaus varchar,
    lisatty DATE,
    kuka integer references kuka(id)
);