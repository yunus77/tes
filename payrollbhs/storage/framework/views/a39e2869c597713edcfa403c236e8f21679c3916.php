

<?php $__env->startSection('title', 'Import Data Absensi'); ?>

<?php $__env->startSection('content'); ?>

    <?php
        $bulan = array ('KS', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
    ?>
    
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card mainbox">
                <div class="card-header">
                    <div class="pull-left">
                    Import Data Absensi Langsung dari REST API
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-sm btn-info" href="<?php echo e(route('absensi.index')); ?>"><span class="fa fa-chevron-left"></span> Back</a>
                    </div>
                </div>
                <div class="card-body mainbox-form">            

                    <form id="myform" action="<?php echo e(route('absensi.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">Tahun</label>
                            <div class="col-9">
                                <select class="form-select" name="tahun" required>
                                    <option value="<?php echo e(date('Y')-1); ?>"><?php echo e(date('Y')-1); ?></option>
                                    <option value="<?php echo e(date('Y')); ?>" selected><?php echo e(date('Y')); ?></option>
                                    <option value="<?php echo e(date('Y')+1); ?>"><?php echo e(date('Y')+1); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">Bulan</label>
                            <div class="col-9">
                                <select class="form-select" name="bulan" required>
                                    <option disable selected hidden></option>
                                    <?php $__currentLoopData = $bulan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nobulan => $namabulan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($nobulan!=0): ?>
                                            <option value="<?php echo e($nobulan); ?>" <?php if(date('m') == $nobulan): ?> selected <?php endif; ?>><?php echo e($namabulan); ?></option>
                                        <?php endif; ?>                                       
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">Karyawan</label>
                            <div class="col-9">
                                <select class="form-select" name="karyawan">
                                    <option value="all">Semua Karyawan</option>
                                    <?php $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($kary->nik); ?>"><?php echo e($kary->nik.' - '.$kary->nama); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <!-- <div class="p-125 row">
                            <label class="col-3 col-form-label">Tgl Start</label>
                            <div class="col-9">
                                <div class="input-group">
                                    <input type="text" name="date1" class="form-control start-date" placeholder="Tgl Start" required/>
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">Tgl End</label>
                            <div class="col-9">
                                <div class="input-group">                                    
                                    <input type="text" name="date2" class="form-control end-date" placeholder="Tgl End" required/>
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div> -->
                        
                        <div class="p-125 row">
                            <div class="col-9 offset-3">
                                <button type="submit" class="btn btn-success"> 
                                    <span class="fa fa-download"></span> Import
                                </button>
                                <span id="infoloading2" style="padding-bottom:5px;"></span>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive shadow-sm pt-4">
        <table class="table table-striped table-hover m-0">
            <thead>
                <tr>
                    <th class="nomor-urut">No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Info</th>
                    <th>Jam Kerja</th>
                    <th>Masuk</th>
                    <th>Pulang</th>
                    <th>Kerja</th>
                    <th>Jam Lebih</th> 
                    <th>Lembur</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                    $i=0;
                ?>
                <?php $__currentLoopData = $absensi_jadi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datae): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $exp = explode(":",$datae->selisih);
                        $is_jam = (intval($exp[0]) != 0) ? intval($exp[0])." Jam" : "";
                        $is_menit = (intval($exp[1]) != 0) ? intval($exp[1])." menit" : "";
                    ?>
                    <tr <?php if($datae->info == "MASUK"): ?> class="" <?php else: ?> class="table-danger" <?php endif; ?>>
                        <td class="tablecenter nomor-urut"><?php echo e(++$i); ?></td>
                        <td class="tablecenter"><?php echo e($datae->nik); ?></td>
                        <td class="tableleft"><?php echo e($datae->nama); ?></td>
                        <td class="tablecenter"><?php echo e($datae->tgl); ?></td>
                        <td class="tablecenter"><?php echo e($datae->info); ?></td>
                        <td class="tablecenter"><?php echo e(($datae->info == "MASUK") ? "08:00 - 17:00" : "-"); ?></td>
                        <td class="tablecenter"><?php echo e($datae->masuk); ?></td>
                        <td class="tablecenter"><?php echo e($datae->pulang); ?></td>
                        <td class="tablecenter"><?php echo e($datae->ct); ?></td>
                            <td class="tablecenter"><?php echo e($is_jam); ?> <?php echo e($is_menit); ?></td>
                        <td class="tablecenter"><?php echo e(($datae->lembur != 0) ? $datae->lembur ." Jam" : ""); ?></td>               
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           
            </tbody>
        </table>                     
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp816\htdocs\payrollbhs\resources\views/absensi/create.blade.php ENDPATH**/ ?>