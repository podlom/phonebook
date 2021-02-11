<?php
/**
 * @author Taras Shkodenko
 * Created by PhpStorm.
 * Date: 11.02.2021
 * Time: 16:09
 */

?>

<hr>
<div class="search-contacts">
    <form action="" method="get">
        <input name="query" type="text" value="<?= $query ?>">
        <input type="hidden" name="action" value="search">
        <input type="submit" value="Искать">
    </form>
</div>

<?php

if (isset($findResult)) {
    if (empty($findResult)) {
        echo '<div class="search-results">По вашему запросу ничего не найдено</div>';
    } else {
        $outPut = '<div class="search-results">Результаты поиска:</div>';
        foreach ((array)$findResult as $c) {
            $outPut .= '<div class="found-contact found-contact-' . $c['id'] . '">';
            $outPut .= '<a href="/?action=edit&id=' . $c['id'] . '">' . $c['phone'] . '</a> - ' . $c['last'] . ' ' . $c['first'] . ' ' . $c['middle'] . ' ';
            $outPut .= ' - [ ';
            $outPut .= '<a href="/?action=edit&id=' . $c['id'] . '">Редактировать</a>';
            $outPut .= ' | ';
            $outPut .= '<a onclick="return confirm(\'Вы действительно хотите удалить запись?\');" href="/?action=delete&id=' . $c['id'] . '">Удалить</a>';
            $outPut .= ' ] ';
            $outPut .= '</div>';
        }
        echo $outPut;
    }
}