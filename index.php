<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste Programação</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/script.js?"></script>
</head>
<body>
    <?php
    error_reporting(E_ERROR | E_PARSE);
    define('__ROOT__', dirname(__FILE__));
    include_once(__ROOT__ . '/src/helpers/includes.php');
    include_once(__ROOT__ . '/src/controller/Post.php');
    ?>
    <header>
        <nav>
            <ul>
                <li><a href="./index.php">Home</a></li>
                <li><a href="./propostas.php">Propostas</a></li>
            </ul>
        </nav>
    </header>
    <?php if($_SESSION['enviado']) { ?>
        <div class="success">
            <h1>Proposta enviada com sucesso!</h1>
        </div>
    <?php } ?>
    <div class="content">
        <div class="plans">
            <?php foreach (Controller::getPlans() as $plan) {
                    $prices = $plan->getPrices()
                ?>
                <div class="plan ">
                    <h4 class="header"><?= $plan->getName() ?></h2>
                    <input type="hidden" name="code" value="<?= $plan->getCode() ?>">

                    <div class="prices">
                        <?php foreach ( $prices as $price): ?>
                            <input type="hidden" name="range_one" data-lifes="<?= $price->getMinLifes() ?>" value="<?= $price->getRangeOne() ?>">
                            <input type="hidden" name="range_two" data-lifes="<?= $price->getMinLifes() ?>" value="<?= $price->getRangeTwo() ?>">
                            <input type="hidden" name="range_three" data-lifes="<?= $price->getMinLifes() ?>" value="<?= $price->getRangeThree() ?>">
                        <?php endforeach ?>
                    </div>

                    <div class="range">
                        <strong>Faixa Etária</strong><br>
                        <?php if(isset( $prices[0])) { ?>
                            <strong>0 a 17 anos</strong><span>: R$ <?= $prices[0]->getRangeOne() ?> por vida</span><br>
                            <strong>18 a 40 anos</strong><span>: R$ <?= $prices[0]->getRangeTwo() ?> por vida</span><br>
                            <strong>40 anos ou mais</strong><span>: R$ <?= $prices[0]->getRangeThree() ?> por vida</span><br>
                            <span class="note"><?= isset($prices[1])  ? 'Desconto exclusivo a partir de  ' . $prices[1]->getMinLifes() .' vidas' : '' ?></span><br>   
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            
        </div>
        <div id="clone">
            <div class="form-person">
                    <label for="name">
                        Nome do Beneficiário:
                        <input type="text" id="name" class="form-input name" name="name[]" required>
                    </label>
                    <label for="age">
                        Idade do Beneficiário:
                        <input type="number" onfocusout="updateValue()" id="age" class="form-input age" name="age[]"  min="1" max="99" required>
                    </label>
                </div>
        </div>
        <form action="" id="form_plan" method="POST" >
            <input type="hidden" name="plan" id="plan_code" value="">
            <div class="header">Contrate seu plano!</div>
            <div class="content">
                <div class="form-person">
                    <label for="name">
                        Nome do Beneficiário:
                        <input type="text" id="name" class="form-input name" name="name[]" required>
                    </label>
                    <label for="age">
                        Idade do Beneficiário:
                        <input type="number" onfocusout="updateValue()" id="age" class="form-input age" name="age[]"  min="1" max="99" required>
                    </label>
                </div>
            </div>

            <span id="add_person">+ Adicionar outro beneficiário</span>
            <button type="submit">
                Enviar proposta
            </button>
        </form>
        <p id="valor_total">
           <strong> Valor total da proposta: </strong>
           <span> R$ 0</span>
        </p>
    </div>
    
</body>
</html>