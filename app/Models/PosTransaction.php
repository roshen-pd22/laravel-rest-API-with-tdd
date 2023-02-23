<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// class PosTransaction extends Model
// {
//     use HasFactory;
// }
class PosTransaction extends Model
{
    protected $table = 'POS_TRANSACTIONS';

    protected $fillable = [
        'id_transazione',
        'num_tessera',
        'circuito',
        'progressivo_tessera',
        'saldo_punti',
        'importo_transazione',
        'tipo_transazione',
        'pos1',
        'pos1_saldo_euro',
        'pos2',
        'pos2_saldo_euro',
        'pos3',
        'pos3_saldo_euro',
        'pos4',
        'pos4_saldo_euro',
        'pos5',
        'pos5_saldo_euro',
        'giorno',
        'mese',
        'anno',
    ];
}