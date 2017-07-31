<?php /* Smarty version 2.6.20, created on 2017-01-04 14:54:38
         compiled from D:%5Cphpstudy%5CWWW%5Cerp_wms%5Capplication%5Ctemplates/admin/test2.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'D:\\phpstudy\\WWW\\erp_wms\\application\\templates/admin/test2.html', 6, false),)), $this); ?>
<html>
   <head>
       <title>form————test</title>
   </head>
    <body>
    <form action='<?php echo ((is_array($_tmp="Test/test2")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
' method="post">
        <?php if (! empty ( $this->_tpl_vars['info'] )): ?>
            <h2><?php echo $this->_tpl_vars['info']; ?>
</h2>
        <?php endif; ?>
        <h5>Username</h5>
        <input type="text" name="username" value="" size="50" />

        <h5>Password</h5>
        <input type="text" name="password" value="" size="50" />

        <h5>Password Confirm</h5>
        <input type="text" name="passconf" value="" size="50" />

        <h5>Email Address</h5>
        <input type="text" name="email" value="" size="50" />

        <div><input type="submit" value="Submit" /></div>
    </form>
    </body>
</html>