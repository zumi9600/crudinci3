  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Sales List</h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="<?= base_url('index.php/welcome') ?>">Home</a></li>
                          <li class="breadcrumb-item active">View</li>
                      </ol>
                  </div>
              </div>
          </div><!-- /.container-fluid -->
          <div class="row">
              <div class="col-12">
                  <a class="btn btn-success float-right" href="<?= base_url() . 'index.php/sale/create' ?>">
                      <i class="nav-icon fas fa-plus"></i>
                      Add
                  </a>
              </div>

          </div>
          <hr>
          <div class="row">
              <div class="col-md-12">
                  <?php
                    $success = $this->session->userdata('success');
                    if ($success != '') {
                    ?>
                      <div class="alert alert-success"><?php echo $success ?></div>
                  <?php
                    }
                    $failure = $this->session->userdata('failure');
                    if ($failure != '') {
                    ?>
                      <div class="alert alert-warning"><?php echo $failure ?></div>
                  <?php } ?>
              </div>
          </div>
      </section>

      <!-- Main content -->
      <section class="content">
          <!-- Total Sales -->
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Total Sales</h3>
                  <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                          <i class="fas fa-minus"></i></button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                          <i class="fas fa-times"></i></button>
                  </div>
              </div>
              <div class="card-body p-0">
                  <table class="table table-striped projects text-center">
                      <thead>
                          <tr>
                              <th style="width: 30%">
                                  Number of Sales
                              </th>
                              <th style="width: 30%">
                                  Sales Amount
                              </th>
                              <th style="width: 30%">
                                  Sales Quantity
                              </th>
                              <!-- <th style="width: 5%">
                                  Quantity
                              </th>
                              <th style="width: 10%">
                                  Amount Paid
                              </th>
                              <th style="width: 10%">
                                  Remaining Amount
                              </th>
                              <th style="width: 5%">
                                  Sold By
                              </th>
                              <th style="width: 4%">
                                  Status
                              </th>
                              <th style="width: 15%">
                                  Action
                              </th> -->
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td>
                                  <?= $total_sales; ?>
                              </td>
                              <td><?= $sale_total_amount ?></td>
                              <td><?= $sale_total_quantity ?></td>
                              <!-- <td>
                                  2 </td>
                              <td>
                                  218 </td>

                              <td>
                                  0 </td>
                              <td>
                                  MuhammadHamza </td>
                              <td class="project-state">
                                  <span class="badge badge-success"> sold</span>
                              </td>
                              <td class="project-actions ">
                                  <a class="btn btn-default btn-sm" target="_blank" href="http://localhost/crudinci3/index.php/sale/invoice/22">
                                      <i class="fas fa-print">
                                      </i>
                                      Print
                                  </a>
                              </td> -->
                      </tbody>
                  </table>
              </div>
              <!-- /.card-body -->
          </div>
          <!-- Default box -->
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">List</h3>
                  <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                          <i class="fas fa-minus"></i></button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                          <i class="fas fa-times"></i></button>
                  </div>
              </div>
              <div class="card-body p-0">
                  <table class="table table-striped projects text-center">
                      <thead>
                          <tr>
                              <th style="width: 0.5%">
                                  #
                              </th>
                              <th style="width: 5%">
                                  Customer
                              </th>
                              <th style="width: 10%">
                                  Amount
                              </th>
                              <th style="width: 5%">
                                  Quantity
                              </th>
                              <th style="width: 10%">
                                  Amount Paid
                              </th>
                              <th style="width: 10%">
                                  Remaining Amount
                              </th>
                              <th style="width: 5%">
                                  Sold By
                              </th>
                              <th style="width: 4%">
                                  Status
                              </th>
                              <th style="width: 15%">
                                  Action
                              </th>
                          </tr>
                          </th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php if (!empty($sales)) {
                                $no = '1';
                                foreach ($sales as $sale) { ?>
                                  <tr>
                                      <td>
                                          <?php echo $no++; ?>
                                      </td>
                                      <td>
                                          <?php echo $sale['customer_first_name'] . " " . $sale['customer_last_name'] ?>
                                          <br />
                                          <small>
                                              <?php echo $sale['time_created'] ?>
                                          </small>
                                      </td>
                                      <td>
                                          <?php echo $sale['sale_amount'] ?>
                                      </td>
                                      <td>
                                          <?php echo $sale['sale_quantity'] ?>
                                      </td>
                                      <td>
                                          <?php echo $sale['sale_amount_paid'] ?>
                                      </td>

                                      <td>
                                          <?php echo $sale['balance'] ?>
                                      </td>
                                      <td>
                                          <?php echo $sale['user_first_name'] . " " . $sale['user_last_name'] ?>
                                      </td>
                                      <td class="project-state">
                                          <span class="badge badge-success"> <?php echo $sale['sale_status'] ?></span>
                                      </td>
                                      <td class="project-actions ">
                                          <a class="btn btn-default btn-sm" target="_blank" href="<?= base_url() . 'index.php/sale/invoice/' . $sale['id'] ?>">
                                              <i class="fas fa-print">
                                              </i>
                                              Print
                                          </a>
                                      </td>
                                  </tr>
                              <?php }
                            } else { ?>
                              <tr>
                                  <td colspan="8">
                                      No sale found.
                                  </td>
                              </tr>
                          <?php } ?>
                      </tbody>
                  </table>
              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->