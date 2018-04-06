<h3>Resultaten van het laden van het Permaned bestand</h3>

{if $failures}
    <table>
        <tr>
            <th>id</th>
            <th>ContactId</th>

            <th>Resultaat</th>
        </tr>
        {foreach from=$failures item=row}
            <tr>
                <td>{$row.id}</td>
                <td>{$row.contact_id}</td>
                <td>{foreach from=$row.message item=messageline}
                      {$messageline}<br/>
                    {/foreach}
                </td>
            </tr>
        {/foreach}
    </table>
{/if}
