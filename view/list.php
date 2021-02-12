<?php
/**
 * @author Taras Shkodenko
 * Created by PhpStorm.
 * Date: 11.02.2021
 * Time: 15:31
 */

$outPut = '';
if (!empty($contacts)) {
    foreach ($contacts as $c) {
        $outPut .= '<div class="contact contact-' . $c['id'] . '">';
        $outPut .= '<a href="/?action=edit&id=' . $c['id'] . '">' . $c['phone'] . '</a> - ' . $c['last'] . ' ' . $c['first'] . ' ' . $c['middle'] . ' ';
        $outPut .= ' - [ ';
        $outPut .= '<a href="/?action=edit&id=' . $c['id'] . '">Редактировать</a>';
        $outPut .= ' | ';
        $outPut .= '<a onclick="return confirm(\'Вы действительно хотите удалить запись?\');" href="/?action=delete&id=' . $c['id'] . '">Удалить</a>';
        $outPut .= ' ] ';
        $outPut .= '</div>';
    }
}
echo $outPut;
