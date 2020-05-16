<?php

use Carbon\Carbon;

function totalLeadCM()
{
    return \App\LeadTracker::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('lead_count');
}

function totalEarnCM()
{
    return \App\LeadTracker::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('earn');
}

function totalLeadByUser($user_id)
{

    $sheetWorkersId = \App\SheetWorker::where('user_id', $user_id)->pluck('id')->toArray();
    return \App\LeadTracker::whereIn('sheet_worker_id', $sheetWorkersId)->sum('lead_count');
}

function totalEarnByUser($user_id)
{
    $sheetWorkersId = \App\SheetWorker::where('user_id', $user_id)->pluck('id')->toArray();
    return \App\LeadTracker::whereIn('sheet_worker_id', $sheetWorkersId)->sum('earn');
}

function worksOnSheet($user_id, $month)
{
    return $sheetWorkersId = \App\SheetWorker::where('user_id', $user_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', $month)->count();
}

function leadByMonthUser($user_id, $month)
{
    $sheetWorkersId = \App\SheetWorker::where('user_id', $user_id)->pluck('id')->toArray();
    return \App\LeadTracker::whereIn('sheet_worker_id', $sheetWorkersId)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', $month)->sum('lead_count');
}

function earnByMonthUser($user_id, $month)
{
    $sheetWorkersId = \App\SheetWorker::where('user_id', $user_id)->pluck('id')->toArray();
    return \App\LeadTracker::whereIn('sheet_worker_id', $sheetWorkersId)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', $month)->sum('earn');
}
