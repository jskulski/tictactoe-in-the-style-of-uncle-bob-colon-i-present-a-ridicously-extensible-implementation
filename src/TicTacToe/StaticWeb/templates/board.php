<form method="POST" action="/move">
  <table>
    <tr>
      <td>
        <?php $this->insert('partials/move', array('moveName' => 'topLeft', 'move' => $topLeft)) ?>
      </td>
      <td>
        <?php $this->insert('partials/move', array('moveName' => 'topMiddle', 'move' => $topMiddle)) ?>
      </td>
      <td>
        <?php $this->insert('partials/move', array('moveName' => 'topRight', 'move' => $topRight)) ?>
      </td>
    </tr>
    <tr>
      <td>
        <?php $this->insert('partials/move', array('moveName' => 'middleLeft', 'move' => $middleLeft)) ?>
      </td>
      <td>
        <?php $this->insert('partials/move', array('moveName' => 'middleMiddle', 'move' => $middleRight)) ?>
      </td>
      <td>
        <?php $this->insert('partials/move', array('moveName' => 'middleRight', 'move' => $middleRight)) ?>
      </td>
    </tr>
    <tr>
      <td>
        <?php $this->insert('partials/move', array('moveName' => 'bottomLeft', 'move' => $bottomLeft)) ?>
      </td>
      <td>
        <?php $this->insert('partials/move', array('moveName' => 'bottomMiddle', 'move' => $bottomMiddle)) ?>
      </td>
      <td>
        <?php $this->insert('partials/move', array('moveName' => 'bottomRight', 'move' => $bottomRight)) ?>
      </td>
    </tr>
  </table>
</form>
