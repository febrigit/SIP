<div class="btn-group float-right ml-3">
    <button type="button" class="btn btn-outline-warning btn-sm btn-flat rounded-pill" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa-solid fa-circle-info"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-right">
        @if($data->createdBy)<div class="dropdown-item"> <span class="badge badge-success">C</span> | {{$data->createdBy->name}} <small>- {{ $data->created_at ? \App\Helpers::dateTimeFormat($data->created_at, "datetime") : ''}}</small></div> @endif
        @if($data->updatedBy)<div class="dropdown-item"> <span class="badge badge-primary">U</span> | {{$data->updatedBy->name}} <small>- {{ $data->updated_at ? \App\Helpers::dateTimeFormat($data->updated_at, "datetime") : ''}}</small></div> @endif
    </div>
</div>