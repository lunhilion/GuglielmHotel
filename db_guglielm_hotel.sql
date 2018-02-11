CREATE TABLE amministratori(
    nome varchar(15) primary key,
    email varchar(50) UNIQUE not null,
    password varchar(50) not null
);

CREATE TABLE appartamenti(
    idStanza varchar(4) primary key,
    nomeStanza varchar(100) not null
);
CREATE TABLE prenotazioni(
    id int unsigned auto_increment primary key,
    nomeUtente varchar(15) not null,
    email varchar(50) UNIQUE not null,
    data_arrivo date,
    data_partenza date,
    nStanza tinyint unsigned,
    tipoStanza varchar(4),
    FOREIGN KEY (tipoStanza) REFERENCES appartamenti(idStanza) ON DELETE CASCADE
);

CREATE TABLE prezzi_disponibilita(
    idStanza varchar(4),
    da date,
    a date,
    costoGiornaliero int unsigned,
    maxStanze tinyint unsigned,
    primary key(idStanza,da,a),
    FOREIGN KEY (idStanza) REFERENCES appartamenti(idStanza) ON DELETE CASCADE
);


INSERT INTO `amministratori` (`nome`, `email`, `password`) VALUES
('Enrico', 'e.sanguin@gmail.com', '743c3e86bedbe9772dadf2e6ea374da9');

INSERT INTO `appartamenti` (`idStanza`, `nomeStanza`) VALUES
('A', 'Camera Singola Classica'),
('B', 'Camera Doppia Classica'),
('C', 'Camera Superior'),
('D', 'Suite');

INSERT INTO `prezzi_disponibilita` (`idStanza`, `da`, `a`, `costoGiornaliero`, `maxStanze`) VALUES
('A','2016-01-01','2016-06-15','20','4'),
('B','2016-06-16','2016-12-31','40','3'),
('C','2016-12-12','2017-12-12','80','3'),
('D','2016-12-12','2017-12-12','100','1');

INSERT INTO `prenotazioni` (`nomeUtente`, `email`, `data_arrivo`, `data_partenza`, `tipoStanza`) VALUES
('Carlo', 'carlo@gmail.com', '2016-01-03', '2016-02-02', 'A'),
('Giuseppe', 'giuseppe@gmail.com', '2016-01-03', '2016-02-02', 'B');

CREATE TRIGGER `update_nStanza` BEFORE INSERT ON `prenotazioni` FOR EACH ROW BEGIN
DECLARE contati tinyint;
SELECT COUNT(*) INTO contati FROM prenotazioni WHERE tipoStanza=NEW.tipoStanza;
SET NEW.nStanza=contati+1;
END