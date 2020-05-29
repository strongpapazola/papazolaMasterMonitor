

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <div class="row">
              <a href="<?= base_url('refresh'); ?>" class="ml-2 mr-2 mt-3 d-sm-inline-block btn btn-sm btn-dark"><i class="fas fa-server mr-1 fa-sm text-white-50"></i> Refresh</a>

              <button type="button" class="float-right mr-1 mt-3 d-sm-inline-block btn btn-sm btn-dark" data-toggle="modal" data-target="#addserver"><i class="fas fa-server mr-1 fa-sm text-white-50"></i> Add Server</button>
            </div>
          </div>


<!-- Modal -->
<div class="modal fade" id="addserver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Server</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

<form action="<?= base_url('home/tambahserver'); ?>" method="POST">
  <div class="form-group">
    <label>Address Server</label>
    <input type="text" class="form-control" name="address" value="<?= set_value('address'); ?>" placeholder="localhost">
    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
  </div>
  <div class="form-group">
    <label>Http Request</label>
    <input type="text" class="form-control" name="requests" value="<?= set_value('requests'); ?>" placeholder="http">
  </div>
  <div class="form-group">
    <label>EndPoint</label>
    <input type="text" class="form-control" name="endpoint" value="papazolaMasterMonitor" placeholder="papazolaMasterMonitor">
  </div>
  <div class="form-group">
    <label>Secret Key</label>
    <input type="text" class="form-control" name="secret_key" value="<?= set_value('secret_key'); ?>" placeholder="dGVzdA==">
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
</form>
    </div>
  </div>
</div>



          <!-- Content Row -->
          <div class="row">
            <?php $i = 0; 

                foreach ($result as $res) :
                  // utils
                  $namaserver = $res['0'];
                  $tanggal = $res['1']['0'];
                  $query = $this->db->get('address', )->row_array();
                  // ram
                  if ( !isset($res['1']['1']['1']['0']) and !isset($res['1']['2']['1']['0']) and !isset($res['1']['3']) ) {
                    echo '<h1>error '.$namaserver.'</h1>';
                  }
                  $totalram = $res['1']['1']['1']['0'];
                  $usedram = $res['1']['1']['1']['1'];
                  $freeram = $res['1']['1']['1']['2'];
                  // disk
                  $filesystem = $res['1']['2']['1']['0'];
                  $totaldisk = $res['1']['2']['1']['1'];
                  $useddisk = $res['1']['2']['1']['2'];
                  $freedisk = $res['1']['2']['1']['3'];
                  $percendisk = $res['1']['2']['1']['4'];
                  // ssh 
                  $ssh = $res['1']['3'];
                  // portopen
                  $port = $res['1']['4'];
            ?>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                      <div class="text-xs font-weight-bold text-dark text-uppercase mb-2"><strong><?= $namaserver . '</strong> ['.$tanggal.']'; ?></div>
                  <div class="row align-items-center">
<!--                     <div class="col">
 -->                      <i class="fas fa-server fa-2x text-gray-300"></i><p>&nbsp&nbsp&nbsp</p>
<!--                     </div>
 -->                    <div class="col">
                      <div class="row">
                        <button type="button" data-toggle="modal" data-target="#port<?= $i; ?>" class="badge badge-dark">port</button>
                        <?php if ($ssh) { ?>
                          <button type="button" data-toggle="modal" data-target="#ssh<?= $i; ?>" class="badge badge-danger">ssh</button>
                        <?php } else { ?>
                          <button type="button" data-toggle="modal" data-target="#ssh<?= $i; ?>" class="badge badge-dark">ssh</button>
                        <?php } ?>
                        <button type="button" data-toggle="modal" data-target="#ram<?= $i; ?>" class="badge badge-dark">ram</button>
                        <button type="button" data-toggle="modal" data-target="#disk<?= $i; ?>" class="badge badge-dark">disk</button>
                        <a href="<?= 'ed'; ?>"></a>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="text-xs font-weight-bold text-dark text-uppercase mb-1 mt-3">Disk</div>
                          <div class="row no-gutters align-items-center">
                            <div class="col">
                              <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-dark" role="progressbar" style="width: <?= $percendisk; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
