<!-- Modal -->
<div class="modal fade" id="transaction_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Remove Transaction(s)</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				{!! Form::open(['action' => ['TransactionController@destroy'], 'method' => 'Delete', 'id' => 'removeTransForm', 'class' => 'row']) !!}

					<div class="">
						<button type="submit" class="btn btn-lg indigo">Remove Transactions</button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
