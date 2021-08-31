<?php
  function showErrorSuccessModel($success, $desc, $btnName = 'OK', $btnLink = '#!') {
    $title = $success ? 'Success' : 'Error';
    $background = $success ? 'green' : 'red';
    echo "<div id='modal' class='modal $background open' style='z-index: 1003; display: block; opacity: 1; top: 10%; transform: scaleX(1) scaleY(1); width: 500px'>
    <div class='modal-content'>
      <h4 class='white-text'>$title</h4>
      <p class='white-text'>$desc</p>
    </div>
    <div class='modal-footer $background'>
      <a href='$btnLink' id='modal-close' class='modal-close waves-effect waves-light btn-flat white $background-text' style='margin-right: 10px'>$btnName</a>
    </div>
  </div>
  
  <script>
    document.querySelector('#modal-close').addEventListener('click', () => { 
      document.querySelector('#modal').setAttribute('style', '');
    });
  </script>
  ";
  }
?>