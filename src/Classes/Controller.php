<?php

namespace NedeljkoKuzmanovic\Reposotory\Classes;

use App\Http\Controllers\Controller as LaravelController;
use NedeljkoKuzmanovic\Reposotory\Classes\Reposotory;
use Illuminate\Container\Container as App;

abstract class Controller extends LaravelController
{
    private $app;
    protected $reposotory;
    /**
     * Return Reposotory Class name
     * @var [type]
     */
    protected abstract function reposotory() : string;
    /**
     * [__construct description]
     * @param App $app [description]
     */
    public function __construct(App $app){
        $this->app = $app;
        $this->setReposotory();
    }
    /**
     * [setReposotory description]
     */
    protected function setReposotory(){
        $reposotory = $this->app->make('\App\Reposotories\\' . $this->reposotory());

        if (!$reposotory instanceof Reposotory){
            abort(500, "Class {$this->reposotory()} must be an instance of NedeljkoKuzmanovic\\Reposotory\\Classes\\Reposotory");
        }

        return $this->reposotory = $reposotory;
    }
    /**
     * [getReposotory description]
     * @return Reposotory [description]
     */
    protected function getReposotory() : Reposotory {
        return $this->reposotory;
    }
}
