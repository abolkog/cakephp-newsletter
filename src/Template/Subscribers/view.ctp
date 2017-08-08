<h1 class="page-header">Subscriber Details</h1>


<div class="panel panel-default">
    <div class="panel-heading">

        <h4 class="panel-title"><?= $subscriber->name ?></h4>
    </div>
    <div class="panel-body">

        <ul class="list-group">
            <li class="list-group-item"><strong>Id: </strong> <?= $subscriber->id ?></li>
            <li class="list-group-item"><strong>Description: </strong> <?= $subscriber->email ?></li>
            <li class="list-group-item"><strong>Created: </strong> <?= $subscriber->created ?></li>
        </ul>
    </div>
</div>


<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <div class="btn-group pull-right">
            <?= $this->Html->link(__("<i class='fa fa-plus'></i> Add To List"), ['action'=>'addToList', $subscriber->id], ['class'=>'btn btn-default btn-sm', 'escape'=>false])  ?>
        </div>
        <h4 class="panel-title pull-left">Mailing Lists</h4>
    </div>
    <div class="panel-body">
        <table class="table table-striped"">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"><?= $this->Paginator->sort('title','List Name') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $counter = 0; foreach ($lists as $list):?>
                    <tr>
                        <td><?= ++$counter ?></td>
                        <td><?= $this->Html->link($list->group->title, ['controller'=>'groups', 'action'=>'view', $list->group->id]) ?></td>
                        <td>
                            <?=
                            $this->Form->postLink("<i class='fa fa-trash'></i> Remove From List",
                                ['action'=>'removeFromList', $subscriber->id, $list->group->id],
                                ['class'=>'btn btn-danger btn-sm','escape'=>false,'confirm'=>__('Are you sure you want to remove this subsciber from the list')])
                            ?>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>



