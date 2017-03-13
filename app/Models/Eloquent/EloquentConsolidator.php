<?php
namespace App\Models\Eloquent;

class EloquentConsolidator {
 
  /**
   * Consolidator Eloquent Model
   *
   * @var  Consolidator
   *
   */
    protected $Consolidator;
 
    public function __construct()
    {
        $this->Consolidator = new \App\Models\Consolidator();
        $this->Consolidator_Tarif = new \App\Models\ConsolidatorTarif();
    }
 
     /**
     * Creates a new roles
     *
     * @param  array $data
     * 	An array as follows: array('name'=>$name, 'description'=>$description, 'author'=>$author, 'publisher'=>$publisher, 'language'=>$language, 'length'=>$length, 'asin'=>$asin);
     *
     * @return  boolean
     */
    public function create(array $data)
    {

      try
      {
//        $this->Consolidator->create($data);
        $cData['NAMACONSOLIDATOR'] = $data['NAMACONSOLIDATOR'];
        $cData['ALAMAT'] = $data['ALAMAT'];
        $cData['NOTELP'] = $data['NOTELP'];
        $cData['CONTACTPERSON'] = $data['CONTACTPERSON'];
        $cData['NPWP'] = $data['NPWP'];
        $cData['UID'] = \Auth::getUser()->name;
        $consolidator_id = $this->Consolidator->insertGetId($cData);
        
//        unset($data['NAMACONSOLIDATOR'],$data['ALAMAT'],$data['NOTELP'],$data['CONTACTPERSON'],$data['NPWP']);
//        $data['TCONSOLIDATOR_FK'] = $consolidator_id;
//        $data['uid'] = \Auth::getUser()->name;
//        $this->Consolidator_Tarif->insertGetId($data);
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Consolidator successfully saved!'));
    }
 
    /**
     * Updates an existing roles
     *
     * @param  int $id Consolidator id
     * @param  array $data
     * 	An array as follows: array('name'=>$name, 'description'=>$description, 'author'=>$author, 'publisher'=>$publisher, 'language'=>$language, 'length'=>$length, 'asin'=>$asin);
     *
     * @return  boolean
     */
    public function update($id, array $data)
    {
//      $Consolidator = $this->Consolidator->find($id);
//      $data['UID'] = \Auth::getUser()->name;
//      
//      foreach ($data as $key => $value)
//      {
//        $Consolidator->$key = $value;
//      }
 
      try
      {
        $cData['NAMACONSOLIDATOR'] = $data['NAMACONSOLIDATOR'];
        $cData['ALAMAT'] = $data['ALAMAT'];
        $cData['NOTELP'] = $data['NOTELP'];
        $cData['CONTACTPERSON'] = $data['CONTACTPERSON'];
        $cData['NPWP'] = $data['NPWP'];
        $cData['UID'] = \Auth::getUser()->name;
        $this->Consolidator->where('TCONSOLIDATOR_PK', $id)->update($cData);
        
//        unset($data['NAMACONSOLIDATOR'],$data['ALAMAT'],$data['NOTELP'],$data['CONTACTPERSON'],$data['NPWP']);
//        $data['uid'] = \Auth::getUser()->name;
//        
//        $tarif = $this->Consolidator_Tarif->where('TCONSOLIDATOR_FK', $id)->first();
//        if($tarif){
//            $this->Consolidator_Tarif->where('TCONSOLIDATOR_FK', $id)->update($data);
//        }else{
//            $consolidator = $this->Consolidator->find($id);
//            $data['TCONSOLIDATOR_FK'] = $consolidator->TCONSOLIDATOR_PK;
//            $this->Consolidator_Tarif->insertGetId($data);
//        }
//        $Consolidator->save();
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Consolidator successfully updated!'));
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
        $this->Consolidator->destroy($id);
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Consolidator successfully deleted!'));
    }
}
