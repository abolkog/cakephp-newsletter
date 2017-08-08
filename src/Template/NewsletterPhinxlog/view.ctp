<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Newsletter.NewsletterPhinxlog $newsletterPhinxlog
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Newsletter Phinxlog'), ['action' => 'edit', $newsletterPhinxlog->version]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Newsletter Phinxlog'), ['action' => 'delete', $newsletterPhinxlog->version], ['confirm' => __('Are you sure you want to delete # {0}?', $newsletterPhinxlog->version)]) ?> </li>
        <li><?= $this->Html->link(__('List Newsletter Phinxlog'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Newsletter Phinxlog'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="newsletterPhinxlog view large-9 medium-8 columns content">
    <h3><?= h($newsletterPhinxlog->version) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Migration Name') ?></th>
            <td><?= h($newsletterPhinxlog->migration_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Version') ?></th>
            <td><?= $this->Number->format($newsletterPhinxlog->version) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start Time') ?></th>
            <td><?= h($newsletterPhinxlog->start_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End Time') ?></th>
            <td><?= h($newsletterPhinxlog->end_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Breakpoint') ?></th>
            <td><?= $newsletterPhinxlog->breakpoint ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
