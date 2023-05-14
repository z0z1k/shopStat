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
        
        </form>
    </table>

    <? foreach($validateErrors as $error): ?>
        <script> alert("<?=$error?>"); </script>
    <? endforeach ?>

</body>
</html>