<?= $this->load->view('/layout/metadata.php', '', true); ?>

<head>
	<title><?= $title; ?>
	</title>
</head>
<div class="content">
	<div class="wrapper">
		<!-- Main content -->
		<section class="content">
			<!-- title row -->
			<div class="row">
				<div class="col-12">
					<h2 class="page-header">
						<i class="fas fa-globe"></i> AdminLTE, Inc.
						<small class="float-right">Date: 2/10/2014</small>
					</h2>
				</div>
				<!-- /.col -->
			</div>
			<!-- info row -->
			<div class="row invoice-info">
				<div class="col-sm-4 invoice-col">
					From
					<?php if (!empty($sales)) {
						$no = '1';
						foreach ($sales as $sale) { ?>
							<address>
								<strong><?php echo $sale['user_first_name'] . $sale['user_last_name'] ?></strong><br />
								Email: <?= $sale['user_email'] ?>
							</address>

				</div>
				<!-- /.col -->
				<div class="col-sm-4 invoice-col">
					To
					<address>
						<strong><?php echo $sale['customer_first_name'] . $sale['customer_last_name'] ?></strong><br />
						<?= $sale['address'] ?><br />
						<?= $sale['phone'] ?><br />
						Email: <?= $sale['email'] ?>
					</address>
				</div>
				<!-- /.col -->
				<div class="col-sm-4 invoice-col">
					<b>Invoice <?= $sale['id'] ?></b><br />
					<b>Order ID:</b> <?= $sale['id'] ?><br />
					<b>Payment Due:</b> <?= $sale['time_created'] ?><br />
				</div>
		<?php }
					} ?>
		<!-- /.col -->
			</div>
			<!-- /.row -->

			<!-- Table row -->
			<div class="row">
				<div class="col-12 table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th style="width: 5%">Serial #</th>
								<th style="width: 15%">Product</th>
								<th style="width: 5%">Quantity</th>
								<th style="width: 10%">Price</th>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($products)) {
								$no = '1';
								foreach ($products as $product) { ?>
									<tr>
										<td><?= $no++ ?></td>
										<td><?= $product['product_name'] ?></td>
										<td><?= $product['product_quantity'] ?></td>
										<td><?= $product['actual_price'] ?></td>
									</tr>
							<?php }
							} ?>
						</tbody>
					</table>
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->

			<div class="row">
				<!-- accepted payments column -->
				<div class="col-6">
					<p class="lead">Payment Methods:</p>
					<img src="<?= base_url() ?>public/dist/img/credit/visa.png" alt="Visa" />
					<img src="<?= base_url() ?>public/dist/img/credit/mastercard.png" alt="Mastercard" />
					<img src="<?= base_url() ?>public/dist/img/credit/american-express.png" alt="American Express" />
					<img src="<?= base_url() ?>public/dist/img/credit/paypal2.png" alt="Paypal" />

					<p class="text-muted well well-sm shadow-none" style="margin-top: 10px">
						Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
						weebly ning heekya handango imeem plugg dopplr jibjab, movity
						jajah plickers sifteo edmodo ifttt zimbra.
					</p>
				</div>
				<!-- /.col -->
				<div class="col-6">
					<p class="lead">Amount Due 2/22/2014</p>

					<div class="table-responsive">
						<table class="table">
							<?php if (!empty($sales)) {
								$no = '1';
								foreach ($sales as $sale) { ?>
									<tr>
										<th style="width: 50%">Total Amount</th>
										<td><?= $sale['sale_amount'] ?></td>
									</tr>
									<tr>
										<th>Quantity</th>
										<td><?= $sale['sale_quantity'] ?></td>
									</tr>
									<tr>
										<th>Amount Paid</th>
										<td><?= $sale['sale_amount_paid'] ?></td>
									</tr>
									<tr>
										<th>Remaining Amount</th>
										<td><?= $sale['balance'] ?></td>
									</tr>
							<?php }
							} ?>
						</table>
					</div>
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</section>
		<!-- /.content -->
	</div>
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
	window.addEventListener("load", window.print());
</script>
</body>

</html>