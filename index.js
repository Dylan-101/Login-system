   // $(document).ready(function() {
       // $('#messageboard').load('reload-messages.php');
       // var refreshId = setInterval(function() {
      //      $('#messageboard').load('reload-messages.php');
       // }, 1000);
      //  $.ajaxSetup({ cache: false });
   // })

function addEmoji(emoji) {
  let input = document.getElementById('userinput');
  
  input.value += emoji;
}

function toggleEmojiDrawer() {
  let drawer = document.getElementById('drawer');

  if (drawer.classList.contains('hidden')) {
    drawer.classList.remove('hidden');
  } else {
    drawer.classList.add('hidden');
  }

  return false;
}

