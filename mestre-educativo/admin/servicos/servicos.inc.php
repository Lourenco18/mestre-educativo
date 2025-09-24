<?php
include $_SERVER['DOCUMENT_ROOT'].'/mestre-educativo/php/include/config.inc.php';
include $arrConfig['dir_admin'].'/ajax/recive-ajax.php';

include $arrConfig['dir_admin'].'/head.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>servicos</title>
</head>
<body>
<?php


$conjuntos = my_query("SELECT * FROM conjunto where ativo = 1");

foreach ($conjuntos as $k => $v) {
 
    echo '<input type="checkbox" onclick= "conjunto_id()" name="conjunto[]" value="' . $v['id_conjunto'] . '" > ' . $v['conjunto'] . '<br>';
}

?>

<div id="selectedIds"></div>

<script>
    function updateSelectedIds() {
        var checkboxes = document.querySelectorAll('input[name="conjunto[]"]:checked');
        var selectedIds = [];
        
        checkboxes.forEach(function (checkbox) {
            selectedIds.push(checkbox.value);
        });
        
        document.getElementById('selectedIds').textContent = '' + selectedIds.join(', ');
        var id_conjunto= selectedIds.join(', ');
        ajax(id_conjunto);
    }
   
   
    function ajax(id_received) {
    console.log(id_received);
    $.ajax({
        url: "<?php echo $arrConfig['url_admin']; ?>/ajax/recive-ajax.php",
        type: "POST",
        data: {id_received: id_received},
        success: function (data) {
            console.log(data)
        },
        error: function(xhr, status, error) {
            alert("Erro na requisição AJAX: " + error);
        }
    });
}

    document.addEventListener("DOMContentLoaded", function () {
        var checkboxes = document.querySelectorAll('input[name="conjunto[]"]');
        var checkboxId5 = document.querySelector('input[value="5"]');

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                if (checkboxId5.checked) {
                    checkboxes.forEach(function (otherCheckbox) {
                        if (otherCheckbox !== checkboxId5) {
                            otherCheckbox.disabled = true;
                            otherCheckbox.checked = false;
                        }
                    });
                } else {
                    checkboxes.forEach(function (otherCheckbox) {
                        otherCheckbox.disabled = false;
                    });
                }
                updateSelectedIds(); // Call the function to update selected IDs whenever a checkbox changes
            });
        });
    });
</script>
</body>
</html>
<?php
include $arrConfig['dir_admin'].'/end.inc.php';
?>
