<h1 class="page-header"><?= __('New Mailing List') ?></h1>


<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;"><?= __('Add New Mailing List') ?></h4>
    </div>
    <div class="panel-body">
        <?= $this->Form->create($group) ?>
            <div class="form-group">
               <?= $this->Form->control('title', ['class'=>'form-control','placeholder'=>__('Mailing List Title')]) ?>
            </div>
            <div class="form-group">
                <?= $this->Form->control('description', ['class'=>'form-control','placeholder'=>__('Mailing List Description')]) ?>
            </div>
            <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>

</div>

