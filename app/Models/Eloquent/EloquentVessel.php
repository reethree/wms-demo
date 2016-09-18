<?php
namespace App\Models\Eloquent;

class EloquentVessel {
 
  /**
   * Vessel Eloquent Model
   *
   * @var  Vessel
   *
   */
    protected $Vessel;
 
    public function __construct()
    {
        $this->Vessel = new \App\Models\Vessel();
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
        $data['uid'] = \Auth::getUser()->name;
      try
      {
//        $this->Vessel->create($data);
        $this->Vessel->insertGetId($data);
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Vessel successfully saved!'));
    }
 
    /**
     * Updates an existing roles
     *
     * @param  int $id Vessel id
     * @param  array $data
     * 	An array as follows: array('name'=>$name, 'description'=>$description, 'author'=>$author, 'publisher'=>$publisher, 'language'=>$language, 'length'=>$length, 'asin'=>$asin);
     *
     * @return  boolean
     */
    public function update($id, array $data)
    {
      $Vessel = $this->Vessel->find($id);
      $data['uid'] = \Auth::getUser()->name;
      
      foreach ($data as $key => $value)
      {
        $Vessel->$key = $value;
      }
 
      try
      {
        $Vessel->save();
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Vessel successfully updated!'));
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
        $this->Vessel->destroy($id);
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Vessel successfully deleted!'));
    }
}
