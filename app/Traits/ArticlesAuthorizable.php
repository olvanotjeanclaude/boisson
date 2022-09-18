<?php

namespace App\Traits;

trait ArticlesAuthorizable{
    public function __construct(){
        $this->middleware('permission:view article')->only("index","show");
        $this->middleware('permission:create article')->only("create");
        $this->middleware('permission:edit article')->only("edit");
        $this->middleware('permission:delete article')->only("destroy");
    }
}
