<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use DB;
use App\Models\invoices;
use App\Models\section;
use App\Models\products;
use Carbon\Carbon;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */



    public function home()
    {
        $count_all_invoices=invoices::count();
        $count_paid_invoices=invoices::where('Status','=','مدفوعة')->count()/invoices::count()*100;
        $count_unpaid_invoices=invoices::where('Status','=','غير مدفوعة')->count()/invoices::count()*100;
        $count_partial_invoices=invoices::where('Status','=','مدفوعة جزئيا')->count()/invoices::count()*100;





        $chartjs2 = app()->chartjs
         ->name('barChartTest')
         ->type('bar')
         ->size(['width' => 400, 'height' => 200])
         ->labels(['الفواتير'])
        //  ->labels(['الفواتير المدفوعة جزئيا','الفواتير المدفوعة', ' الفواتير الغير مدفوعة'])
         ->datasets([
            [
                "label" => "الفواتير المدفوعة جزئيا",
                'backgroundColor' => ['rgba(160, 89, 100, 0.6)'],
                'data' => [$count_partial_invoices,59]
            ],
             [
                 "label" => "الفواتير المدفوعة",
                 'backgroundColor' => ['rgba(220, 80, 10, 0.6)'],
                 'data' => [$count_paid_invoices,60]
             ],
             [
                 "label" => "الفواتير الغير المدفوعة",
                 'backgroundColor' => ['rgba(45, 99, 132, 0.6)'],
                 'data' => [$count_unpaid_invoices,50]
             ],
      
         ])
         ->options([]);


         $chartjs = app()->chartjs
        ->name('pieChartTest')
        ->type('pie')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['الفواتير المدفوعة', 'الفواتير غير المدفوعة'])
        ->datasets([
            [
                'backgroundColor' => ['red', 'blue'],
                'hoverBackgroundColor' => ['#FF6384', '#36A2EB'],
                'data' => [$count_paid_invoices, $count_unpaid_invoices]
            ]
        ])
        ->options([]);

        return view('index',compact('chartjs','chartjs2'));
    }

}
