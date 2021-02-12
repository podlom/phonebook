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

<form action="<?php echo $action ?>" method="post">
    <div>
        <label for="phone">Номер телефона *:</label>
        <input type="number" name="phone" required value="<?php echo $phone ?>">
    </div>
    <div>
        <label for="first">Имя *:</label>
        <input type="text" name="first" maxlength="32" required value="<?php echo $first ?>">
    </div>
    <div>
        <label for="middle">Отчество:</label>
        <input type="text" name="middle" maxlength="32" value="<?php echo $middle ?>">
    </div>
    <div>
        <label for="last">Фамилия *:</label>
        <input type="text" name="last" maxlength="32" required value="<?php echo $last ?>">
    </div>
    <div>
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <input type="submit" value="Добавить">
    </div>
    <div>* - Поле обязательно для заполнения</div>
</form>

