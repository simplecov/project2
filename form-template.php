<?
global $cs;
?>

<form id="counter-score-form" method="get" class="counter-score-form">

    <label class="counter-label">
        <input class="counter-input" name="firstname" type="text" placeholder="Ваше имя" value="<?=$cs->getRequest('firstname')?>">
    </label>

    <label class="counter-label">
        <input class="counter-input" name="lastname" type="text" placeholder="Ваша фамилия" value="<?=$cs->getRequest('lastname')?>">
    </label>

    <label class="counter-label">
        <input class="counter-input" name="apartment" type="number" placeholder="Номер квартиры" value="<?=$cs->getRequest('apartment')?>">
    </label>


    <div class="counter-form-divider"></div>


    <label class="counter-label">
        <input class="counter-input" name="month" type="number" placeholder="Месяц" value="<?=$cs->getRequest('month')?>">
    </label>

    <label class="counter-label">
        <input class="counter-input" name="year" type="number" placeholder="Год" value="<?=$cs->getRequest('year')?>">
    </label>


    <div class="counter-form-divider"></div>


    <label class="counter-label">
        <input class="counter-input" name="water_cold_1" type="number" placeholder="Холодная вода 1" value="<?=$cs->getRequest('water-cold-1')?>">
    </label>

    <label class="counter-label">
        <input class="counter-input" name="water_cold_2" type="number" placeholder="Холодная вода 2" value="<?=$cs->getRequest('water-cold-2')?>">
    </label>

    <label class="counter-label">
        <input class="counter-input" name="water_hot_1" type="number" placeholder="Горячая вода 1" value="<?=$cs->getRequest('water-hot-1')?>">
    </label>

    <label class="counter-label">
        <input class="counter-input" name="water_hot_2" type="number" placeholder="Горячая вода 2" value="<?=$cs->getRequest('water-hot-2')?>">
    </label>

    <label class="counter-label">
        <input class="counter-input" name="electricity" type="number" placeholder="Электричество" value="<?=$cs->getRequest('electricity')?>">
    </label>


    <div class="counter-form-divider"></div>


    <input type="checkbox" name="personaldata" value="1"> Даю разрешение на обработку персональных данных


    <div class="counter-form-divider"></div>


    <label class="counter-label">
        <input class="count-button" type="submit" value="Отправить данные">
    </label>
</form>