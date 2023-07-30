<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Model;
   
class Absensi extends Model
{
    const UPDATED_AT = 'created_at';

    protected $table="absensi_jadi";
    protected $guarded = ['id'];

    public function scopeSearch($q)
    {
        return empty(request()->search) ? $q : $q->where('absensi_jadi.nik', 'like', '%'.request()->search.'%')
                                                ->orWhere('karyawan.nama', "like", "%" . request()->search . "%")
                                                ->orWhere('absensi_jadi.tgl', "like", "%" . request()->search . "%");
    }

}