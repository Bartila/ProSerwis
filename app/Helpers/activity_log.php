<?php
// app/Helpers/activity_log.php
use App\Models\ActivityLog;

function log_activity($action, $modelType = null, $modelId = null, $description = null)
{
    \App\Models\ActivityLog::create([
        'user_id'    => auth()->id(),
        'action'     => $action,
        'model_type' => $modelType,
        'model_id'   => $modelId,
        'description'=> $description,
    ]);
}
