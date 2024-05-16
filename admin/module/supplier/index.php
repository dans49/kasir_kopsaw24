        <h4>Data Supplier</h4>
        <br />
        <?php if(isset($_GET['success-supplier'])){?>
        <div class="alert alert-success">
            <p>Edit Supplier Berhasil !</p>
        </div>
        <?php }?>
        <?php if(isset($_GET['success'])){?>
        <div class="alert alert-success">
            <p>Tambah Supplier Berhasil !</p>
        </div>
        <?php }?>
        <?php if(isset($_GET['remove'])){?>
        <div class="alert alert-danger">
            <p>Hapus Supplier Berhasil !</p>
        </div>
        <?php }?>
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-primary btn-md mr-2" data-toggle="modal" data-target="#myModal">
            <i class="fa fa-plus"></i> Insert Data</button>
        <a href="index.php?page=supplier" class="btn btn-success btn-md">
            <i class="fa fa-refresh"></i> Refresh Data</a>
        <div class="clearfix"></div>
        <br />
        <!-- view barang -->
        <div class="card card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm" id="example1">
                    <thead>
                        <tr style="background:#DFF0D8;color:#333;">
                            <th>No.</th>
                            <th>Nama Supplier</th>
                            <th>Nomor Telepon</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php 
							$hasil = $lihat -> supplier();
							$no=1;
							foreach($hasil as $isi){
						?>
                        <tr>
                            <td><?php echo $no;?></td>
                            <td><?php echo $isi['nama_supplier'];?></td>
                            <td><?php echo $isi['telepon'];?></td>
                            <td><?php echo $isi['alamat'];?></td>
                            <td><?php echo $isi['status'];?></td>
                            <td>
								<button type="button" class="btn btn-warning" data-toggle="modal"
									data-target="#myModalEdit<?php echo $isi['id_supplier'];?>">Edit</button>
								<div id="myModalEdit<?php echo $isi['id_supplier'];?>" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<!-- Modal content-->
										<div class="modal-content" style=" border-radius:0px;">
											<div class="modal-header" style="background:#285c64;color:#fff;">
												<h5 class="modal-title"><i class="fa fa-edit"></i> Edit Supplier</h5>
												<button type="button" class="close" data-dismiss="modal">&times;</button>
											</div>
											<form action="fungsi/edit/edit.php?supplier=edit" method="POST">
												<div class="modal-body">
													<table class="table table-striped bordered">
														<tr>
															<td>Nama Supplier</td>
															<td><input type="text" hidden value="<?php echo $isi['id_supplier'];?>" name="id_supplier2">
																<input type="text" value="<?php echo $isi['nama_supplier'];?>" required class="form-control"
																	name="nama_supplier2"></td>
														</tr>
														<tr>
															<td>Nomor Telepon</td>
															<td><input type="number" value="<?php echo $isi['telepon'];?>" required class="form-control"
																	name="telepon2"></td>
														</tr>
														<tr>
															<td>Alamat</td>
															<td><input type="text" value="<?php echo $isi['alamat'];?>" required class="form-control"
																	name="alamat2"></td>
														</tr>
														<tr>
															<td>Status</td>
															<td><select name="status2" class="form-control" required>
																	<option value="<?php echo $isi['status'];?>"><?php echo $isi['status'];?></option>
																	<?php if($isi['status']="AKTIF"){?> 
																	<option value="TIDAK AKTIF">TIDAK AKTIF</option>
																	<?php } else { ?> 
																	<option value="AKTIF">AKTIF</option>
																	<?php }?>
																</select></td>
														</tr>
													</table>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Update
														Data</button>
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div>
											</form>
										</div>
									</div>

								</div>
								<a href="fungsi/hapus/hapus.php?supplier=hapus&id=<?php echo $isi['id_supplier'];?>" 
									onclick="javascript:return confirm('Hapus Data Supplier ?');">
									<button class="btn btn-danger">Hapus</button>
								</a>
							</td>
						</tr>
								<?php $no++; }?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end view barang -->
        <!-- tambah barang MODALS-->
        <!-- Modal -->

        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content" style=" border-radius:0px;">
                    <div class="modal-header" style="background:#285c64;color:#fff;">
                        <h5 class="modal-title"><i class="fa fa-plus"></i> Tambah Supplier</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="fungsi/tambah/tambah.php?supplier=tambah" method="POST">
                        <div class="modal-body">
                            <table class="table table-striped bordered">
                                <tr>
                                    <td>Nama Supplier</td>
                                    <td><input type="text" placeholder="Masukan Nama Supplier" required class="form-control"
                                            name="nama_supplier"></td>
                                </tr>
                                <tr>
                                    <td>Nomor Telepon</td>
                                    <td><input type="number" placeholder="Masukan Nomor Telepon" required class="form-control"
                                            name="telepon"></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td><input type="text" placeholder="Masukan Alamat" required class="form-control"
                                            name="alamat"></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td><input type="text" readonly="readonly" required value="AKTIF" class="form-control" 
											name="status"></td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Insert
                                Data</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>