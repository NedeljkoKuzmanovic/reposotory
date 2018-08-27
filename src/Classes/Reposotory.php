<?php

namespace NedeljkoKuzmanovic\Reposotory\Classes;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;

abstract class Reposotory {

    private $app;

    protected $model; //Defines default model for this Reposotory

    /**
     * Returns name of model class
     * @var string
     */
    public abstract function model() : string;

    /**
     * [__construct description]
     * @param App $app [description]
     */
    public function __construct(App $app){
        $this->app = $app;
        $this->setModel();
    }

    /**
     * Sets defined model
     */
    protected function setModel(){
        $model = $this->app->make('\App\\' . $this->model());

        if (!$model instanceof Model)
            abort(500, "Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->model = $model;
    }

    /**
     * get Reposotory Model
     * @return Model [description]
     */
    protected function getModel() : Model {
        return $this->model;
    }

    /**
     * generic method for creating record in Reposotory model
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function create(Request $request){
        $this->getModel()->create($request);
    }

    /**
     * Update existing record
     * @param  Request $reuquest  [description]
     * @param  int     $id        [description]
     * @param  string  $attribute [description]
     * @return [type]             [description]
     */
    public function update(Request $reuquest, int $id, string $attribute="id"){
        return $this->getModel()->where($attribute, '=', $id)->update($data);
    }

    /**
     * [delete description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete(int $id) {
        return $this->model->destroy($id);
    }

}
