  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Subcategories</h1>
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
                  <a class="btn btn-success float-right" href="<?= base_url() . 'index.php/subcategory/create' ?>">
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
                  <h3 class="card-title">Subcategories</h3>
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
                              <th style="width: 15%">
                                  Name
                              </th>
                              <th style="width: 15%">
                                  Brand
                              </th>
                              <th style="width: 15%">
                                  Category
                              </th>
                              <th style="width: 15%">
                                  Action
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php if (!empty($subcategories)) {
                                $no = '1';
                                foreach ($subcategories as $subcategory) { ?>
                                  <tr>
                                      <td>
                                          <?php echo $no++; ?>
                                      </td>
                                      <td>
                                          <a>
                                              <?php echo $subcategory['name'] ?>
                                          </a>
                                          <br />
                                          <small>
                                              <?php echo $subcategory['created_at'] ?>
                                          </small>
                                      </td>
                                      <td>
                                          <?php echo $subcategory['brand_name']; ?>
                                      </td>
                                      <td>
                                          <?php echo $subcategory['category_name']; ?>
                                      </td>
                                      <td class="project-actions ">
                                          <!-- <a class="btn btn-primary btn-sm" href="#">
                                      <i class="fas fa-folder">
                                      </i>
                                      View
                                  </a> -->
                                          <a class="btn btn-info btn-sm" href="<?= base_url() . 'index.php/subcategory/edit/' . $subcategory['id'] ?>">
                                              <i class="fas fa-pencil-alt">
                                              </i>
                                              Edit
                                          </a>
                                          <a class="btn btn-danger btn-sm" href="<?= base_url() . 'index.php/subcategory/delete/' . $subcategory['id'] ?>">
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
                                      Subcategories not found.
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