<?php

class Plan{
    protected $registry;
    protected $code;
    protected $name;
    protected $prices;

    public function __construct($registry, $code, $name){
        $this->registry = $registry;
        $this->code = $code;
        $this->name = $name;

        $this->findPrices();
    }
   
    private function findPrices() {
        if($this->code) {
            $results = json_decode(file_get_contents('./src/db/prices.json'), FILE_USE_INCLUDE_PATH);
            foreach ($results as $item) {
                if( $this->code == $item['codigo']) {
                    $this->prices[] = new Price(
                            $item['codigo'], 
                            $item['minimo_vidas'],
                            $item['faixa1'],
                            $item['faixa2'],
                            $item['faixa3'],
                        );
                }
            }
        }
    }

    public function getPrices(){
        return $this->prices;
    }

    public function getCode() {
        return $this->code;
    }

    public function getName() {
        return $this->name;
    }

}