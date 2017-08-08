<h1 class="page-header"><?= __('Import Subscribers') ?></h1>


<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;"><?= __('Import Subscribers to [{0}] mailing list', $group->title) ?></h4>
    </div>
    <div class="panel-body">

        <div class="alert-info alert">
            <i class="fa fa-warning"></i> Note:<strong>Only Comma Separated Value (CSV) are accepted</strong>
        </div>

        <div>
            <p>File format <strong>MUST BE</strong> {name,email}</p>
            <p>Example:</p>
            <pre>
                    user1,user1@jennifersoft.com
                    user2,user2@jennifersoft.com
                    ...
            </pre>
        </div>

        <?= $this->Form->create(null, ['type'=>'file']) ?>
        <div class="form-group">
            <?= $this->Form->control('listfile', ['class'=>'form-control','label'=>'Select File','type'=>'file','required']) ?>
        </div>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>

</div>