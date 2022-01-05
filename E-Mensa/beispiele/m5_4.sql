/*<!--
- Praktikum DBWT. Autoren:
- Paul, Ebeling, 3272182
- Alan, Tofeq, 3286019
-->*/

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
