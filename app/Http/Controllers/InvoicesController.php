<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\section;
use App\Models\products;
use App\Models\User;
use App\Models\invoices_details;
use App\Models\invoice_attachments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

use Illuminate\Http\Request;
use App\Notifications\AddInvoice;
use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Events\MyEventClass;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices=invoices::all();
        // dd($invoices);

        return view('invoices.invoices',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections=section::all();
        return view('invoices.add_invoice',compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     invoices::create([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
        ]);

        $invoice_id = invoices::latest()->first()->id;
        invoices_details::create([
            'id_Invoice' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'Section' => $request->Section,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);

        if ($request->hasFile('pic')) {

            $invoice_id = Invoices::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new invoice_attachments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->Created_by = Auth::user()->name;
            $attachments->invoice_id = $invoice_id;
            $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        }

        // send notification

        // $user = User::get();
        // $invoices = invoices::latest()->first();
        // Notification::send($user, new \App\Notifications\addInvoice($invoice_id));

     

        //notification
        $user=\App\Models\User::get();
        $invoices_last_add=invoices::latest()->first();

        // $details=[
        //     'greeting'=>'hi lina',
        //     'body'=>'this is a new invoices',
        //     'thanks'=>"thank you for visiting morasoft for invoices",
        // ];

        Notification::send($user, new \App\Notifications\Add_invoice_new($invoices_last_add));


        
        // event(new MyEventClass('hello world'));

        session()->flash('Add', 'تم اضافة الفاتورة بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show(invoices $invoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     $invoices=invoices::where('id',$id)->first();
     $sections=section::all();

     return view('invoices.edit_invoice',compact('invoices','sections'));
      
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($id);
        $invoice_edit=invoices::findOrFail($request->invoice_id);

        $invoice_edit->update([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
        ]);

        // $invoice_id = invoices::latest()->first()->id;
        // invoices_details::update([
        //     'id_Invoice' => $invoice_id,
        //     'invoice_number' => $request->invoice_number,
        //     'product' => $request->product,
        //     'Section' => $request->Section,
        //     'Status' => 'غير مدفوعة',
        //     'Value_Status' => 2,
        //     'note' => $request->note,
        //     'user' => (Auth::user()->name),
        // ]);

        // if ($request->hasFile('pic')) {

        //     $invoice_id = Invoices::latest()->first()->id;
        //     $image = $request->file('pic');
        //     $file_name = $image->getClientOriginalName();
        //     $invoice_number = $request->invoice_number;

        //     $attachments = new invoice_attachments();
        //     $attachments->file_name = $file_name;
        //     $attachments->invoice_number = $invoice_number;
        //     $attachments->Created_by = Auth::user()->name;
        //     $attachments->invoice_id = $invoice_id;
        //     $attachments->save();

        //     // move pic
        //     $imageName = $request->pic->getClientOriginalName();
        //     $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        // }



        session()->flash('edit', 'تم تعديل الفاتورة بنجاح');
        return back();
        
    }

    
    public function details($id)
    {
        $invoice_info=invoices::where('id',$id)->first();
    
        $invoice_status=DB::select('select * from invoices_details where id_Invoice = ?',[$id]);
        $invoice_attachment=DB::select('select * from invoice_attachments where invoice_id = ?',[$id]);

        

        return view('invoices.invoices_details',compact('invoice_info','invoice_status','invoice_attachment','id'));

    }

    public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("product_name", "id");
        return json_encode($products);
    }

    public function status_update($id){
        $invoices=invoices::where('id',$id)->first();
        $sections=section::all();

        return view('invoices.status_update',compact('invoices','sections'));
   }

   public function status($id, Request $request)
   {
       $invoices = invoices::findOrFail($id);

       if ($request->Status === 'مدفوعة') {

           $invoices->update([
               'Value_Status' => 1,
               'Status' => $request->Status,
               'Payment_Date' => $request->Payment_Date,
           ]);

           invoices_details::create([
               'id_Invoice' => $request->invoice_id,
               'invoice_number' => $request->invoice_number,
               'product' => $request->product,
               'Section' => $request->Section,
               'Status' => $request->Status,
               'Value_Status' => 1,
               'note' => $request->note,
               'Payment_Date' => $request->Payment_Date,
               'user' => (Auth::user()->name),
           ]);
       }

       else {
           $invoices->update([
               'Value_Status' => 3,
               'Status' => $request->Status,
               'Payment_Date' => $request->Payment_Date,
           ]);
           invoices_details::create([
               'id_Invoice' => $request->invoice_id,
               'invoice_number' => $request->invoice_number,
               'product' => $request->product,
               'Section' => $request->Section,
               'Status' => $request->Status,
               'Value_Status' => 3,
               'note' => $request->note,
               'Payment_Date' => $request->Payment_Date,
               'user' => (Auth::user()->name),
           ]);
       }
       session()->flash('Status_Update');
       return redirect('/invoices');

   }

   public function Invoice_Paid()
   {
       $invoices = Invoices::where('Value_Status', 1)->get();
       return view('invoices.invoices_paid',compact('invoices'));
   }

   public function Invoice_unPaid()
   {
       $invoices = Invoices::where('Value_Status',2)->get();
       return view('invoices.invoices_unpaid',compact('invoices'));
   }

   public function Invoice_Partial()
   {
       $invoices = Invoices::where('Value_Status',3)->get();
       return view('invoices.invoices_Partial',compact('invoices'));
   }


   public function print_invoice($id){
       $invoices=invoices::where('id',$id)->first();
    
       return view('invoices.invoice_print',compact('invoices'));
   }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $invoices=invoices::where('id',$id)->first();

        $details=invoice_attachments::where('invoice_id',$id)->first();

        $id_page=$request->id_page;

        if(!$id_page==2)
        {
            if(!empty($details->invoice_number)){
                Storage::disk('public_uploads')->deleteDirectory($details->invoice_number);
            }
    
            $invoices->forceDelete();
            session()->flash('delete_invoice');
            return back();
        }
        else{
            $invoices->delete();
            session()->flash('archive_invoice');
            return back();
        }

       
      
    }

    public function export() 
    {
        return Excel::download(new InvoicesExport, 'invoices.xlsx');
    }

    public function mark_all(){
        $userUnreadNotification=auth()->user()->unreadNotifications;

        if($userUnreadNotification){
            $userUnreadNotification->markAsRead();
            return back();
        }
    }
}
