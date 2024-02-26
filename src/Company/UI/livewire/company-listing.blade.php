
<div>
    <h2>Company Listing</h2>
    @foreach($companies as $company)
        <div class="block">
            <div>{{ $company['id'] }}</div>
            <div>{{ $company['name'] }}</div>
            <div>{{ $company['description'] }}</div>
            <div>{{ $company['address'] }}</div>
            <div>{{ $company['industry'] }}</div>
            <div>{{ $company['currency'] }}</div>
            <div>{{ $company['dividend_per_share'] }}</div>
            <div>{{ $company['last_50_days_avg'] }}</div>
        </div>
    @endforeach
</div>
