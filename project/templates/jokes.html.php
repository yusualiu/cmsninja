

  <?php if (isset($error)): ?>
    <p>
      <?php echo $error; ?>
    </p>
  <?php else: ?>
    <p><?php echo $totalJokes?> jokes have been submitted to the Internet Joke Database.</p>
  <?php foreach ($jokes as $joke): ?>
    <blockquote>
      <p>
        <?php echo htmlspecialchars($joke['joketext'],
        ENT_QUOTES, 'UTF-8') ?>
        (by <a href="mailto:<?php
echo htmlspecialchars($joke['email'], ENT_QUOTES,
'UTF-8'); ?>"><?php
echo htmlspecialchars($joke['name'], ENT_QUOTES,
'UTF-8'); ?></a> on <?php
 $date = new DateTime($joke['jokedate']);
echo $date->format('jS F Y'); ?>)

<a href="editjoke.php?id=<?=$joke['id']?>">
Edit</a>
        <form action="deletejoke.php" method="post">
      <input type="hidden" name="id" value="<?=$joke['id']?>">
          <input type="submit" value="Delete">
      </form>
      </p>     
      
    </blockquote>
    
  <?php endforeach; ?>
  <?php endif; ?>
