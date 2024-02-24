@extends('userlayout')

@section('content')
    <!-- Page content -->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">



                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="modal fade" id="modal-formp" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="mb-0 font-weight-bolder">{{__('Delete Account')}}</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('delaccount')}}" method="post">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                        <textarea type="text" name="reason" class="form-control" rows="5"
                                                  placeholder="{{__('Sorry to see you leave, Please tell us why you are leaving')}}"
                                                  required></textarea>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-neutral btn-block">{{__('Delete
                                        account')}}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modal-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                         aria-hidden="true">
                        <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">

                        </div>
                    </div>
                </div>
            </div>
@stop
