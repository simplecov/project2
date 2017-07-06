<?
$cs = new \Simplecov\CounterScore();

$cs->bug($cs->getRequest('firstname'));
?>

<form id="counter-score-form" class="counter-score-form">

    <label class="counter-label">
        <input class="counter-input" name="firstname" type="text" placeholder="Ваше имя" value="<?=$cs->getRequest('firstname')?>">
    </label>

    <label class="counter-label">
        <input class="counter-input" name="lastname" type="text" placeholder="Ваша фамилия">
    </label>

    <label class="counter-label">
        <input class="counter-input" name="apartment" type="number" placeholder="Номер квартиры">
    </label>


    <div class="counter-form-divider"></div>


    <label class="counter-label">
        <input class="counter-input" name="month" type="number" placeholder="Месяц">
    </label>

    <label class="counter-label">
        <input class="counter-input" name="year" type="number" placeholder="Год">
    </label>


    <div class="counter-form-divider"></div>


    <label class="counter-label">
        <input class="counter-input" name="water-cold-1" type="number" placeholder="Холодная вода 1">
    </label>

    <label class="counter-label">
        <input class="counter-input" name="water-cold-2" type="number" placeholder="Холодная вода 2">
    </label>

    <label class="counter-label">
        <input class="counter-input" name="water-hot-1" type="number" placeholder="Горячая вода 1">
    </label>

    <label class="counter-label">
        <input class="counter-input" name="water-hot-2" type="number" placeholder="Горячая вода 2">
    </label>

    <label class="counter-label">
        <input class="counter-input" name="electricity" type="number" placeholder="Электричество">
    </label>


    <div class="counter-form-divider"></div>


    <input type="checkbox" name="personaldata" value="1"> Даю разрешение на обработку персональных данных


    <div class="counter-form-divider"></div>


    <label class="counter-label">
        <input class="count-button" type="submit" value="Отправить данные">
    </label>
</form>