<?php
namespace App\Models\Eloquent;

class EloquentPelabuhan {
 
  /**
   * Pelabuhan Eloquent Model
   *
   * @var  Pelabuhan
   *
   */
    protected $Pelabuhan;
 
    public function __construct()
    {
        $this->Pelabuhan = new \App\Models\Pelabuhan();
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
        $negara = \App\Models\Negara::find($data['NAMANEGARA']);
        $data['TNEGARA_FK'] = $negara['TNEGARA_PK'];
        $data['NAMANEGARA'] = $negara['NAMANEGARA'];
        $data['KODENEGARA'] = $negara['KODENEGARA'];
        
        $data['UID'] = \Auth::getUser()->name;
      try
      {
//        $this->Pelabuhan->create($data);
        $this->Pelabuhan->insertGetId($data);
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Pelabuhan successfully saved!'));
    }
 
    /**
     * Updates an existing roles
     *
     * @param  int $id Pelabuhan id
     * @param  array $data
     * 	An array as follows: array('name'=>$name, 'description'=>$description, 'author'=>$author, 'publisher'=>$publisher, 'language'=>$language, 'length'=>$length, 'asin'=>$asin);
     *
     * @return  boolean
     */
    public function update($id, array $data)
    {
      $Pelabuhan = $this->Pelabuhan->find($id);
      
      $negara = \App\Models\Negara::find($data['NAMANEGARA']);
      $data['TNEGARA_FK'] = $negara['TNEGARA_PK'];
      $data['NAMANEGARA'] = $negara['NAMANEGARA'];
      $data['KODENEGARA'] = $negara['KODENEGARA'];
        
      $data['UID'] = \Auth::getUser()->name;
      
      foreach ($data as $key => $value)
      {
        $Pelabuhan->$key = $value;
      }
 
      try
      {
        $Pelabuhan->save();
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Pelabuhan successfully updated!'));
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
        $this->Pelabuhan->destroy($id);
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Pelabuhan successfully deleted!'));
    }
}
