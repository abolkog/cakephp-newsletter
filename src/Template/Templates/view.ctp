<h1 class="page-header"><?= __('View Template') ?></h1>
<table class="table table-striped"">
    <thead>
    <tr>
        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('name') ?></th>
        <th scope="col"><?= $this->Paginator->sort('created') ?></th>
        <th scope="col" class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td><?= $template->id ?></td>
            <td>
                <?= $template->name ?>
            </td>
            <td><?= $template->created ?></td>
            <td>
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="listActions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <?= __('Actions') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="listActions">
                        <li>
                            <?= $this->Html->link("<i class='fa fa-eye'></i> ".__('Preview'), ['action'=>'preview',$template->id], ['escape'=>false,'target'=>'_blank','onclick'=>"return !window.open(this.href, 'Preview', 'width=800,height=600')"]) ?>
                        </li>
                        <li><?= $this->Html->link("<i class='fa fa-edit'></i> ".__('Edit'),['action'=>'edit',$template->id],['escape'=>false]) ?></li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <?= $this->Form->postLink("<i class='fa fa-trash'></i> ".__('Delete'),['action'=>'delete', $template->id],['confirm'=>'Are you sure you want to delete this template?','escape'=>false]) ?>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
    </tbody>
</table>

<div class="panel panel-default" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel-heading clearfix">
        <h3 class="panel-title pull-left"><i class="fa fa-file-code-o"></i>
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Template Body (Source)
            </a>
        </h3>
    </div>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body">
            <?= $this->Text->autoParagraph(h($template->body)); ?>
        </div>
    </div>
</div>


<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <h3 class="panel-title pull-left"><i class="fa fa-envelope"></i> Campaigns Using this template</h3>
    </div>
    <div class="panel-body">
        <table class="table table-responsive table-hover">

            <thead>
            <tr>
                <th>Id</th>
                <th>Campaign</th>
                <th>Created</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($template->campaigns as $campaign):?>
                <tr>
                    <td><?= $campaign->id; ?></td>
                    <td><?= $this->Html->link($campaign->subject,['controller'=>'campaigns','action'=>'view',$campaign->id]) ?></td>
                    <td><?= $this->App->niceDate($campaign->created); ?></td>
                    <td>
                        <?php $status = $this->App->campaignStatusToString($campaign->status) ?>
                        <span class="badge badge-<?= $status['color'] ?>"><?= $status['status'] ?></span>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>

        </table>

    </div>
</div>
