<?php if(isset($id)): ?>
<div class="stat" id="<?php echo htmlspecialchars($id) ?>">
    <?php else: ?>
    <div class="stat">
        <?php endif; ?>

        <div class="top">
            <?php if(isset($icon)): ?>
            <i class="<?php echo htmlspecialchars($icon) ?>"></i>
            <?php endif; ?>
            <?php if(isset($title)): ?>
            <div class="title">
                <?php echo htmlspecialchars($title) ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="value">
            <?php if(isset($value)) {
            echo htmlspecialchars($value ?? "");
        } ?>
            <?php if(isset($inputs)): ?>
            <form>
                <div class="inputs">
                    <?php
                    foreach ($inputs as $key => $value): ?>
                    <div class="input">
                        <input value="<?php echo htmlspecialchars($value["default"]); ?>"
                            type="<?php echo htmlspecialchars($value["type"]); ?>"
                            name="<?php echo htmlspecialchars($id); ?>-input"
                            id="<?php echo htmlspecialchars($id); ?>-input"
                            min="<?php echo htmlspecialchars($value["min"]); ?>">
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="save">
                    <button type="submit">Save Changes</button>
                </div>
            </form>
            <?php endif; ?>
        </div>
    </div>