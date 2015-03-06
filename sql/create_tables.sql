-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE KUKA (
    id SERIAL PRIMARY KEY,
    name varchar(50) NOT NULL,
    password varchar(50) NOT NULL
);
CREATE TABLE TARKEYS (
    id SERIAL PRIMARY KEY,
    tarkeysaste integer NOT NULL,
    kuvaus varchar(200)
);
CREATE TABLE LUOKKA (
    id SERIAL PRIMARY KEY,
    nimi varchar(100),
    kuvaus varchar
);
CREATE TABLE ASKARE (
    id SERIAL PRIMARY KEY,
    name varchar(50) NOT NULL,
    tarkeys integer references tarkeys(id),
    luokka integer references luokka(id),
    kuvaus varchar,
    lisatty DATE,
    kuka integer references kuka(id)
);