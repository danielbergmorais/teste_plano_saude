<?php

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'POST') {
 
  if(isset($_POST['plan'])) {
    $plan = $_POST['plan'];
   
    $proposal = new Proposal();
    $proposal->setPlan($plan);

    if(isset($_POST['name'])) {
      for($x= 0; $x < count($_POST['name']); $x++){
        $proposal->addBeneficiaries(new Beneficiary($_POST['name'][$x], $_POST['age'][$x]));
      }
    }
    $proposal->save();
    $_SESSION['enviado'] = true;
  }

}



