<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Cakephp NewsLetter</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <?= $this->Html->link(__('Mailing Lists'),['controller'=>'groups']) ?>
                </li>
                <li>
                    <?= $this->Html->link(__('Subscribers'),['controller'=>'subscribers']) ?>
                </li>

                <li>
                    <?= $this->Html->link(__('Campaigns'),['controller'=>'campaigns']) ?>
                </li>
                <li>
                    <?= $this->Html->link(__('Templates'),['controller'=>'templates']) ?>
                </li>

                <li>
                    <?= $this->Html->link(__('Back To Site'),['controller'=>'pages','action'=>'display','plugin'=>false]) ?>
                </li>

            </ul>
        </div>
    </div>
</nav>