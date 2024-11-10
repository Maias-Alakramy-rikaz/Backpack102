@extends(backpack_view('blank'))

@section('content')
<div id="app">
    <meta charset="utf-8">
    {{-- ChartStyle --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <main class="py-4">
        <div class="container">
            <div class="card rounded">
                <div class="card-body py-3 px-3">
                    {!! $teachersChart->container() !!}
                </div>
            </div>
        </div>
    </main>
</div>

    {{-- Chartscript --}}
    @if($teachersChart)
    {!! $teachersChart->script() !!}
    @endif
@endsection
