<?php
namespace App\Models\Eloquent;

class EloquentManifest {
 
  /**
   * Consolidator Eloquent Model
   *
   * @var  Consolidator
   *
   */
    protected $Manifest;
 
    public function __construct()
    {
        $this->Manifest = new \App\Models\Manifest();
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
        $cData['INVOICE'] = $data['INVOICE'];
        $this->Manifest->where('TMANIFEST_PK', $id)->update($cData);
        
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Manifest successfully updated!'));
    }

}
