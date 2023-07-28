<?php

class Proposal {
    protected $code;
    protected $beneficiaries;
    protected $plan_code;
    protected $plan;

    public function __construct() {
        $this->code = time();
        $this->beneficiaries = [];
    }

    public function addBeneficiaries($beneficiary){
        if($beneficiary && gettype($beneficiary) == 'object' && get_class($beneficiary) == 'Beneficiary')
            $this->beneficiaries [] = $beneficiary;
    }

    public function getPlan() {
        return $this->plan;
    }

    public function setPlan($plan_code) {
        $this->plan_code = $plan_code;
        $this->findPlan();
    }

    private function findPlan() {
        if($this->plan_code) {
            $results = json_decode(file_get_contents('./src/db/plans.json'), FILE_USE_INCLUDE_PATH);
            foreach ($results as $item) {
                if( $this->plan_code == $item['codigo']){
                    $this->plan = new Plan(
                            $item['registro'], 
                            $item['codigo'],
                            $item['nome']
                        );
                    break;
                }
            }
        }
    }
    
    public function save() {
        $name_file = $this->code . '.json';
        $data = [];
        $qtd = count($this->beneficiaries);
       
        $selected_price;
        foreach($this->plan->getPrices() as $price) {
            if($qtd >= $price->getMinLifes()){
                $selected_price = $price;
            }
        }

        foreach ($this->beneficiaries as $beneficiary) {
            $data [] = [
                'beneficiary' => ['name' => $beneficiary->getName(), 'age' => $beneficiary->getAge()],
                'plan' => ['name'=> $this->plan->getName(),  'code'=> $this->plan->getCode() ],
                'price' => $this->getPriceByAge($selected_price, $beneficiary->getAge())
            ];
        }
        $data = json_encode(['code' => $this->code, 'data'=> $data]);
        $enc = encrypt($data);
      
        file_put_contents(
                __ROOT__ . '/src/db/proposals/'.$name_file,
                $enc
        );
    }

    private function getPriceByAge($price, $age) {
        switch ($age) {
            case ($age < 18):
               return $price->getRangeOne();
            case ($age > 17 && $age < 41):
                return $price->getRangeTwo();
            case ($age > 40):
                return $price->getRangeThree();
        }
    }

}