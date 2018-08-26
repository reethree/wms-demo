<?php
namespace App\Models\Eloquent;

class EloquentRoles {
 
  /**
   * Roles Eloquent Model
   *
   * @var  Roles
   *
   */
    protected $Roles;
 
    public function __construct()
    {
        $this->Roles = new \App\Models\Roles();
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
      $data['slug'] = str_slug($data['name']);
              
      try
      {
        $this->Roles->create($data);
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Roles successfully saved!'));
    }
 
    /**
     * Updates an existing roles
     *
     * @param  int $id Roles id
     * @param  array $data
     * 	An array as follows: array('name'=>$name, 'description'=>$description, 'author'=>$author, 'publisher'=>$publisher, 'language'=>$language, 'length'=>$length, 'asin'=>$asin);
     *
     * @return  boolean
     */
    public function update($id, array $data)
    {
      $Roles = $this->Roles->find($id);
      
      $data['slug'] = str_slug($data['name']);
      
      foreach ($data as $key => $value)
      {
        $Roles->$key = $value;
      }
 
      try
      {
        $Roles->save();
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Roles successfully updated!'));
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
        $this->Roles->destroy($id);
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Roles successfully deleted!'));
    }
}
