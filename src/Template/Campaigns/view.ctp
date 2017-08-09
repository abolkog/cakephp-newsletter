<h1 class="page-header"><?= __('View Campaign') ?></h1>

<table class="table table-striped"">
    <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('subject') ?></th>
            <th scope="col"><?= $this->Paginator->sort('From') ?></th>
            <th scope="col"><?= $this->Paginator->sort('group_id','Mailing List') ?></th>
            <th scope="col"><?= $this->Paginator->sort('template_id','Template') ?></th>
            <th scope="col"><?= $this->Paginator->sort('status') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created', 'Created On') ?></th>
            <th scope="col"><?= $this->Paginator->sort('completed', 'Completed On') ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?= $campaign->id ?></td>

            <td>
                <?= $this->Html->link($campaign->subject, ['action'=>'view',$campaign->id]) ?>
            </td>

            <td><?= $campaign->sender ?></td>

            <td><?= $this->Html->link($campaign->group->title , ['controller'=>'groups','action'=>'view',$campaign->group->id])?></td>

            <td><?= $campaign->template_id == 0 ? __("None") :
                    $this->Html->link($campaign->template->name,['controller'=>'templates','action'=>'view',$campaign->template->id])  ?></td>

            <td>
                <?php $status = $this->App->campaignStatusToString($campaign->status) ?>
                <span class="badge  badge-<?= $status['color'] ?>"><?= $status['status'] ?></span>
            </td>

            <td><?= $campaign->created ?></td>

            <td><?= $campaign->completed ?></td>
        </tr>
    </tbody>
</table>

<div class="panel-default panel">
    <div class="panel-heading">
        <h3 class="panel-title">
            <i class="fa fa-file-code-o"></i> <?= __('Contents');?>
        </h3>
    </div>
    <div class="panel-body">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#contentHtml">HTML</a>
            </li>
            <li>
                <a data-toggle="tab" href="#contentSource">Source</a>
            </li>
            <li>
                <a data-toggle="tab" href="#contentPreview">Preview</a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="contentHtml" class="tab-pane fade in active padding-top-5">
                <?= $campaign->contents; ?>
            </div>
            <div id="contentSource" class="tab-pane fade padding-top-5">
                <?= $this->Text->autoParagraph(h($campaign->contents)); ?>
            </div>
            <div id="contentPreview" class="tab-pane fade padding-top-5">
                <?= $this->Html->link("<i class='fa fa-eye'></i> ".__('Preview'), ['action'=>'preview',$campaign->id], ['class'=>'btn btn-info','escape'=>false,'target'=>'_blank','onclick'=>"return !window.open(this.href, 'Preview', 'width=800,height=600')"]) ?>
            </div>
        </div>
    </div>
</div>


<?php if($campaign->status == 1 ):?>
<div class="panel panel-info">
    <div class="panel-heading clearfix">
        <h3 class="panel-title pull-left"><i class="fa fa-gear"></i> Start Sending</h3>
    </div>
    <div class="panel-body">
        <div class="alert alert-warning">
            <p><i class="fa fa-warning"></i>
                <?= __('Campaign cannot be modified once you started it. If you want to make some changes do them now and then come back here to start sending the campaign')?>
            </p>
        </div>
        <div class="pull-right">
            <?= $this->Form->create(null, ['id'=>'startCampain']) ?>
            <button type="submit"  id="startCampaignBtn" class="btn btn-primary pbtn">
                <i class='fa fa-check'></i> <?=__('Start The Campaign')?>
            </button>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>
<?php endif;?>