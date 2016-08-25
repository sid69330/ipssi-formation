<?php

class Export
{	
	private $ci;
	
	public function __construct()
	{
		$this->ci = $CI = &get_instance();
	}

	public function exportTable($table)
	{
        $this->ci->db->select('*');
        $this->ci->db->from($table);

        $result = $this->ci->db->get()->result_array();

        //print_r($result);

        if(count($result) > 0)
        {
            header("Content-Type: text/plain");
            header("Content-disposition: attachment; filename=export_".$table.".csv");

            $out = fopen('PHP://output', 'w');

            $i = 0;
            $tab = array();
            //$tab2 = array();
            foreach($result as $row)
            {
                $tab2 = array();
                foreach($row as $key=>$value)
                {
                    if($i == 0)
                    {
                        array_push($tab, $key);
                    }
                    array_push($tab2, $value);
                }
                if($i == 0)
                {
                    fputcsv($out, $tab, ';');
                }
                fputcsv($out, $tab2, ';');
                $i++;
            }
            fclose($out);
        }
	}
}