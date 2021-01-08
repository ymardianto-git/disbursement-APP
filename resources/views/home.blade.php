@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card panel-info">
                <div class="card-header">
                <h4 class="card-title my-20 float-left">List 
                  <a class="btn btn-success ml-5" href="javascript:void(0)" id="createDisburse">Create</a>
                </h4>
            </div>
                <div class="card-body">
                    <table class="table table-bordered disburse-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Transaction Id</th>
                            <th>Account Number</th>
                            <th>Bank Code</th>
                            <th>Amount</th>
                            <th>Remark</th>
                            <th>Created At</th>
                            <th>Time served</th>
                            <th>Receipt</th>
                             <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>


     <div class="modal fade" id="ajaxModel" aria-hidden="true">
          <div class="modal-dialog">

             <div class="modal-content">
                <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading"></h4>
                              <button type="button" class="close" data-dismiss="modal">
                    &times;</button>
                </div>

                <div class="modal-body">
                        <form id="disburseForm" name="disburseForm" class="form-horizontal">
                           <input type="hidden" name="id" id="id">
                            <input type="hidden" name="transaction_id" id="transaction_id">
                            <div class="form-group">
                                <label for="name" class="col-sm-4 control-label">Bank Code</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="bank_code" name="bank_code" placeholder="Enter Bank Code" value="" maxlength="50" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Account Number</label>
                                <div class="col-sm-12">
                                     <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Enter Account Number" value="" maxlength="50" required="">
                                </div>
                            </div>

                             <div class="form-group">
                                <label class="col-sm-4 control-label">Amount</label>
                                <div class="col-sm-12">
                                     <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Amount" maxlength="50" required="">
                                </div>
                            </div>

                               <div class="form-group">
                                <label class="col-sm-4 control-label">Remark</label>
                               <div class="col-sm-12">
                                    <textarea id="remark" name="remark" required="" placeholder="" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-offset-2 col-sm-10">
                             <button type="submit" class="btn btn-success" id="saveBtn" value="create">Submit
                             </button>
                            </div>
                        </form>
                    </div>

             </div>
          </div>
     </div>

</div>

@endsection
