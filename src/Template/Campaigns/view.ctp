<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Newsletter.Campaign $campaign
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Campaign'), ['action' => 'edit', $campaign->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Campaign'), ['action' => 'delete', $campaign->id], ['confirm' => __('Are you sure you want to delete # {0}?', $campaign->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Campaigns'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Campaign'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Templates'), ['controller' => 'Templates', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Template'), ['controller' => 'Templates', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="campaigns view large-9 medium-8 columns content">
    <h3><?= h($campaign->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Subject') ?></th>
            <td><?= h($campaign->subject) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sender') ?></th>
            <td><?= h($campaign->sender) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Group') ?></th>
            <td><?= $campaign->has('group') ? $this->Html->link($campaign->group->title, ['controller' => 'Groups', 'action' => 'view', $campaign->group->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Template') ?></th>
            <td><?= $campaign->has('template') ? $this->Html->link($campaign->template->name, ['controller' => 'Templates', 'action' => 'view', $campaign->template->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($campaign->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($campaign->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($campaign->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Completed') ?></th>
            <td><?= h($campaign->completed) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Contents') ?></h4>
        <?= $this->Text->autoParagraph(h($campaign->contents)); ?>
    </div>
</div>
