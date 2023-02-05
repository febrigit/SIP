<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    use SoftDeletes;

    protected $table = 'division';
    //


    // <option value="COP">CORPORATE SECRETARY</option>
    // <option value="INT">INTERNAL AUDIT</option>
    // <option value="ACC">ASSESSMENT & CONSULTATION</option>
    // <option value="LRN">LEARNING</option>
    // <option value="RCM">RESIDENCE & MICE</option>
    // <option value="FHC">FINANCE & HUMAN CAPITAL</option>
    // <option value="FEQ">FACILITY EQUIPMENT & QHSEE</option>
    // <option value="KMT">KNOWLEDGE MANAGEMENT</option>
}
