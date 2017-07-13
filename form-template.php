<?
global $cs;
if(COUNTER_FORM_ERROR_ACTIVE)
{
    $cs->bug($cs->getRequest());
    $cs->bug($cs->getRedirectString());
    $cs->bug($cs->getRedirectString(false));
    $cs->bug($cs->getServer());
    //exit;
}
?>
<?if($cs->getRequestValue($cs->getFormRequestName()) == 'y'):?>
    <div class="counter-score-form-success">
        Данные успешно сохранены.
    </div>
<?else:?>
    <form id="counter-score-form" method="GET" action="" class="counter-score-form">

        <hr class="counter-form-divider">

        <h3>Персональные данные</h3>

        <label for="#personaldata" class="counter-label personaldata">
            <input id="personaldata" type="checkbox" name="personaldata" value="1" <?if($cs->getRequestValue('personaldata')):?>checked<?endif?> > Даю разрешение на обработку персональных данных
        </label>

        <label class="counter-label half">
            <input class="counter-input" name="firstname" type="text" placeholder="Ваше имя" value="<?=$cs->getRequestValue('firstname')?>" >
        </label>

        <label class="counter-label half">
            <input class="counter-input" name="lastname" type="text" placeholder="Ваша фамилия" value="<?=$cs->getRequestValue('lastname')?>" >
        </label>

        <label class="counter-label full">
            <input class="counter-input" name="apartment" type="number" placeholder="Номер квартиры" value="<?=$cs->getRequestValue('apartment')?>" >
        </label>


        <hr class="counter-form-divider">

        <h3>Дата</h3>

        <label class="counter-label half">
            <input class="counter-input" name="month" type="number" placeholder="Месяц" value="<?=$cs->getRequestValue('month')?>" >
        </label>

        <label class="counter-label half">
            <input class="counter-input" name="year" type="number" placeholder="Год" value="<?=date('Y')?>" >
        </label>


        <hr class="counter-form-divider">

        <h3>Данные счетчиков</h3>

        <label class="counter-label fourth">
            <input class="counter-input" name="water_cold_1" type="number" placeholder="Холодная вода 1" value="<?=$cs->getRequestValue('water_cold_1')?>" >
        </label>

        <label class="counter-label fourth">
            <input class="counter-input" name="water_cold_2" type="number" placeholder="Холодная вода 2" value="<?=$cs->getRequestValue('water_cold_2')?>" >
        </label>

        <label class="counter-label fourth">
            <input class="counter-input" name="water_hot_1" type="number" placeholder="Горячая вода 1" value="<?=$cs->getRequestValue('water_hot_1')?>" >
        </label>

        <label class="counter-label fourth">
            <input class="counter-input" name="water_hot_2" type="number" placeholder="Горячая вода 2" value="<?=$cs->getRequestValue('water_hot_2')?>" >
        </label>

        <label class="counter-label fourth">
            <input class="counter-input" name="electricity" type="number" placeholder="Электричество" value="<?=$cs->getRequestValue('electricity')?>" >
        </label>

        <?if(count($cs->getMessages()) > 0):?>
            <div class="result success">
                <?foreach($cs->getMessages() as $string):?>
                    <p class="result-string"><?=$string?></p>
                <?endforeach;?>
            </div>
        <?endif?>

        <?if(count($cs->getErrors()) > 0):?>
            <div class="result error">
                <?foreach($cs->getErrors() as $string):?>
                    <p class="result-string"><?=$string?></p>
                <?endforeach;?>
            </div>
        <?endif?>

        <input type="hidden" name="<?=$cs->getFormRequestName()?>" value="submit">

        <label class="counter-label full">
            <input class="count-button" type="submit" value="Отправить данные">
        </label>

        <div class="clearfix"></div>
    </form>
<?endif?>