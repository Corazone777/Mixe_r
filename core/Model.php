<?php
namespace Core;

class Model
{
	/*
	 * @db-> new instance of the Database object
	 */
    protected $db;

    public function __construct()
    {
        $this->db = new Database;
    }
}
