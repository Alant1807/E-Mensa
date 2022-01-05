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