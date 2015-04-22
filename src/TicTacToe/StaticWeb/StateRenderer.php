<?php


namespace JSK\TicTacToe\StaticWeb;


class StateRenderer {

  /** @var  Template */
  private $template;

  function __construct($template)
  {
    $this->template = $template;
  }

  public function render(\JSK\TicTacToe\Game\State $state)
  {
    $this->template->render();
    return '---\n---\n---';
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