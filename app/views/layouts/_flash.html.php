      <?php foreach (flash_now()+flash() as $type=>$flashes) : ?>
      <div class="alert fade in alert-<?= $type ?>">
        <a class="close" data-dismiss="alert" href="#">×</a>
      <?php if (is_array($flashes)) : ?>
        <ul>
        <?php foreach ($flashes as $flash) : ?>
          <li><?= $flash ?></li>
        <?php endforeach ?>
        </ul>
      <?php else : ?>
        <?= $flashes ?>
      <?php endif; ?>
      </div>
      <?php endforeach ?>