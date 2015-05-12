<table>
  <tr>
    <th>State Id</th>
    <th>Board</th>
    <th>Play this game</th>
  </tr>
  <?php foreach ($states as $state): ?>
    <tr>
      <?php $this->insert('partials/state', array('state' => $state)); ?>
    </tr>
  <?php endforeach; ?>
</table>
