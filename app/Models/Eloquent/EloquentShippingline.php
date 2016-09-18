<?php
namespace App\Models\Eloquent;

class EloquentShippingline {
 
  /**
   * Shippingline Eloquent Model
   *
   * @var  Shippingline
   *
   */
    protected $Shippingline;
 
    public function __construct()
    {
        $this->Shippingline = new \App\Models\Shippingline();
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
//        $this->Shippingline->create($data);
        $this->Shippingline->insertGetId($data);
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Shippingline successfully saved!'));
    }
 
    /**
     * Updates an existing roles
     *
     * @param  int $id Shippingline id
     * @param  array $data
     * 	An array as follows: array('name'=>$name, 'description'=>$description, 'author'=>$author, 'publisher'=>$publisher, 'language'=>$language, 'length'=>$length, 'asin'=>$asin);
     *
     * @return  boolean
     */
    public function update($id, array $data)
    {
      $Shippingline = $this->Shippingline->find($id);
      $data['uid'] = \Auth::getUser()->name;

      foreach ($data as $key => $value)
      {
        $Shippingline->$key = $value;
      }

      try
      {
        $Shippingline->save();
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Shippingline successfully updated!'));
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
        $this->Shippingline->destroy($id);
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Shippingline successfully deleted!'));
    }
}
