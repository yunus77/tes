

<?php $__env->startSection('title', 'Absensi'); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-center">
        <div class="col-12">
            <p class="text-muted">
                <i class="fa fa-home px-1"></i> Home
                <i class="fa fa-angle-right px-2"></i> Absensi
            </p>
            <div class="d-flex pb-2"> 
                <div class="">
                    <form action="<?php echo e(route('absensi.index')); ?>" class="search-form" method="GET" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="<?php echo e(request()->search); ?>">
                            <button class="btn btn-outline-primary" type="submit">
                                <span class="fa fa-search"></span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="ms-auto">
                    <a class="btn btn-success" href="<?php echo e(route('absensi.create')); ?>"> 
                        <span class="fa fa-plus"></span> Impor Data Absensi
                    </a>     
                </div>
            </div>

            <div class="table-responsive shadow-sm">
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
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $absensi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datae): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                            <td class="tablecenter">
                                <?php if(Auth::user()->username == "staff"): ?>
                                    <form action="<?php echo e(route('absensi.destroy',$datae->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>                                                
                                        <button type="submit" class="btn btn-sm btn-danger"><span class="fa fa-times"></span> Delete</button>
                                    </form>
                                <?php endif; ?>    
                            </td>                   
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>                    
            </div>            
                        
            <div class="pt-2 ps-2">
                <?php echo $absensi->links(); ?>

            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp816\htdocs\payrollbhs\resources\views/absensi/index.blade.php ENDPATH**/ ?>