<div class="stat" id="<?php echo htmlspecialchars($id) ?>">
    <div class="top">
        <?php if($icon): ?>
            <i class="<?php echo htmlspecialchars($icon) ?>"></i>
        <?php endif; ?>
        <div class="title">
            <?php echo htmlspecialchars($title) ?>
        </div>
    </div>
    <div class="value">
        <?php echo htmlspecialchars($value ?? "") ?>
    </div>
</div>