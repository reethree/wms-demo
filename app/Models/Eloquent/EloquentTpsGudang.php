<?php
namespace App\Models\Eloquent;

class EloquentTpsGudang {
 
  /**
   * TpsGudang Eloquent Model
   *
   * @var  TpsGudang
   *
   */
    protected $TpsGudang;
 
    public function __construct()
    {
        $this->TpsGudang = new \App\Models\TpsGudang();
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
//        $this->TpsGudang->create($data);
        $this->TpsGudang->insertGetId($data);
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'TpsGudang successfully saved!'));
    }
 
    /**
     * Updates an existing roles
     *
     * @param  int $id TpsGudang id
     * @param  array $data
     * 	An array as follows: array('name'=>$name, 'description'=>$description, 'author'=>$author, 'publisher'=>$publisher, 'language'=>$language, 'length'=>$length, 'asin'=>$asin);
     *
     * @return  boolean
     */
    public function update($id, array $data)
    {
      $TpsGudang = $this->TpsGudang->find($id);
      $data['UID'] = \Auth::getUser()->name;
      
      foreach ($data as $key => $value)
      {
        $TpsGudang->$key = $value;
      }
 
      try
      {
        $TpsGudang->save();
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Gudang successfully updated!'));
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
        $this->TpsGudang->destroy($id);
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Gudang successfully deleted!'));
    }
}
