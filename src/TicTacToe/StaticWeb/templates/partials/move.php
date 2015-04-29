<?php if ($move->isX()): ?>
  X
<?php elseif ($move->isO()): ?>
  O
<?php elseif ($move->isNullObject()): ?>
  <button type="submit" name="moveName" value="<?= $moveName ?>">
    Make Move Here
  </button>
<?php else: ?>
  <?php throw new \LogicException(); ?>
<?php endif ?>
