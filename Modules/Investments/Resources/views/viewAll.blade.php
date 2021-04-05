@extends('dashboard::layouts.master')

@section('content')
    @if(count($investments) > 0 )
    @include('core::table',[
    $title = 'Investment Table',
    $description = 'Manage all investments activities',
    $fieldlists = ['id','title','price','proposed_amount','status'],
    $modeldata = $investments,
    $addButton = 'data-toggle="modal" data-target="#addInvestment"'
])
<!-- Add plan -->
    <div class="modal fade" id="addInvestment">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Investment Plan:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/investments/createInvestment">
                        @csrf
                        <div class="form-group">
                            <label for="input">Title</label>
                            <input class="form-control" type="text" id="input" name="title" placeholder="Enter title" value="" autocomplete="on" />
                        </div>
                        <div class="form-group">
                            <label for="input">Proposed Amount</label>
                            <input class="form-control" type="number" id="input" min="1" name="proposed_amount" placeholder="Enter Proposed amount" value="" autocomplete="on" />
                        </div>
                        <div class="form-group">
                            <label for="input">Price</label>
                            <input class="form-control" type="number" min="1" id="input" name="price" placeholder="Enter amount" value="" autocomplete="on" />
                        </div>

                        <div class="form-group">

                            <input class="form-control btn btn-outline-success" type="submit"/>
                        </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

         @else
        <script>
            alert('No investments plan added currently')
        </script>
    @endif
@endsection
