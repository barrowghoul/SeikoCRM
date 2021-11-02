<div>
    <a href="{{ route('prospects.index') }}" class="btn btn-sm btn-danger">{{ __('Reject') }}</a>
    <div class="modal" tabindex="-1" id="exampleModal" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form method="post" action="{{ route('prospect.reject', $prospect) }}" autocomplete="off" enctype="multipart/form-data">
                @csrf
                @method('put')                
                <div class="modal-header">
                <h5 class="modal-title">{{ __('Reject')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">                
                    <div class="form-group text-center">
                        <textarea type="text" class="form-control" name="form-control" id="comment"></textarea>
                    </div>              
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-dismiss="modal">{{ __('Reject')}}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                </div>
            </form>
          </div>
        </div>
      </div>
</div>
