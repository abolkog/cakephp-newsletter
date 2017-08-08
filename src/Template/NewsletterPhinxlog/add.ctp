<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Newsletter Phinxlog'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="newsletterPhinxlog form large-9 medium-8 columns content">
    <?= $this->Form->create($newsletterPhinxlog) ?>
    <fieldset>
        <legend><?= __('Add Newsletter Phinxlog') ?></legend>
        <?php
            echo $this->Form->control('migration_name');
            echo $this->Form->control('start_time');
            echo $this->Form->control('end_time');
            echo $this->Form->control('breakpoint');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
