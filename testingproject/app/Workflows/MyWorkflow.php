<?php

use Workflow\ActivityStub;
use Workflow\Workflow;

class MyWorkflow extends Workflow
{
    public function execute()
    {
        $result = yield ActivityStub::make(MyActivity::class);

        return $result;
    }
}
