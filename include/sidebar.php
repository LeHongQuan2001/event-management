<!-- sidebar: style can be found in sidebar.less -->

<section class="sidebar">
  <ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
	<li class="treeview"> 
		<a href="<?php echo WEB_ROOT; ?>views/?v=DB"><i class="fa fa-calendar"></i><span>Calendar</span></a>
	</li>
	<?php 
	$type = $_SESSION['calendar_fd_user']['type'];
	if($type == 'admin' || $type =='giaovu') {
	?>
	<!-- <li class="treeview"> 
		<a href="<?php echo WEB_ROOT; ?>views/?v=HOLY"><i class="fa fa-plane"></i><span>Holidays</span></a>
	</li> -->
	<li class="treeview"> 
		<a href="<?php echo WEB_ROOT; ?>views/?v=USERS"><i class="fa fa-users"></i><span>Quản lý tài khoản</span></a>
	</li>
	<li class="treeview"> 
		<a href="<?php echo WEB_ROOT; ?>views/?v=GIAOVIEN"><i class="fa fa-users"></i><span>Quản lý giảng viên</span></a>
	</li>
	<?php
	}
	?>
    
  
	
	<li class="treeview"> 
		<a href="<?php echo WEB_ROOT; ?>views/?v=CLASS"><i class="fa-solid fa-school"></i><span>Quản lý lớp</span></a>
	</li>
	<li class="treeview"> 
		<a href="<?php echo WEB_ROOT; ?>views/?v=HOCKY"><i class="fa-solid fa-books"></i><span>Quản lý học kỳ</span></a>
	</li>
	<li class="treeview"> 
		<a href="<?php echo WEB_ROOT; ?>views/?v=HOCPHAN"><i class="fa-solid fa-book-open-cover"></i><span>Quản lý học phần</span></a>
	</li>
	
	<li class="treeview"> 
		<a href="<?php echo WEB_ROOT; ?>views/?v=LTT"><i class="fa fa-calendar"></i><span>Lịch giảng dạy</span></a>
	</li>
	<li class="treeview"> 
		<a href="<?php echo WEB_ROOT; ?>views/?v=kehoach"><i class="fa fa-calendar"></i><span>Ke hoach</span></a>
	</li>
	<li class="treeview"> 
		<a href="<?php echo WEB_ROOT; ?>views/?v=LIST"><i class="fa fa-newspaper-o"></i><span>Quản lý kế hoạch</span></a>
	</li>
	<li class="treeview"> 
		<a href="<?php echo WEB_ROOT; ?>views/?v=HOLY"><i class="fa-solid fa-book-open-cover"></i><span>Holydays</span></a>
	</li>

  </ul>
 
</section>
<!-- /.sidebar -->