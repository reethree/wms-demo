<?php
namespace App\Models\Eloquent;

class EloquentPerusahaan {
 
  /**
   * Perusahaan Eloquent Model
   *
   * @var  Perusahaan
   *
   */
    protected $Perusahaan;
 
    public function __construct()
    {
        $this->Perusahaan = new \App\Models\Perusahaan();
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
//        $this->Perusahaan->create($data);
        $this->Perusahaan->insertGetId($data);
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Perusahaan successfully saved!'));
    }
 
    /**
     * Updates an existing roles
     *
     * @param  int $id Perusahaan id
     * @param  array $data
     * 	An array as follows: array('name'=>$name, 'description'=>$description, 'author'=>$author, 'publisher'=>$publisher, 'language'=>$language, 'length'=>$length, 'asin'=>$asin);
     *
     * @return  boolean
     */
    public function update($id, array $data)
    {
      $Perusahaan = $this->Perusahaan->find($id);
      $data['UID'] = \Auth::getUser()->name;
      
      foreach ($data as $key => $value)
      {
        $Perusahaan->$key = $value;
      }
 
      try
      {
        $Perusahaan->save();
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Perusahaan successfully updated!'));
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
        $this->Perusahaan->destroy($id);
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Perusahaan successfully deleted!'));
    }
}
