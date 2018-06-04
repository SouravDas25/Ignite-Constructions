<?php

namespace App\Http\Controllers\Voyager\ContentTypes;

class Relationship extends BaseType
{
    /**
     * @return string
     */
    public function handle()
    {
        return $this->request->input($this->row->field);
    }
}
