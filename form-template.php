<?
global $cs;
$cs->bug($_REQUEST);
?>

<?if($cs->getRequestValue('counter-score-form-success') == 'y'):?>
    <div class="counter-score-form-success">
        Данные успешно сохранены
    </div>
<?else:?>
    <form id="counter-score-form" method="GET" action="" class="counter-score-form">

        <label class="counter-label">
            <input class="counter-input" name="firstname" type="text" placeholder="Ваше имя" value="<?=$cs->getRequestValue('firstname')?>">
        </label>

        <label class="counter-label">
            <input class="counter-input" name="lastname" type="text" placeholder="Ваша фамилия" value="<?=$cs->getRequestValue('lastname')?>">
        </label>

        <label class="counter-label">
            <input class="counter-input" name="apartment" type="number" placeholder="Номер квартиры" value="<?=$cs->getRequestValue('apartment')?>">
        </label>


        <div class="counter-form-divider"></div>


        <label class="counter-label">
            <input class="counter-input" name="month" type="number" placeholder="Месяц" value="<?=$cs->getRequestValue('month')?>">
        </label>

        <label class="counter-label">
            <input class="counter-input" name="year" type="number" placeholder="Год" value="<?=$cs->getRequestValue('year')?>">
        </label>


        <div class="counter-form-divider"></div>


        <label class="counter-label">
            <input class="counter-input" name="water_cold_1" type="number" placeholder="Холодная вода 1" value="<?=$cs->getRequestValue('water_cold_1')?>">
        </label>

        <label class="counter-label">
            <input class="counter-input" name="water_cold_2" type="number" placeholder="Холодная вода 2" value="<?=$cs->getRequestValue('water_cold_2')?>">
        </label>

        <label class="counter-label">
            <input class="counter-input" name="water_hot_1" type="number" placeholder="Горячая вода 1" value="<?=$cs->getRequestValue('water_hot_1')?>">
        </label>

        <label class="counter-label">
            <input class="counter-input" name="water_hot_2" type="number" placeholder="Горячая вода 2" value="<?=$cs->getRequestValue('water_hot_2')?>">
        </label>

        <label class="counter-label">
            <input class="counter-input" name="electricity" type="number" placeholder="Электричество" value="<?=$cs->getRequestValue('electricity')?>">
        </label>


        <div class="counter-form-divider"></div>


        <input type="checkbox" name="personaldata" value="1"> Даю разрешение на обработку персональных данных

        <div class="counter-form-divider"></div>

        <?if(count($cs->getErrors()) > 0):?>
            <div class="result">
                <?foreach($cs->getErrors() as $string):?>
                    <p class="result-string"><?=$string?></p>
                <?endforeach;?>
            </div>

            <div class="counter-form-divider"></div>
        <?endif?>

        <input type="hidden" name="request_name" value="<?=$cs->getFormRequestName()?>">

        <label class="counter-label">
            <input class="count-button" type="submit" value="Отправить данные">
        </label>
    </form>
<?endif?>