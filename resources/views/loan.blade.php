@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-2">
			<ul class="nav flex-column text-center">
				<li class="nav-item">
					<a class="nav-link" href="#">書籍登録</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('loan') }}">貸出許可</a>
				</li>
			</ul>
		</div>
		<div class="col-md-9">
			<div class="alert alert-secondary" role="alert">
				<strong>お知らせ</strong></br>書籍を貸し出しました。
			</div>
			<h3>
				貸出許可一覧
			</h3>
			<div class="" >
				<table class="table table-striped  table-hover" style="background-color:#FFFFFF;">
					<thead>
						<tr>
							<th>
								書籍
							</th>
							<th>
								申請者
							</th>
							<th>
								貸出期間
							</th>
							<th>
								許可
							</th>
							<th>
								状態
							</th>
						</tr>
					</thead>
					<tbody>
					@foreach($loan as $key => $val)
						<tr>
							<td>
								{{$val['title']}}
							</td>
							<td>
								{{$val['borrower_name']}}
							</td>
							<td>
								{{$val['loan_date']}}～{{$val['return_date']}}
							</td>
							<td>
								<div class="btn-group btn-group-sm" role="group">
									<form action="/loan" method="post">
										<input type="hidden" value="{{$val['book_owner_id']}}" id="book_owner_id" name="book_owner_id">
										{{ csrf_field() }}
										@if($val['loan_status'] == 0)
											<button class="btn btn-secondary" type="submit" value="2" id="loan_status" name="loan_status">
												OK
											</button>
											<button class="btn btn-secondary" type="submit" value="3" id="loan_status" name="loan_status">
												NG
											</button>
										@elseif($val['loan_status'] == 1)
											<button class="btn btn-secondary" type="submit" value="2" id="loan_status" name="loan_status"  disabled="disabled">
												OK
											</button>
											<button class="btn btn-secondary" type="submit" value="3" id="loan_status" name="loan_status" disabled="disabled">
												NG
											</button>
										@elseif($val['loan_status'] == 2)
											<button class="btn btn-secondary active" type="submit" value="2" id="loan_status" name="loan_status">
												OK
											</button>
											<button class="btn btn-secondary" type="submit" value="3" id="loan_status" name="loan_status">
												NG
											</button>
										@elseif($val['loan_status'] == 3)
											<button class="btn btn-secondary" type="submit" value="2" id="loan_status" name="loan_status">
												OK
											</button>
											<button class="btn btn-secondary active" type="submit" value="3" id="loan_status" name="loan_status">
												NG
											</button>
										@endif
									</form>
								</div>
							</td>
							<td>
								<form action="" method="post">
									@if($val['loan_status'] == 0)
										返却済
									@elseif($val['loan_status'] == 1)
										貸出中
									@elseif($val['loan_status'] == 2)
										貸出許可
									@elseif($val['loan_status'] == 3)
										貸出NG
									@endif
								</form>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
