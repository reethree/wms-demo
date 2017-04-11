<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tcontainer';
    protected $primaryKey = 'TCONTAINER_PK';
    public $timestamps = false;
    
    public static function insertOrGet($no_cont, $size, $noseal, $jobid)
    {
        // Check Container
        $container = Container::where(array('TJOBORDER_FK' => $jobid, 'NOCONTAINER' => $no_cont))->first();
        if($container) {
            return $container;
        }else{
            // Insert New Container
            $data = array();
            $data['TGLENTRY'] = date('Y-m-d H:i:s');
            $data['UID'] = \Auth::getUser()->name;

            // COPY JOBORDER
            $joborder = \App\Models\Joborder::findOrFail($jobid);
            
            $data['NOCONTAINER'] = $no_cont;
            $data['SIZE'] = $size;
            $data['TEUS'] = $size / 20;
            $data['NO_SEAL'] = $noseal;
            $data['TJOBORDER_FK'] = $joborder->TJOBORDER_PK;
            $data['NoJob'] = $joborder->NOJOBORDER;
            $data['NO_BC11'] = $joborder->TNO_BC11;
            $data['TGL_BC11'] = $joborder->TTGL_BC11;
            $data['NO_PLP'] = $joborder->NO_PLP;
            $data['TGL_PLP'] = $joborder->TGL_PLP;
            $data['TCONSOLIDATOR_FK'] = $joborder->TCONSOLIDATOR_FK;
            $data['NAMACONSOLIDATOR'] = $joborder->NAMACONSOLIDATOR;
            $data['TLOKASISANDAR_FK'] = $joborder->TLOKASISANDAR_FK;
            $data['ETA'] = $joborder->ETA;
            $data['ETD'] = $joborder->ETD;
            $data['VESSEL'] = $joborder->VESSEL;
            $data['VOY'] = $joborder->VOY;
            $data['TPELABUHAN_FK'] = $joborder->TPELABUHAN_FK;
            $data['NAMAPELABUHAN'] = $joborder->NAMAPELABUHAN;
            $data['PEL_MUAT'] = $joborder->PEL_MUAT;
            $data['PEL_BONGKAR'] = $joborder->PEL_BONGKAR;
            $data['PEL_TRANSIT'] = $joborder->PEL_TRANSIT;
            $data['NOMBL'] = $joborder->NOMBL;
            $data['TGL_MASTER_BL'] = $joborder->TGL_MASTER_BL;
            $data['KD_TPS_ASAL'] = $joborder->KD_TPS_ASAL;
            $data['KD_TPS_TUJUAN'] = $joborder->GUDANG_TUJUAN;
            $data['CALL_SIGN'] = $joborder->CALLSIGN;
            
            $container_id = Container::insertGetId($data);
            
            $container = Container::find($container_id);
            
            return $container;
            
        }
    }

}

class Containercy extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tcontainercy';
    protected $primaryKey = 'TCONTAINER_PK';
    public $timestamps = false;

}
