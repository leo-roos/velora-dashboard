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
            <?php if(isset($progress)): ?>
                <div class="text"><?= htmlspecialchars($progress) ?>%</div>
                <div class="bar">
                    <div class="progress" style="width: <?= htmlspecialchars($progress) ?>%"></div>
                </div>
            <?php endif; ?>
            <?php if(isset($inputs)): ?>
            <form>
                <div class="inputs">
                    <?php
                    foreach ($inputs as $key => $value): ?>
                    <?php $inputId = htmlspecialchars("$id-input"); ?>
                    <div class="input">
                        <input
                            placeholder="<?= htmlspecialchars($value["default"]) ?>"
                            type="<?= htmlspecialchars($value["type"]) ?>"
                            name="<?= $inputId ?>"
                            id="<?= $inputId ?>"
                            min="<?= htmlspecialchars($value["min"]) ?>"
                            <?php if (isset($value["data-account"])): ?>
                                data-account="<?= htmlspecialchars($value["data-account"]) ?>"
                            <?php endif; ?>
                        >
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