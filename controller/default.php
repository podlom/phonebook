<?php
/**
 * @author Taras Shkodenko
 * Created by PhpStorm.
 * Date: 11.02.2021
 * Time: 13:43
 */

class DefaultController
{
    public function defaultAction()
    {
        include dirname(dirname(__FILE__)) . '/view/header.php';
        $id = $last = $middle = $first = $phone = $msg = '';
        $action = '/?action=add';
        include dirname(dirname(__FILE__)) . '/view/form.php';
        include_once 'model/contact.class.php';
        $contact = new Contact();
        $contacts = $contact->findAll();
        include dirname(dirname(__FILE__)) . '/view/list.php';
        $query = $_GET['query'] ?? '';
        include dirname(dirname(__FILE__)) . '/view/find.php';
        include dirname(dirname(__FILE__)) . '/view/footer.php';
    }

    public function addAction()
    {
        include_once 'model/contact.class.php';
        $contact = new Contact();
        if (!empty($_POST)) {
            $res = $contact->findByPhone($_POST['phone']);
            if (empty($res)) {
                $res2 = $contact->add(['phone' => $_POST['phone'], 'first' => $_POST['first'], 'middle' => $_POST['middle'], 'last' => $_POST['last']]);
                if ($res2) {
                    include dirname(dirname(__FILE__)) . '/view/header.php';
                    echo 'Контакт был успешно добавлен в базу. <a href="/">Перейти к списку контактов</a>.';
                    include dirname(dirname(__FILE__)) . '/view/footer.php';
                }
            }
        }
    }

    public function editAction()
    {
        include_once 'model/contact.class.php';
        $contact = new Contact();
        if (!empty($_POST)) {
            $edited = $contact->edit($_POST);
            if ($edited) {
                header('Location: /?action=edit&id=' . $_POST['id'] . '&msg=1');
            }
        }
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $res = $contact->findById($_GET['id']);
            if (is_array($res[0]) && !empty($res[0])) {
                include dirname(dirname(__FILE__)) . '/view/header.php';
                $id = $res[0]['id'];
                $last = $res[0]['last'];
                $middle = $res[0]['middle'];
                $first = $res[0]['first'];
                $phone = $res[0]['phone'];
                $action = '/?action=edit';
                $msg = $_GET['msg'] ?? '';
                include dirname(dirname(__FILE__)) . '/view/form.php';
                include dirname(dirname(__FILE__)) . '/view/footer.php';
            }
        }
    }

    public function deleteAction()
    {
        include_once 'model/contact.class.php';
        $contact = new Contact();
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $res = $contact->delete($_GET['id']);
            if ($res) {
                include dirname(dirname(__FILE__)) . '/view/header.php';
                echo 'Контакт был успешно удален из базы. <a href="/">Перейти к списку контактов</a>.';
                include dirname(dirname(__FILE__)) . '/view/footer.php';
            }
        }
    }

    public function searchAction()
    {
        include_once 'model/contact.class.php';
        $contact = new Contact();
        if (isset($_GET['query']) && !empty($_GET['query'])) {
            include dirname(dirname(__FILE__)) . '/view/header.php';
            $findResult = $contact->findStr($_GET['query']);
            $query = $_GET['query'] ?? '';
            include dirname(dirname(__FILE__)) . '/view/find.php';
            include dirname(dirname(__FILE__)) . '/view/footer.php';
        }
    }
}
