<?php  $subscriber = $this->SubscribeWidget->config('subscriber'); ?>

    <?= $this->Form->create($subscriber, ['url'=>['controller'=>'subscribers','action'=>'subscribe','plugin'=>'Newsletter']]) ?>
        <div class="form-group">
            <?= $this->Form->control('name', ['class'=>'form-control','required','placeholder'=>__('Your name')]) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('email', ['class'=>'form-control','required','type'=>'email','placeholder'=>__('Your email')]) ?>
        </div>
        <?= $this->Form->button(__('Submit'),['class'=>'btn btn-primary pbtn']) ?>
    <?= $this->Form->end(); ?>