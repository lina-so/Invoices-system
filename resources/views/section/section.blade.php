@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  الاقسام</span>
						</div>
					</div>
			
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
 
				<!-- row -->
				<div class="row">
				<!-- <div class="row row-sm"> -->
			
				@if (session()->has('Add'))
				    <div class="alert alert-success alert-dismissible fade show" role="alert" style="padding:none;">
						<strong>{{session()->get('Add')}}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="close"> <span aria-hidden="true">&times;</span></button>
					</div>
					
				@endif

				@if (session()->has('Error'))
				    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="padding:none;">
						<strong>{{session()->get('Error')}}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="close"> <span aria-hidden="true">&times;</span></button>
					</div>
					
				@endif

				@if(session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
	
					<!--div-->
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافة قسم</a>

								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0"> اسم القسم</th>
												<th class="border-bottom-0">الملاحظات </th>
												<th class="border-bottom-0"> العمليات</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											@php
												$i=0
											@endphp
											@foreach ($sections as $x )
											@php
												$i++
											@endphp
											<tr>
												<td>{{$i}}</td>
												<td>{{$x->section_name}}</td>
												<td>{{$x->description}}</td>
												<td>

													<a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
													data-id="{{ $x->id }}" data-section_name="{{ $x->section_name }}"
													data-description="{{ $x->description }}" data-toggle="modal" href="#exampleModal2"
													title="تعديل"><i class="las la-pen"></i></a>

													<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
													data-id="{{ $x->id }}" data-section_name="{{ $x->section_name }}" data-toggle="modal"
													href="#modaldemo9" title="حذف"><i class="las la-trash"></i></a>

												</td>
												<td></td>
											
											</tr>
											@endforeach
											
										
										
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--/div-->

					<!--div-->
					<!-- <div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">Hoverable Rows Table</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 tx-gray-500 mb-2">Example of Valex Hoverable Rows Table.. <a href="">Learn more</a></p>
							</div>
							<div class="card-body">
								<div class="table-responsive hoverable-table">
									<button id="button" class="btn btn-primary mg-b-20">Delete selected row</button>
									<table id="example-delete" class="table text-md-nowrap">
										<thead>
											<tr>
												<th>Name</th>
												<th>Position</th>
												<th>Office</th>
												<th>Age</th>
												<th>Start date</th>
												<th>Salary</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Tiger Nixon</td>
												<td>System Architect</td>
												<td>Edinburgh</td>
												<td>61</td>
												<td>2011/04/25</td>
												<td>$320,800</td>
											</tr>
											<tr>
												<td>Garrett Winters</td>
												<td>Accountant</td>
												<td>Tokyo</td>
												<td>63</td>
												<td>2011/07/25</td>
												<td>$170,750</td>
											</tr>
											<tr>
												<td>Ashton Cox</td>
												<td>Junior Technical Author</td>
												<td>San Francisco</td>
												<td>66</td>
												<td>2009/01/12</td>
												<td>$86,000</td>
											</tr>
											<tr>
												<td>Cedric Kelly</td>
												<td>Senior Javascript Developer</td>
												<td>Edinburgh</td>
												<td>22</td>
												<td>2012/03/29</td>
												<td>$433,060</td>
											</tr>
											<tr>
												<td>Airi Satou</td>
												<td>Accountant</td>
												<td>Tokyo</td>
												<td>33</td>
												<td>2008/11/28</td>
												<td>$162,700</td>
											</tr>
											<tr>
												<td>Brielle Williamson</td>
												<td>Integration Specialist</td>
												<td>New York</td>
												<td>61</td>
												<td>2012/12/02</td>
												<td>$372,000</td>
											</tr>
											<tr>
												<td>Herrod Chandler</td>
												<td>Sales Assistant</td>
												<td>San Francisco</td>
												<td>59</td>
												<td>2012/08/06</td>
												<td>$137,500</td>
											</tr>
											<tr>
												<td>Rhona Davidson</td>
												<td>Integration Specialist</td>
												<td>Tokyo</td>
												<td>55</td>
												<td>2010/10/14</td>
												<td>$327,900</td>
											</tr>
											<tr>
												<td>Colleen Hurst</td>
												<td>Javascript Developer</td>
												<td>San Francisco</td>
												<td>39</td>
												<td>2009/09/15</td>
												<td>$205,500</td>
											</tr>
											<tr>
												<td>Sonya Frost</td>
												<td>Software Engineer</td>
												<td>Edinburgh</td>
												<td>23</td>
												<td>2008/12/13</td>
												<td>$103,600</td>
											</tr>
											<tr>
												<td>Jena Gaines</td>
												<td>Office Manager</td>
												<td>London</td>
												<td>30</td>
												<td>2008/12/19</td>
												<td>$90,560</td>
											</tr>
											<tr>
												<td>Quinn Flynn</td>
												<td>Support Lead</td>
												<td>Edinburgh</td>
												<td>22</td>
												<td>2013/03/03</td>
												<td>$342,000</td>
											</tr>
											<tr>
												<td>Charde Marshall</td>
												<td>Regional Director</td>
												<td>San Francisco</td>
												<td>36</td>
												<td>2008/10/16</td>
												<td>$470,600</td>
											</tr>
											<tr>
												<td>Haley Kennedy</td>
												<td>Senior Marketing Designer</td>
												<td>London</td>
												<td>43</td>
												<td>2012/12/18</td>
												<td>$313,500</td>
											</tr>
											<tr>
												<td>Tatyana Fitzpatrick</td>
												<td>Regional Director</td>
												<td>London</td>
												<td>19</td>
												<td>2010/03/17</td>
												<td>$385,750</td>
											</tr>
											<tr>
												<td>Michael Silva</td>
												<td>Marketing Designer</td>
												<td>London</td>
												<td>66</td>
												<td>2012/11/27</td>
												<td>$198,500</td>
											</tr>
											<tr>
												<td>Paul Byrd</td>
												<td>Chief Financial Officer (CFO)</td>
												<td>New York</td>
												<td>64</td>
												<td>2010/06/09</td>
												<td>$725,000</td>
											</tr>
											<tr>
												<td>Gloria Little</td>
												<td>Systems Administrator</td>
												<td>New York</td>
												<td>59</td>
												<td>2009/04/10</td>
												<td>$237,500</td>
											</tr>
											<tr>
												<td>Bradley Greer</td>
												<td>Software Engineer</td>
												<td>London</td>
												<td>41</td>
												<td>2012/10/13</td>
												<td>$132,000</td>
											</tr>
											<tr>
												<td>Dai Rios</td>
												<td>Personnel Lead</td>
												<td>Edinburgh</td>
												<td>35</td>
												<td>2012/09/26</td>
												<td>$217,500</td>
											</tr>
											<tr>
												<td>Jenette Caldwell</td>
												<td>Development Lead</td>
												<td>New York</td>
												<td>30</td>
												<td>2011/09/03</td>
												<td>$345,000</td>
											</tr>
											<tr>
												<td>Yuri Berry</td>
												<td>Chief Marketing Officer (CMO)</td>
												<td>New York</td>
												<td>40</td>
												<td>2009/06/25</td>
												<td>$675,000</td>
											</tr>
											<tr>
												<td>Caesar Vance</td>
												<td>Pre-Sales Support</td>
												<td>New York</td>
												<td>21</td>
												<td>2011/12/12</td>
												<td>$106,450</td>
											</tr>
											<tr>
												<td>Doris Wilder</td>
												<td>Sales Assistant</td>
												<td>Sidney</td>
												<td>23</td>
												<td>2010/09/20</td>
												<td>$85,600</td>
											</tr>
											<tr>
												<td>Angelica Ramos</td>
												<td>Chief Executive Officer (CEO)</td>
												<td>London</td>
												<td>47</td>
												<td>2009/10/09</td>
												<td>$1,200,000</td>
											</tr>
											<tr>
												<td>Gavin Joyce</td>
												<td>Developer</td>
												<td>Edinburgh</td>
												<td>42</td>
												<td>2010/12/22</td>
												<td>$92,575</td>
											</tr>
											<tr>
												<td>Jennifer Chang</td>
												<td>Regional Director</td>
												<td>Singapore</td>
												<td>28</td>
												<td>2010/11/14</td>
												<td>$357,650</td>
											</tr>
											<tr>
												<td>Brenden Wagner</td>
												<td>Software Engineer</td>
												<td>San Francisco</td>
												<td>28</td>
												<td>2011/06/07</td>
												<td>$206,850</td>
											</tr>
											<tr>
												<td>Fiona Green</td>
												<td>Chief Operating Officer (COO)</td>
												<td>San Francisco</td>
												<td>48</td>
												<td>2010/03/11</td>
												<td>$850,000</td>
											</tr>
											<tr>
												<td>Shou Itou</td>
												<td>Regional Marketing</td>
												<td>Tokyo</td>
												<td>20</td>
												<td>2011/08/14</td>
												<td>$163,000</td>
											</tr>
											<tr>
												<td>Michelle House</td>
												<td>Integration Specialist</td>
												<td>Sidney</td>
												<td>37</td>
												<td>2011/06/02</td>
												<td>$95,400</td>
											</tr>
											<tr>
												<td>Suki Burks</td>
												<td>Developer</td>
												<td>London</td>
												<td>53</td>
												<td>2009/10/22</td>
												<td>$114,500</td>
											</tr>
											<tr>
												<td>Prescott Bartlett</td>
												<td>Technical Author</td>
												<td>London</td>
												<td>27</td>
												<td>2011/05/07</td>
												<td>$145,000</td>
											</tr>
											<tr>
												<td>Gavin Cortez</td>
												<td>Team Leader</td>
												<td>San Francisco</td>
												<td>22</td>
												<td>2008/10/26</td>
												<td>$235,500</td>
											</tr>
											<tr>
												<td>Martena Mccray</td>
												<td>Post-Sales support</td>
												<td>Edinburgh</td>
												<td>46</td>
												<td>2011/03/09</td>
												<td>$324,050</td>
											</tr>
											<tr>
												<td>Unity Butler</td>
												<td>Marketing Designer</td>
												<td>San Francisco</td>
												<td>47</td>
												<td>2009/12/09</td>
												<td>$85,675</td>
											</tr>
											<tr>
												<td>Howard Hatfield</td>
												<td>Office Manager</td>
												<td>San Francisco</td>
												<td>51</td>
												<td>2008/12/16</td>
												<td>$164,500</td>
											</tr>
											<tr>
												<td>Hope Fuentes</td>
												<td>Secretary</td>
												<td>San Francisco</td>
												<td>41</td>
												<td>2010/02/12</td>
												<td>$109,850</td>
											</tr>
											<tr>
												<td>Vivian Harrell</td>
												<td>Financial Controller</td>
												<td>San Francisco</td>
												<td>62</td>
												<td>2009/02/14</td>
												<td>$452,500</td>
											</tr>
											<tr>
												<td>Timothy Mooney</td>
												<td>Office Manager</td>
												<td>London</td>
												<td>37</td>
												<td>2008/12/11</td>
												<td>$136,200</td>
											</tr>
											<tr>
												<td>Jackson Bradshaw</td>
												<td>Director</td>
												<td>New York</td>
												<td>65</td>
												<td>2008/09/26</td>
												<td>$645,750</td>
											</tr>
											<tr>
												<td>Olivia Liang</td>
												<td>Support Engineer</td>
												<td>Singapore</td>
												<td>64</td>
												<td>2011/02/03</td>
												<td>$234,500</td>
											</tr>
											<tr>
												<td>Bruno Nash</td>
												<td>Software Engineer</td>
												<td>London</td>
												<td>38</td>
												<td>2011/05/03</td>
												<td>$163,500</td>
											</tr>
											<tr>
												<td>Sakura Yamamoto</td>
												<td>Support Engineer</td>
												<td>Tokyo</td>
												<td>37</td>
												<td>2009/08/19</td>
												<td>$139,575</td>
											</tr>
											<tr>
												<td>Thor Walton</td>
												<td>Developer</td>
												<td>New York</td>
												<td>61</td>
												<td>2013/08/11</td>
												<td>$98,540</td>
											</tr>
											<tr>
												<td>Finn Camacho</td>
												<td>Support Engineer</td>
												<td>San Francisco</td>
												<td>47</td>
												<td>2009/07/07</td>
												<td>$87,500</td>
											</tr>
											<tr>
												<td>Serge Baldwin</td>
												<td>Data Coordinator</td>
												<td>Singapore</td>
												<td>64</td>
												<td>2012/04/09</td>
												<td>$138,575</td>
											</tr>
											<tr>
												<td>Zenaida Frank</td>
												<td>Software Engineer</td>
												<td>New York</td>
												<td>63</td>
												<td>2010/01/04</td>
												<td>$125,250</td>
											</tr>
											<tr>
												<td>Zorita Serrano</td>
												<td>Software Engineer</td>
												<td>San Francisco</td>
												<td>56</td>
												<td>2012/06/01</td>
												<td>$115,000</td>
											</tr>
											<tr>
												<td>Jennifer Acosta</td>
												<td>Junior Javascript Developer</td>
												<td>Edinburgh</td>
												<td>43</td>
												<td>2013/02/01</td>
												<td>$75,650</td>
											</tr>
											<tr>
												<td>Cara Stevens</td>
												<td>Sales Assistant</td>
												<td>New York</td>
												<td>46</td>
												<td>2011/12/06</td>
												<td>$145,600</td>
											</tr>
											<tr>
												<td>Hermione Butler</td>
												<td>Regional Director</td>
												<td>London</td>
												<td>47</td>
												<td>2011/03/21</td>
												<td>$356,250</td>
											</tr>
											<tr>
												<td>Lael Greer</td>
												<td>Systems Administrator</td>
												<td>London</td>
												<td>21</td>
												<td>2009/02/27</td>
												<td>$103,500</td>
											</tr>
											<tr>
												<td>Jonas Alexander</td>
												<td>Developer</td>
												<td>San Francisco</td>
												<td>30</td>
												<td>2010/07/14</td>
												<td>$86,500</td>
											</tr>
											<tr>
												<td>Shad Decker</td>
												<td>Regional Director</td>
												<td>Edinburgh</td>
												<td>51</td>
												<td>2008/11/13</td>
												<td>$183,000</td>
											</tr>
											<tr>
												<td>Michael Bruce</td>
												<td>Javascript Developer</td>
												<td>Singapore</td>
												<td>29</td>
												<td>2011/06/27</td>
												<td>$183,000</td>
											</tr>
											<tr>
												<td>Donna Snider</td>
												<td>Customer Support</td>
												<td>New York</td>
												<td>27</td>
												<td>2011/01/25</td>
												<td>$112,000</td>
											</tr>
										</tbody>
										<tfoot>
											<tr>
												<th>Name</th>
												<th>Position</th>
												<th>Office</th>
												<th>Age</th>
												<th>Start date</th>
												<th>Salary</th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					</div> -->
				</div>


					<!-- Basic modal -->
				<div class="modal" id="modaldemo8">
					<div class="modal-dialog" role="document">
						<div class="modal-content modal-content-demo">
							<div class="modal-header">
								<h6 class="modal-title">اضافة القسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<form action="{{route('sections.store')}}" method="post">
								{{csrf_field()}}

							<div class="modal-body">
								<div class="form-group">
									<label for="exampleInputEmaili">اسم القسم</label>
									<input type="text" class="form-control" id="section_name" name="section_name" required>
								</div>

								

							<div class="form-group">
								<label for="exampleInputEmaili"> ملاحظات</label>
								<textarea type="text" class="form-control" id="description" name="description" rows="3"></textarea>
							</div>

							</div>


							<div class="modal-footer">
								<button class="btn  btn-primary" type="submit">تأكيد</button>
								<button class="btn  btn-secondary" data-dismiss="modal" type="button">إغلاق</button>
							</div>
</form>
						</div>
					</div>
				</div>
		<!-- End Basic modal -->
				</div>

				  <!-- edit -->
				  <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">تعديل القسم</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form action="sections/update" method="post" autocomplete="off">
                                            {{method_field('patch')}}
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <input type="hidden" name="id" id="id" value="">
                                                <label for="recipient-name" class="col-form-label">اسم القسم:</label>
                                                <input class="form-control" name="section_name" id="section_name" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="col-form-label">ملاحظات:</label>
                                                <textarea class="form-control" id="description" name="description"></textarea>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">تاكيد</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    <!-- delete -->
                    <div class="modal" id="modaldemo9">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                                                   type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="sections/destroy" method="post">
                                    {{method_field('delete')}}
                                    {{csrf_field()}}
                                    <div class="modal-body">
                                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                        <input type="hidden" name="id" id="id" value="">
                                        <input class="form-control" name="section_name" id="section_name" type="text" readonly>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                        <button type="submit" class="btn btn-danger">تاكيد</button>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>

				<!-- row closed -->

			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>

<script>
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var section_name = button.data('section_name')
            var description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #section_name').val(section_name);
            modal.find('.modal-body #description').val(description);
        })
    </script>

    <script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var section_name = button.data('section_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #section_name').val(section_name);
        })
    </script>

@endsection