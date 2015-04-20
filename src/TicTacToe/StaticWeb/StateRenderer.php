<?php


namespace JSK\TicTacToe\StaticWeb;


class StateRenderer {

  public function render(\JSK\TicTacToe\Game\State $state)
  {
    $html =<<<EOF
<table cellspacing="4">
  <tr>
    <td>
      <button>Make move</button>
    </td>
    <td>
      <button>Make move</button>
    </td>
    <td>
      <button>Make move</button>
    </td>
  </tr>
  <tr>
    <td>
      <button>Make move</button>
    </td>
    <td>
      <button>Make move</button>
    </td>
    <td>
      <button>Make move</button>
    </td>
  </tr>
  <tr>
    <td>
      <button>Make move</button>
    </td>
    <td>
      <button>Make move</button>
    </td>
    <td>
      <button>Make move</button>
    </td>
  </tr>
</table>
EOF;
    return $html;
  }

}