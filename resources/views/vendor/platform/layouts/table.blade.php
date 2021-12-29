<style>
   table {
   width: 100%;
 
   word-wrap: keep-all;
}


    .nodisplay{
        display: none;
    }
</style>

@empty(!$title)
    <fieldset>
            <div class="col p-0 px-3">
                <legend class="text-black">
                    {{ $title }}
                </legend>
            </div>
    </fieldset>
@endempty

<div class="bg-white rounded shadow-sm mb-3"
     data-controller="table"
     data-table-slug="{{$slug}}"
>


    <div class="table-responsive">
        <table @class([
            'table',
            'table-striped'  => $striped,
            'table-bordered' => $bordered,
            'table-hover'    => $hoverable,
       ])>
            <thead>
                <tr>
                    @foreach($columns as $column)
                        {!! $column->buildTh() !!}
                    @endforeach
                </tr>
            </thead>
            <tbody>
            @if (!is_null($rows))
                @foreach($rows as $source)
                    <tr>
                        @foreach($columns as $column)
                            {!! $column->buildTd($source) !!}
                        @endforeach
                    </tr>
                @endforeach
            @endif
           

            @if($total->isNotEmpty())
                <tr>
                    @foreach($total as $column)
                        {!! $column->buildTd($repository) !!}
                    @endforeach
                </tr>
            @endif

            </tbody>
        </table>
    </div>

    @if(($rows instanceof \Illuminate\Contracts\Pagination\Paginator || $rows instanceof \Illuminate\Contracts\Pagination\CursorPaginator || $rows instanceof \Illuminate\Support\Collection) && $rows->isEmpty())
        <div class="text-center py-5 w-100">
            <h3 class="fw-light">
                @isset($iconNotFound)
                    <x-orchid-icon :path="$iconNotFound" class="block m-b"/>
                @endisset


                {!!  $textNotFound !!}
            </h3>

            {!! $subNotFound !!}
        </div>
    @endif

    @includeWhen(($rows instanceof \Illuminate\Contracts\Pagination\Paginator || $rows instanceof \Illuminate\Contracts\Pagination\CursorPaginator) && $rows->isNotEmpty(),
        'platform::layouts.pagination',[
            'paginator' => $rows,
            'columns' => $columns,
            'onEachSide' => $onEachSide,
        ])
</div>

<script>

$("table tbody tr").each(function() {
        let cell = $.trim($(this).find('td').text());
        if (cell.length == 0){
            console.log('Empty cell');
            $(this).addClass('nodisplay');
        }
});
</script>
