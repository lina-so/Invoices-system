@extends('layouts.master')
@section('css')
<!---Internal  Prism css-->
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<!---Internal Input tags css-->
<link href="{{URL::asset('assets/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
<!--- Custom-scroll -->
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">معلومات الفاتورة</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{$invoice_info->invoice_number}}</span>
						</div>
					</div>
			
				</div>
				<!-- breadcrumb -->
@endsection
		@section('content')

          @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

			<!-- row -->
			<div class="row">

                 <div class="panel panel-primary tabs-style-3">
	<div class="tab-menu-heading">
		<div class="tabs-menu ">
			<!-- Tabs -->
			<ul class="nav panel-tabs">
				<li class=""><a href="#tab11" class="active" data-toggle="tab"><i class="fa fa-laptop"></i>معلومات الفاتورة</a></li>
				<li><a href="#tab12" data-toggle="tab"><i class="fa fa-cube"></i> حالات الفاتورة</a></li>
				<li><a href="#tab13" data-toggle="tab"><i class="fa fa-cogs"></i> المرفقات</a></li>
				
			</ul>
		</div>
	</div>
	<div class="panel-body tabs-menu-body">
		<div class="tab-content">
			<div class="tab-pane active" id="tab11">
                 <div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0">رقم الفاتورة</th>
												<th class="border-bottom-0">تاريخ الفاتورة</th>
												<th class="border-bottom-0">تاريخ الاستحقاق</th>
												<th class="border-bottom-0">المنتج</th>
												<th class="border-bottom-0">القسم</th>
												<th class="border-bottom-0">الخصم</th>
												<th class="border-bottom-0">نسبة الضريبة</th>
												<th class="border-bottom-0">قيمة الضريبة</th>
												<th class="border-bottom-0">الاجمالي</th>
												<th class="border-bottom-0">الحالة</th>
												<th class="border-bottom-0">الملاحظات</th>


								
											</tr>
										</thead>
										<tbody>
										@php
										$i=0;
										@endphp
										@php
										$i++;
										@endphp
											<tr>
												<td>{{$i}}</td>
												<td>{{$invoice_info->invoice_number}}</td>
												<td>{{$invoice_info->invoice_Date}}</td>
												<td>{{$invoice_info->Due_date}}</td>
												<td>{{$invoice_info->product}}</td>
												<td><a href="#">{{$invoice_info->section_id}}</a></td>
												<td>{{$invoice_info->Discount}}</td>
												<td>{{$invoice_info->Rate_VAT}}</td>
												<td>{{$invoice_info->Value_VAT}}</td>

												<td>{{$invoice_info->Total}}</td>
												<td>
													@if($invoice_info->Value_Status==1)
													<span class="text-success">{{$invoice_info->Status}}</span>
													@elseif($invoice_info->Value_Status==2)
													<span class="text-danger">{{$invoice_info->Status}}</span>
													@else
													<span class="text-warning">{{$invoice_info->Status}}</span>
													@endif


												</td>
		
												<td>{{$invoice_info->note}}</td>
												
												
											</tr>
										
										
										</tbody>
									</table>
								</div>
							</div>
			</div>

			<div class="tab-pane" id="tab12">
                  <div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0">رقم الفاتورة</th>
											
												<th class="border-bottom-0">المنتج</th>
												<th class="border-bottom-0">القسم</th>
                                                <th class="border-bottom-0">الحالة</th>
												<th class="border-bottom-0">الملاحظات</th>

												<th class="border-bottom-0">اسم المستخدم</th>
												<th class="border-bottom-0"> تاريخ الانشاء</th>
												<th class="border-bottom-0"> تاريخ التعديل</th>
											
											</tr>
										</thead>
										<tbody>
										@php
										$i=0;
										@endphp
										@foreach($invoice_status as $info)
										@php
										$i++;
										@endphp
											<tr>
												<td>{{$i}}</td>
												<td>{{$info->invoice_number}}</td>
												<td>{{$info->product}}</td>
												<td><a href="#">{{$info->Section}}</a></td>
                                                	<td>
													@if($info->Value_Status==1)
													<span class="text-success">{{$info->Status}}</span>
													@elseif($info->Value_Status==2)
													<span class="text-danger">{{$info->Status}}</span>
													@else
													<span class="text-warning">{{$info->Status}}</span>
													@endif


												</td>
		
												<td>{{$info->note}}</td>


												<td>{{$info->user}}</td>
												<td>{{$info->created_at}}</td>
												<td>{{$info->updated_at}}</td>

											
											
												
												
											</tr>
											@endforeach
										
										
										</tbody>
									</table>
								</div>
							</div>
         	</div>






