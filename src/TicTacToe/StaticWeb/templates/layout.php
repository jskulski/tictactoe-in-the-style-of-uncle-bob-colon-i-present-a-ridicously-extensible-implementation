Welcome to tic tac toe

<form method="POST" action="/move">
  <input type="hidden" name="stateId" value="<?= $stateId ?>" />
  <?= $board ?>
</form>