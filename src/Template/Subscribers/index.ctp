<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Newsletter.Subscriber[]|\Cake\Collection\CollectionInterface $subscribers
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Subscriber'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subscriptions'), ['controller' => 'Subscriptions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subscription'), ['controller' => 'Subscriptions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="subscribers index large-9 medium-8 columns content">
    <h3><?= __('Subscribers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($subscribers as $subscriber): ?>
            <tr>
                <td><?= $this->Number->format($subscriber->id) ?></td>
                <td><?= h($subscriber->name) ?></td>
                <td><?= h($subscriber->email) ?></td>
                <td><?= h($subscriber->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $subscriber->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $subscriber->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $subscriber->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subscriber->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
