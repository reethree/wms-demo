<?php
namespace App\Models\Eloquent;

class EloquentNegara {
 
  /**
   * Negara Eloquent Model
   *
   * @var  Negara
   *
   */
    protected $Negara;
 
    public function __construct()
    {
        $this->Negara = new \App\Models\Negara();
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
        $data['UID'] = \Auth::getUser()->name;
      try
      {
//        $this->Negara->create($data);
        $this->Negara->insertGetId($data);
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Negara successfully saved!'));
    }
 
    /**
     * Updates an existing roles
     *
     * @param  int $id Negara id
     * @param  array $data
     * 	An array as follows: array('name'=>$name, 'description'=>$description, 'author'=>$author, 'publisher'=>$publisher, 'language'=>$language, 'length'=>$length, 'asin'=>$asin);
     *
     * @return  boolean
     */
    public function update($id, array $data)
    {
      $Negara = $this->Negara->find($id);
      $data['UID'] = \Auth::getUser()->name;
      
      foreach ($data as $key => $value)
      {
        $Negara->$key = $value;
      }
 
      try
      {
        $Negara->save();
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Negara successfully updated!'));
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
        $this->Negara->destroy($id);
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Negara successfully deleted!'));
    }
}
