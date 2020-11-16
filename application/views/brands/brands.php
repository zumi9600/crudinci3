  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Brands</h1>
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
                  <a class="btn btn-success float-right" href="<?= base_url() . 'index.php/brand/create' ?>">
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

          <!-- Default box -->
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Brands</h3>

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
                                  ID
                              </th>
                              <th style="width: 15%">
                                  Name
                              </th>
                              <th style="width: 15%">
                                  Action
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php if (!empty($brands)) {
                                foreach ($brands as $brand) { ?>
                                  <tr>
                                      <td>
                                          <?php echo $brand['id'] ?>
                                      </td>
                                      <td>
                                          <a>
                                              <?php echo $brand['name'] ?>
                                          </a>
                                          <br />
                                          <small>
                                              <?php echo $brand['created_at'] ?>
                                          </small>
                                      </td>
                                      <td class="project-actions ">
                                          <!-- <a class="btn btn-primary btn-sm" href="#">
                                      <i class="fas fa-folder">
                                      </i>
                                      View
                                  </a> -->
                                          <a class="btn btn-info btn-sm" href="<?= base_url() . 'index.php/brand/edit/' . $brand['id'] ?>">
                                              <i class="fas fa-pencil-alt">
                                              </i>
                                              Edit
                                          </a>
                                          <a class="btn btn-danger btn-sm" href="<?= base_url() . 'index.php/brand/delete/' . $brand['id'] ?>">
                                              <i class="fas fa-trash">
                                              </i>
                                              Delete
                                          </a>
                                      </td>
                                  </tr>
                              <?php }
                            } else { ?>
                              <tr>
                                  <td colspan="8">
                                      Products not found.
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