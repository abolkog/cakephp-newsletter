<h1 class="page-header"><?= __('Mailing Lists') ?></h1>


<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;"></h4>
        <div class="btn-group pull-right">
            <?= $this->Html->link(__('New List'), ['action'=>'add'], ['class'=>'btn btn-default btn-sm'])  ?>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped"">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($groups as $list) :?>
                    <tr>
                        <td><?= $list->id ?></td>
                        <td>
                            <?= $this->Html->link($list->title, ['action'=>'view',$list->id]) ?>
                        </td>
                        <td><?= $list->created ?></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="listActions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <?= __('Actions') ?>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="listActions">
                                    <li><?= $this->Html->link(__('View'),['action'=>'view',$list->id]) ?></li>
                                    <li><?= $this->Html->link(__('Edit'),['action'=>'edit',$list->id]) ?></li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <?= $this->Form->postLink(__('Delete'),['action'=>'delete', $list->id],['confirm'=>'Are you sure you want to delete this list?']) ?>
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
