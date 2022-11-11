<?php

namespace App\Http\Controllers;


use App\Models\invoices;
use App\Models\section;
use App\Models\products;
use Illuminate\Http\Request;

class invoices_ReportController extends Controller
{
    public function index(){
        return view('reports.invoices_report');
    }

    public function Search_invoices(Request $request){
        // dd($request);

        $rdio = $request->rdio;
    
    
     // في حالة البحث بنوع الفاتورة
        
        if ($rdio == 1) {
           
           
     // في حالة عدم تحديد تاريخ
            if ($request->type && $request->start_at =='' && $request->end_at =='') {
                
               $invoices = invoices::select('*')->where('Status','=',$request->type)->get();
               $type = $request->type;
               return view('reports.invoices_report',compact('type'))->withDetails($invoices);
            }
            
            // في حالة تحديد تاريخ استحقاق
            else {
                // dd($request);
               
              $start_at = date($request->start_at);
              $end_at = date($request->end_at);
              $type = $request->type;
              
              $invoices = invoices::whereBetween('Due_date',[$start_at,$end_at])->where('Status','=',$request->type)->get();
              return view('reports.invoices_report',compact('type','start_at','end_at'))->withDetails($invoices);
              
            }
    
     
            
        } 
        
    //====================================================================
        
    // في البحث برقم الفاتورة
        else {
            
            $invoices = invoices::select('*')->where('invoice_number','=',$request->invoice_number)->get();
            return view('reports.invoices_report')->withDetails($invoices);
            
        }
    
        
         
        }


    public function customers_report()
    {
        $sections=section::all();
        return view('reports.customers_report',compact('sections'));
    }

    public function customres_search(Request $request){

        // dd($request);
        $start_at = date($request->start_at);
        $end_at = date($request->end_at);
        $sections=section::all();

        $product=$request->product;
        $section=$request->Section;

        
        $invoices = invoices::whereBetween('Due_date',[$start_at,$end_at])->where('section_id','=',$request->Section)->where('product','=',$request->product)->get();
        // dd($section);
        return view('reports.customers_report',compact('start_at','end_at','sections','section'))->withDetails($invoices);
    }
}
