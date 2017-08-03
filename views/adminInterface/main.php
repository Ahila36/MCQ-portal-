<!DOCTYPE html>
<html lang="en" data-ng-app="mainApp">
    <head>
        <meta charset='utf-8'>
        <title>Manage MCQ quiz </title>

        <!--        angular scripts -->
        <script src="<?php echo(JS . 'angular.min.js'); ?>"></script>
        <script src="<?php echo(JS . 'angular-route.min.js'); ?>"></script>
        <script src="<?php echo(JS . 'jquery.js'); ?>"></script>
        <script src="<?php echo(JS . 'bootstrap.min.js'); ?>"></script>

        <!--        load CSS files-->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link href="<?php echo(CSS . 'loginStyle.css'); ?>" rel="stylesheet">

        <!--        the JS file which contains all controls of angular-->
        <script src="<?php echo(ANGULAR . 'main_ang.js'); ?>"></script>
        <script src="<?php echo(ANGULAR . 'admin_quiz_ang.js'); ?>"></script>
        <script src="<?php echo(ANGULAR . 'admin_question_ang.js'); ?>"></script>
        <script src="<?php echo(ANGULAR . 'admin_login_ang.js'); ?>"></script>
        <script src="<?php echo(ANGULAR . 'admin_result_ang.js'); ?>"></script>
        <script src="<?php echo(ANGULAR . 'user_quiz_ang.js'); ?>"></script>
        <script src="<?php echo(ANGULAR . 'user_question_ang.js'); ?>"></script>
        <script src="<?php echo(ANGULAR . 'user_result_ang.js'); ?>"></script>

    <div ng-view>
        <!--        all the partial views goes here-->
    </div>
</body>
</html>



