<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propostas</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/script.js"></script>
</head>
<body>
    <?php
    define('__ROOT__', dirname(__FILE__));
    include_once(__ROOT__ . '/src/helpers/includes.php');
    ?>
    <header>
        <nav>
            <ul>
                <li><a href="./index.php">Home</a></li>
                <li><a href="./propostas.php">Propostas</a></li>
            </ul>
        </nav>
    </header>
    <h1>Propostas</h1>
    <?php 
    $propostas = Controller::getProposals();  
    foreach ($propostas as $proposta):?>
        <div class="proposals">
            <div class="header">
                Proposta numero: <?= $proposta->code ?>
            </div>
            <?php foreach ($proposta->data as $data) {?>
                <div class="content">
                    <strong>Nome:</strong> <span><?= $data->beneficiary->name ?></span><br>
                    <strong>Idade:</strong> <span><?= $data->beneficiary->age ?></span><br>
                    <strong>Plano:</strong> <span><?= $data->plan->name ?></span><br>
                    <strong>Valor:</strong> <span>R$ <?= $data->price ?></span><br>
                </div>
            <?php }?>
        </div>  
    <?php endforeach; ?>
     
</body>
</html>