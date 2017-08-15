# Newsletter plugin for CakePHP

This plugins adds a basic News Letter functionality to your CakePHP based application.

## Requirements

* CakePHP 3.x

## Installation

        composer require abolkog/Newsletter

* Enable the plugin within your config/bootstrap.php 

        Plugin::load('Newsletter', ['bootstrap' => false, 'routes' => true]);
        
* Run the following command in the CakePHP console to create the tables using the Migrations plugin:

        bin/cake migrations migrate -p newsletter
        


## Usage

### Displaying the Subscribe Form

* Load the **Newsletter component** in your controller
        
        $this->loadComponent('Newsletter.Newsletter');

* Display the form using the **SubscribeWidget** in your views

        <?= $this->SubscribeWidget->show(); ?>

### Example
in AppController.php

        namespace App\Controller;
        
        use Cake\Controller\Controller;
        use Cake\Event\Event;
        
        class AppController extends Controller
        {
        
            public function initialize()
            {
                parent::initialize();
                $this->loadComponent('Newsletter.Newsletter');
            }
        }

in footer.ctp

    <footer>
        <div class="row">
            <div class="col-md-3">
                <?= $this->SubscribeWidget->show(); ?>
            </div>
        </div>
    </footer>


### Accessing the admin area
* The easiest way is to add the following link to your navigation to access the admin area of the news letter

        <?= $this->Html->link('News Letter', ['controller'=>'groups','plugin'=>'Newsletter']) ?>

### Sender Shell
 The sender shell is used to send out emails as well as showing current emails in the queue
 
* To list all emails in the queue

        bin/cake newsletter.sender  show
         
* To start Processing the email queue

        bin/cake newsletter.sender  run
This run command will processs 50 emails per time. you can override it by passing the **limit** argument

        bin/cake newsletter.sender run -l 100

* To see all available commmands 
        
        bin/cake newsletter.sender

## License
Licensed under the [MIT](http://www.opensource.org/licenses/mit-license.php) License. Redistributions of the source code included in this repository must retain the copyright notice found in each file.