<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Newsletter.NewsletterPhinxlog[]|\Cake\Collection\CollectionInterface $newsletterPhinxlog
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Newsletter Phinxlog'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="newsletterPhinxlog index large-9 medium-8 columns content">
    <h3><?= __('Newsletter Phinxlog') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('version') ?></th>
                <th scope="col"><?= $this->Paginator->sort('migration_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('start_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('end_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('breakpoint') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($newsletterPhinxlog as $newsletterPhinxlog): ?>
            <tr>
                <td><?= $this->Number->format($newsletterPhinxlog->version) ?></td>
                <td><?= h($newsletterPhinxlog->migration_name) ?></td>
                <td><?= h($newsletterPhinxlog->start_time) ?></td>
                <td><?= h($newsletterPhinxlog->end_time) ?></td>
                <td><?= h($newsletterPhinxlog->breakpoint) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $newsletterPhinxlog->version]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $newsletterPhinxlog->version]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $newsletterPhinxlog->version], ['confirm' => __('Are you sure you want to delete # {0}?', $newsletterPhinxlog->version)]) ?>
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
