<div class="floatR">

	<?php if($Auth->user('id')): ?>
		<div class="login">
				<div class="account" id="account">
	                    <span class="name"><i class="ion-person"></i><?php echo $Auth->user('prenom'); ?> <?php echo $Auth->user('nom'); ?></span>
	                    <i class="ion-chevron-down" id='ico-account'></i>
	            </div>
	            <div class="topmenu hide" id="topbar-menu">
	            	<?php if($Auth->user('role') == 'admin'): ?>
		                <a href="profile.php?id=<?php echo $Auth->user('id'); ?>"><i class="ion-person"></i> Mon compte</a>
		                <a href="admin/index.php"><i class="ion-briefcase"></i> Administration</a>
		                <a href="class/logout.php"><i class="ion-power"></i> Se deconnecter</a>
		            <?php elseif($Auth->user('role') == 'contrib'): ?>
		                <a href="profile.php?id=<?php echo $Auth->user('id'); ?>"><i class="ion-person"></i> Mon compte</a>
		                <a href="admin/index.php"><i class="ion-briefcase"></i> Administration</a>
		                <a href="class/logout.php"><i class="ion-power"></i> Se deconnecter</a>
		            <?php else: ?>
		            	<a href="profile.php?id=<?php echo $Auth->user('id'); ?>"><i class="ion-person"></i> Mon compte</a>
		            	<a href="class/logout.php"><i class="ion-power"></i> Se deconnecter</a>
		            <?php endif; ?>
            	</div>
	    </div>
    <?php else: ?>
    	<div class="login">
    		<a href="connexion.php" class="btn_connect"><i class="ion-power"></i>&nbsp;&nbsp;<span>CONNEXION</span></a>
    	</div>
    <?php endif; ?>
</div>