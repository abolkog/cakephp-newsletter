<h1 class="page-header"><?= __('New Template') ?></h1>


<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;"><?= __('Add New Template') ?></h4>
    </div>
    <div class="panel-body">
        <?= $this->Form->create($template) ?>
        <div class="form-group">
            <?= $this->Form->control('name', ['class'=>'form-control','placeholder'=>__('Template name')]) ?>
        </div>

        <div class="alert alert-info">
            Use the placeholder <strong>%contents%</strong> in the template body where you want your contents to appear
        </div>

        <div class="form-group">
            <?= $this->Form->control('body', ['class'=>'form-control','placeholder'=>__('Template body')]) ?>
        </div>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>

</div>

