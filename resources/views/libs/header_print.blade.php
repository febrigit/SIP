    <div class="row">
        <div class="col-2">
            <img src="{{asset('img/logo.png')}}" width="100px" height="100px">
        </div>
        <div class="col text-left pt-2 pl-4 text-center">
            <b>
                @if(isset($program))<span>{{ strtoupper($program) }}</span><br>@endif
                <span>{{ $title ?? '' }}</span><br>
                </b>
        </div>
        <div class="col-3 pt-2">
            <small>YAYASAN PEMBANGUNAN CITRA INSAN INDONESIA<br></small>
            <small>Ruko Royal No.11, Sawangan Permai Jl. Muchtar Raya, Sawangan Depok 16511 Phone / Fax : (0221) 22779688</small><br>
        </div>
    </div>