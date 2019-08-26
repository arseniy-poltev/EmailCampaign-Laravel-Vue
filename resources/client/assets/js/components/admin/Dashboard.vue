<template>
  <section class="content-wrapper" style="min-height: 960px;">
    <section class="content-header">
      <h1>
        Dashboard
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="#">
            <i class="fas fa-tachometer-alt"></i> Home
          </a>
        </li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <section class="content" hidden>
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua">
              <i class="fas fa-bookmark"></i>
            </span>

            <div class="info-box-content">
              <span class="info-box-text">Messages</span>
              <span class="info-box-number">1,410</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green">
              <i class="fas fa-bookmark"></i>
            </span>

            <div class="info-box-content">
              <span class="info-box-text">Bookmarks</span>
              <span class="info-box-number">410</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow">
              <i class="fa fa-files-o"></i>
            </span>

            <div class="info-box-content">
              <span class="info-box-text">Uploads</span>
              <span class="info-box-number">13,648</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red">
              <i class="fa fa-star-o"></i>
            </span>

            <div class="info-box-content">
              <span class="info-box-text">Likes</span>
              <span class="info-box-number">93,139</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <div>
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Latest Orders</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove">
                <i class="fa fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Item</th>
                    <th>Status</th>
                    <th>Popularity</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <a href="pages/examples/invoice.html">OR9842</a>
                    </td>
                    <td>Call of Duty IV</td>
                    <td>
                      <span class="label label-success">Shipped</span>
                    </td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">
                        <canvas
                          width="34"
                          height="20"
                          style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"
                        ></canvas>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <a href="pages/examples/invoice.html">OR1848</a>
                    </td>
                    <td>Samsung Smart TV</td>
                    <td>
                      <span class="label label-warning">Pending</span>
                    </td>
                    <td>
                      <div class="sparkbar" data-color="#f39c12" data-height="20">
                        <canvas
                          width="34"
                          height="20"
                          style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"
                        ></canvas>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <a href="pages/examples/invoice.html">OR7429</a>
                    </td>
                    <td>iPhone 6 Plus</td>
                    <td>
                      <span class="label label-danger">Delivered</span>
                    </td>
                    <td>
                      <div class="sparkbar" data-color="#f56954" data-height="20">
                        <canvas
                          width="34"
                          height="20"
                          style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"
                        ></canvas>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <a href="pages/examples/invoice.html">OR7429</a>
                    </td>
                    <td>Samsung Smart TV</td>
                    <td>
                      <span class="label label-info">Processing</span>
                    </td>
                    <td>
                      <div class="sparkbar" data-color="#00c0ef" data-height="20">
                        <canvas
                          width="34"
                          height="20"
                          style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"
                        ></canvas>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <a href="pages/examples/invoice.html">OR1848</a>
                    </td>
                    <td>Samsung Smart TV</td>
                    <td>
                      <span class="label label-warning">Pending</span>
                    </td>
                    <td>
                      <div class="sparkbar" data-color="#f39c12" data-height="20">
                        <canvas
                          width="34"
                          height="20"
                          style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"
                        ></canvas>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <a href="pages/examples/invoice.html">OR7429</a>
                    </td>
                    <td>iPhone 6 Plus</td>
                    <td>
                      <span class="label label-danger">Delivered</span>
                    </td>
                    <td>
                      <div class="sparkbar" data-color="#f56954" data-height="20">
                        <canvas
                          width="34"
                          height="20"
                          style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"
                        ></canvas>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <a href="pages/examples/invoice.html">OR9842</a>
                    </td>
                    <td>Call of Duty IV</td>
                    <td>
                      <span class="label label-success">Shipped</span>
                    </td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">
                        <canvas
                          width="34"
                          height="20"
                          style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"
                        ></canvas>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix">
            <a
              href="javascript:void(0)"
              class="btn btn-sm btn-info btn-flat pull-left"
            >Place New Order</a>
            <a
              href="javascript:void(0)"
              class="btn btn-sm btn-default btn-flat pull-right"
            >View All Orders</a>
          </div>
          <!-- /.box-footer -->
        </div>
      </div>
    </section>
  </section>
</template>
<script>
export default {};
</script>

