<?php
/**
 * @author Taras Shkodenko
 * Created by PhpStorm.
 * Date: 11.02.2021
 * Time: 13:34
 */

if (!empty($msg) && ($msg == 1)) {
    echo '<div class="message">Изменения успешно сохранены в базу. <a href="/">Перейти к списку контактов</a>.</div>';
}

?>

<form action="<?= $action ?>" method="post">
    <div>
        <label for="phone">Номер телефона *:</label>
        <input type="number" name="phone" required value="<?= $phone ?>">
    </div>
    <div>
        <label for="first">Имя *:</label>
        <input type="text" name="first" maxlength="32" required value="<?= $first ?>">
    </div>
    <div>
        <label for="middle">Отчество:</label>
        <input type="text" name="middle" maxlength="32" value="<?= $middle ?>">
    </div>
    <div>
        <label for="last">Фамилия *:</label>
        <input type="text" name="last" maxlength="32" required value="<?= $last ?>">
    </div>
    <div>
        <input type="hidden" name="id" value="<?= $id ?>">
        <input type="submit" value="Добавить">
    </div>
    <div>* - Поле обязательно для заполнения</div>
</form>

