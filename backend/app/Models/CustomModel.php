<?php

namespace App\Models;

use App\Services\Request\OrderDetailServiceRequest;
use CodeIgniter\Database\BaseConnection;
use CodeIgniter\Model;

class CustomModel extends Model
{
    protected BaseConnection $conn;

    public function __construct(){
        $this->conn = db_connect();
    }
    public function getOrderType() : array
    {
        $builder = $this->conn->table("tbl_order_type");
        return $builder->select("ot_code, ot_desc")->where("status", 1)->get()->getResultArray();
    }

    public function getDivisionsByPsrCode(int $psr_code) : array
    {
        $builder = $this->conn->table("tbl_cust_psr");
        
        return $builder->select("div_code, div_desc")
                ->where('psr_code', $psr_code)->where('div_code <>', '')->where("status", 1)->groupBy("div_code")->orderBy("div_desc")
                ->get()->getResultArray();
    }

    public function getCustomersByDivCodeAndPsrCode(int $div_code, string $psr_code) : array
    {
        $builder = $this->conn->table("tbl_customer a");
        $query = $builder->distinct()->select("a.cust_code, a.cust_name")->join("tbl_cust_psr b","b.cust_code = a.cust_code", "inner")->where("b.psr_code", $psr_code)->where('b.div_code', $div_code)->where('a.status', 1);

        return $query->get()->getResultArray();
    }

    public function getBranchPlant() : array
    {
        $builder = $this->conn->table('tbl_branch_plant');
        $query = $builder->select('branch_code, branch_desc')->where('status',1);

        return $query->get()->getResultArray();
    }

    public function getSkus() : array
    {
        $builder = $this->conn->table('tbl_uts_sku a');
        $query = $builder->select('a.sku_code, a.sku_desc')->join('tbl_sku b', 'b.sku_code = a.sku_code', 'inner')->where('a.div_code', '')->where('a.status',1);

        return $query->get()->getResultArray();
    }

    public function getPromoItemByCustomerPlantDivision($ship_to, $branch_code, $div_code): array
    {
        $builder = $this->conn->table('tbl_uts_sku');
        $builder->join('tbl_sku', 'tbl_sku.sku_code = tbl_uts_sku.sku_code', 'inner');
        $builder->where('tbl_sku.tag', 2);
        $builder->where('tbl_uts_sku.cust_site', $ship_to);
        $builder->where('tbl_uts_sku.branch_code', $branch_code);
        $builder->where('tbl_uts_sku.div_code', $div_code);
        $builder->where('tbl_sku.status', 1);

        return $builder->get()->getResultArray();
    }

    public function getPromoItemByCustomerDivision($ship_to, $div_code): array
    {
        $builder = $this->conn->table('tbl_uts_sku');
        $builder->join('tbl_sku', 'tbl_sku.sku_code = tbl_uts_sku.sku_code', 'inner');
        $builder->where('tbl_sku.tag', 2);
        $builder->where('tbl_uts_sku.cust_site', $ship_to);
        $builder->where('tbl_uts_sku.div_code', $div_code);
        $builder->where('tbl_sku.status', 1);

        return $builder->get()->getResultArray();
    }

    public function getPromoItemByPlantDivision($branch_code, $div_code): array
    {
        $builder = $this->conn->table('tbl_uts_sku');
        $builder->join('tbl_sku', 'tbl_sku.sku_code = tbl_uts_sku.sku_code', 'inner');
        $builder->where('tbl_sku.tag', 2);
        $builder->where('tbl_uts_sku.branch_code', $branch_code);
        $builder->where('tbl_uts_sku.div_code', $div_code);
        $builder->where('tbl_sku.status', 1);

        return $builder->get()->getResultArray();
    }

    public function getPromoItemByDivision($div_code): array
    {
        $builder = $this->conn->table('tbl_uts_sku');
        $builder->join('tbl_sku', 'tbl_sku.sku_code = tbl_uts_sku.sku_code', 'inner');
        $builder->where('tbl_sku.tag', 2);
        $builder->where('tbl_uts_sku.div_code', $div_code);
        $builder->where('tbl_sku.status', 1);

        return $builder->get()->getResultArray();
    }

    public function getSkuByCustomerPlantDivision(OrderDetailServiceRequest $details){
        $builder = $this->conn->table('tbl_uts_sku a');
		$builder->select("a.sku_code, b.sku_desc, c.id");
        $builder->distinct();
        $builder->join("tbl_sku b", "a.sku_code = b.sku_code", "inner");
        $builder->join("site_key_combination c", "c.material_sku = a.sku_code", "left");
        $builder->where("b.tag !=", $details->item_tag);
        $builder->where("a.cust_site", $details->ship_to);
        $builder->where("a.branch_code", $details->branch_code);
        $builder->where("a.div_code", $details->div_code);
        $builder->where("a.status", $details->status);
        
        return $builder->get()->getResultArray();
    }

    public function getSkuByCustomerDivision(OrderDetailServiceRequest $details){
        $builder = $this->conn->table("tbl_uts_sku a");
        $builder->select("a.sku_code, b.sku_desc, c.id");
        $builder->distinct();
        $builder->join("tbl_sku b", "a.sku_code = b.sku_code", "inner");
        $builder->join("site_key_combination c", "c.material_sku = a.sku_code", "left");
        $builder->where("b.tag !=", $details->item_tag);
        $builder->where("a.cust_site", $details->ship_to);
        $builder->where("a.div_code", $details->div_code);
        $builder->where("a.status", $details->status);
        
        return $builder->get()->getResultArray();
    }

    public function getSkuByPlantDivision(OrderDetailServiceRequest $details){
        $builder = $this->conn->table("tbl_uts_sku a");
        $builder->select("a.sku_code, b.sku_desc, c.id");
        $builder->distinct();
        $builder->join("tbl_sku as b", "a.sku_code = b.sku_code", "inner");
        $builder->join("site_key_combination as c", "c.material_sku = a.sku_code", "left");
        $builder->where("b.tag !=", $details->item_tag);
        $builder->where("(a.branch_code = '{$details->branch_code}' OR a.branch_code = '')");
        $builder->where("a.div_code", $details->div_code);
        $builder->where("a.status", $details->status);

        return $builder->get()->getResultArray();
    }

    public function getSkuByDivision(OrderDetailServiceRequest $details){
        $builder = $this->conn->table("tbl_uts_sku a");
        $builder->select("a.sku_code, b.sku_desc, c.id");
        $builder->distinct();
        $builder->join("tbl_sku as b", "a.sku_code = b.sku_code", "inner");
        $builder->join("site_key_combination as c", "c.material_sku = a.sku_code", "left");
        $builder->where("b.tag !=", $details->item_tag);
        $builder->where("a.div_code", $details->div_code);
        $builder->where("a.status", $details->status);

        return $builder->get()->getResultArray();
    }
}
