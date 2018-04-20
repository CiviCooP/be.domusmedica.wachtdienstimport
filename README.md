## Domus Medica Import wachtdiensten

Deze extensie maakt het mogelijk een excel bestand met wachtdiensten te importeren in 
CiviCRM, als wachtdienst activiteiten.

## Gebruik

Na installatie van de extensie wordt kan in het menu Kringen_ de optie _Wachtdienst Import_ gekozen worden. Vervolgens 
kan het te importeren bestand gekozen worden en een import optie geselecteerd. De volgende opties zijn mogelijk:

* Dry Run: de import wordt nagelopen op mogelijke fouten maar niet daadwerkelijk uitgevoerd.
* Test: de wachtdienst activiteiten worden aangemaakt met de test indicator. Zijn dan niet zichtbaar
op de contact kaar maar kunnen wel gevonden als er op test gezocht wordt. Zo zijn ze eenvoudig achteraf
te verwijderen.
* Maak de activiteiten aan, zonder de test indicator.

## Structuur importbestand

Het import bestand heeft de CSV indeling. Kolommen worden gescheiden door een CiviCRM Import/Export Field Separator.
Meestal is dat een komma (,). Zo'n bestand is aan te maken door binnen Excel (of LibreOffice Calc) de optie 'opslaan als CSV te gebruiken.

De eerste regel wordt overgeslagen. 

- Gebruiker ID: CiviCRM Contact id van de planner van de wachtdienst.
- Gebruikersnaam: De naam van de planner. Dit is alleen ter documentatie, de import negeert dit.	
- RIZIV: Het Riziv nummer van de arts die ingeplant wordt. Ontbreekt dit dan word het record geweigerd.
- Naam huisarts: Wordt in het onderwerp van de wachtdienst activiteit gezet.
- Activiteits ID: Wordt genegeerd.
- Onderwerp: Wordt genegeerd.
- Datum activiteit: De datum en de tijd waarop de dienst start. Deze heeft de volgende indeling dd-mm-yyyy uu:mm. 
Voorbeeld 01-05-2018 13:00
- Einddatum/tijd: De datum en de tijd waarop de dienst afloopt. Ook deze heeft de indeling dd-mm-yyyy uu:mm. 
- Wachtdienst: 	Contact Id van de wachtdienst waar de arts ingeplant wordt.
- Wachtdienstplaats: Naam van het wachtdienst onderdeel. Dit is alleen ter documentatie en wordt door de import
verder genegeerd.
- Activiteitsstatus: Wordt genegeerd.





## Technische objecten

Deze extensie maakt een tabel aan met de volgende structuur:

```sql
CREATE TABLE `import_wachtdienst` (
  `id`                      INT                  AUTO_INCREMENT,
  `contact_id`              INT,
  `contact_name`            VARCHAR(128),
  `riziv`                   VARCHAR(14),
  `arts_naam`               VARCHAR(128),
  `activity_type`           INT,
  `onderwerp`               VARCHAR(100),
  `datumtijd_start`         VARCHAR(20),
  `datumtijd_eind`          VARCHAR(20),
  `wachtdienst_id`          INT,
  `wachtdienst_naam`        VARCHAR(128),
  `processed`               VARCHAR(1)  NOT NULL DEFAULT 'N',
  `message`                 TEXT                 DEFAULT NULL,
  PRIMARY KEY (`id`)
)
```