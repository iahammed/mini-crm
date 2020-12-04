@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form 
    @if(isset($transaction))
        action = "{{ route('transaction.update', $transaction->id) }}"
    @else
        action = "{{ route('transaction.store') }}"
    @endif
    method = "POST"
    >
    @csrf
    @if(isset($transaction))
        @method('PUT')
    @endif
    
    <div class="form-group">
        <label for="date">Date</label>
        <input class="form-control" 
               type="date"
               name = "transaction_date" 
               value = "@$transaction->transaction_date ?  $transaction->transaction_date : ''"
               placeholder="Date" 
               id="date">
    </div>
    <div class="form-group">
        <label for="client">Select list:</label>
        <select class="form-control" id="client" name = "client_id">
            @foreach($clients as $client)
            <option value="{{ $client->id }}">{{ $client->fullname }}</option>
            @endforeach

        </select>
    </div>
    <div class="form-group">
        <label for="amt">Amount</label>
        <input class="form-control" 
               type="number" 
               name = "amount"
               value = "{{ @$transaction->amount ?  $transaction->amount : 0}}"
               placeholder="Enter Amount" 
               id="amt">
    </div>
    <button type="submit" class="btn btn-primary" name ="submit" value="Deposit">Deposit</button>
    <button type="submit" class="btn btn-primary" name ="submit" value="Withdraw">Withdraw</button>
</form>
