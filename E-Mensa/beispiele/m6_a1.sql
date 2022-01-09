CREATE TABLE IF NOT EXISTS bewertungen
(
    id                  INT(8) PRIMARY KEY AUTO_INCREMENT,
    bemerkung           VARCHAR(200) NOT NULL CHECK (LENGTH(bemerkung) > 4),
    sternebewertung     ENUM ('sehr gut', 'gut', 'schlecht', 'sehr schlecht'),
    bewertungszeitpunkt DATETIME     NOT NULL DEFAULT NOW(),
    hervorgehoben       BOOLEAN      NOT NULL DEFAULT 0,
    gericht_id           INT(8)       NOT NULL,
    FOREIGN KEY (gericht_id) REFERENCES gericht (id),
    benutzer VARCHAR(100) NOT NULL,
    FOREIGN KEY (benutzer) REFERENCES benutzer (email)
);
