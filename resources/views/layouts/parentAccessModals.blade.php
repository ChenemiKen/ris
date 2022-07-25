{{-- parent access disable confirmation --}}
<!-- Modal -->
<div class="modal fade bd-example-modal-sm" id="parentAccessDisableModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">This will shut parents out of the portal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-style btn-sm" data-dismiss="modal">Cancel</button>
                <form action="{{route('parent_access')}}" method="post">
                    @csrf
                    <input type="text" name="parentLogin" id="" value=false hidden>
                    <button type="submit" class="btn-style btn-style-danger btn-lg">Proceed</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- parent access enable confirmation --}}
<!-- Modal -->
<div class="modal fade bd-example-modal-sm" id="parentAccessEnableModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">This will enable parents to login to the portal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-style btn-sm" data-dismiss="modal">Cancel</button>
                <form action="{{route('parent_access')}}" method="post">
                    @csrf
                    <input type="text" name="parentLogin" id="" value=true hidden>
                    <button type="submit" class="btn-style btn-style-danger">Proceed</button>
                </form>
            </div>
        </div>
    </div>
</div>