<!--                     <div class="col">
                    </div>
                    <div class="col">
                    </div>
                    <div class="col">
                    </div>
 -->
                    <!-- Modal -->
                    <div class="modal fade" id="port<?= $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Port Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <table class="table table-responsive">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Protocol</th>
                                  <th scope="col">Port</th>
                                  <th scope="col">PID</th>
                                </tr>
                              </thead>
                              <tbody>
                                    <?php 
                                    $numport = 1;
                                    foreach (range(0, count($port)-1) as $iport) :
                                      if ( $port[$iport]['0'] == 'tcp'){
                                        $portprotocol = $port[$iport]['0'];
                                        $portopen = $port[$iport]['1'];
                                        $portpid =  $port[$iport]['4'];
                                      } elseif ( $port[$iport]['0'] == 'tcp6'){
                                        $portprotocol = $port[$iport]['0'];
                                        $portopen = $port[$iport]['1'];
                                        $portpid =  $port[$iport]['4'];
                                      } elseif ( $port[$iport]['0'] == 'udp'){
                                        $portprotocol = $port[$iport]['0'];
                                        $portopen = $port[$iport]['1'];
                                        $portpid =  $port[$iport]['3'];
                                      } elseif ( $port[$iport]['0'] == 'udp6'){
                                        $portprotocol = $port[$iport]['0'];
                                        $portopen = $port[$iport]['1'];
                                        $portpid =  $port[$iport]['3'];
                                      } else {
                                        $portprotocol = $port[$iport]['0'];
                                        $portopen = '';
                                        $portpid = '';
                                      } ?>
                                <tr>
                                  <th scope="row"><?= $numport; ?></th>
                                  <td><?= $portprotocol; ?></td>
                                  <td><?= $portopen; ?></td>
                                  <td><?= $portpid; ?></td>
                                </tr>
                              <?php $numport = $numport + 1; ?>
                                    <?php endforeach; ?>
                              </tbody>
                            </table>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Modal -->

                    <div class="modal fade" id="ssh<?= $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">SSH Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            <table class="table table-responsive">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">User SSH</th>
                                  <th scope="col">Source SSH</th>
                                  <th scope="col">Stat SSH</th>
                                </tr>
                              </thead>
                              <tbody>

                            <?php if ( $ssh == null ) { 
                                $userssh = '';
                                $sourcessh = '';
                                $statssh = '';        
                              } else {
                                $numssh = 1;
                                foreach (range(0, count($ssh)-1) as $i) :
                                  $userssh = ($ssh[$i]['2']);
                                  $sourcessh = ($ssh[$i]['5']);
                                  $statssh = ($ssh[$i]['6']);
                               ?>
                                <tr>
                                  <th scope="row"><?= $numssh; ?></th>
                                  <td><?= $userssh; ?></td>
                                  <td><?= $sourcessh; ?></td>
                                  <td><?= $statssh; ?></td>
                                </tr>
                                <?php $numssh = $numssh + 1; ?>
                            <?php endforeach;
                            } ?>

                              </tbody>
                            </table>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade" id="ram<?= $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">RAM Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            <table class="table table-responsive">
                              <tbody>

                                <tr>
                                  <th>Total Ram : </th>
                                  <td><?= $totalram; ?></td>
                                </tr>
                                <tr>
                                  <th>Used Ram : </th>
                                  <td><?= $usedram; ?></td>
                                </tr>
                                <tr>
                                  <th>Free Ram : </th>
                                  <td><?= $freeram; ?></td>
                                </tr>

                              </tbody>
                            </table>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade" id="disk<?= $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Disk Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                  <table class="table table-responsive">
                    <tbody>

                      <tr>
                        <th>File System : </th>
                        <td><?= $filesystem; ?></td>
                      </tr>
                      <tr>
                        <th>Total Disk : </th>
                        <td><?= $totaldisk; ?></td>
                      </tr>
                      <tr>
                        <th>Used Disk : </th>
                        <td><?= $useddisk; ?></td>
                      </tr>
                      <tr>
                        <th>Free Disk : </th>
                        <td><?= $freedisk; ?></td>
                      </tr>
                      <tr>
                        <th>Percent Disk : </th>
                        <td><?= $percendisk; ?></td>
                      </tr>

                    </tbody>
                  </table>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
<?php $i = $i + 1; ?>
<?php endforeach; ?>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; strongpapazola <?= date('Y'); ?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>
