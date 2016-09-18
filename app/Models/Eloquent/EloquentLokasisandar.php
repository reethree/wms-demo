<?php
namespace App\Models\Eloquent;

class EloquentLokasisandar {
 
  /**
   * Lokasisandar Eloquent Model
   *
   * @var  Lokasisandar
   *
   */
    protected $Lokasisandar;
 
    public function __construct()
    {
        $this->Lokasisandar = new \App\Models\Lokasisandar();
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
//        $this->Lokasisandar->create($data);
        $this->Lokasisandar->insertGetId($data);
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Lokasi Sandar successfully saved!'));
    }
 
    /**
     * Updates an existing roles
     *
     * @param  int $id Lokasisandar id
     * @param  array $data
     * 	An array as follows: array('name'=>$name, 'description'=>$description, 'author'=>$author, 'publisher'=>$publisher, 'language'=>$language, 'length'=>$length, 'asin'=>$asin);
     *
     * @return  boolean
     */
    public function update($id, array $data)
    {
      $Lokasisandar = $this->Lokasisandar->find($id);
      $data['UID'] = \Auth::getUser()->name;
      
      foreach ($data as $key => $value)
      {
        $Lokasisandar->$key = $value;
      }
 
      try
      {
        $Lokasisandar->save();
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Lokasi Sandar successfully updated!'));
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
        $this->Lokasisandar->destroy($id);
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Lokasi Sandar successfully deleted!'));
    }
}
