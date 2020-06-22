<?php

use Carbon\Carbon;

function month($month, $year = '')
{
    if ($year == '') {
        $year = date('Y');
    }
    if (date('d') > 25) {
        $month = $month + 1;
        if ($month == 13) {
            $month = 1;
        }
    }

    switch ($month) {
        case 1:
            $m = $year - 1 . '-12-26' . ',' . $year . '-01-25';
            break;
        case 2:
            $m = $year . '-01-26' . ',' . $year . '-02-25';
            break;
        case 3:
            $m = $year . '-02-26' . ',' . $year . '-03-25';
            break;
        case 4:
            $m = $year . '-03-26' . ',' . $year . '-04-25';
            break;
        case 5:
            $m = $year . '-04-26' . ',' . $year . '-05-25';
            break;
        case 6:
            $m = $year . '-05-26' . ',' . $year . '-06-25';
            break;
        case 7:
            $m = $year . '-06-26' . ',' . $year . '-07-25';
            break;
        case 8:
            $m = $year . '-07-26' . ',' . $year . '-08-25';
            break;
        case 9:
            $m = $year . '-08-26' . ',' . $year . '-09-25';
            break;
        case 10:
            $m = $year . '-09-26' . ',' . $year . '-10-25';
            break;
        case 11:
            $m = $year . '-10-26' . ',' . $year . '-11-25';
            break;
        case 12:
            $m = $year . '-11-26' . ',' . $year . '-12-25';
            break;
        default:
            $m = null;
            break;
    }

    return explode(",", $m);
}

function totalEarn()
{
    return \App\LeadTracker::all()->sum('earn');
}

function totalLead()
{
    return \App\LeadTracker::all()->sum('lead_count');
}

function totalLeadCM()
{
    return \App\LeadTracker::whereBetween('date', month(date('m')))->sum('lead_count');
}

function totalEarnCM()
{
    return \App\LeadTracker::whereBetween('date', month(date('m')))->sum('earn');
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
    return $sheetWorkersId = \App\SheetWorker::where('user_id', $user_id)->whereBetween('created_at', month($month))->count();
}

function worksOnSheetByDate($user_id, $dateFrom, $dateTo)
{
    return $sheetWorkersId = \App\SheetWorker::where('user_id', $user_id)->whereBetween('created_at', [$dateFrom, $dateTo])->count();
}

function leadByMonthUser($user_id, $month)
{
    $sheetWorkersId = \App\SheetWorker::where('user_id', $user_id)->pluck('id')->toArray();
    return \App\LeadTracker::whereIn('sheet_worker_id', $sheetWorkersId)->whereBetween('date', month($month))->sum('lead_count');
}

function leadByDateUser($user_id, $dateFrom, $dateTo)
{
    $sheetWorkersId = \App\SheetWorker::where('user_id', $user_id)->whereBetween('created_at', [$dateFrom, $dateTo])->pluck('id')->toArray();
    return \App\LeadTracker::whereIn('sheet_worker_id', $sheetWorkersId)->sum('lead_count');
}

function earnByMonthUser($user_id, $month)
{
    $sheetWorkersId = \App\SheetWorker::where('user_id', $user_id)->pluck('id')->toArray();
    return \App\LeadTracker::whereIn('sheet_worker_id', $sheetWorkersId)->whereBetween('date', month($month))->sum('earn');
}

function earnByDateUser($user_id, $dateFrom, $dateTo)
{
    $sheetWorkersId = \App\SheetWorker::where('user_id', $user_id)->whereBetween('created_at', [$dateFrom, $dateTo])->pluck('id')->toArray();
    return \App\LeadTracker::whereIn('sheet_worker_id', $sheetWorkersId)->sum('earn');
}

function totalEarnBySheet($sheetId)
{
    $sheetWorkersId = \App\SheetWorker::where('sheet_id', $sheetId)->pluck('id')->toArray();
    return \App\LeadTracker::whereIn('sheet_worker_id', $sheetWorkersId)->sum('earn');
}

function totalLeadBySheet($sheetId)
{
    $sheetWorkersId = \App\SheetWorker::where('sheet_id', $sheetId)->pluck('id')->toArray();
    return \App\LeadTracker::whereIn('sheet_worker_id', $sheetWorkersId)->sum('lead_count');
}


function totalEarnBySheetUser($sheetId, $user_id)
{
    $sheetWorkersId = \App\SheetWorker::where('user_id', $user_id)->where('sheet_id', $sheetId)->pluck('id')->toArray();
    return \App\LeadTracker::whereIn('sheet_worker_id', $sheetWorkersId)->sum('earn');
}

function totalLeadBySheetUser($sheetId, $user_id)
{
    $sheetWorkersId = \App\SheetWorker::where('user_id', $user_id)->where('sheet_id', $sheetId)->pluck('id')->toArray();
    return \App\LeadTracker::whereIn('sheet_worker_id', $sheetWorkersId)->sum('lead_count');
}


function getUserRate($sheet_id, $user_id)
{
    $sheetWorker =  \App\SheetWorker::where('user_id', $user_id)->where('sheet_id', $sheet_id)->first();
    return $sheetWorker ? $sheetWorker->rate : 0;
}

/** Total */

function earnByDateUserSheets($user_id, $sheets, $dateFrom, $dateTo)
{
    $sheetWorkersId = \App\SheetWorker::where('user_id', $user_id)->whereIn('sheet_id', $sheets)->whereBetween('created_at', [$dateFrom, $dateTo])->pluck('id')->toArray();
    return \App\LeadTracker::whereIn('sheet_worker_id', $sheetWorkersId)->sum('earn');
}

function leadByDateUserSheet($user_id, $sheets, $dateFrom, $dateTo)
{
    $sheetWorkersId = \App\SheetWorker::where('user_id', $user_id)->whereIn('sheet_id', $sheets)->whereBetween('created_at', [$dateFrom, $dateTo])->pluck('id')->toArray();
    return \App\LeadTracker::whereIn('sheet_worker_id', $sheetWorkersId)->sum('lead_count');
}


function checkBill($url)
{
    $murl = str_replace(env('APP_URL'), "", $url);

    return $bill = App\Bill::where('report_url', $murl)->first();
}
