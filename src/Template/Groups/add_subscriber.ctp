<h1 class="page-header"><?= __('Subscription') ?></h1>


<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;"><?= __('Add Subscriber to [{0}] mailing list', $group->title) ?></h4>
    </div>
    <div class="panel-body">
        <?= $this->Form->create($subscription) ?>
        <div class="form-group">
            <?= $this->Form->control('subscriber_id', ['class'=>'form-control','placeholder'=>__('Mailing List Title')]) ?>
        </div>
        <?= $this->Form->button(__('Submit'),['class'=>'btn btn-primary pbtn']) ?>
        <?= $this->Form->end() ?>
    </div>

</div>

