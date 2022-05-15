<?php
namespace Core;

class Controller
{
	/*
	 * @model -> new instance of the base Model class 
	 */
	
    protected $model;

    public function __construct()
    {
        $this->model = new Model();
    }
}
