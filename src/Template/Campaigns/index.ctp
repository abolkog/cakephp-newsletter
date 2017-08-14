<h1 class="page-header"><?= __('Campaigns List') ?></h1>


<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;"></h4>
        <div class="btn-group pull-right">
            <?= $this->Html->link("<i class='fa fa-plus'></i> ".__('New Campaign'), ['action'=>'add'], ['class'=>'btn btn-default btn-sm','escape'=>false])  ?>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped"">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('subject') ?></th>
            <th scope="col"><?= $this->Paginator->sort('sender_name', 'From Name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('sender_email', 'From Email') ?></th>
            <th scope="col"><?= $this->Paginator->sort('group_id','Mailing List') ?></th>
            <th scope="col"><?= $this->Paginator->sort('template_id','Template') ?></th>
            <th scope="col"><?= $this->Paginator->sort('status') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created', 'Created On') ?></th>
            <th scope="col"><?= $this->Paginator->sort('completed', 'Completed On') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($campaigns as $campaign) :?>
            <tr>
                <td><?= $campaign->id ?></td>

                <td>
                    <?= $this->Html->link($campaign->subject, ['action'=>'view',$campaign->id]) ?>
                </td>

                <td><?= $campaign->sender_name ?></td>

                <td><?= $campaign->sender_email ?></td>

                <td><?= $this->Html->link($campaign->group->title , ['controller'=>'groups','action'=>'view',$campaign->group->id])?></td>

                <td><?= $campaign->template_id == 0 ? __("None") :
                        $this->Html->link($campaign->template->name,['controller'=>'templates','action'=>'view',$campaign->template->id])  ?></td>

                <td>
                    <?php $status = $this->App->campaignStatusToString($campaign->status) ?>
                    <span class="badge badge-<?= $status['color'] ?>"><?= $status['status'] ?></span>
                </td>

                <td><?= $campaign->created ?></td>

                <td><?= $campaign->completed ?></td>

                <td>
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="listActions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <?= __('Actions') ?>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="listActions">
                            <li><?= $this->Html->link("<i class='fa fa-eye'></i> ".__('View'),['action'=>'view',$campaign->id],['escape'=>false]) ?></li>
                            <li><?= $this->Html->link("<i class='fa fa-edit'></i> ".__('Edit'),['action'=>'edit',$campaign->id],['escape'=>false]) ?></li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <?= $this->Form->postLink("<i class='fa fa-copy'></i> ".__('Clone'),['action'=>'createClone', $campaign->id],['confirm'=>'Are you sure you want to clone this list?','escape'=>false]) ?>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <?= $this->Form->postLink("<i class='fa fa-trash'></i> ".__('Delete'),['action'=>'delete', $campaign->id],['confirm'=>'Are you sure you want to delete this list?','escape'=>false]) ?>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>

        </table>
    </div>
    <div class="panel-footer">
        <?= $this->element('paginator') ?>
    </div>
</div>
