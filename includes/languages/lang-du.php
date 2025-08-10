<?php
    function lang($phrase)
    {
        static $lang = array(
            // nave
            'LOGIN/REGISTER' => 'anmelden/registrieren',
            'SUPPORT' => 'Unterstützung',
            'CART' => 'Einkaufswagen',
            'DELETES ALL' => 'Alles löschen',
            'TOTAL PRICE' => 'Gesamtpreis',
            'TOTAL ITEMS' => 'Gesamtprodukte',
            'PROCEED' => 'Fortfahren',
            
            'PROFILE' => 'Profil',
            'VIEW PROFILE' => 'Profil anzeigen',
            'VIEW ORDER' => 'Bestellungen ansehen',
            'VIEW INFORMATION' => 'Informationen anzeigen',
            'LOGOUT' => 'Ausloggen',

            // form
            'NAME' => 'Name*',
            'ORDER ID' => 'Auftragsnummer*',
            'EMAIL ADDRESS' => 'E-Mail-Adresse*',
            'COMMENTS' => 'Dein Kommentar*',
            'USERNAME' => 'Nutzername*',
            'NUMBER' => 'Telefonnummer*',
            'STREET' => 'Straße*',
            'ZIP-CODE' => 'PLZ*',
            'PASSWORD' => 'Passwort*',
            'NEW PASSWORD' => 'Neues Kennwort*',
            'ENTER THE CODE' => 'Code eingeben*',
            'SHOW PASSWORD' => 'Passwort anzeigen',
            'FORGET PASSWORD' => 'Passwort vergessen?',
            'SEND' => 'Schicken',
            'UPDATES' => 'Aktualisieren',
            
            
            // error
            'EMPTY NAME' => 'Der Name darf nicht leer sein.',
            'EMPTY LESS NAME' => 'Der Name darf nicht weniger als 4 Zeichen lang sein.',
            'EMPTY MORE NAME' => 'Der Name darf nicht mehr als 25 Zeichen lang sein.',
            'EMPTY EMAIL' => 'E-Mail darf nicht leer sein.',
            'EMPTY COMMENT' => 'Der Kommentar darf nicht leer sein.',
            'EMPTY ORDER ID' => 'OrderId darf nicht leer sein.',
            'EMPTY ORDER ID IS NOT' => 'Diese Bestell-ID befindet sich nicht in unseren Unterlagen.',

            'EMPTY USERNAME' => 'Der Benutzername darf nicht leer sein.',
            'EMPTY TAKEN USERNAME' => 'Dieser Benutzername ist bereits vergeben.',
            'EMPTY TAKEN EMAIL' => 'Diese E-Mail ist schon vergeben.',
            'EMPTY PASSWORD' => 'Das Passwort darf nicht leer sein.',
            'EMPTY CHARACTERS PASSWORD' => 'Das Passwort darf nicht weniger als 8 Zeichen lang sein.',
            'EMPTY LESS CHARACTERS USERNAME' => 'Der Benutzername darf nicht weniger als 4 Zeichen lang sein.',
            'EMPTY MORE CHARACTERS USERNAME' => 'Der Benutzername darf nicht mehr als 20 Zeichen lang sein.',
            'EMPTY NUMBER' => 'Die Zahl darf nicht leer sein.',
            'EMPTY STREET' => 'Die Straße kann nicht leer sein.',
            'EMPTY ZIP CODE' => 'Die Postleitzahl darf nicht leer sein.',
            'EMPTY LOCATION' => 'Der Standort darf nicht leer sein.',
            'EMPTY VALID LOCATION' => 'Sie müssen einen gültigen Standort auswählen.',
            'EMPTY CART' => 'Ihr Warenkorb ist leer.',
            'EMPTY CHOOSE PAYMENT' => 'Sie müssen eine Zahlungsmethode auswählen.',
            'EMPTY SOMETHING WENT WRONG' => 'Etwas ist schief gelaufen. Bitte versuche es erneut.',

            
            
            
            // Home
            'MEAL' => 'Mahlzeit',
            'OFFERS' => 'Bietet an',
            'ADD' => 'Zusatz',
            'SALE' => 'Rabatt',
            'FINAL PRICE' => 'Endgültiger Preis',
            'ADD TO CART' => 'in den Warenkorb legen',
            'EXTRAS' => 'Extras',
            
            // support
            'RETURN THE ORDER' => 'Problem oder Rückgabe der Bestellung',
            'COMPLAINTS OR COMMENTS' => 'Beschwerden oder Kommentare',
            'IF WANT TO CANCEL THE ORDER' => 'Wenn Sie die Bestellung sofort stornieren möchten, rufen Sie die Nummer an',
            'COMMENT OR COMPLAIN SENT SUCCESSFULLY' => 'Kommentar oder Beschwerde erfolgreich gesendet.',
            'ORDER ID THAT WAS' => 'Verwenden Sie die Bestell-ID, die Ihnen zugesandt wurde.',
            
            
            // register
            'REGISTER' => 'registrieren', 
            'HAVE AN ACCOUNT' => 'Ein Konto haben?', 
            'LOGIN NOW' => 'Jetzt einloggen', 
            
            
            // login 
            'LOGIN' =>'Anmeldung',
            'THE INFORMATION DOES NOT MATCH' =>'Die von Ihnen eingegebenen Informationen stimmen mit keinem unserer Datensätze überein.',
            'Do NOT HAVE ACCOUNT' =>'Sie haben noch kein Konto?',
            'SIGN UP NOW' =>'Jetzt registrieren',

            // Reset Password
            'RESET PASSWORD' => 'Passwort zurücksetzen',
            'ENTER YOUR EMAIL' => 'Geben Sie Ihre E-Mail-Adresse ein und der Code wird Ihnen zugesandt!',
            'VERIFY YOUR EMAIL' => 'Bestätigen Sie Ihre E-Mail',
            'PLEASE ENTER DIGIT' => 'Bitte geben Sie den Ihnen zugesandten 4-stelligen Code ein.',
            
            
            // 404 error
            'PAGE NOT FOUND' => 'Hoppla! Seite nicht gefunden',
            'BACK TO HOME' => 'Zurück zur Startseite',
            
            // cart 
            'NAME OF MEAL' => 'Name_Of_Meal',
            'EXTRAS MEAL' => 'Essenszusätze',
            'PRICE MEAL' => 'Essenspreis',
            'COUNTER MEAL' => 'Anzahl_der_Mahlzeiten',
            'SAVE CHANGE' => 'Änderungen_speichern',
            'EXTRAS TOTAL' => 'Gesamtzugänge',
            'MEAL TOTAL' => 'Gesamtportionen',
            'CHECKOUT' => 'Kasse',
            'EMPTY CART MESSAGE' => 'Ihr Warenkorb ist derzeit leer',
            'RETURN HOME' => 'nach Hause zurückkehren',


            // Profile
            'WELCOME'=>'Willkommen',
            'YOUR ORDERS'=>'Deine Bestellungen',
            'ALL ORDERS SITE'=>'Alle auf der Website getätigten Bestellungen.',
            'YOUR INFORMATION'=>'Ihre Informationen',
            'ALL YOUR DATA'=>'Alle Ihre Daten zum Bearbeiten.',
            'DELETES ACCOUNT'=>'Konto löschen',
            'ARE YOU DELETING ACCOUNT'=>'Sind Sie sicher, dass Sie Ihr Konto löschen möchten?!',
            'ALL YOUR INFORMATION DELETED'=>'*PS: Alle Ihre Informationen und Bestellungen werden gelöscht.',
            'YES' => 'Ja',
            'CLOSE' => 'Schließen',
            'SOMETHING WENT WRONG' => 'Es ist ein Fehler aufgetreten. Versuchen Sie es später noch einmal.',
            'YOUR UPDATED SUCCESSFULLY' => 'Ihre Informationen wurden erfolgreich aktualisiert.',
            'LEAVE IT TO BE CHANGED' => 'Lassen Sie das Feld leer, wenn Sie nicht möchten, dass es geändert wird',




            // checkout & payment & orderConfirmation
            'PROMO CODE' => 'Rabattgutschein',
            'APPLY THE CODE' => 'Anwendung',
            'DO NOT FORGET BUILD NUMBER' => 'Vergessen Sie bitte nicht die Build-Nummer.',
            'ADDRESS' => 'Straße, Hausnummer, Postleitzahl*',
            'YOUR ADDRESS' => 'deine Adresse',
            'ORDER DETAILS' => 'deine Adresse',
            'PAYMENT METHOD' => 'Bezahlverfahren',
            'STATUS' => 'Bestellstatus',
            'DATE' => 'Datum',
            'ORDER NOTES' => 'Bestellhinweise (optional)',
            'CHOOSE PAYMENT METHOD' => 'Wählen Sie die Zahlungsmethode.',
            'ONLINE PAYMENT' => 'Onlinebezahlung.',
            'PAYMENT UPON RECEIPT' => 'Zahlung nach Eingang der Bestellung.',
            'COUPON ADDED SUCCESSFULLY' => 'Gutschein erfolgreich hinzugefügt.',    
            'COUPON ENDED' => 'Entschuldigung, der Gutschein ist abgelaufen.',
            'NO COUPON' => 'Leider gibt es keinen solchen Gutschein.',
            'CONFIRM ORDER AND PAYMENT' => 'Bestellung bestätigt und erfolgreich bezahlt. Vielen Dank für Ihre Bestellung bei Jenan Alsham.<br>Überprüfen Sie Ihre E-Mails, um Ihre Bestelldetails einzusehen.',
            'CONFIRM ORDER' => 'Bestellung erfolgreich bestätigt, vielen Dank für Ihre Bestellung bei Jenan Al Sham.<br>Überprüfen Sie Ihre E-Mails, um Ihre Bestelldetails einzusehen.',






            // Footer
            'COPYRIGHT' => 'Copyright © 2023 Jenan Alsham | Entworfen und entwickelt von',
            
    
        );
        return $lang[$phrase];
    }
?>