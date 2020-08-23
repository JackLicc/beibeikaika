<html>
<head>
    <title>App Name - <?php echo $__env->yieldContent('title'); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vant@2.9/lib/index.css"/>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
</head>
<body>
<?php $__env->startSection('header'); ?>
    <!-- his is the master header. -->
<?php echo $__env->yieldSection(); ?>

<div class="container">
    <?php echo $__env->yieldContent('content'); ?>
</div>

<?php $__env->startSection('footer'); ?>
    <!-- his is the master footer. -->
<?php echo $__env->yieldSection(); ?>
<!-- import script -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vant@2.9/lib/vant.min.js"></script>
</body>
</html>
<?php /**PATH /home/vagrant/code/beibeikaika/resources/views/layouts/app.blade.php ENDPATH**/ ?>