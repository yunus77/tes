<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Model;
   
class Payroll extends Model
{
    const UPDATED_AT = 'created_at';

    protected $table="gaji";
    protected $guarded = ['id'];

    public function scopeSearch($q)
    {
        return empty(request()->search) ? $q : $q->where('gaji.nik', 'like', '%'.request()->search.'%')
                                                ->orWhere('karyawan.nama', "like", "%" . request()->search . "%")
                                                ->orWhere('gaji.tahun', "like", "%" . request()->search . "%")
                                                ->orWhere('gaji.bulan', "like", "%" . request()->search . "%");
    }

}