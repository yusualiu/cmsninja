<!-- <form action="" method="post">
  <input type="hidden" name="jokeid" value="<?//php //echo $joke//[//'id'];?>">
  <label for="joketext">Type your joke here:</label>
  <textarea id="joketext" name="joketext" rows="3" cols="40">
    <?//= //$joke['joketext']?>
  </textarea>
  <input type="submit" value="Save">
</form> -->
<!-- 
<form action="" method="post">
  <input type="hidden" name="jokeid"  value="
  <?//php if (isset($joke)): ?>
    <?//=$joke//['id']?>
  <?//php endif; ?>

  <?//=$joke//['id'] ?? ''?>">
  <label for="joketext">Type your joke here:</label>
  <textarea id="joketext" name="joketext" rows="3" cols="40">
  <?//php if (isset($joke)): ?>
    <?//=$joke['joketext']?>
  <?//php endif; ?>
  </textarea>
  <input type="submit" name="submit" value="Save">
</form> -->

<form action="" method="post">
  <input type="hidden" name="joke[id]" value="<?=$joke['id'] ?? ''?>">
<label for="joketext">Type your joke here: </label>
<textarea id="joketext" name="joke[joketext]" rows="3" cols="40">
  <?=$joke['joketext'] ?? ''?>
</textarea>
<input type="submit" name="submit" value="Save">
</form>