<?php

$template_artist = 'Artist';
$template_title = 'Title';
$template_note = 'Note';

$template_css = '
#cover {
  width: 600px;
  height: 600px;
  background-color: white;
  color: black;
  font-family: sans-serif;
  font-size: 20px;
  border: 0.5em double teal;
}
#cover .container {
  padding: 2em;
}

#cover .container .artist {
  font-size: 2em;
}

#cover .container .title {
  font-size: 3em;
  font-weight: bold;
}

#cover .container .note {
  color: gray;
  font-size: 1.5em;
  font-style: italic;
}
';

$template_html = '
<style type="text/css">{CSS}</style>
<div id="cover">
  <div class="container">
    <div class="artist">{ARTIST}</div>
    <div class="title">{TITLE}</div>
    <div class="note">{NOTE}</div>
  </div>
</div>
';

$template = (array_key_exists('template', $_GET) ? $_GET['template'] : false);
if(!empty($template)) {
  $template_path = 'music/coverart/templates/' . strtolower($template) . '.php';
  if(file_exists($template_path)) {
    include($template_path);
  }
}

$artist = (array_key_exists('artist', $_POST) ? $_POST['artist'] : trim($template_artist));
$title = (array_key_exists('title', $_POST) ? $_POST['title'] : trim($template_title));
$note = (array_key_exists('note', $_POST) ? $_POST['note'] : trim($template_note));
$html = trim($template_html);
$css = (array_key_exists('css', $_POST) ? $_POST['css'] : trim($template_css));
if(empty(trim($css))) {
  $css = '#cover { border: 2px solid teal; }';
}

?>

<form action="#" method="post">
  <p>
  <label for="artist">Artist:</label>
  <input type="text" name="artist" value="<?php echo $artist; ?>">
  </p>
  <p>
  <label for="title">Title:</label>
  <input type="text" name="title" value="<?php echo $title; ?>">
  </p>
  <p>
  <label for="artist">Note:</label>
  <input type="text" name="note" class="long" value="<?php echo $note; ?>">
  </p>
  <p>
    <label for="html">Layout (HTML):</label>
    <textarea name="html" readonly disabled><?php echo htmlspecialchars($template_html); ?></textarea>
  </p>
  <p>
  <label for="css">Styling (CSS):</label>
  <textarea name="css" class="tall"><?php echo $css; ?></textarea>
  </p>
  <p>
    <input type="submit" name="submit" class="button" value="Generate Cover Art">
    <input type="reset" name="reset" class="button" value="Reset">
    <input type="reset" name="reload" class="button" value="Reload" onclick="window.location.href = window.location.pathname;">
  </p>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js" type="text/javascript"></script>
  <script type="text/javascript">
    function generateCoverImage() {
      var cover_block = document.getElementById('cover');
      domtoimage.toPng(cover_block).then(function (dataUrl) {
        var link = document.createElement('a');
        link.download = '<?php echo $artist . ' - ' . $title; ?>.png';
        link.href = dataUrl;
        link.click();
      }).catch(function (err) {
        console.error('Unable to create image and/or start downloading.', err);
      });
    }
  </script>
  <p style="font-size: smaller;">(<a href="#dom2img" onclick="generateCoverImage(); return(false);">Experimental: Download HTML+CSS cover art as an image. Note that custom fonts may not render correctly.</a>)</p>

</form>

<?php
  echo str_ireplace(array('{CSS}','{ARTIST}','{TITLE}','{NOTE}'), array($css, $artist, $title, $note), $template_html);
?>
