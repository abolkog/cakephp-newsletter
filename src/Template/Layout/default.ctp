<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        CakePHP NewsLetter
    </title>
    <?= $this->Html->meta('icon') ?>

    <!-- BootStrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <?= $this->Html->css('Newsletter.jquery.steps') ?>
    <!-- jQuery -->
    <script  src="http://code.jquery.com/jquery-3.2.1.min.js"  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="  crossorigin="anonymous"></script>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>

</head>
<body style="padding-top: 70px;">

<!-- Navigation -->
<?= $this->element('layout/navbar') ?>
<!-- Navigation -->


<!-- Page Content -->
<div class="container">

    <div class="row">
        <div class="col-lg-12">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </div>


    <hr>

    <!-- Footer -->
    <?= $this->element('layout/footer') ?>
    <!-- Footer -->


</div>
<!-- /.container -->


<!-- Bootstrap Core JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- Plugins -->
<?= $this->Html->script('Newsletter.jquery.validate.min'); ?>
<?= $this->Html->script('Newsletter.jquery.steps.min'); ?>
<!-- Plugins -->

<!-- Scripts in views -->
<?= $this->fetch('scriptBottom'); ?>

</body>
</html>
