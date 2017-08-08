<h1 class="page-header">List Details</h1>


<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title"><?= $group->title ?></h4>
    </div>
    <div class="panel-body">

        <ul class="list-group">
            <li class="list-group-item"><strong>Id: </strong> <?= $group->id ?></li>
            <li class="list-group-item"><strong>Created: </strong> <?= $group->created ?></li>
            <li class="list-group-item"><strong>Description: </strong> <?= $group->description ?></li>
        </ul>
    </div>
</div>


<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left"><?= __('Subscribers [{0}]', $subscribers->count()) ?></h4>
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-gear"></i> <?= __('Actions') ?></button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li><?= $this->Html->link("<i class='fa fa-plus'></i> ". __('Add Subscriber'), ['action'=>'addSubscriber', $group->id], ['escape'=>false]) ?></li>
                <li><?= $this->Html->link("<i class='fa fa-refresh'></i> ".__('Import Subscribers'), ['action'=>'importSubscriber', $group->id], ['escape'=>false]) ?></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">

        <table class="table table-striped"">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('email') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($subscribers as $data) :?>
            <tr>
                <td><?= $data->id ?></td>
                <td>
                    <?= $this->Html->link($data->subscriber->name, ['controller'=>'subscribers','action'=>'view',$data->subscriber->id]) ?>
                </td>
                <td>
                    <?= $this->Html->link($data->subscriber->email, ['controller'=>'subscribers','action'=>'view',$data->subscriber->id]) ?>
                </td>
                <td>
                    <?=
                    $this->Form->postLink("<i class='fa fa-trash'></i> ".__('Remove From List'),
                        ['action'=>'removeFromList', $data->subscriber->id, $group->id],
                        ['class'=>'btn btn-danger btn-sm','escape'=>false,'confirm'=>'Are you sure you want to remove this subsciber from the list'])
                    ?>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>

        </table>

    </div>
</div>


