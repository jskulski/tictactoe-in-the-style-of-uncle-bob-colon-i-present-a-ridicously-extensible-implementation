Welcome to tic tac toe

<form method="POST" action="/move">
  <input type="hidden" name="stateId" value="<?= $stateId ?>" />
  <?= $board ?>
</form>

<a href="/">Back to the list</a>
<form action="/state" method="POST"><button value="New Game">Create new Game</button></form>