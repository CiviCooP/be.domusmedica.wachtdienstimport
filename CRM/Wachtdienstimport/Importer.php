<?php
/**
 * Imports the CVS permamed file into the temporary import table
 *
 * @author Klaas Eikelbooml (CiviCooP) <klaas.eikelboom@civicoop.org>
 * @date 3-april-2018
 * @license AGPL-3.0
 *
 */
class CRM_Wachtdienstimport_Importer
{

    private $fieldseperator;
    private $skip;

    const
        NUM_ROWS_TO_INSERT = 100;
    /**
     * CRM_Sync_PermamedImporter constructor.
     */
    public function __construct($fieldseperator = ',',$skip=1)
    {
        $this->fieldseperator=$fieldseperator;
        $this->skip = $skip;
    }

    public function truncate()
    {
        $dao = new CRM_Core_DAO();
        $dao->query('truncate table import_wachtdienst');

    }

    public function importCVStoTable($file){
        // allow the file import to finish in 5 minutes
        ini_set('max_execution_time', 300);


        // now in code - but mebbe json it
        $mapping = array (
          'contact_id'  => 0,
          'contact_name' => 1,
          'riziv'        =>2,
          'arts_naam'    =>3,
          'activity_type' => 4,
          'onderwerp'     =>5,
          'datumtijd_start' =>6,
          'datumtijd_eind'  =>7,
          'wachtdienst_id'  =>8,
          'wachtdienst_naam' =>9,
        );

        $sqlfields = array_keys($mapping);


        $fd = fopen($file, 'r');

        // skip header columns
        for($i=0;$i<$this->skip;$i++) {

            fgetcsv($fd, 0, $this->fieldseperator);

        }
        $dao = new CRM_Core_DAO();
        $sql = NULL;
        $first = TRUE;
        $count = 0;
        while ($csvrow = fgetcsv($fd, 0, $this->fieldseperator)) {
            $row = array();
            foreach($mapping as $pos){
                $row[] = $csvrow[$pos];
            }

            if (!$first) {
                $sql .= ', ';
            }
            else {
                $first = FALSE;
            }
            // trim whitespace
            $row = array_map(function ($string) {
                return trim($string, chr(0xC2) . chr(0xA0));
            }, $row);
            // add quotes
            $row = array_map(['CRM_Core_DAO', 'escapeString'], $row);
            $sql .= "('" . implode("', '", $row) . "')";
            $count++;
            if ($count >= self::NUM_ROWS_TO_INSERT && !empty($sql)) {
                $sql = "INSERT INTO import_wachtdienst (" . implode(',', $sqlfields) . ") VALUES $sql";
                $dao->query($sql);
                $sql = NULL;
                $first = TRUE;
                $count = 0;
            }
        }
        if (!empty($sql)) {
            $sql = "INSERT INTO import_wachtdienst (" . implode(',', $sqlfields) . ") VALUES $sql";;
            $dao->query($sql);
        }
        fclose($fd);

    }
}