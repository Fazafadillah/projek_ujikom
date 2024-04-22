<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PaketExport;

class paket extends Model
{
    use HasFactory;
    protected $table = 'jenis';
}
