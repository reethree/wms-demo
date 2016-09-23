<?php
namespace App\Models\Eloquent;

class EloquentContainer {
 
  /**
   * Container Eloquent Model
   *
   * @var  Container
   *
   */
    protected $Container;
 
    public function __construct()
    {
        $this->Container = new \App\Models\Container();
    }
 
     /**
     * Creates a new roles
     *
     * @param  array $data
     * 	An array as follows: array('name'=>$name, 'description'=>$description, 'author'=>$author, 'publisher'=>$publisher, 'language'=>$language, 'length'=>$length, 'asin'=>$asin);
     *
     * @return  boolean
     */
    public function create(array $data, $joborder_id)
    {
        $data['TGLENTRY'] = date('Y-m-d H:i:s');
        $data['UID'] = \Auth::getUser()->name;
        
        // COPY JOBORDER
        $joborder = \App\Models\Joborder::findOrFail($joborder_id);
        
        $data['TEUS'] = $data['SIZE'] / 20;
        $data['TJOBORDER_FK'] = $joborder->TJOBORDER_PK;
        $data['NoJob'] = $joborder->NOJOBORDER;
        $data['NO_BC11'] = $joborder->NO_BC11;
        $data['TGL_BC11'] = $joborder->TGL_BC11;
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
        
        try
        {
  //        $this->Container->create($data);
          $this->Container->insertGetId($data);
        }
        catch (Exception $e)
        {
          return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
        }

        return json_encode(array('success' => true, 'message' => 'Container successfully saved!'));
    }
 
    /**
     * Updates an existing roles
     *
     * @param  int $id Container id
     * @param  array $data
     * 	An array as follows: array('name'=>$name, 'description'=>$description, 'author'=>$author, 'publisher'=>$publisher, 'language'=>$language, 'length'=>$length, 'asin'=>$asin);
     *
     * @return  boolean
     */
    public function update($id, array $data, $joborder_id)
    {
      $Container = $this->Container->find($id);
      
      $data['TEUS'] = $data['SIZE'] / 20;
      $data['UID'] = \Auth::getUser()->name;
      
      foreach ($data as $key => $value)
      {
        $Container->$key = $value;
      }
 
      try
      {
        $Container->save();
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Container successfully updated!'));
    }
 
    /**
     * Deletes an existing roles
     *
     * @param  int id
     *
     * @return  boolean
     */
    public function delete($id)
    {
      try
      {
        $this->Container->destroy($id);
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Container successfully deleted!'));
    }
}
