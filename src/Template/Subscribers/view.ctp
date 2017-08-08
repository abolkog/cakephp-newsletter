<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Newsletter.Subscriber $subscriber
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Subscriber'), ['action' => 'edit', $subscriber->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Subscriber'), ['action' => 'delete', $subscriber->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subscriber->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Subscribers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subscriber'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subscriptions'), ['controller' => 'Subscriptions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subscription'), ['controller' => 'Subscriptions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="subscribers view large-9 medium-8 columns content">
    <h3><?= h($subscriber->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($subscriber->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($subscriber->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($subscriber->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($subscriber->created) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Subscriptions') ?></h4>
        <?php if (!empty($subscriber->subscriptions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Group Id') ?></th>
                <th scope="col"><?= __('Subscriber Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($subscriber->subscriptions as $subscriptions): ?>
            <tr>
                <td><?= h($subscriptions->id) ?></td>
                <td><?= h($subscriptions->group_id) ?></td>
                <td><?= h($subscriptions->subscriber_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Subscriptions', 'action' => 'view', $subscriptions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Subscriptions', 'action' => 'edit', $subscriptions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Subscriptions', 'action' => 'delete', $subscriptions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subscriptions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
