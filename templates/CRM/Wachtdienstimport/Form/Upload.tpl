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
</table>
<p>Het te importeren bestand moet de volgende indeling hebben:</p>
<div class="crm-submit-buttons">
  {include file="CRM/common/formButtons.tpl" location="bottom"}
</div>

