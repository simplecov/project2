<?php
global $cs;
global $dbcs;

$cs->bug($dbcs->getEjectedData());
$ejectedData = $dbcs->getEjectedData();
?>
<form id="get-data-form" method="GET" action="" class="counter-score-form">
    <label class="counter-label half">
        <select name="month">
            <option value="1">Январь</option>
            <option value="2">Февраль</option>
            <option value="3">Март</option>
            <option value="4">Апрель</option>
            <option value="5">Май</option>
            <option value="6">Июнь</option>
            <option value="7">Июль</option>
            <option value="8">Август</option>
            <option value="9">Сентябрь</option>
            <option value="10">Октябрь</option>
            <option value="11">Ноябрь</option>
            <option value="12">Декабрь</option>
        </select>
    </label>

    <label class="counter-label half">
        <select name="year">
            <option value="<?=(int)date('Y')?>"><?=date('Y')?></option>
            <option value="<?=(int)date('Y') - 1?>"><?=(int)date('Y') - 1?></option>
        </select>
    </label>

    <input type="hidden" name="<?=$cs->getFormRequestName()?>" value="getdata">

    <label class="counter-label full">
        <input class="count-button" type="submit" value="Получить данные">
    </label>

    <div class="clearfix"></div>
</form>

<?if($ejectedData):?>
<table class="result success">
    <tbody>
    <tr>
        <td>ID</td>
        <td>Имя</td>
        <td>Фамилия</td>
        <td>Квартира</td>
        <td>Месяц</td>
        <td>Год</td>
        <td>Холодная вода 1</td>
        <td>Холодная вода 2</td>
        <td>Горячая вода 1</td>
        <td>Горячая вода 2</td>
        <td>Электричество</td>
        <td>Согласие</td>
    </tr>
    <?foreach($ejectedData as $array):?>
        <tr>
            <?foreach($array as $key => $value):?>

                <td><b><?=$value?></b></td>

            <?endforeach?>
        </tr>
    <?endforeach?>
    </tbody>
</table>
<?else:?>
<div class="result error">
    <p>По вашему запросу данных нет.</p>
</div>
<?endif?>
