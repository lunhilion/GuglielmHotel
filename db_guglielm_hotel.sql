CREATE TABLE amministratori(
    nome varchar(15) primary key,
    email varchar(50) UNIQUE not null,
    password varchar(50) not null
);

CREATE TABLE appartamenti(
    nStanza varchar(4) primary key,
    nomeStanza varchar(100) not null,
    maxPersone tinyint,
    /*forse "tipoStanza"*/
);
CREATE TABLE prenotazioni(
    id int unsigned auto_increment primary key,
    nomeUtente varchar(15) not null,
    nPersone tinyint unsigned,
    data_arrivo date,
    data_partenza date,
    nStanza varchar(4) not null,
    FOREIGN KEY (nStanza) REFERENCES appartamenti(nStanza) ON DELETE CASCADE
);

CREATE TABLE prezzi_disponibilita(
    nStanza varchar(4),
    da date,
    a date,
    costoGiornaliero int unsigned,
    primary key(nStanza,da,a),
    FOREIGN KEY (nStanza) REFERENCES appartamenti(nStanza) ON DELETE CASCADE
);


INSERT INTO `amministratori` (`nome`, `email`, `password`) VALUES
('Enrico', 'e.sanguin@gmail.com', '743c3e86bedbe9772dadf2e6ea374da9');

INSERT INTO `prenotazioni` (`nomeUtente`, `nPersone`, `data_arrivo`, `data_partenza`, `nStanza`) VALUES
('carlo', '1', '2016-01-03', '2016-02-02', '1A');

INSERT INTO `appartamenti` (`nStanza`, `nomeStanza`, `maxPersone`) VALUES
('1A', 'Camera Singola Classica', '1'),
('2B', 'Camera Doppia Classica', '2'),
('3C', 'Camera Superior', '4'),
('4D', 'Suite', '2');

INSERT INTO `prezzi_disponibilita` (`nStanza`, `da`, `a`, `costoGiornaliero`) VALUES
('1A','2016-01-01','2016-06-15','20'),
('2B','2016-06-16','2016-12-31','40'),
('3C','2016-12-12','2017-12-12','80'),
('4D','2016-12-12','2017-12-12','100');
