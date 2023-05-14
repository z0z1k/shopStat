<html>
<head>
    <title><?=$title?></title>
    <link rel="stylesheet" href="<?=BASE_URL?>assets/css/mystyle.css">
    <link rel="canonical" href="<?=$canonical?>">
</head>
<body>

    <table class="table-fill">
        <form method="post">  
        
        <?=$content?>
        
        

        <tr>
                <td colspan="6">
                        <input type="date" name="setStartDate" value="<?=date('Y-m-d', $dateStart)?>"> <!-- Перша дата -->

                        <!-- Вибір одного дня або періоду -->

                        <?php  if (isset($_POST['datePeriod']) || $dateEnd-$dateStart > 86399) { ?>
                            <input type="date" name="setEndDate" value="<?=date('Y-m-d', $dateEnd)?>"> <!-- Друга дата -->
                            <input type="submit" value="-" name="dateDay"> <!-- Кнопка для вибору одного дня -->
                        <?php } else { ?>
                            <input type="submit" value="+" name="datePeriod"> <!-- Кнопка вибору періоду -->
                        <?php } ?>

                        <!-- Кінець вибору -->

                        <input type="submit" value="setDate" name="setDateBTN"> : <br> <!-- Кнопка відправки дати -->
                        
                        
                        <p>Сума грязних <?=getSumPriceSale($dateStart, $dateEnd)?> грн</p>
                        <p>Сума чистих <?=getSumProfitSale($dateStart, $dateEnd)?> грн</p>
                        <p>Витрати <?=getSumPriceCost($dateStart, $dateEnd)?> грн</p>
                        <p>Загальний дохід <?=getSumProfitSale($dateStart, $dateEnd)-getSumPriceCost($dateStart, $dateEnd)?> грн</p>
                        <? if(getDayCount($dateStart, $dateEnd) > 1): ?>
                            <p>Середній дохід за день <?=ceil((getSumProfitSale($dateStart, $dateEnd)-getSumPriceCost($dateStart, $dateEnd))/getDayCount($dateStart, $dateEnd))?> грн</p>
                        <? endif ?>

                        
                </td>
            </tr>
            </form>
    </table>


    <? foreach($validateErrors as $error): ?>
        <script> alert("<?=$error?>"); </script>
    <? endforeach ?>

</body>
</html>