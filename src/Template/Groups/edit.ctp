<h1 class="page-header"><?= __('Edit Mailing List') ?></h1>


<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;"><?= $group->title ?></h4>
    </div>
    <div class="panel-body">
        <?= $this->Form->create($group,['type'=>'post']) ?>
        <div class="form-group">
            <?= $this->Form->control('title', ['class'=>'form-control','placeholder'=>__('Mailing List Title')]) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('description', ['class'=>'form-control','placeholder'=>__('Mailing List Description')]) ?>
        </div>
        <?= $this->Form->button(__('Submit'),['class'=>'btn btn-primary pbtn']) ?>
        <?= $this->Form->end() ?>
    </div>

</div>

