<h1 class="page-header"><?= __('Edit Subscriber') ?></h1>


<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;"><?= __('Edit subscriber information') ?></h4>
    </div>
    <div class="panel-body">
        <?= $this->Form->create($subscriber) ?>
        <div class="form-group">
            <?= $this->Form->control('name', ['class'=>'form-control','placeholder'=>__('Subscriber name')]) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('email', ['class'=>'form-control','placeholder'=>__('Subscriber email')]) ?>
        </div>
        <?= $this->Form->button(__('Submit'),['class'=>'btn btn-primary pbtn']) ?>
        <?= $this->Form->end() ?>
    </div>

</div>

