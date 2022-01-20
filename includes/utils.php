<?php

function getPostParam($param)
{
  return isset($_POST[$param]) ? $_POST[$param] : "";
}

?>
