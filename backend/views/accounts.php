<?php
$user = empty($user) ? null : $user;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
</head>
<body>
    <div>
        <?php if (empty($user)) : ?>
        <div>No user with the target id was found.</div>
        <?php else : ?>
        <div>
            <span>Email:</span>
            <span><?= isset($user['email']) ? $user['email'] : '-' ?></span>
        </div>
        <div>
            <span>Name:</span>
            <span><?= isset($user['name']) ? $user['name'] : '-' ?></span>
        </div>
        <div>
            <span>Birth date:</span>
            <span><?= (isset($user['birth_date']) && is_numeric($user['birth_date'])) ? date('d/m/Y', $user['birth_date']) : 'n/a' ?></span>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
