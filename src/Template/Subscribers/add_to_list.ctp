<h1 class="page-header"><?= __('Add Subscriber to Mailing List') ?></h1>


<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            Add [<?= $subscriber->name ?>] To Mailing List
        </h4>
    </div>
    <div class="panel-body">
        <?= $this->Form->create($subscription) ?>
        <div class="form-group">
            <?= $this->Form->control('group_id', ['label'=>'Select Mailing List','class'=>'form-control']) ?>
        </div>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>

</div>

