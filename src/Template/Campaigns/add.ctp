<h1 class="page-header"><?= __('New Campaign') ?></h1>


<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;"><?= __('Create new campaign') ?></h4>
    </div>
    <div class="panel-body">
        <?= $this->Form->create($campaign,['id'=>'campaign-form']) ?>
            <div>
                <h3><?=__('Contents')?></h3>
                <section>
                    <div class="form-group">
                        <label><?= __('Title')?></label>
                        <?= $this->Form->input('subject',['id'=>'subject','div'=>false,'label'=>false,'class'=>'form-control', 'placeholder'=>__('Campaign Title')]); ?>
                    </div>
                    <div class="form-group">
                        <label><?= __('From Name')?></label>
                        <?= $this->Form->input('sender_name',['id'=>'sender_name','div'=>false,'label'=>false,'class'=>'form-control', 'placeholder'=>__('ABC NewsLetter')]); ?>
                    </div>
                    <div class="form-group">
                        <label><?= __('From Address')?></label>
                        <?= $this->Form->input('sender_email',['id'=>'sender_email','div'=>false,'label'=>false,'class'=>'form-control', 'placeholder'=>__('email@example.com')]); ?>
                    </div>
                    <div class="form-group">
                        <label><?= __('Contents')?></label>
                        <?= $this->Form->input('contents',['id'=>'contents','div'=>false,'label'=>false,'class'=>'form-control','rows'=>15]); ?>
                    </div>
                </section>

                <h3><?=__('Mailing List')?></h3>
                <section>
                    <div class="form-group">
                        <label><?=__('Mailing List')?></label>
                        <?= $this->Form->input('group_id',['id'=>'group_id', 'empty'=>__('Select a mailing list'),'div'=>false,'label'=>false,'class'=>'form-control','required']); ?>
                    </div>
                </section>

                <h3><?=__('Template')?></h3>
                <section>
                    <div class="form-group">
                        <label><?=__('Template')?></label>
                        <?= $this->Form->input('template_id',['id'=>'template_id', 'empty'=>__('Select a template'),'div'=>false,'label'=>false,'class'=>'form-control']); ?>
                    </div>
                </section>

                <h3><?= __('Finish')?></h3>
                <section>
                    <h3><?=__('Review your settings before submit')?></h3>
                    <hr/>
                    <div class="col col-md-9">
                        <ul>
                            <li><?= _('Title')?>: <span id="selectedTitle"></span></li>
                            <li><?= _('From:')?> <span id="selectedFrom"></span></li>
                            <li><?= _('Selected Mailing List')?>: <span id="selectedList"></span></li>
                            <li><?= _('Selected Template')?>: <span id="selectedTemplate"></span></li>
                            <li><?= _('Contents')?>: <div id="selectedContents"></div></li>
                        </ul>
                    </div>
                </section>

            </div>

        <?= $this->Form->end() ?>
    </div>

</div>

<?= $this->Html->script('Newsletter.campaign',['block'=>'scriptBottom']); ?>