<div class="tab-pane" id="tab13">
	<div class="card-body">
		<p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
		<h5 class="card-title">اضافة مرفقات</h5>
		<form method="post" action="{{route('InvoiceAttachments.store')}}"
			enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="custom-file">
				<input type="file" class="custom-file-input" id="customFile"
					name="file_name" required>
				<input type="hidden" id="customFile" name="invoice_number"
					value="{{ $invoice_info->invoice_number }}">
				<input type="hidden" id="invoice_id" name="invoice_id"
					value="{{ $invoice_info->id }}">
				<label class="custom-file-label" for="customFile">حدد
					المرفق</label>
			</div><br><br>
			<button type="submit" class="btn btn-primary btn-sm "
				name="uploadedFile">تاكيد</button>
		</form>
	</div>

        <br>

                 <div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0">رقم الفاتورة</th>
												<th class="border-bottom-0"> اسم المستخدم</th>
												<th class="border-bottom-0"> تاريخ الانشاء</th>
												<th class="border-bottom-0">تاريخ التعديل</th>
												<th class="border-bottom-0"> العمليات</th>
											</tr>
										</thead>
										<tbody>
										@php
										$i=0;
										@endphp
										@foreach($invoice_attachment as $info)
										@php
										$i++;
										@endphp
											<tr>
												<td>{{$i}}</td>
												<td>{{$info->invoice_number}}</td>
												<td>{{$info->Created_by}}</td>
												<td>{{$info->created_at}}</td>
												<td>{{$info->updated_at}}</td>

                                                <td colspan="2">

                                                    <a class="btn btn-outline-success btn-sm"
                                                        href="{{ url('View_file') }}/{{ $invoice_info->invoice_number }}/{{ $info->file_name }}"
                                                        role="button"><i class="fas fa-eye"></i>&nbsp;
                                                        عرض</a>

                                                    <a class="btn btn-outline-info btn-sm"
                                                        href="{{ url('download') }}/{{ $invoice_info->invoice_number }}/{{ $info->file_name }}"
                                                        role="button"><i
                                                            class="fas fa-download"></i>&nbsp;
                                                        تحميل</a>

                                                        <button class="btn btn-outline-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-file_name="{{ $info->file_name }}"
                                                            data-invoice_number="{{ $info->invoice_number }}"
                                                            data-id_file="{{ $info->id }}"
                                                            data-target="#delete_file">حذف</button>

                                                            </td>
										
											</tr>
											@endforeach
										
										
										</tbody>
									</table>
								</div>
							</div>
			</div>
		
		</div>
	</div>
</div>



			</div>
				<!-- row closed -->


     <!-- delete -->
    <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('delete_file') }}" method="post">

                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p class="text-center">
                        <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                        </p>

                        <input type="hidden" name="id_file" id="id_file" value="">
                        <input type="hidden" name="file_name" id="file_name" value="">
                        <input type="hidden" name="invoice_number" id="invoice_number" value="">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Jquery.mCustomScrollbar js-->
<script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- Internal Input tags js-->
<script src="{{URL::asset('assets/plugins/inputtags/inputtags.js')}}"></script>
<!--- Tabs JS-->
<script src="{{URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js')}}"></script>
<script src="{{URL::asset('assets/js/tabs.js')}}"></script>
<!--Internal  Clipboard js-->
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>
<!-- Internal Prism js-->
<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>

<script>
        $('#delete_file').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_file = button.data('id_file')
            var file_name = button.data('file_name')
            var invoice_number = button.data('invoice_number')
            var modal = $(this)
            modal.find('.modal-body #id_file').val(id_file);
            modal.find('.modal-body #file_name').val(file_name);
            modal.find('.modal-body #invoice_number').val(invoice_number);
        })
    </script>
@endsection