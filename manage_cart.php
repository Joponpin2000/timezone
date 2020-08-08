<?php
if (isset($_POST['type']) && trim($_POST['type']) == 'update')
{
    if (isset($_POST['pid']))
    {
        $pid = trim($_POST['id']);

        if (!empty($_POST['quantity']) && is_numeric($_POST['quantity']))
        {
            if (in_array($pid, array_keys($_SESSION['cart'])))
            {
                foreach ($_SESSION['cart'] as $k => $v)
                {
                    if ($pid == $k)
                    {
                        if (empty($_SESSION['cart'][$k]['quantity']))
                        {
                            $_SESSION['cart'][$k]['quantity'] = 0;
                        }
                        $_SESSION['cart'][$k]['quantity'] += $_POST['quantity'];
                    }
                }
            }
        }    
    }
}
?>