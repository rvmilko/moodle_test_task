<?php if (!empty($data['users'])): ?>
    <ul>
        <?php foreach ($data['users'] as $user): ?>
            <li><?php echo fullname($user); ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p><?php echo get_string('nousers', 'block_userlist'); ?></p>
<?php endif; ?>