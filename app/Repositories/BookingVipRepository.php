<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Consts;
use Session;
use Hash;
use DB;

class BookingVipRepository extends BaseRepository implements RepositoryInterface
{
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    // Get all instances of model
    public function getAll()
    {
        return $this->model->all();
    }
    // Get all instances of model
    public function getAllWith()
    {
        return $this->model->with('services_procedure')->get();
    }
    // Get all instances of model
    public function getAllOfWith($slug)
    {
        return $this->model->where('slug', '=', $slug)->with('services_procedure')->first();
    }
    public function getPrices($id){
        return DB::table('services_procedure')->where('service_id', '=', $id)->sum('prices');
    }
    // create a new record in the database
    public function create(array $data)
    {
        try {
            $service = $this->model->create($data);
            DB::commit();
            return $service;
        } catch (\Exception $exception) {
            // return false;
            DB::rollBack();
            dd($exception);
        }
    }

    // update record in the database
    public function update(array $data, $id = null)
    {
        $record = $this->find($id);
        return $record->update($data);
    }

    // remove record from the database
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    // show the record with the given id
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }

    // Custom......................

    public function getHistory($id = null){
        return $this->model->where('customer_id', '=', $id)->get();
    }

    public function getAllBooking(){
         return $this->model->with('customer')->get();
    }
    
}
