CREATE VIEW IF NOT EXISTS view_suppengerichte AS
SELECT name FROM gericht
WHERE name LIKE '%suppe%';

CREATE VIEW IF NOT EXISTS view_anmeldungen AS
SELECT anzahlanmeldungen FROM benutzer
ORDER BY anzahlanmeldungen ASC ;

DROP VIEW view_kategoriegerichte_vegetarisch;

CREATE VIEW IF NOT EXISTS view_kategoriegerichte_vegetarisch AS
SELECT gericht.name AS gerichtname ,
       kategorie.name AS kategorie
FROM gericht
         JOIN gericht_hat_kategorie ON gericht.id = gericht_hat_kategorie.gericht_id && gericht.vegetarisch IS TRUE
         RIGHT JOIN kategorie ON gericht_hat_kategorie.kategorie_id = kategorie.id;

CREATE PROCEDURE AnmeldeCounter(IN email_input VARCHAR(100))
BEGIN
    UPDATE benutzer SET anzahlanmeldungen = anzahlanmeldungen + 1
    WHERE email = email_input;
end;

CREATE PROCEDURE AnzahlfehlerCounter(IN email_input VARCHAR(100))
BEGIN
    UPDATE benutzer SET anzahlfehler = anzahlfehler + 1
    WHERE email = email_input;
end;