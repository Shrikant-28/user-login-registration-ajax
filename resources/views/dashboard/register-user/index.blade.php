@extends('dashboard.app')


@section('cssExtend')
     <link href="{{ asset('assets/jqdata-table/css/jquery.dataTables.min.css') }}"  rel="stylesheet" />
     <link href="{{ asset('assets/jqdata-table/css/buttons.dataTables.min.css') }}" rel="stylesheet" />
@endsection

@section('content')

    <div class="container">
        <div class="bg-main-content">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered display nowrap" style="width:100%" id="data_table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>City</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $row)
                                <tr>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->phone_number}}</td>
                                    <td>{{$row->city}}</td>
                                    <td><a href="#"
                                        data-name="{{$row->name}}"
                                        data-phone_number="{{$row->phone_number}}"
                                        data-city="{{$row->city}}"
                                        data-gender="{{$row->gender}}"
                                        data-signup_for_letters="{{$row->signup_for_letters}}"
                                        class="viewDetails">View</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center">No Record Found</td>
                                    <td style="display: none"></td>
                                    <td style="display: none"></td>
                                    <td style="display: none"></td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>City</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="container modal-container">

                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>


  @section('jsExtend')
    <script src= "{{ asset('assets/jqdata-table/js/jquery.dataTables.min.js')}}"></script>
    <script src= "{{ asset('assets/jqdata-table/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src= "{{ asset('assets/jqdata-table/js/dataTables.buttons.min.js')}}"></script>
    <script src= "{{ asset('assets/jqdata-table/js/jszip.min.js')}}"></script>
    <script src= "{{ asset('assets/jqdata-table/js/pdfmake.min.js')}}"></script>
    <script src= "{{ asset('assets/jqdata-table/js/vfs_fonts.js')}}"></script>
    <script src= "{{ asset('assets/jqdata-table/js/buttons.html5.min.js')}}"></script>
    <script src= "{{ asset('assets/jqdata-table/js/buttons.print.min.js')}}"></script>
    <script>
        $('#data_table').DataTable({
        // dom: 'Bfrtip',
        // buttons: [
        //     'copy', 'csv', 'excel', 'pdf', 'print'
        // ],
        order: [],
        });

        $("#data_table").on("click", ".viewDetails", function(){
       // $(".viewDetails").on('click',function() {

        // $(".viewDetails").click(function(){
            var name = $(this).data('name');
            var phone_number = $(this).data('phone_number');
            var city = $(this).data('city');
            var gender = $(this).data('gender');
            var signup_for_letters = $(this).data('signup_for_letters') == 1 ? "Yes" : "No";

            $(".modal-title").html(name);

            var str = `

            <div class="row mt-2">
                <div class="col-md-6"><b>Phone Number</b></div>
                <div class="col-md-6">${phone_number}</div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6"><b>City</b></div>
                <div class="col-md-6">${city}</div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6"><b>Gender</b></div>
                <div class="col-md-6">${gender}</div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6"><b>Signup for News Letter</b></div>
                <div class="col-md-6">${signup_for_letters}</div>
            </div>
            `;

            $(".modal-container").html(str);

            $('#exampleModal').modal('show');
        })
    </script>
@endsection


@endsection
