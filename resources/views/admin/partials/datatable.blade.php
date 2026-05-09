{{--
    Reusable Yajra DataTable container.

    Required vars:
      $id          string  unique table id
      $ajaxUrl     string  data endpoint (server-side)
      $columns     array   list of ['data' => 'col', 'name' => 'col', 'title' => 'Title', 'orderable' => true|false, 'searchable' => true|false]
      $orderColumn int     default 0
      $orderDir    string  default 'desc'
--}}
<div class="card border-0 shadow-sm">
  <div class="card-body">
    <div class="table-responsive">
      <table id="{{ $id }}"
             class="table table-striped table-hover align-middle yajra-datatable"
             data-ajax-url="{{ $ajaxUrl }}"
             data-order-col="{{ $orderColumn ?? 0 }}"
             data-order-dir="{{ $orderDir ?? 'desc' }}"
             data-columns='@json($columns)'
             style="width: 100%;">
        <thead>
          <tr>
            @foreach ($columns as $col)
              <th>{{ $col['title'] ?? $col['data'] }}</th>
            @endforeach
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
