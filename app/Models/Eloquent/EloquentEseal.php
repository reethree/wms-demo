<?php
namespace App\Models\Eloquent;

class EloquentEseal {
 
  /**
   * Eseal Eloquent Model
   *
   * @var  Eseal
   *
   */
    protected $Eseal;
 
    public function __construct()
    {
        $this->Eseal = new \App\Models\Eseal();
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
//        $this->Eseal->create($data);
        $this->Eseal->insertGetId($data);
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Eseal successfully saved!'));
    }
 
    /**
     * Updates an existing roles
     *
     * @param  int $id Eseal id
     * @param  array $data
     * 	An array as follows: array('name'=>$name, 'description'=>$description, 'author'=>$author, 'publisher'=>$publisher, 'language'=>$language, 'length'=>$length, 'asin'=>$asin);
     *
     * @return  boolean
     */
    public function update($id, array $data)
    {
      $Eseal = $this->Eseal->find($id);
      $data['uid'] = \Auth::getUser()->name;
      
      foreach ($data as $key => $value)
      {
        $Eseal->$key = $value;
      }
 
      try
      {
        $Eseal->save();
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Eseal successfully updated!'));
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
        $this->Eseal->destroy($id);
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Eseal successfully deleted!'));
    }
}
