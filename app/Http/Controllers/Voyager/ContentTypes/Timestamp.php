<?php

namespace App\Http\Controllers\Voyager\ContentTypes;

use Carbon\Carbon;

class Timestamp extends BaseType
{
    public function handle()
    {
        if (!in_array($this->request->method(), ['PUT', 'POST'])) {
            return;
        }

        $content = $this->request->input($this->row->field);

        if (empty($content)) {
            return;
        }

        return Carbon::parse($content);
    }
}
