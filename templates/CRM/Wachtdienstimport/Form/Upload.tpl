{* HEADER *}
{* <div class="crm-submit-buttons">
  {include file="CRM/common/formButtons.tpl" location="top"}
</div>
*}
<h3>{ts}Importeer de wachtdienst activiteiten{/ts}</h3>
<table class="form-layout">
  <tr>
    <td class="label">{$form.uploadFile.label}</td>
    <td>{$form.uploadFile.html}<br />
      <div class="description">{ts}File format must be comma-separated-values (CSV). File must be UTF8 encoded if it contains special characters (e.g. accented letters, etc.).{/ts}</div>
      {ts 1=$uploadSize}Maximum Upload File Size: %1 MB{/ts}
    </td>
  </tr>
  <tr>
    <td>{$form.testOption.label}</td>
    <td>{$form.testOption.html}<br />

  </tr>
</table>

<h3>{ts}Gebruik{/ts}</h3>
<p>Het import bestand heeft de CSV indeling. Kolommen worden gescheiden door een komma (,). Zo'n bestand is aan te maken
  door binnen Excel (of LibreOffice Calc) de optie 'opslaan als CSV te gebruiken.</p>
<p>De eerste regel wordt overgeslagen.</p>

<ul>
  <li>Gebruiker ID: CiviCRM Contact id van de planner van de wachtdienst.</li>
  <li>Gebruikersnaam: De naam van de planner. Dit is alleen ter documentatie, de import negeert dit.</li>
  <li>RIZIV: Het Riziv nummer van de arts die ingeplant wordt. Ontbreekt dit dan word het record geweigerd.</li>
  <li>Naam huisarts: Wordt in het onderwerp van de wachtdienst activiteit gezet</li>
  <li>Activiteits ID: Wordt genegeerd.</li>
  <li>Onderwerp: Wordt genegeerd.</li>
  <li>Datum activiteit: De datum en de tijd waarop de dienst start. Deze heeft de volgende indeling dd-mm-yyyy uu:mm.
  Voorbeeld 01-05-2018 13:00</li>
  <li>Einddatum/tijd: De datum en de tijd waarop de dienst afloopt. Ook deze heeft de indeling dd-mm-yyyy uu:mm.</li>
  <li>Wachtdienst: 	Contact Id van de wachtdienst waar de arts ingeplant wordt.</li>
  <li>Wachtdienstplaats: Naam van het wachtdienst onderdeel. Dit is alleen ter documentatie en wordt door de import.</li>
verder genegeerd.
  <li>Activiteitsstatus: Wordt genegeerd.</li>
</ul>

<div class="crm-submit-buttons">
  {include file="CRM/common/formButtons.tpl" location="bottom"}
</div>

