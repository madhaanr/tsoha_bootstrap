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
    kuvaus varchar,
    lisatty DATE,
    kuka_id integer references kuka(id)
);
CREATE TABLE ASKARE_LUOKKA (
    askare_id integer,
    luokka_id integer,
    primary key(askare_id,luokka_id),
    foreign key (askare_id) references askare(id) on update cascade on delete cascade,
    foreign key (luokka_id) references luokka(id) on update cascade on delete cascade
);