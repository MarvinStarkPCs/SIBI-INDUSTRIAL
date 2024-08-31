<?php
namespace App\Models;
use CodeIgniter\Model;
class ComboboxModel extends Model
{
protected $DBGroup  = 'default';

public function  getTableData($tablaName){
    if(!$this->db->tableExists($tablaName)){
        return false;
    }
    return $this->db->table($tablaName)->get()->getResultArray();
}

}
