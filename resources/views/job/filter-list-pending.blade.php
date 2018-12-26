   <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
  <script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>

  <script>
    $(document).ready(function() {
      $('#datatable').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [5, 10, 15, -1],
          [5, 10, 15, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search records",
        }

      });
  </script>

  <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="text-center">Bil</th>
                      <th class="text-center">Booking Number</th>
                      <th class="text-center">Customer Name</th>
                      <th class="text-center">Service</th>
                      <th class="text-center">Date Booking</th>
                      <th class="disabled-sorting text-center">Current Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php $i = 1;?>
                      @foreach($jobrequest as $key=>$data)
                    <tr>
                      <td class="text-center">{{$i++}}</td>
                      <td class="text-center">{{$data->booking_id}}</td>
                      <td class="text-center">{{$data->name}}</td>
                      <td class="text-center">{{$data->service}}</td>
                      <td class="text-center">{{date('d M Y', strtotime($data->date_booking))}}</td>
                      <td class="text-center">
                        {{$data->status_job}}
                      </td>
                       <td class="text-center">
                         <a href="{{route('detailJobView',['booking_id'=>$data->booking_id])}}" class="btn btn-sm btn-success">View</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
  </table>