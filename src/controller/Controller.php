<?php

class Controller {

    public static function getPlans () {
        $results = json_decode(file_get_contents('./src/db/plans.json'), FILE_USE_INCLUDE_PATH);
        $data;
        foreach ($results as $item) {
           
            $data [] = new Plan(
                        $item['registro'], 
                        $item['codigo'],
                        $item['nome']
                    );
               
        }

        return $data;
    }

    public static function getProposals() {
        $files = scandir('./src/db/proposals/');

        $proposals = [];
        foreach ($files as $file) {
            if($file === '.' || $file === '..') {continue;}
            $results = file_get_contents('./src/db/proposals/'.$file, FILE_USE_INCLUDE_PATH);

            $proposals[] = json_decode(decrypt($results));
        }
        return $proposals;
    }   
}