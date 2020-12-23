<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="index3.html" class="brand-link">
		<img src="<?= base_url() ?>public/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">AdminLTE 3</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?= base_url() ?>public/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block"><?= $user->first_name . ' ' . $user->last_name ?></a>
			</div>
		</div> <!-- /.user-panel -->

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Nav Header -->
				<li class="nav-item has-treeview">
					<a href="<?= base_url('index.php/brand') ?>" class="nav-link">
						<i class="nav-icon fas fa-tags"></i>
						<p>
							Brands
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview" style="display: none;">
						<li class="nav-item">
							<a href="<?= base_url('index.php/brand/create') ?>" class="nav-link">
								<i class="nav-icon fas fa-plus"></i>
								<p>Add</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('index.php/brand') ?>" class="nav-link">
								<i class="nav-icon far fa-eye"></i>
								<p>List</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item has-treeview">
					<a href="<?= base_url('index.php/category') ?>" class="nav-link">
						<i class="nav-icon fas fa-bars"></i>
						<p>
							Categories
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview" style="display: none;">
						<li class="nav-item">
							<a href="<?= base_url('index.php/category/create') ?>" class="nav-link">
								<i class="nav-icon fas fa-plus"></i>
								<p>Add</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('index.php/category') ?>" class="nav-link">
								<i class="nav-icon far fa-eye"></i>
								<p>List</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item has-treeview">
					<a href="<?= base_url('index.php/subcategory') ?>" class="nav-link">
						<i class="nav-icon fas fa-stream"></i>
						<p>
							Subcategories
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview" style="display: none;">
						<li class="nav-item">
							<a href="<?= base_url('index.php/subcategory/create') ?>" class="nav-link">
								<i class="nav-icon fas fa-plus"></i>
								<p>Add</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('index.php/subcategory') ?>" class="nav-link">
								<i class="nav-icon far fa-eye"></i>
								<p>List</p>
							</a>
						</li>
					</ul>
				</li>

				<li class="nav-item has-treeview">
					<a href="<?= base_url('index.php/product') ?>" class="nav-link">
						<i class="nav-icon fas fa-box-open"></i>
						<p>
							Products
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview" style="display: none;">
						<li class="nav-item">
							<a href="<?= base_url('index.php/product/create') ?>" class="nav-link">
								<i class="nav-icon fas fa-plus"></i>
								<p>Add</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('index.php/product') ?>" class="nav-link">
								<i class="nav-icon far fa-eye"></i>
								<p>List</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item has-treeview">
					<a href="<?= base_url('index.php/customer') ?>" class="nav-link">
						<i class="nav-icon fas fa-users"></i>
						<p>
							Customers
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview" style="display: none;">
						<li class="nav-item">
							<a href="<?= base_url('index.php/customer/create') ?>" class="nav-link">
								<i class="nav-icon fas fa-plus"></i>
								<p>Add</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('index.php/customer') ?>" class="nav-link">
								<i class="nav-icon far fa-eye"></i>
								<p>List</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('index.php/sale') ?>" class="nav-link">
						<i class="nav-icon fas fa-money-check-alt"></i>
						<p>
							Sales
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('index.php/sale/list') ?>" class="nav-link">
						<i class="nav-icon fas fa-list"></i>
						<p>
							Sales List
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('index.php/refund') ?>" class="nav-link">
						<i class=" nav-icon fas fa-exchange-alt"></i>
						<p>
							Refund
						</p>
					</a>
				</li>
				<!-- /.examples -->
			</ul>
		</nav> <!-- /.sidebar-menu -->
	</div> <!-- /.sidebar -->
</aside>